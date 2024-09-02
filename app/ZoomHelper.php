<?php

use Firebase\JWT\JWT;

class ZoomHelper
{
    public static function generateSignature($apiKey, $apiSecret, $meetingNumber, $role)
    {
        $time = time() * 1000 - 30000; // Convert to milliseconds
        $data = base64_encode($apiKey . $meetingNumber . $time . $role);
        $hash = hash_hmac('sha256', $data, $apiSecret, true);
        $signature = rtrim(strtr(base64_encode($data . $hash), '+/', '-_'), '=');
        
        return $signature;
    }
}