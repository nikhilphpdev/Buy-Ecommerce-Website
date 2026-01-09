<?php
header('Content-Type: application/json');
include('../dis-setting/config-settings/config.php');


/*Product SKU */

try {
    if (isset($_POST['sku'])) {

        $sku = trim($_POST['sku']);
        $product_id = isset($_POST['product_id']) ? ($_POST['product_id']) : 0;

        if ($product_id > 0) {
            // Edit mode → Skip current product
            $query = "SELECT COUNT(*) as count FROM all_product WHERE product_sku = '$sku' AND product_auto_id != '$product_id'";
        } else {
            // Add mode
            $query = "SELECT COUNT(*) as count FROM all_product WHERE product_sku = '$sku'";
        }

        $result = mysqli_query($contdb, $query);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            $count = $data['count'];

            if ($count > 0) {
                echo json_encode(['exists' => true]);
                exit;
            } else {
                echo json_encode(['exists' => false]);
                exit;
            }
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    exit;
}


try {
      if(isset($_POST['customer_id'])){
         
    $fname    = $_POST['edit-fname'] ?? '';
    $lname    = $_POST['edit-lname'] ?? '';
    $email    = $_POST['edit-email'] ?? '';
    $age      = $_POST['edit-age'] ?? '';
    $gender   = $_POST['edit-gender'] ?? '';
    $phone    = $_POST['edit-phone'] ?? '';
    $address  = $_POST['edit-address'] ?? '';
    $city     = $_POST['edit-city'] ?? '';
    $state    = $_POST['edit-state'] ?? '';
    $pincode  = $_POST['edit-pincode'] ?? '';
    $country  = $_POST['edit-country'] ?? '';
    $customer_id = $_POST['customer_id']; 

    $profile_img = null;

    if (isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
        $targetDir = "../images/";
        $fileName = time() . "_" . basename($_FILES['profile_image']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
            $profile_img = $fileName;
        } else {
            throw new Exception("Image upload failed.");
        }
    }
 
// Check Email in both tables
$checkEmail = "
    SELECT 'customer' AS source FROM customer 
    WHERE customer_email = '$email' AND customer_ui_id != '$customer_id'
    UNION
    SELECT 'userlogntable' AS source FROM userlogntable 
    WHERE user_email = '$email' AND user_auto != '$customer_id'
";
$resultEmail = mysqli_query($contdb, $checkEmail);

// Check Mobile in both tables
$checkMobile = "
    SELECT 'customer' AS source FROM customer 
    WHERE customer_phone = '$phone' AND customer_ui_id != '$customer_id'
    UNION
    SELECT 'userlogntable' AS source FROM userlogntable 
    WHERE user_mobileno = '$phone' AND user_auto != '$customer_id'
";
$resultMobile = mysqli_query($contdb, $checkMobile);

$messages = [];

if (mysqli_num_rows($resultEmail) > 0) {
    $messages[] = "Email already exists!";
}

if (mysqli_num_rows($resultMobile) > 0) {
    $messages[] = "Mobile number already exists!";
}

if (!empty($messages)) {
    echo json_encode([
        'success' => false,
        'message' => implode(" ", $messages) // join both if needed
    ]);
    exit;
}
 else {
    $update = "
        UPDATE customer c
        JOIN userlogntable u ON c.customer_ui_id = u.user_auto
        SET 
            c.customer_fname   = '$fname',
            c.customer_lname   = '$lname',
            c.customer_email   = '$email',
            c.customer_age     = '$age',
            c.customer_gender  = '$gender',
            c.customer_phone   = '$phone',
            c.customer_address = '$address',
            c.customer_city    = '$city',
            c.customer_state   = '$state',
            c.customer_pincode = '$pincode',
            c.customer_country = '$country',
            u.user_first_name  = '$fname',
            u.user_lastname    = '$lname',
            u.user_mobileno    = '$phone',
            u.user_email       = '$email'";

    if ($profile_img !== null) {
        $update .= ", c.customer_img = '$profile_img'";
    }

    $update .= " WHERE c.customer_ui_id = '$customer_id'";

    $result = mysqli_query($contdb, $update);
}

        
       if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Customer updated successfully',
         'data' => [
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'address' => $address,
                'age' => $age,
                'gender' => $gender,
                'phone' => $phone,
                'city' => $city,
                'state' => $state,
                'pincode' => $pincode,
                'country' => $country,
               
            ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update customer: ' . mysqli_error($contdb)
    ]);
}
exit;
      }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);



?>