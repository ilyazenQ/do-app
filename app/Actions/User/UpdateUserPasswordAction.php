<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordAction
{
    public function execute(array $fields): \Illuminate\Contracts\Auth\Authenticatable
    {
        auth()->user()->update([
            'password' => Hash::make($fields['new_password']),
        ]);

        return auth()->user();
    }
}
