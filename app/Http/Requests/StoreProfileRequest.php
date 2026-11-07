<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio'       => 'nullable|string|max:255',
            'phone'     => 'required|string|max:20',
            'address'   => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'image'     => 'required|image|mimes:png,jpg,jpeg,gif,heic|max:3072'
        ];
    }
    /**
     * Get the custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'user_id.required'  => 'The user ID field is required.',
            'user_id.integer'   => 'The user ID must be an integer.',
            'user_id.exists'    => 'The selected user ID is invalid.',
            'bio.string'        => 'The bio must be a string.',
            'bio.max'           => 'The bio may not be greater than 255 characters.',
            'phone.required'    => 'The phone field is required.',
            'phone.string'      => 'The phone must be a string.',
            'phone.max'         => 'The phone may not be greater than 20 characters.',
            'address.string'    => 'The address must be a string.',
            'address.max'       => 'The address may not be greater than 255 characters.',
            'birthdate.date'    => 'The date of birth must be a valid date.',
            'image.string'      => 'The file size is more than 3 MB'
        ];
    }

    /**
     * Get the custom attribute names for validation.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'user_id' => 'user ID',
            'bio' => 'biography',
            'phone' => 'phone number',
            'address' => 'address',
            'birthdate' => 'date of birth',
        ];
    }
}
