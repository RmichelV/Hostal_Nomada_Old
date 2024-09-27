<?php

namespace App\Http\Requests\ReservationRoom;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRoomRequest extends FormRequest
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
            'reservation_id' => 'sometimes|required|exists:reservations,id',
            'room_id' => 'sometimes|required|exists:rooms,id',
        ];
    }
}
