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
            $store = $this->vehicleService->storeVehicle($data);
            if (is_array($store)) {
                $response = $store;
            } else {
                $response = [
                    'status' => 201,
                    'message' => 'berhasil create transaction',
                    'data' => $store
                ];
            }
        } catch (\Throwable $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response,$response['status']);
    }

    public function findAll()
    {
        try {
            $response = [
                'status' => 200,
                'message' => 'berhasil get all kendaraan',
                'data' => $this->vehicleService->findAll()
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response,$response['status']);
    }

    public function findById($id)
    {
        try {
            $response = [
                'status' => 200,
                'message' => 'berhasil get kendaraan',
                'data' => $this->vehicleService->findById($id)
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response,$response['status']);
    }

    public function findWithTransaction()
    {
        $vehicles = $this->vehicleService->findWithTransaction();
        return response()->json([
            'status' => 200,
            'message' => 'berhasil get penjualan tiap kendaraan',
            'data' => $vehicles
        ],200);
    }
}
