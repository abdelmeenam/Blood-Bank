<?php


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
// using package
function sendNotification($fcmToken, DonationRequest $donationRequest)
{
    $firebase = (new Factory)->withServiceAccount(config('services.firebase.credentials.file'));
    $messaging = $firebase->createMessaging();
    $message = CloudMessage::withTarget('token', $fcmToken)
        ->withNotification(Notification::create('New Donation Request', 'A new donation request has been submitted'))
        ->withData([
            'donation_request_id' => $donationRequest->id,
            'blood_type_id' => $donationRequest->blood_type_id,
            'governorate_id' => $donationRequest->governorate_id,
            'city_id' => $donationRequest->city_id,
        ]);
    $messaging->send($message);
}

*/

//Server key : AAAAc2sFOhQ:APA91bEL9vB8iv7deZol6CqxjGXspbIs-tE5VUinVejenfaeEwvU6wpBCOonTSC5Ohugx56rQEg3lGLmz_DwA1_RbvCMkebvH3XdYvJn-8rldM6QuzLhclpaOiI64EcbJQa9LAl5gm3J
function notifyByFirebase($title, $body, $tokens, $data = [])        // paramete 5 =>>>> $type
{

    $registrationIDs = $tokens;

    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
    $headers = array(
        'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
