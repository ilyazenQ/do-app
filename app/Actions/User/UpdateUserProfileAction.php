<?php

namespace App\Actions\User;

class UpdateUserProfileAction
{
    public function execute(array $fields): \Illuminate\Contracts\Auth\Authenticatable
    {
        auth()->user()->update([
            'name' => $fields['name'],
            'email' => $fields['email']
        ]);
        return auth()->user();
    }
}
