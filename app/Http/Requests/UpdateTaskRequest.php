<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'priority' => 'sometimes|integer|min:1|max:5',
            'user_id' => 'sometimes|in:high,medium,low|exists:users,id'
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'title.string' => 'عنوان المهمة يجب أن يكون نصاً.',
            'title.max' => 'عنوان المهمة يجب ألا يتجاوز 255 حرفاً.',
            'description.string' => 'وصف المهمة يجب أن يكون نصاً.',
            'priority.integer' => 'الأولوية يجب أن تكون رقماً صحيحاً.',
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
            'title' => 'عنوان المهمة',
            'description' => 'وصف المهمة',
            'priority' => 'الأولوية',
        ];
    }
}
