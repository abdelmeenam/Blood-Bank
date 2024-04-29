<?php

namespace App\Http\Requests\AdminDashboardRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGovernorateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:governorates,name',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'governorate_en.required' => __('Governorate en name is required'),
            'governorate_ar.required' => __('Governorate ar name is required'),
            'governorate_en.string' => __('Governorate name en must be a string'),
            'governorate_ar.string' => __('Governorate name ar must be a string'),
            'governorate_en.max' => __('Governorate name en must be less than 255 characters'),
            'governorate_ar.max' => __('Governorate name ar must be less than 255 characters'),
        ];
    }
}