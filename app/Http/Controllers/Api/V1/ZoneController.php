<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ZoneResource;
use App\Models\Zone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
 * @group Zone
 *
 */
class ZoneController extends Controller
{
    public function index(): Response|JsonResponse
    {
        $zones = ZoneResource::collection(Zone::all());

        return $this->sendResponse($zones);
    }
}
