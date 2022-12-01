<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException as InvalidArgEx; 

class TransactionService {

    protected $transactionRepository;
    protected $vehicleService;

    public function __construct(
        TransactionRepository $transactionRepository,
        VehicleService $vehicleService
    )
    {
        $this->transactionRepository  = $transactionRepository;
        $this->vehicleService  = $vehicleService;
    }

    public function findAll()
    {
        return $this->transactionRepository->findAll();
    }

    public function findById($id)
    {
        return $this->transactionRepository->findById($id);
    }

    public function findByVehicleId($id)
    {
        return $this->transactionRepository->findByVehicleId($id);
    }
    
    public function storeTransaction($data)
    {
        $validator = Validator::make($data, [
            'vehicle_id' => 'required',
            'qty' => 'required',
            'total_price' => 'required',
            'payment_method' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgEx($validator->errors()->first());
        }

        $vehicle = $this->vehicleService->findById($data['vehicle_id']);
        if ($vehicle) {
            if ($data['qty'] > $vehicle->stock) {
                throw new \Exception("stock kendaraan tidak mencukupi");
            } else {
                $this->vehicleService->updateVehicle($vehicle->id,[
                    'stock' => $vehicle->stock - $data['qty']
                ]);
    
                $createTransaction = $this->transactionRepository->store($data,$vehicle->id);

                return $this->findById($createTransaction->id);
            }
        } else {
            throw new \Exception("kendaraan tidak ditemukan");
        }
    }
}