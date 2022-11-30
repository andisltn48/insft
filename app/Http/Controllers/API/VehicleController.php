<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function storeVehicle(Request $request)
    {
        $data = $request->all();

        try {
            $response = [
                'data' => $this->vehicleService->storeVehicle($data)
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }
}
