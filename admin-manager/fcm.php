<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

require_once "FirebaseAccessToken.php";

class FirebaseNotification
{
    public static function sendNotification(
        $jsonFilePath,
        $projectId,
        $topic,
        $title,
        $body,
        $customData = []
    ) {
        try {
            // 1. Access Token Generate
            $accessToken = FirebaseAccessToken::getAccessToken($jsonFilePath);
            $url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";

            // 3. Payload
            $messagePayload = [
                "message" => [
                    "topic" => $topic,
                    "notification" => (object)[], // empty object
                    "data" => array_merge($customData, [
                        "title" => $title,
                        "body"  => $body,
                         "url" => "https://testing.buyjee.com/" 
                    ])
                ]
            ];


            $payload = json_encode($messagePayload);

            // 4. Headers
            $headers = [
                "Authorization: Bearer $accessToken",
                "Content-Type: application/json"
            ];

            // 5. CURL POST
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return [
                "sent" => $httpCode === 200,
                "payload_sent" => $messagePayload,
                "access_token_used" => $accessToken,  
                "fcm_response" => json_decode($response, true),
                "http_code" => $httpCode
            ];

        } catch (Exception $ex) {
            return [
                "sent" => false,
                "error" => $ex->getMessage()
            ];
        }
    }
}
