<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchenduleResource extends JsonResource
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
            'bus' => $this->bus,
            'line' => $this->line,
            'kelas' => $this->kelas,
            'from' => $this->from,
            'to' => $this->to,
            'berangkat' => $this->berangkat,
            'datang' => $this->datang,
            'jarak' => $this->jarak,
            'speed' => $this->speed,
            'created_at' => date("Y-m-d", strtotime($this->created_at)),
        ];
    }
}
