<?php

require_once "vendor/autoload.php";
use Gilclei\JWT\JWT;

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
$tokenId    = base64_encode(random_bytes(16));
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+1 minutes')->getTimestamp(); // Add 60 seconds
$serverName = "127.0.0.1";
$username   = "admin"; //$body->username; // Retrieved from filtered POST data

// Create the token as an array
$data = [
    'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
    'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
    'iss'  => $serverName,                  // Issuer
    'nbf'  => $issuedAt->getTimestamp(),    // Not before
    'exp'  => $expire,                      // Expire
    'data' => [                             // Data related to the signer user
        'userName' => $username,            // User name
    ]
];
// Encode the array to a JWT string.
echo $token = JWT::encode(
    $data,      //Data to be encoded in the JWT
    $secretKey, // The signing key
    'HS256'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
);

$decoded = JWT::decode($token, $secretKey, array('HS256'));
print_r(PHP_EOL);
print_r($decoded);