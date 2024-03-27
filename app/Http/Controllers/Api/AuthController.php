<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequests\RegisterRequest;

class AuthController extends Controller
{


    public function register(RegisterRequest $request)
    {
        /*$rules = [
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
        */

        $data = $request->user();
        $data['password'] = Hash::make($data['password']);
        $client = Client::create($data);

        return apiResponse(200, 'Client created successfully', [
            'client' => $client,
            'api_token' => $client->createToken(uniqid())->plainTextToken
        ]);
    }



    public function login(LoginRequest $request)
    {
        /*
        $rules = [
            'phone' => 'required|regex:/^\+20\d{10}$/|exists:clients,phone',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }
        */
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
}