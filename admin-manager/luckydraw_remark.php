<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

header('Content-Type: application/json');
require "fcm.php";
include('../dis-setting/config-settings/config.php');
include('../dis-setting/config-settings/functions-board.php');


date_default_timezone_set("Asia/Kolkata");  
if (isset($_POST['luckydraw_id']) && isset($_POST['remark'])) {

    $lucky_id   = trim($_POST['luckydraw_id']);
    $remark     = trim($_POST['remark']);
    $status     = trim($_POST['status']);

    $sql = $contdb->prepare("UPDATE customer_luckydraw SET remark = ?, status = ? WHERE customer_ui_id = ?");
    $sql->bind_param("sis", $remark, $status, $lucky_id);

    if (!$sql->execute()) {
        echo json_encode(["status" => "error", "message" => "Database error"]);
        exit;
    }

    //  Notification Setup
    $title = ($status == 1)
        ? "Your lucky draw request has been approved."
        : "Your lucky draw request has been rejected.";

    $body = "Remark: " . $remark;
    $topic = "customer_" . $lucky_id;  

               $customData = [
                "customer_ui_id" => $lucky_id,
                "remark"       => $remark,
                "status"       => strval($status)
            ];
         $notify = FirebaseNotification::sendNotification(
            __DIR__ . "/service-account.json",
            "buyjee-ba483",
            $topic,
            $title,
            $body,
            $customData
        );
        
        if ($notify['sent'] === true) {
            echo json_encode([
                "status" => "success",
                "http_code" => $notify['http_code'],
                "message" => "Notification sent successfully",
                "fcm_id" => $notify['fcm_response']['name'] ?? null,
                "access_token_used" => $notify['access_token_used'],   
                "payload_sent" => $notify['payload_sent'],
                 "url" => "https://testing.buyjee.com/" 
            ]);
        } else {
            echo json_encode([
                "status" => "failed",
                "message" => "Notification failed",
                "http_code" => $notify['http_code'],
                "error" => $notify['fcm_response'] ?? "Unknown Error",
                "access_token_used" => $notify['access_token_used'],  
                "payload_sent" => $notify['payload_sent'],
                 "url" => "https://testing.buyjee.com/" 
            ]);
        }
        
        exit;


} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}



?>
