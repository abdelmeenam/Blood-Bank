<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use App\Models\DonationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DonationRequests\CreateDonationRequest;

class DonationController extends Controller
{


    public function getAllDonationRequests(Request $request)
    {
        $donation = DonationRequest::latest()->with(['client:id,name', 'bloodType:id,name', 'city:id,name'])->paginate(10);
        return apiResponse(200, "success", $donation);
    }

    public function filterDonationRequestsByBloodType(Request $request)
    {
        $rules = [
            'blood_type_id' => 'required|exists:blood_types,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $donations = DonationRequest::where('blood_type_id', $request->blood_type_id)->with(['client:id,name', 'bloodType:id,name', 'city:id,name'])->paginate(10);
        $donations = $donations->isEmpty() ? apiResponse(404, 'No requests found with this blood type.') : apiResponse(200, 'success', $donations);
        return $donations;
    }

    /*
    public function sendNotification(Request $request)
    {
        $firebaseToken = Client::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FCM_SERVER_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        return $response;
    }

    */
    public function createDonationRequest(CreateDonationRequest $request)
    {
        //$donationRequest = DonationRequest::create($request->all());
        $donationRequest = $request->user()->donationRequests()->create($request->all());
        $matchingClients = $this->findMatchingClients($donationRequest);
        dd($matchingClients);


        foreach ($matchingClients as $client) {
            $this->sendNotification($client->fcm_token, $donationRequest);
        }
        return apiResponse(200, "success", $donationRequest);
    }
    private function sendNotification($fcmToken, DonationRequest $donationRequest)
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

        // $messaging->send($message); // Uncomment this line when using Firebase
    }

    private function findMatchingClients(DonationRequest $donationRequest)
    {
        return Client::whereHas('bloodTypes', function ($query) use ($donationRequest) {
            $query->where('blood_type_id', $donationRequest->blood_type_id);
        })->whereHas('governorates', function ($query) use ($donationRequest) {
            $query->where('governorate_id', $donationRequest->governorate_id);
        })->pluck('id')->toArray();
    }
}