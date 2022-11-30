<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Services\MotorcycleService;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VehicleService {
    protected $vehicleRepository;
    protected $motorcycleService;

    public function __construct(VehicleRepository $vehicleRepository, MotorcycleService $motorcycleService)
    {
        $this->vehicleRepository  = $vehicleRepository;
        $this->motorcycleService  = $motorcycleService;
    }

    public function findAll()
    {
        return $this->vehicleRepository->findAll();
    }

    public function storeVehicle($data)
    {
        $validator = Validator::make($data, [
            'warna' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer',
            'type' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $vehicleStore = $this->vehicleRepository->store($data);
        if ($data['type'] == "motorcycle") {
            try {
                $this->motorcycleService->storeMotorcycle($data,$vehicleStore->id);
            } catch (\Throwable $e) {
                return [
                    'status' => 500,
                    'error' => $e->getMessage()
                ];
            } 
        }

        return $this->vehicleRepository->findById($vehicleStore->id);
    }
}