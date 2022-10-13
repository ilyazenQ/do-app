<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\ResponseWithTokenResource;
use App\Http\Resources\User\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function __construct(
        private AuthService $service
    )
    {
    }

    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource($this->service->createNewUser($request->validated()));
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(LoginRequest $request): ResponseWithTokenResource
    {
        return $this->service->loginUser($request->validated());
    }

    /**
     * Get the authenticated User.
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'data' => [
                'message' => 'Successfully logged out'
            ]
        ]);
    }

    /**
     * Refresh a token.
     */
    public function refresh()
    {
        return $this->service->respondWithToken(auth()->refresh());
    }
}
