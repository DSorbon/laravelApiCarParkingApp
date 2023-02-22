<?php

namespace App\Http\Resources\Api\V1;

use App\Services\ParkingPriceService;
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
        $totalPrice = $this->total_price ?? ParkingPriceService::calculatePrice(
            $this->zone_id,
            $this->start_time,
            $this->end_time
        );

        return [
            'id' => $this->id,
            'zone' => ZoneResource::make($this->zone),
            'vehicle' => VehicleResource::make($this->vehicle),
            'start_time' => $this->start_time->toDateTimeString(),
            'end_time' => $this->end_time?->toDateTimeString(),
            'total_price' => $totalPrice
        ];
    }
}
