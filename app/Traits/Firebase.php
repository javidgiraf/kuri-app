<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Firebase
{
    public function sendNotification($fcmNotification)
    {

        $url = config('firebase.firbase_url');
        $serverKey = config('firebase.firebase_server_key');

        return Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type'  => 'application/json',
        ])->post($url, $fcmNotification)->json();
    }
}
