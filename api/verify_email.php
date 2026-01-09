<?php
include_once('../config_db/conn_connect.php');
$conn = conndata();
session_start();
header("Content-Type: application/json");
try {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['user_email'] ?? '';

    if (empty($email)) {
        echo json_encode([
            "status" => 400,
            "message" => "Email Id is required"
        ]);
        exit;
    }
    $checkSql = $conn->prepare("
        SELECT user_type 
        FROM userlogntable 
        WHERE user_email = ?
    ");
    $checkSql->bind_param("s", $email);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userType = $row['user_type'];

        echo json_encode([
            "status" => 409,
            "message" => "This email is already registered as $userType. Please use a different Email ID."
        ]);
        exit;
    }

    echo json_encode([
        "status" => 200
    
    ]);


} catch (Exception $e) {

    echo json_encode([
        "status" => 500,
        "message" => "Something went wrong. Please try again later.",
        "error" => $e->getMessage() // 🔸 remove in production for security
    ]);
    exit;
}
