<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CustomerAuthController;
use App\Http\Controllers\Api\OfficeSpaceController;
use App\Http\Controllers\Api\OfficeSpaceTransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('api_key')->group (function () {
    
    Route::get('/city/{city:slug}', [CityController::class, 'show']);
    Route::get('/cities', [CityController::class, 'index']);

    Route::get('/office/{officeSpace:slug}', [OfficeSpaceController::class, 'show']);
    Route::get('/offices', [OfficeSpaceController::class, 'index']);

    Route::post('/office-space-transactions', [OfficeSpaceTransactionController::class, 'store']);
    
    Route::post('/check-transaction', [OfficeSpaceTransactionController::class, 'booking_details']);

    Route::post('/customer/register', [CustomerAuthController::class, 'register']);
    Route::post('/customer/login', [CustomerAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->post('/customer/logout', [CustomerAuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->post('/customer/Register', [CustomerAuthController::class, 'Register']);
    Route::middleware('auth:sanctum')->post('/customer/Login', [CustomerAuthController::class, 'Login']);
    
    
    // Route::get('/office/{slug}', [OfficeSpaceController::class, 'showBySlug']);
    // Route::get('/office-space-transactions', [OfficeSpaceTransactionController::class, 'index']);
    // Route::get('office-space-transactions', [OfficeSpaceTransactionController::class, 'booking_details']);
});