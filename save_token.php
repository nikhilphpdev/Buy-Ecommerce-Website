<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 
header('Content-Type: application/json');
include('../dis-setting/config-settings/config.php');

/*if (isset($_POST['luckydraw_id'])) {

    $customer_id = trim($_POST['luckydraw_id']);
    $token       = trim($_POST['fcm_token']);
    $status      = trim($_POST['status']);
        // check old record
        $check = $contdb->prepare("SELECT customer_ui_id FROM customer WHERE customer_ui_id = ?");
        $check->bind_param("s", $customer_id);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            // update
            $update = $contdb->prepare("UPDATE customer SET fcm_token = ? WHERE customer_ui_id = ?");
            $update->bind_param("ss", $token, $customer_id);
            $update->execute();
        } else {
            // insert
            $insert = $contdb->prepare("INSERT INTO customer (customer_ui_id, fcm_token, customer_date) VALUES (?, ?, NOW())");
            $insert->bind_param("ss", $customer_id, $token);
            $insert->execute();
        }

        echo json_encode(["status" => "success"]);

   
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
*/
echo'<pre>'; print_r($_POST); die;
if(isset($_POST['customer_id'])){
    $customer_id = $_POST['customer_id'];
$fcm_token   = $_POST['fcm_token'];

$contdb->query("UPDATE customer SET fcm_token='$fcm_token' WHERE customer_ui_id='$customer_id'");
echo "success";
}
?>