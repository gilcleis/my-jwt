[![Build Status](https://travis-ci.org/gilclei/my-jwt.png?branch=master)](https://travis-ci.org/gilclei/my-jwt)
[![Latest Stable Version](https://poser.pugx.org/gilclei/my-jwt/v/stable)](https://packagist.org/packages/gilclei/my-jwt)
[![Total Downloads](https://poser.pugx.org/gilclei/my-jwt/downloads)](https://packagist.org/packages/gilclei/my-jwt)
[![License](https://poser.pugx.org/gilclei/my-jwt/license)](https://packagist.org/packages/gilclei/my-jwt)

My-JWT
=======
A simple library to encode and decode JSON Web Tokens (JWT) in PHP.

Installation
------------

Use composer to manage your dependencies and download My-JWT:

```bash
composer require gilclei/my-jwt
```

Example
-------
```php
<?php
use \Gilclei\JWT\JWT;

$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key);
$decoded = JWT::decode($jwt, $key, array('HS256'));

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key, array('HS256'));

?>

```
```
php exemplo.php
```
```
vendor/bin/phpunit tests/
```

