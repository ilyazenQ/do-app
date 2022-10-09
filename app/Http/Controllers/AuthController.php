<?php

namespace App\Http\Controllers;

use App\Actions\Auth\CreateNewUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $service
    )
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(RegisterRequest $request)
    {
        return new UserResource($this->service->createNewUser($request->validated()));
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        return $this->service->loginUser($request->validated());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->service->respondWithToken(auth()->refresh());
    }
}
