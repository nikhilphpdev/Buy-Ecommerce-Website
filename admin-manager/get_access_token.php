<?php
require_once "FirebaseAccessToken.php";

$jsonFile = __DIR__ . "/service-account.json";
$accessToken = FirebaseAccessToken::getAccessToken($jsonFile);

// सिर्फ access token output
echo $accessToken;
