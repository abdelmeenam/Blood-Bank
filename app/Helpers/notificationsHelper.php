<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Request;

/*
function sendNotification(Request $request)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $FcmToken = Client::whereNotNull('device_token')->pluck('device_token')->all();

    $serverKey = 'AAAA6MPweDU:APA91bGUqL4b9sXCASfgpsosKciBjfBL5tXnZSwFrZXixulGP1iSC8FXDj8N-31gMTCQyw-u2mObNYTSqhKf9D1EYoz-hYDnj9bv3h2WQQHkzHhWGmdUUSObotJZsL7hHLu_vG1QuNBR'; // ADD SERVER KEY HERE PROVIDED BY FCM

    $data = [
        "registration_ids" => $FcmToken,
        "notification" => [
            "title" => $request->title,
            "body" => $request->body,
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
    // FCM response
    dd($result);
}



function send_notification_FCM($notification_id, $title, $message, $id, $type)
{

    $accesstoken = env('FCM_KEY');

    $URL = 'https://fcm.googleapis.com/fcm/send';

    $post_data = '{
            "to" : "' . $notification_id . '",
            "data" : {
              "body" : "",
              "title" : "' . $title . '",
              "type" : "' . $type . '",
              "id" : "' . $id . '",
              "message" : "' . $message . '",
            },
            "notification" : {
                 "body" : "' . $message . '",
                 "title" : "' . $title . '",
                  "type" : "' . $type . '",
                 "id" : "' . $id . '",
                 "message" : "' . $message . '",
                "icon" : "new",
                "sound" : "default"
                },

          }';
    // print_r($post_data);die;

    $crl = curl_init();

    $headr = array();
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: ' . $accesstoken;
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

    $rest = curl_exec($crl);

    if ($rest === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        //print_r('Curl error: ' . curl_error($crl));
        $result_noti = 0;
    } else {

        $result_noti = 1;
    }

    //curl_close($crl);
    //print_r($result_noti);die;
    return $result_noti;
}*/