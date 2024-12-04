<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $username;
    protected $password;
    protected $senderId;

    public function __construct()
    {
        $this->username = env('SMSMANTRA_USERNAME');
        $this->password = env('SMSMANTRA_PASSWORD');
        $this->senderId = env('SMSMANTRA_SENDERID');
    }

    public function sendOtp($mobile, $otp)
    {
        $url = "http://api.smsmantra.com/v2/sms.aspx";
        $message = "Your OTP is $otp. Please do not share it with anyone.";

        $response = Http::get($url, [
            'username' => $this->username,
            'password' => $this->password,
            'to'       => $mobile,
            'message'  => $message,
            'sender'   => $this->senderId,
        ]);

        return $response->successful();
    }
}