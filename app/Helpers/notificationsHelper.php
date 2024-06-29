<?php


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