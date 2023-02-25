<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
 * @group Auth
 */
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): Response|JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return $this->sendError('The provided credentials are incorrect',[], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $device = substr($request->userAgent() ?? '', 0, 255);

        $expiresAt = $request->remember ? null : now()->addMinutes(config('session.lifetime'));

        return $this->sendResponse([
            'accessToken' => Auth::user()->createToken($device, expiresAt: $expiresAt)->plainTextToken
        ], '', Response::HTTP_CREATED);
    }
}
