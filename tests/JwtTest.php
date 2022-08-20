<?php

use PHPUnit\Framework\TestCase;
use Gilclei\JWT\JWT;

class JwtTest extends TestCase
{


    public function testEncodeJWT()
    {
        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        $tokenId    = 'A2GZwCA+RAsvoRvbz7LRWQ==';       
        $serverName = "127.0.0.1";
        $username   = "admin";         
        $data = [
            'iat'  => 1661016279 ,  
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => 1661016279, 
            //'exp'  => 1661016339, 
            'data' => [           
                'userName' => $username,
            ]
        ];
        
        $token = JWT::encode(
            $data,      
            $secretKey, 
            'HS256'     
        );
        $this->assertEquals('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjEwMTYyNzksImp0aSI6IkEyR1p3Q0ErUkFzdm9SdmJ6N0xSV1E9PSIsImlzcyI6IjEyNy4wLjAuMSIsIm5iZiI6MTY2MTAxNjI3OSwiZGF0YSI6eyJ1c2VyTmFtZSI6ImFkbWluIn19.ZsvqlxWE0YiNkDyYWDIzwX_k3FcHZPAPo57p7g8_P5o', $token);
        //$decoded = JWT::decode($token, $secretKey, array('HS256'));

       // print_r(json_encode($decoded));
    }


    public function testDecodeJWT()
    {
        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        
        $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjEwMTYyNzksImp0aSI6IkEyR1p3Q0ErUkFzdm9SdmJ6N0xSV1E9PSIsImlzcyI6IjEyNy4wLjAuMSIsIm5iZiI6MTY2MTAxNjI3OSwiZGF0YSI6eyJ1c2VyTmFtZSI6ImFkbWluIn19.ZsvqlxWE0YiNkDyYWDIzwX_k3FcHZPAPo57p7g8_P5o';
        $decoded = JWT::decode($token, $secretKey, array('HS256'));
       
        $data = [
            'iat'  => 1661016279 ,  
            'jti'  => 'A2GZwCA+RAsvoRvbz7LRWQ==',
            'iss'  => "127.0.0.1",
            'nbf'  => 1661016279, 
            //'exp'  => 1661016339, 
            'data' => [           
                'userName' => "admin",
            ]            
        ];
        
        $data = json_decode(json_encode($data));
        print_r($data);        
        $this->assertEquals($data, $decoded);
    }
}
