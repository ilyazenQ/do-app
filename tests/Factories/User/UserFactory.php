<?php

namespace Tests\Factories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tests\Factories\FactoryInterface;

class UserFactory implements FactoryInterface
{
    const PASSWORD = "12345678";

    public static function new(): self
    {
        return new self();
    }

    public function create(array $data = [], array $extra = []): Model
    {
        $model = User::create([
            'name' => $data['name'] ?? 'testName',
            'email' => $data['email'] ?? 'test@email.com',
            'password' => $data['password'] ?? Hash::make(self::PASSWORD),
        ]+ $extra);

        return $model->refresh();
    }
}
