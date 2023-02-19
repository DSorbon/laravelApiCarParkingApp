<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\UpdateProfileRequest;
use App\Http\Resources\Api\V1\Auth\ProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request): Response|JsonResponse
    {
        return $this->sendResponse(new ProfileResource(Auth::user()));
    }

    public function update(UpdateProfileRequest $request): Response|JsonResponse
    {
        $validatedData = $request->validated();

        $user = Auth::user();
        $user->update($validatedData);

        return $this->sendResponse(new ProfileResource($user), '', Response::HTTP_ACCEPTED);
    }
}
