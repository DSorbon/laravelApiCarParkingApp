<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StartParkingRequest;
use App\Http\Resources\Api\V1\ParkingResource;
use App\Models\Parking;
use App\Services\ParkingPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParkingController extends Controller
{
    public function show(Parking $parking): Response|JsonResponse
    {
        return $this->sendResponse(ParkingResource::make($parking));
    }
    public function start(StartParkingRequest $request): Response|JsonResponse
    {
        $parking = Parking::create($request->validated());
        $parking->load('vehicle', 'zone');

        return $this->sendResponse(ParkingResource::make($parking), '', Response::HTTP_CREATED);
    }

    public function stop(Parking $parking): Response|JsonResponse
    {
        $parking->update([
            'end_time' => now(),
            'total_price' => ParkingPriceService::calculatePrice($parking->zone_id, $parking->start_time)
        ]);

        return $this->sendResponse(ParkingResource::make($parking), '', Response::HTTP_ACCEPTED);
    }
}
