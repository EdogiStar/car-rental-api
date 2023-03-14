<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
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
// public Routes
Route::post('/cars', [CarController::class, 'store']);
Route::post('/cars/{id}', [CarController::class, 'destroy']);
Route::put('/cars/{id}', [CarController::class, 'update']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/cars/{id}', [CarController::class, 'show']);
    
    Route::get('/cars', [CarController::class, 'index']);
    Route::post('/logout', [UserController::class, 'logout']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
