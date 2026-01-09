<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class FirebaseAccessToken {
    private static $cache = [];

    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function getAccessToken($jsonFilePath, $debug = false) {
        if (!file_exists($jsonFilePath)) die("❌ Service account file not found");

        // Cache check
        if (isset(self::$cache[$jsonFilePath]) && self::$cache[$jsonFilePath]['expiry'] > time()) {
            if ($debug) echo "Using cached token\n";
            return self::$cache[$jsonFilePath]['access_token'];
        }

        $jsonKey = json_decode(file_get_contents($jsonFilePath), true);
        $privateKey = str_replace("\\n", "\n", $jsonKey['private_key']);
        $clientEmail = $jsonKey['client_email'];
        $tokenUri = $jsonKey['token_uri'];

        $now = time();

        // JWT Header + Claims
        $header = self::base64UrlEncode(json_encode(['alg'=>'RS256','typ'=>'JWT']));
        $claims = self::base64UrlEncode(json_encode([
            'iss' => $clientEmail,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => $tokenUri,
            'iat' => $now,
            'exp' => $now + 3600
        ]));

        $jwt = "$header.$claims";
        if (!openssl_sign($jwt, $signature, $privateKey, OPENSSL_ALGO_SHA256)) die("❌ JWT signing failed");
        $jwt .= "." . self::base64UrlEncode($signature);

        // Request OAuth2 access token
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $tokenUri,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded']
        ]);

        $response = curl_exec($ch);
        if (!$response) die("❌ CURL failed: " . curl_error($ch));
        curl_close($ch);

        $data = json_decode($response, true);
        if (!isset($data['access_token'])) die("❌ Access token not received");

        // Cache token
        self::$cache[$jsonFilePath] = [
            'access_token' => $data['access_token'],
            'expiry' => $now + ($data['expires_in'] ?? 3600)
        ];

       return $data['access_token'];
            }
}

// Usage
$token = FirebaseAccessToken::getAccessToken(__DIR__ . "/service-account.json", true);

