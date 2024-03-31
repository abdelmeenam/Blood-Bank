<?php

use Twilio\Rest\Client as TwilioClient; // Import TwilioClient

function apiResponse($status, $message, $data = null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response);
}



function sendSms($phoneNumber, $pinCode)
{
    $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
    $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
    $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

    $client = new TwilioClient($twilioAccountSid, $twilioAuthToken);

    // Send SMS message
    $client->messages->create(
        $phoneNumber,
        [
            'from' => $twilioPhoneNumber,
            'body' => "Your pin code is: $pinCode"
        ]
    );
}