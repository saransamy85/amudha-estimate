<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EstimateController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */
Route::post('/login', [AuthController::class, 'logins']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', [AuthController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/leads', [LeadController::class, 'index']);

    Route::get('/leads/{id}', [LeadController::class, 'show']);

    Route::post('/leads', [LeadController::class, 'store']);

    Route::put('/leads/{id}', [LeadController::class, 'update']);

    Route::delete('/leads/{id}', [LeadController::class, 'destroy']);
});

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/customers/{id}', [CustomerController::class, 'show']);

Route::post('/customers', [CustomerController::class, 'store']);

Route::put('/customers/{id}', [CustomerController::class, 'update']);

Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

Route::get('/estimates', [EstimateController::class, 'index']);

Route::get('/estimates/{id}', [EstimateController::class, 'show']);

Route::post('/estimates', [EstimateController::class, 'store']);

Route::put('/estimates/{id}', [EstimateController::class, 'update']);

Route::delete('/estimates/{id}', [EstimateController::class, 'destroy']);

Route::get('/estimates/{id}/pdf', [EstimateController::class, 'pdf']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
