<?php

include_once('dis-setting/connection.php');


if (!empty($_POST)) {
    mysqli_begin_transaction($contdb);

    $fname = mysqli_real_escape_string($contdb, trim($_POST['Firstname']));
    $lname = mysqli_real_escape_string($contdb, trim($_POST['lname']));
    $email = mysqli_real_escape_string($contdb, trim($_POST['emailid']));
    $mobile = mysqli_real_escape_string($contdb, trim($_POST['mobileno']));
    $password = md5(trim($_POST['password']));
    $customerType = $_POST['customerType'];
  //  $customerTypeStr = mysqli_real_escape_string($contdb, implode(",", $customerType));

    $response = []; 
    $session_id = '0';
    $cookies = '0';
    $user_type = 'customer';
    $user_status = '0';

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($mobile) && !empty($password) && !empty($customerType)) {

        $email_check_query = "SELECT * FROM userlogntable WHERE user_email = '$email'";
        $result = mysqli_query($contdb, $email_check_query);

        if (mysqli_num_rows($result) > 0) {
            $response['status'] = 'error';
            $response['message'] = 'Email ID already exists. Please use another email.';
            echo json_encode($response);
            exit;
        }

        $sing_val_data = str_replace(" ", "-", $fname) . '-' . str_replace(" ", "-", $lname);
        $auto_num = uniqid();
        $shaffauto = str_shuffle($auto_num . $email);

        try {
            $insert_user_query = "INSERT INTO userlogntable (user_first_name, user_email, user_lastname, user_mobileno, user_password, user_session_id, user_cookies, user_type, user_status, user_auto) 
            VALUES ('$fname', '$email', '$lname', '$mobile', '$password', '$session_id', '$cookies', '$user_type', '$user_status', '$shaffauto')";
            
            if (!mysqli_query($contdb, $insert_user_query)) {
                throw new Exception('Error inserting into userlogntable: ' . mysqli_error($contdb));
            }

            $insert_customer_query = "INSERT INTO customer (customer_fname, customer_lname, customer_name_url, customer_ui_id, customer_img, customer_address, customer_gender, customer_age, customer_phone, customer_email, customer_auto, customer_date, customer_time, customer_active, customer_type) 
            VALUES ('$fname', '$lname', '$sing_val_data', '$shaffauto', '0', '0', '0', '0', '$mobile', '$email', '$auto_num', NOW(), NOW(), '1', '$customerType')";

            if (!mysqli_query($contdb, $insert_customer_query)) {
                throw new Exception('Error inserting into customer: ' . mysqli_error($contdb));
            }

            mysqli_commit($contdb);
                include_once('phpmailer/customer-email.php');
            $response['status'] = 'success';
            $response['message'] = 'Registration successfully';
            echo json_encode($response);

        } catch (Exception $e) {
            mysqli_rollback($contdb);
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
            echo json_encode($response);
        }
    }
}


?>


