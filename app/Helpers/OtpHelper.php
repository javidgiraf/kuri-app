<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class OtpHelper
{
    public static function getOtp()
    {
        return rand(100000, 999999);
    }

    public static function sendOtp($mobile, $otp)
    {
        $apiKey = 'YOUR_API_KEY';
        $senderId = 'YOUR_SENDER_ID';

        $response = Http::get('https://www.mysmsmantra.com/api/sendSMS', [
            'api_key' => $apiKey,
            'sender' => $senderId,
            'mobile' => $mobile,
            'message' => "Your OTP is: {$otp}",
            'format' => 'json'
        ]);

        return $response->json();
    }
}
