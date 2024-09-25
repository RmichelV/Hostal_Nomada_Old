<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'employee_id' => 'nullable|exists:employees,id',
            'type' => 'sometimes|required|in:Personal,Externa',
            'res_date' => 'nullable|date',
            'entry_date' => 'required|date',
            'depature_date' => 'required|date|after:entry_date',
        ];
    }
}
