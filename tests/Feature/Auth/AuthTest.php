<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\User\UserFactory;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_login(): void
    {
        $user = UserFactory::new()->create();

        $response = $this->post('api/auth/login', [
            'email' => $user->email,
            'password' => UserFactory::PASSWORD,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals(count($response['data']), 4);
    }

    public function test_user_can_logout()
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->post('api/auth/logout', []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'message' => 'Successfully logged out'
                ]
            ]);
    }

    public function test_user_can_refresh_token(): void
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->post('api/auth/refresh', []);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals(count($response['data']), 4);
    }
}
