<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorRequest extends FormRequest
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
            'language' => ['required', 'string'],
            // 'service_title' => ['required', 'string'],
            'resume' => ['required', 'file'],
            'skills' => ['array'],
            'category_id' => ['array'],
            'experience' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'title' => ['required', 'string'],
            'school' => ['required', 'string'],
            'degree' => ['required', 'string'],
            'field_of_study' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'award_title' => ['required', 'string'],
            'company' => ['required', 'string'],
            'date' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after:date'],
            'experience_title' => ['required', 'string'],
            'days' => ['array'],
            'days.*.available' => ['string'],
            // 'days.*.start_time' => ['required_if:days.*.available,true', 'date_format:H:i'],
            // 'days.*.end_time' => ['required_if:days.*.available,true', 'date_format:H:i', 'after:days.*.start_time'],
        ];
    }
}
