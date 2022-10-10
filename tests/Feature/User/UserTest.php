<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\User\UserFactory;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_update_profile(): void
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->post('api/user/update-profile',
            [
                'email' => 'newMail@mail.ru',
                'name'=>'newName'
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['email'], 'newMail@mail.ru');
        $this->assertEquals($response['data']['name'], 'newName');
    }

    public function test_user_can_update_password(): void
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->post('api/user/update-password',
            [
                'current_password' => UserFactory::PASSWORD,
                'new_password'=>'123456a'
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }

}
