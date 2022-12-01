<?php

namespace App\Services;

use App\Repositories\CarRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException as InvalidArgEx; 

class CarService {

    protected $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository  = $carRepository;
    }
    
    public function storeCar($data,$vehicleId)
    {
        $validator = Validator::make($data, [
            'mesin' => 'required',
            'kapasitas_penumpang' => 'required',
            'tipe' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgEx($validator->errors()->first());
        }

        return $this->carRepository->store($data,$vehicleId);
    }
}