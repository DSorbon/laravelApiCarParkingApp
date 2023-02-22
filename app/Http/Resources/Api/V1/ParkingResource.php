<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
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
            'zone' => ZoneResource::make($this->zone),
            'vehicle' => VehicleResource::make($this->vehicle),
            'start_time' => $this->start_time->toDateTimeString(),
            'end_time' => $this->end_time?->toDateTimeString(),
            'total_price' => $this->total_price
        ];
    }
}
