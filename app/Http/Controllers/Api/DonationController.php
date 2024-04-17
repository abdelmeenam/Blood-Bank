<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\FcmToken;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\DonationRequest;


use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Kreait\Firebase\Messaging\RegistrationToken;
use Kreait\Firebase\Messaging\RegistrationTokens;
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



    public function createDonationRequest(CreateDonationRequest $request)
    {
        $donationRequest = $request->user()->donationRequests()->create($request->all());
        $matchingClients = $this->findMatchingClients($donationRequest);
        /*
        $notification = $donationRequest->notifications()->create([
            'title' => 'يوجد طلب تبرع جديد',
            'content' => 'يوجد طلب تبرع جديد بفصيلة دم ' . $donationRequest->bloodType->name . ' في مدينة ' . $donationRequest->city->name . ' والمحافظة ' . $donationRequest->city->governorate->name . ',
        ]);
        $notification->clients()->attach($matchingClients);
        */
        $registrationIds = $this->getClientFcmTokens($donationRequest);
        dd($registrationIds, $matchingClients);

        $registrationTokens = new RegistrationTokens($registrationIds);

        foreach ($registrationIds as $token) {
            $this->sendNotification($token, $donationRequest);
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
    }



    private function findMatchingClients(DonationRequest $donationRequest)
    {
        return Client::whereHas('governorates', function ($query)  use ($donationRequest) {
            $query->where('governorate_id', $donationRequest->city->governorate_id);
        })->whereHas('bloodTypes', function ($query) use ($donationRequest) {
            $query->where('blood_type_id', $donationRequest->blood_type_id);
        })->pluck('id')->toArray();
    }

    private function getClientFcmTokens(DonationRequest $donationRequest)
    {
        $tokens = FcmToken::whereNotNull('token') // Exclude null tokens
            ->where('token', '!=', '') // Exclude empty strings
            ->whereHas('client', function ($query) use ($donationRequest) {
                $query->whereHas('governorates', function ($query) use ($donationRequest) {
                    $query->where('governorate_id', $donationRequest->city->governorate_id);
                })->whereHas('bloodTypes', function ($query) use ($donationRequest) {
                    $query->where('blood_type_id', $donationRequest->blood_type_id);
                });
            })->pluck('token')->toArray();

        return $tokens;
    }

    public function storeFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);
        /*
        auth()->user()->fcmTokens()->updateOrCreate([
            'token' => $request->fcm_token,
        ]);
        return response()->json(['message' => 'FCM token stored successfully']);
        */
    }
}