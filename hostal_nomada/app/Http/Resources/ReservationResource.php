<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'employee_id' => $this->employee_id,
            'type' => $this->type,
            'res_date' => $this->res_date,
            'entry_date' => $this->entry_date,
            'depature_date' => $this->depature_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
