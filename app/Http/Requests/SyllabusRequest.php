<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyllabusRequest extends FormRequest
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
    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'syllabus' => 'required_without:description|array',
            'syllabus.*' => 'string|max:255',
            'description' => 'required_without:syllabus|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string',
        ];
    }
}
