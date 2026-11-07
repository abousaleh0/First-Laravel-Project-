<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bio' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|required|string|max:20', // أعدنا الهاتف مع sometimes
            'address' => 'sometimes|nullable|string|max:255',
            'birthdate' => 'sometimes|nullable|date'
        ];
    }

    public function messages(): array
    {
        // نظفنا الرسائل من user_id
        return [
            'bio.string' => 'The bio must be a string.',
            'bio.max' => 'The bio may not be greater than 255 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone must be a string.',
            'phone.max' => 'The phone may not be greater than 20 characters.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'birthdate.date' => 'The date of birth must be a valid date.',
        ];
    }

    public function attributes(): array
    {
        // نظفنا الأسماء من user_id
        return [
            'bio' => 'biography',
            'phone' => 'phone number',
            'address' => 'address',
            'birthdate' => 'date of birth',
        ];
    }
}