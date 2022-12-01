<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository {
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function findAll()
    {
        return $this->transaction->with('vehicle.motorcycle','vehicle.car')->get();
    }

    public function findById($id)
    {
        return $this->transaction->with('vehicle.motorcycle','vehicle.car')->find($id);
    }

    public function findByVehicleId($id)
    {
        return $this->transaction->where('vehicle_id',$id)->get();
    }

    public function store($data,$vehicleId)
    {
        $transaction = new $this->transaction;

        $transaction->vehicle_id = $vehicleId;
        $transaction->qty = $data['qty'];
        $transaction->total_price = $data['total_price'];
        $transaction->payment_method = $data['payment_method'];

        $transaction->save();

        return $transaction->fresh();
    }
}