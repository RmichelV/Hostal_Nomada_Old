<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationRoomController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('users',UserController::class);
Route::resource('nacionalidades',NacionalidadController::class);
Route::resource('rols',RolController::class);
Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('reservationrooms', ReservationRoomController::class);
    Route::apiResource('roomtypes', RoomTypeController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('shifts', ShiftController::class);

