<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRoom\ReservationRoomRequest;
use App\Http\Requests\ReservationRoom\UpdateReservationRoomRequest;
use App\Http\Resources\ReservationRoomResource;
use App\Models\ReservationRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReservationRoomController extends Controller
{
    public function index()
    {
        try {
            $reservationRooms = ReservationRoom::all();
            return ReservationRoomResource::collection($reservationRooms)->additional([
                'message' => 'Reservation rooms retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ReservationRoomRequest $request)
    {
        try {
            $reservationRoom = ReservationRoom::create($request->validated());
            return (new ReservationRoomResource($reservationRoom))->additional([
                'message' => 'Reservation room created successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating reservation room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $reservationRoom = ReservationRoom::findOrFail($id);
            return (new ReservationRoomResource($reservationRoom))->additional([
                'message' => 'Reservation room retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Reservation room not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateReservationRoomRequest $request, ReservationRoom $reservationRoom)
    {
        try {
            $reservationRoom->update($request->validated());
            return (new ReservationRoomResource($reservationRoom))->additional([
                'message' => 'Reservation room updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating reservation room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ReservationRoom $reservationRoom)
    {
        try {
            $reservationRoom->delete();
            return response()->json([
                'message' => 'Reservation room deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting reservation room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
