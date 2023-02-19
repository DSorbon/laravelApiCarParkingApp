<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreVehicleRequest;
use App\Http\Requests\Api\V1\UpdateVehicleRequest;
use App\Http\Resources\Api\V1\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    public function index(): Response|JsonResponse
    {
        return $this->sendResponse(VehicleResource::collection(Vehicle::all()));
    }

    public function store(StoreVehicleRequest $request): Response|JsonResponse
    {
        $vehicle = Vehicle::create($request->validated());

        return $this->sendResponse(VehicleResource::make($vehicle), '', Response::HTTP_CREATED);
    }

    public function show(Vehicle $vehicle): Response|JsonResponse
    {
        return $this->sendResponse(VehicleResource::make($vehicle));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): Response|JsonResponse
    {
        $vehicle->update($request->validated());

        return $this->sendResponse(VehicleResource::make($vehicle), '', Response::HTTP_ACCEPTED);
    }

    public function destroy(Vehicle $vehicle): Response|JsonResponse
    {
        $vehicle->delete();

        return $this->sendResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
