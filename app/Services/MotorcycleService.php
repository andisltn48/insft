<?php

namespace App\Services;

use App\Repositories\MotorcycleRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException as InvalidAE; 

class MotorcycleService {

    protected $motorcycleRepository;

    public function __construct(MotorcycleRepository $motorcycleRepository)
    {
        $this->motorcycleRepository  = $motorcycleRepository;
    }
    
    public function storeMotorcycle($data,$vehicleId)
    {
        $validator = Validator::make($data, [
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidAE($validator->errors()->first());
        }

        return $this->motorcycleRepository->store($data,$vehicleId);
    }
}