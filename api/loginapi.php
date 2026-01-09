<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);*/

include_once('../config_db/conn_connect.php');
$conn = conndata();
session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$identifier = $data['identifier'] ?? '';
$password   = md5($data['password'] ?? '');

$chking_user_status = "
    SELECT * FROM userlogntable 
    WHERE 
        (user_email='$identifier' 
        OR user_mobileno='$identifier') 
    AND user_status='0'
    LIMIT 1
";

$query_user_status = $conn->query($chking_user_status);

if ($query_user_status->num_rows == 0) {
    echo json_encode([
        "status" => 404,
        "message" => "User not found or inactive"
    ]);
    exit;
}
$chking_user_chking = "
    SELECT * FROM userlogntable 
    WHERE 
        (user_email='$identifier' 
        OR user_mobileno='$identifier') 
        AND user_password='$password'
        AND user_status='0'
    LIMIT 1
";
$query = $conn->query($chking_user_chking);
if ($query->num_rows == 0) {
    echo json_encode([
        "status" => 401,
        "message" => "Incorrect password"
    ]);
    exit;
}
$user = $query->fetch_assoc();
if ($user['user_type'] != "customer") {
    echo json_encode([
        "status" => 403,
        "message" => "Only customers can login"
    ]);
    exit;
}

echo json_encode([
    "status" => 200,
    "message" => "Login successful",
    "user" => [
        "user_id"     => $user['user_auto'],
        "fname"   => $user['user_first_name'],
        "lname"   => $user['user_lastname'],
        "email"  => $user['user_email'],
        "mobile" => $user['user_mobileno']
    ]
]);

?>

