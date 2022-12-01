<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Services\MotorcycleService;
use App\Services\CarService;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VehicleService {
    protected $vehicleRepository;
    protected $motorcycleService;
    protected $carService;

    public function __construct(
        VehicleRepository $vehicleRepository,
        MotorcycleService $motorcycleService,
        CarService $carService
    )
    {
        $this->vehicleRepository  = $vehicleRepository;
        $this->motorcycleService  = $motorcycleService;
        $this->carService  = $carService;
    }

    public function findAll()
    {
        return $this->vehicleRepository->findAll();
    }

    public function findById($id)
    {
        return $this->vehicleRepository->findById($id);
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
        try {
            
            $vehicleStore = $this->vehicleRepository->store($data);
            if ($data['type'] == "motorcycle") {
                $this->motorcycleService->storeMotorcycle($data,$vehicleStore->id);
            } elseif ($data['type'] == "car") {
                $this->carService->storeCar($data,$vehicleStore->id);
            }
        } catch (\Throwable $e) {
            $this->deleteVehicle($vehicleStore->id);
            return [
                'status' => 500,
                'error' => $e->getMessage().' vehicle deleted'
            ];
        } 

        return $this->vehicleRepository->findById($vehicleStore->id);
    }

    public function deleteVehicle($id)
    {
        return $this->vehicleRepository->delete($id);
    }

    public function updateVehicle($id,$data)
    {
        return $this->vehicleRepository->update($id,$data);
    }
}