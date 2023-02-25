<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/*
 * @group Auth
 */
class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request): Response|JsonResponse
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        $device = substr($request->userAgent() ?? '', 0, 255);

        return $this->sendResponse([
            'accessToken' => $user->createToken($device)->plainTextToken,
        ], '', Response::HTTP_CREATED);
    }
}
