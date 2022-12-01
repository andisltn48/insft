<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function() {
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['jwt.api']], function() {
        Route::post('/vehicle/store', [VehicleController::class, 'storeVehicle']);
        Route::get('/vehicle/get-all', [VehicleController::class, 'findAll']);
        Route::get('/vehicle/get/{id}', [VehicleController::class, 'findById']);
        
        Route::post('/transaction/store', [TransactionController::class, 'storeTransaction']);
        Route::get('/transaction/get-all', [TransactionController::class, 'findAll']);
        Route::get('/transaction/get/{id}', [TransactionController::class, 'findById']);

        Route::post('/auth/logout', [AuthController::class, 'logout']);
    });
});
