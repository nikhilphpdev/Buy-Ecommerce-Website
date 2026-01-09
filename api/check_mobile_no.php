<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

*/

include_once('../config_db/conn_connect.php');
$conn = conndata();
session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$mobile = $data['mobile'] ?? '';

if (empty($mobile)) {
    echo json_encode([
        "status" => 400,
        "message" => "Mobile number is required"
    ]);
    exit;
}

$uSql = $conn->prepare("SELECT user_auto, user_type FROM userlogntable WHERE user_mobileno = ?");
$uSql->bind_param("s", $mobile);
$uSql->execute();
$uRes = $uSql->get_result();

// IF mobile number exists
if ($uRes && $uRes->num_rows > 0) {

    $uRow = $uRes->fetch_assoc();
    $userType = $uRow['user_type'];

    // Block vendor or subvendor
    if ($userType == 'vendor' || $userType == 'subvendor') {
        echo json_encode([
            "status" => 409,
            "message" => "This mobile number is already registered as $userType. Please use a different number."
        ]);
        exit;
    }

    // Allow customer login
    if ($userType == 'customer') {

        $_SESSION['customer_id'] = $uRow['user_auto'];
        $_SESSION['mobile'] = $mobile;

        echo json_encode([
            "status" => 200,
            "message" => "Mobile No. exists",
            "session_id" => session_id(),
            "user_id" => $uRow['user_auto']
        ]);
        exit;
    }
}

echo json_encode([
    "status" => 201,
    "message" => "Mobile number is new, you can register"
]);
exit;
?>
