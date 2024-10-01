<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\ReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        try {
            $reservations = Reservation::all();
            return ReservationResource::collection($reservations)->additional([
                'message' => 'Reservations retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entry_date' => 'required|date',
            'depature_date' => 'required|date',
            'rooms' => 'required|array', 
        ]);
    
        $reservation = Reservation::create([
            'user_id' => Auth::id(), 
            'entry_date' => $validated['entry_date'],
            'depature_date' => $validated['depature_date'],
        ]);
    
        // Asocia las habitaciones seleccionadas
        $reservation->rooms()->attach($validated['rooms']);
    
        return response()->json(['message' => 'Reserva creada exitosamente'], 201);
    }
    


    public function show($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            return (new ReservationResource($reservation))->additional([
                'message' => 'Reservation retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Reservation not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        try {
            $reservation->update($request->validated());
            return (new ReservationResource($reservation))->additional([
                'message' => 'Reservation updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating reservation',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return response()->json([
                'message' => 'Reservation deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting reservation',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getUserReservations()
{
    $user = Auth::user();

    $reservations = Reservation::with('rooms')
                                ->where('user_id', 1)
                                ->get();

    return response()->json(['data' => $reservations], 200);
}

}
