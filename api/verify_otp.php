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

$otp    = $data['otp'] ?? '';

$update_pass =md5($otp);
if (empty($otp)) {
    echo json_encode([
        "status" => 400,
        "message" => "Password are required"
    ]);
    exit;
}

/* -----------------------------
   1. Check from DATABASE
------------------------------*/
$checkSql = $conn->prepare("
    SELECT user_auto, user_first_name, user_lastname, user_mobileno, user_email, user_password, password_expiry 
    FROM userlogntable 
    WHERE user_password = ? AND user_type = 'customer'
");
$checkSql->bind_param("s", $update_pass);
$checkSql->execute();
$result = $checkSql->get_result();


if ($result->num_rows == 0) {
    echo json_encode([
        "status" => 404,
        "message" => "Incorrect password. Please try again"
    ]);
    exit;
}

$user = $result->fetch_assoc();

if ($user['user_password'] !== $update_pass) {
    echo json_encode([
        "status" => 401,
        "message" => "Invalid Password"
    ]);
    exit;
}

// Check OTP expiry
$current_time = date("Y-m-d H:i:s");

if ($current_time > $user['password_expiry']) {
    echo json_encode([
        "status" => 408,
        "message" => "Password expired. Please request a new one."
    ]);
    exit;
}

echo json_encode([
    "status" => 200,
    "message" => "Password Verified Successfully",
    "fname"  =>$user['user_first_name'],
    "lname"  =>$user['user_lastname'],
     "mobile"  =>$user['user_mobileno'],
      "email"  =>$user['user_email'],
    "user_id" => $user['user_auto'],
    
]);
?>
