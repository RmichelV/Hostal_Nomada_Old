<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRoom\ReservationRoomRequest;
use App\Http\Requests\ReservationRoom\UpdateReservationRoomRequest;
use App\Http\Resources\ReservationRoomResource;
use App\Models\ReservationRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReservationRoomRequest::collection(ReservationRoom::all());
    }

    public function store(ReservationRoomRequest $request)
    {
        $reservationRoom = ReservationRoom::create($request->validated());
        return new ReservationRoomResource($reservationRoom);
    }

    public function show($id)
    {
        $reservationRoom = ReservationRoom::findOrFail($id);
        return new ReservationRoomResource($reservationRoom);
    }

    public function update(UpdateReservationRoomRequest $request, ReservationRoom $reservationRoom)
    {
        $reservationRoom->update($request->validated());
        return new ReservationRoomResource($reservationRoom);
    }

    public function destroy(ReservationRoom $reservationRoom)
    {
        $reservationRoom->delete();
        return response(null, Response::HTTP_OK);
    }
}
