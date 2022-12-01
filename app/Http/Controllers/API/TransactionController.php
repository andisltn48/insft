<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function storeTransaction(Request $request)
    {
        $data = $request->all();

        try {
            $response = [
                'status' => 201,
                'message' => 'berhasil create transaction',
                'data' => $this->transactionService->storeTransaction($data)
            ];
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
                'message' => 'berhasil get all transaction',
                'data' => $this->transactionService->findAll()
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
                'message' => 'berhasil get transaction',
                'data' => $this->transactionService->findById($id)
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response,$response['status']);
    }
}
