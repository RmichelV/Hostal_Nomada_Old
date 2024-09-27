<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'room_type_id' => 'sometimes|required|exists:room_types,id',
            'name' => 'sometimes|required|string|max:255',
            'floor_number' => 'nullable|integer',
            'status' => 'sometimes|required|in:Disponible,No_disponible',
        ];
    }
}
