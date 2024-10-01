<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            // 'interest_areas' => 'required|array',
           'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'is_paid' => 'required|boolean',
            'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
            'topic_expertise'=>['required','string'],
            'image'=>['required','image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }
}
