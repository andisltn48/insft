<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use JWTAuth;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login()
    {
        $request = [
            "email" => "admin@gmail.com",
            "password" => "123password"
        ];

        $response = $this->post('/api/v1/auth/login',$request);

        $response->assertStatus(200);
    }

    public function test_logout()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();

        $token = JWTAuth::fromUser($user);
        $response = $this->post('/api/v1/auth/logout/?token='.$token);

        $response->assertStatus(200);
    }
}
