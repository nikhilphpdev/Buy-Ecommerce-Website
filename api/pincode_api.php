<?php


header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
$pincode = trim($data['pincode'] ?? '');


if ($pincode == "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Pincode required"
    ]);
    exit;
}

if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)) {
    http_response_code(422);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid pincode format"
    ]);
    exit;

}
$url = "https://api.postalpincode.in/pincode/" . $pincode;
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data[0]['Status'] != 'Success') {
    echo json_encode(["status" => "error", "message" => "Invalid pincode"]);
    exit;
}

$post = $data[0]['PostOffice'];
echo json_encode($post);



