<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Mail\SendCodeResetPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use Twilio\Rest\Client as TwilioClient; // Import TwilioClient

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|regex:/^\+20\d{10}$/|unique:clients,phone',
            'password' => 'required|confirmed|min:6',
            'date_of_birth' => 'required|date',
            'last_donation_date' => 'required|date',
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }


        $request['password'] = Hash::make($request['password']);
        $client = Client::create($request->all());

        return apiResponse(200, 'Client created successfully', [
            'client' => $client,
            'api_token' => $client->createToken(uniqid())->plainTextToken
        ]);
    }

    public function login(LoginRequest $request)
    {

        if (!Auth::guard('clients-api')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return apiResponse(401, 'Invalid credentials');
        }

        $client = Auth::guard('clients-api')->user();
        return apiResponse(200, 'Logged in successfully', [
            'client' => $client,
            'api_token' => $client->createToken(uniqid())->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return apiResponse(200, 'Logged out successfully');
    }

    public function forgetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:clients,email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            $client->pin_code = rand(1111, 9999);
            $client->save();

            $data = [
                'name' => $client->name,
                'code' => $client->pin_code,
            ];

            Mail::to($client->email)->send(new SendCodeResetPassword('Forgot Password Request', $data));
            sendSms($client->phone, $client->pin_code);

            return apiResponse(200, 'Pin code sent successfully');
        }
    }


    public function resetPassword(Request $request)
    {

        $rules = [
            'pin_code' => 'required|string|exists:clients,pin_code',
            'password' => 'required|string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $client = Client::where('pin_code', $request->pin_code)->first();

        // check if it does not expired: the time is one hour
        if ($client) {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;
            $client->save();
            return apiResponse(200, 'Password updated successfully.');
        }

        return apiResponse(422, 'Invalid code');
    }
}