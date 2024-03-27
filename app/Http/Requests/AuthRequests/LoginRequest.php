<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|regex:/^\+20\d{10}$/|exists:clients,phone',
            'password' => 'required',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            apiResponse(422, $validator->errors())
        );
    }
}