<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
            'phone' => 'required|string|digits:11|unique:student_users,phone',
            'gender' => 'nullable|in:male,female,other',
            'religion' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'father_mobile' => 'nullable|string|digits:11',
            'mother_mobile' => 'nullable|string|digits:11',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.digits' => 'Phone number must be 11 digits.',
            'phone.unique' => 'This phone number is already registered.',
        ];
    }
}
