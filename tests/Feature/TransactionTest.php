<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use JWTAuth;

class TransactionTest extends TestCase
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
        $response = $this->get('/api/v1/transaction/get-all?token='.$token);

        $response->assertStatus(200);
    }

    public function test_get_by_id()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $transaction = \App\Models\Transaction::take(1)->first();

        $token = JWTAuth::fromUser($user);
        $response = $this->get('/api/v1/transaction/get/'.$transaction->id.'?token='.$token);

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $vehicle = \App\Models\Vehicle::take(1)->first();
        $transaction = [
            "vehicle_id"=>$vehicle->id,
            "qty"=>1,
            "total_price"=>10000000,
            "payment_method"=>"cash"
        ];

        $token = JWTAuth::fromUser($user);
        $response = $this->post('/api/v1/transaction/store/?token='.$token,$transaction);

        $response->assertStatus(201);
    }
}
