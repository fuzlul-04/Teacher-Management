<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher')->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email')->ignore($teacherId),
            ],
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ];
    }
}
