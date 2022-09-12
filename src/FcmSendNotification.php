<?php

namespace RidhoPujiono\FcmSendNotification;

use App\Models\User;

class FcmSendNotification
{
    public function sendNotificationAll($title, $body, $urlClick = null)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $device_token = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = env('SERVER_KEY_FCM');

        $data = [
            "registration_ids" => $device_token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "data" => [
                "openURL" => $urlClick
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        $data = [
            "registration_ids" => $device_token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
        ];
        return response($data);
    }
    public static function sendNotificationSingle($user_id, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $device_token = User::where('id', $user_id)->first()->device_token;

        $serverKey = env('SERVER_KEY_FCM');

        $data = [
            "registration_ids" => $device_token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],

        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        $data = [
            "registration_ids" => $device_token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
        ];
        return response($data);
    }
}
