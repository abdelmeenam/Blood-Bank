<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $client = $request->user();

        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'sometimes|string|max:255',
                'email' => [
                    'sometimes',
                    'email',
                    Rule::unique('clients')->ignore($client->id),
                ],
                'phone' => [
                    'sometimes',
                    'string',
                    'max:20',
                    Rule::unique('clients')->ignore($client->id),
                ],
                'date_of_birth' => 'sometimes|date',
                'last_donation_date' => 'nullable|date',
                'city_id' => 'sometimes|exists:cities,id',
                'blood_type_id' => 'sometimes|exists:blood_types,id',
                'password' => 'nullable|string|min:8|confirmed',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $client->fill($request->only(['name', 'email', 'phone', 'date_of_birth', 'last_donation_date', 'city_id', 'blood_type_id']));
            if ($request->has('password')) {
                $client->password = bcrypt($request->input('password'));
            }
            $client->save();
            return apiResponse(200, 'Profile updated successfully', [
                'client' => $client
            ]);
        }

        return apiResponse(200, 'Profile data retrieved successfully', [
            'client' => $client
        ]);
    }

    public function getNotificationSettings(Request $request)
    {
        $client = $request->user();
        return apiResponse(200, 'Notification settings retrieved successfully', [
            'governorates' => $client->governorates()->pluck('id')->toArray(),
            'blood_types' => $client->bloodTypes()->pluck('id')->toArray()
        ]);
    }

    public function updateNotificationSettings(Request $request)
    {
        $client = $request->user();

        $rules = [
            'governorates' => 'sometimes|array',
            'governorates.*' => 'exists:governorates,id',
            'blood_types' => 'sometimes|array',
            'blood_types.*' => 'exists:blood_types,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->has('governorates')) {
            $client->governorates()->sync($request->input('governorates'));
        }

        if ($request->has('blood_types')) {
            $client->bloodTypes()->sync($request->input('blood_types'));
        }

        return apiResponse(200, 'Notification settings updated successfully', [
            'governorates' => $client->governorates()->pluck('id')->toArray(),
            'blood_types' => $client->bloodTypes()->pluck('id')->toArray()
        ]);
    }
}