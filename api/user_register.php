<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);*/

include_once('../config_db/conn_connect.php');
$conn = conndata();

header("Content-Type: application/json");

// Read JSON Input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
$fname   = trim($data['fname']   ?? '');
$lname   = trim($data['lname']   ?? '');
$email   = trim($data['email']   ?? '');
$mobile  = trim($data['mobile']  ?? '');
$address = trim($data['address'] ?? '');
$pincode   = trim($data['pincode'] ?? '');
$district  = trim($data['district'] ?? '');
$state     = trim($data['state'] ?? '');
$areaname      = trim($data['Name'] ?? '');        // <-- Post Office Name
$country   = trim($data['country'] ?? '');

function generatePassword() {
    return ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3)) 
           . '@' 
           . substr(str_shuffle('0123456789'), 0, 4);
}
$new_pass = generatePassword();

if ($fname == ""  || $email == "" || $mobile == "" || $address == "" || $pincode == "") {
    echo json_encode([
        "status" => 400,
        "message" => "All fields are required"
    ]);
    exit;
}
if ($pincode == "" || strlen($pincode) != 6) {
    echo json_encode([
        "status" => 400,
        "message" => "Valid 6 digit pincode required"
    ]);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "status" => 422,
        "message" => "Invalid email format"
    ]);
    exit;
}

if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
    echo json_encode([
        "status" => 400,
        "message" => "Invalid mobile number. Must be 10 digits and start with 6-9."
    ]);
    exit;
}

$hashed_password = md5($new_pass);


$auto_num     = uniqid();
$customer_url = strtolower(str_replace(" ", "-", $fname . "-" . $lname));
$unique_user  = md5(uniqid() . $email);

// Check duplicate email
$email_check = $conn->prepare("SELECT user_email AS email
FROM userlogntable
WHERE user_email = ?
  AND user_type = 'customer'

UNION

SELECT customer_email AS email
FROM customer
WHERE customer_email = ?");
$email_check->bind_param("ss", $email, $email);
$email_check->execute();
if ($email_check->get_result()->num_rows > 0) {
    echo json_encode(["status" => 409, "message" => "Email already exists"]);
    exit;
}

// Check duplicate mobile in both tables
$mobile_check = $conn->prepare("SELECT user_mobileno AS mobile 
FROM userlogntable 
WHERE user_mobileno = ? 
  AND user_type = 'customer'

UNION

SELECT customer_phone AS mobile
FROM customer 
WHERE customer_phone = ?");
$mobile_check->bind_param("ss", $mobile, $mobile);
$mobile_check->execute();
if ($mobile_check->get_result()->num_rows > 0) {
    echo json_encode(["status" => 409, "message" => "Mobile already exists"]);
    exit;
}

$conn->begin_transaction();
try {


    $sql1 = $conn->prepare("
        INSERT INTO userlogntable 
        (user_first_name, user_lastname, user_email, user_mobileno, user_password, user_session_id, user_cookies, user_type, user_status, user_auto)
        VALUES (?, ?, ?, ?, ?, '0', '0', 'customer', '0', ?)");
    $sql1->bind_param("ssssss", $fname, $lname, $email, $mobile, $hashed_password, $unique_user);

    if (!$sql1->execute()) {
        throw new Exception("User insert failed");
    }

  $sql2 = $conn->prepare("
    INSERT INTO customer 
    (
        customer_fname, customer_lname, customer_name_url, customer_ui_id,
        customer_img, customer_address, customer_country, customer_state
        ,customer_area,customer_city, customer_pincode, customer_gender, customer_age,
        customer_phone, customer_email, customer_auto,
        customer_date, customer_time, customer_active, customer_type
    )
    VALUES (?, ?, ?, ?, '0', ?, ?, ?,?, ?, ?, '0', '0', ?, ?, ?, NOW(), NOW(), '1', 'Retail Customer')
");

if (!$sql2) {
    die(json_encode([
        "status" => "error",
        "message" => "SQL Prepare Failed: " . $conn->error
    ]));
}

$sql2->bind_param(
    "sssssssssssss",
    $fname,                    
    $lname,                    
    $customer_url,             
    $unique_user,              
    $address,                  
    $country,   
    $state,      
    $areaname,
     $district,
    $pincode,                  
    $mobile,                   
    $email,                    
    $auto_num                 
);
    if (!$sql2->execute()) {
        throw new Exception("Customer insert failed");
    }
    $conn->commit();
    echo json_encode([
        "status" => 200,
        "message" => "Registration successfully"
    ]);

} catch (Exception $e) {

    $conn->rollback();

    echo json_encode([
        "status" => 400,
        "message" => $e->getMessage()
    ]);
}
