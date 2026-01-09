<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);*/

session_start();
include_once('../config_db/conn_connect.php');
$conn = conndata();

header("Content-Type: application/json");

// Receive JSON RAW body
$data = json_decode(file_get_contents("php://input"), true);

$bill_number = $data['bill_number'] ?? '';
$user_id     = $data['user_id'] ?? '';
$image       = $data['image'] ?? ''; // base64 image

if (!$user_id) {
    echo json_encode(["status" => 401, "message" => "User not logged in"]);
    exit;
}

if ($bill_number == "") {
    echo json_encode(["status" => 400, "message" => "Bill number is required"]);
    exit;
}

// Base64 Image Handling
if (strpos($image, "data:image") === 0) {
    $image = explode(",", $image)[1];
}
$decodedImage = base64_decode($image);
if (!$decodedImage) {
    echo json_encode(["status" => 400, "message" => "Invalid image"]);
    exit;
}
$fileName = "lucky_" . time() . "_" . rand(1000,9999) . ".png";
if (!is_dir("../luckydraw")) mkdir("../luckydraw", 0777, true);
file_put_contents("../luckydraw/".$fileName, $decodedImage);


// 0⃣ Check bill number already exists
$checkBill = $conn->prepare("
    SELECT id, customer_ui_id ,luckydraw_code 
    FROM customer_luckydraw
    WHERE bill_number = ?
     AND status IN (0,1,3)
    LIMIT 1
");
$checkBill->bind_param("s", $bill_number);
$checkBill->execute();
$resBill = $checkBill->get_result();

if ($resBill->num_rows > 0) {
    $rowBill = $resBill->fetch_assoc();

    echo json_encode([
        "status" => 409,
        "message" => "This bill number is already used.",
         "bill_number" => $bill_number,
         "luckydraw_code" => $rowBill['luckydraw_code'],
         "customer_ui_id" => $rowBill['customer_ui_id'],
         "image_url" => "https://testing.buyjee.com/luckydraw/"
    ]);
    exit;
}

/* =====================================================
   1️⃣ — Check if user already approved
===================================================== */
$check = $conn->prepare("
    SELECT id, bill_number, luckydraw_code, status
    FROM customer_luckydraw
    WHERE customer_ui_id = ?
    ORDER BY id DESC
    LIMIT 1
");
$check->bind_param("s", $user_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    switch ((int)$row['status']) {

        case 1: // Approved
            echo json_encode([
                "status" => 400,
                "message" => "Lucky Draw has already been approved.",
                "bill_number" => $row['bill_number'],
                "luckydraw_code" => $row['luckydraw_code'],
                "customer_ui_id" => $user_id,
                "image_url" => "https://testing.buyjee.com/luckydraw/"
            ]);
            exit;

        case 0: // Pending
        case 3: // Re-apply
            echo json_encode([
                "status" => 409,
                "message" => "You have already applied for Lucky Draw.",
                "bill_number" => $row['bill_number'],
                "luckydraw_code" => $row['luckydraw_code'],
                "customer_ui_id" => $user_id,
                "image_url" => "https://testing.buyjee.com/luckydraw/"
            ]);
            exit;
    }
}


/* =====================================================
   2️⃣ — Check if user has any existing record
===================================================== */
$checkUser = $conn->prepare("
    SELECT id,customer_ui_id, luckydraw_code, status 
    FROM customer_luckydraw
    WHERE customer_ui_id = ?
     AND status IN (2,3)
    ORDER BY id DESC
    LIMIT 1
");
$checkUser->bind_param("s", $user_id);
$checkUser->execute();
$result = $checkUser->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_id = $row['customer_ui_id'];
    $existing_code = $row['luckydraw_code'];

    // If status = 0 or NULL → allow update
    if ($row['status'] == 2 || $row['status'] == 3 ) {
        $status = 3; // pending / processing
        $sale_type = 'winter sale';
        $update = $conn->prepare("
            UPDATE customer_luckydraw
            SET bill_number = ?, image = ?, status = ?, sale_type = ?, updated_at = NOW()
            WHERE customer_ui_id = ?
        ");
        $update->bind_param("ssiss", $bill_number, $fileName, $status, $sale_type ,$existing_id);
        $update->execute();

        echo json_encode([
            "status" => 202,
            "message" => "Lucky Draw has been re-applied successfully",
            "bill_number" => $bill_number,
            "luckycode" => $existing_code,
            "customer_ui_id"=>$existing_id,
            "image_url" => "https://testing.buyjee.com/luckydraw/".$fileName
        ]);
        exit;
    }

   /* // Status = 1 → Already approved (should not happen here because of first check)
    echo json_encode([
        "status" => 400,
        "message" => "You have already Approved Lucky Draw.---"
    ]);
    exit;*/
}


/* =====================================================
   3️⃣ — Insert new record if no existing user record
===================================================== */
function generateUniqueCoupon($conn, $prefix = "BUYJEE", $length = 4) {
    do {
        $code = $prefix . str_pad(rand(0, pow(10,$length)-1), $length, '0', STR_PAD_LEFT);
        $check = $conn->prepare("SELECT luckydraw_code FROM customer_luckydraw WHERE luckydraw_code = ?");
        $check->bind_param("s", $code);
        $check->execute();
        $result = $check->get_result();
    } while ($result->num_rows > 0);
    return $code;
}

$luckycode = generateUniqueCoupon($conn);


$insert = $conn->prepare("
    INSERT INTO customer_luckydraw (customer_ui_id, luckydraw_code, bill_number, image, sale_type, status)
    VALUES (?, ?, ?, ?, 'winter sale', 0)
");
$insert->bind_param("ssss", $user_id, $luckycode, $bill_number, $fileName);

if ($insert->execute()) {
    echo json_encode([
        "status" => 200,
        "message" => "Lucky Draw inserted successfully",
        "bill_number" => $bill_number,
        "luckycode" => $luckycode,
        "customer_ui_id"=>$user_id,
        "image_url" => "https://testing.buyjee.com/luckydraw/".$fileName
    ]);
} else {
    echo json_encode([
        "status" => 500,
        "message" => "DB insert failed"
    ]);
}

?>
