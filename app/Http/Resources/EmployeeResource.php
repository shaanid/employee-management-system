<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => (string)$this->name ?? '',
            'email' => (string)$this->email ?? '',
            'password' => (string)$this->password ?? '',
            'position_id' => (string)$this->position_id ?? '',
            'dob' => (string)$this->dob ?? '',
            'gender' => (string)$this->gender ?? '',
            'phone' => (string)$this->phone ?? '',
            'status' => (string)$this->status ?? '',
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
