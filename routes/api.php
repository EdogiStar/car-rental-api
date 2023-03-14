<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/available_cars', [BookingController::class, 'available_cars']);
    Route::post('/book_car', [BookingController::class, 'book_car']);
    Route::get('/booked_cars', [BookingController::class, 'booked_cars']);

    Route::post('/cars', [CarController::class, 'store']);
    Route::post('/cars/{id}', [CarController::class, 'destroy']);
    Route::put('/cars/{id}', [CarController::class, 'update']);
    Route::get('/cars/{id}', [CarController::class, 'show']);    
    Route::get('/cars', [CarController::class, 'index']);
    
    Route::post('/logout', [UserController::class, 'logout']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
