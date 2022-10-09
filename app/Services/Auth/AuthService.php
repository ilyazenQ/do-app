<?php

namespace App\Services\Auth;

use App\Http\Resources\ResponseWithTokenResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param array $fields
     * @return User
     */
    public function createNewUser(array $fields): User
    {
        return User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]
        );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return ResponseWithTokenResource
     */
    public function respondWithToken($token): ResponseWithTokenResource
    {
        return new ResponseWithTokenResource($token);
    }

    public function loginUser(array $fields)
    {

        $credentials = Arr::only($fields,['email','password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

}
