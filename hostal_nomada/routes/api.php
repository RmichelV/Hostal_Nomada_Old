<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NationalityController;
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
// Route::patch('/users/{id}', [UserController::class, 'updatePartial']);
Route::resource('nationalities',NationalityController::class);
Route::resource('rols',RolController::class);
Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('reservationrooms', ReservationRoomController::class);
    Route::apiResource('roomtypes', RoomTypeController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('shifts', ShiftController::class);
    Route::get('/my-reservations', [ReservationController::class, 'getUserReservations']);
    use App\Http\Controllers\AuthController;

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

