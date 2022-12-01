<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use JWTAuth;

class VehicleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_all()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->get('/api/v1/vehicle/get-all?token='.$token);

        $response->assertStatus(200);
    }

    public function test_get_all_with_transaction()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->get('/api/v1/vehicle/get-with-transaction?token='.$token);

        $response->assertStatus(200);
    }

    public function test_get_by_id()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $vehicle = \App\Models\Vehicle::take(1)->first();

        $token = JWTAuth::fromUser($user);
        $response = $this->get('/api/v1/vehicle/get/'.$vehicle->id.'?token='.$token);

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $vehicle = [
            "warna" => "biru",
            "harga" => 10000,
            "tahun" => 2010,
            "type" => "motorcycle",
            "stock" => 20,
            "mesin" => "200cc",
            "tipe_suspensi" => "text",
            "tipe_transmisi" => "text",
        ];

        $token = JWTAuth::fromUser($user);
        $response = $this->post('/api/v1/vehicle/store/?token='.$token,$vehicle);

        $response->assertStatus(201);
    }
}
