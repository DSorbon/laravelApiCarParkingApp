<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/*
 * @group Auth
*/
class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response|JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->sendResponse([],'', Response::HTTP_NO_CONTENT);
    }
}
