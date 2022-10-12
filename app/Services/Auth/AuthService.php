<?php

namespace App\Services\Auth;

use App\Http\Resources\User\ResponseWithTokenResource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

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
     * @param string $token
     *
     * @return \App\Http\Resources\User\ResponseWithTokenResource
     */
    public function respondWithToken($token): ResponseWithTokenResource
    {
        return new ResponseWithTokenResource($token);
    }

    public function loginUser(array $fields): ResponseWithTokenResource
    {
        $credentials = Arr::only($fields, ['email', 'password']);
        $token = auth()->attempt($credentials);
        return $this->respondWithToken($token);
    }

}
