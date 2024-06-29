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
        $tokens = FcmToken::whereIn('client_id', $matchingClients)->whereNotNull('token')->pluck('token')->toArray();
        // Create notification for matching clients
        if (count($matchingClients) > 0) {
            $donationRequest->notification()->create([
                'title' => 'أحتاج متبرع',
                'content' => ' أحتاج متبرع بفصيلة دم  ' . $donationRequest->bloodType->name . ' في مدينة ' . $donationRequest->city->name . ' بمحافظة ' . $donationRequest->city->governorate->name . '',
            ])->clients()->attach($matchingClients);
        }
        // Send notification to matching clients
        if (count($tokens) > 0) {
            $title = $donationRequest->notification->title;
            $content = $donationRequest->notification->content;
            $data = [
                'action' => 'new notify',
                'data' => null,
                'client' => 'client',
                'title' => $title,
                'content' => $content,
                'donation_request_id' => $donationRequest->id
            ];
            $result = notifyByFirebase($title, $content, $tokens, $data);
            //info("Notification result: $result");
        }

        return apiResponse(200, "تم الاضافة بنجاح", $donationRequest);
    }


    private function findMatchingClients(DonationRequest $donationRequest)
    {
        return Client::whereHas('governorates', function ($query)  use ($donationRequest) {
            $query->where('governorate_id', $donationRequest->city->governorate_id);
        })->whereHas('bloodTypes', function ($query) use ($donationRequest) {
            $query->where('blood_type_id', $donationRequest->blood_type_id);
        })->pluck('id')->toArray();
    }
}
