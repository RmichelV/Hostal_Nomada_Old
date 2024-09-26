<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<string>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required',
            'start_time.required' => 'The start time is required',
            'start_time.date_format' => 'The start time format must be H:i:s',
            'end_time.required' => 'The end time is required',
            'end_time.date_format' => 'The end time format must be H:i:s',
            'end_time.after' => 'The end time must be after the start time',
        ];
    }
}
