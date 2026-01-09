<?php 
include_once('../config_db/conn_connect.php');
$conn = conndata();

session_start();
header("Content-Type: application/json");
// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

$mobile = $data['mobile'] ?? '';

if (empty($mobile)) {
    echo json_encode(["status" => 400, "message" => "Mobile number is required"]);
    exit;
}

// Static OTP return for this number only
if ($mobile == '9811742810') {
    $sql = $conn->prepare("SELECT user_otp, user_first_name FROM userlogntable WHERE user_mobileno = ? LIMIT 1");
    $sql->bind_param("s", $mobile);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $otp = $row['user_otp'];
        $name = $row['user_first_name'] ?: "User";

        // SMS message
        $message = "Hi $name, Your OTP for mobile verification is $otp. Use this code to complete the process. Don't share it with anyone. Best, Team Sarvodaya";

        $api_url = "https://http.myvfirst.com/smpp/sendsms";
        $fields = [
            "username" => "trtruckhttp",
            "password" => "InEEdtrUck@1",
            "to"      => $mobile,
            "from"    => "TSSVPL",
            "text"    => $message,
            "dlr-mask" => "19"
        ];

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_response = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($sms_response === false) {
            echo json_encode([
                "status" => 500,
                "message" => "SMS API failed",
                "error" => $curl_error
            ]);
            exit;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Existing OTP sent successfully",
            "mobile" => $mobile,
            "otp" => $otp, // remove in production
            "sms_api" => $sms_response
        ]);
        exit;
    } else {
        echo json_encode([
            "status" => 404,
            "message" => "Mobile number not found"
        ]);
        exit;
    }
}

// OTP generator
function generatePassword() {
    return ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3)) 
           . '@' 
           . substr(str_shuffle('0123456789'), 0, 4);
}

$otp = generatePassword();
$newpass = md5($otp);
$expiry_time = date("Y-m-d H:i:s", strtotime("+2 minutes"));

// Check user exists
$check = $conn->prepare("
    SELECT user_auto, user_first_name 
    FROM userlogntable 
    WHERE user_mobileno=? AND user_type='customer'
");
$check->bind_param("s", $mobile);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["status" => 404, "message" => "Mobile number not found"]);
    exit;
}

$user = $result->fetch_assoc();
$user_id = $user['user_auto'];
$name = $user['user_first_name'] ?: "User";

// Update password & OTP
$update = $conn->prepare("
    UPDATE userlogntable 
    SET user_password=?, user_otp=?, password_expiry=? 
    WHERE user_auto=?
");
$update->bind_param("ssss", $newpass, $otp, $expiry_time, $user_id);
$update->execute();

// SMS body
$message = "Hi $name, Your OTP for mobile verification is $otp. Use this code to complete the process. Don't share it with anyone. Best, Team Sarvodaya";

$api_url = "https://http.myvfirst.com/smpp/sendsms";

$fields = [
    "username" => "trtruckhttp",
    "password" => "InEEdtrUck@1",
    "to"      => $mobile,
    "from"    => "TSSVPL",
    "text"    => $message,
    "dlr-mask" => "19"
];

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$sms_response = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

// Check CURL Fail
if ($sms_response === false) {
    echo json_encode([
        "status" => 500,
        "message" => "SMS API failed",
        "error" => $curl_error
    ]);
    exit;
}

// Final successful response
echo json_encode([
    "status" => 200,
    "message" => "OTP sent successfully",
    "mobile" => $mobile,
    "otp" => $otp,            // ❗ REMOVE IN PRODUCTION
    "sms_api" => $sms_response,
    "user_id" => $user_id
]);
exit;

?>
