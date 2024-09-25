<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomController extends Controller
{
    public function index()
    {
        try {
            $rooms = Room::all();
            return RoomResource::collection($rooms)->additional([
                'message' => 'Rooms retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(RoomRequest $request)
    {
        try {
            $room = Room::create($request->validated());
            return (new RoomResource($room))->additional([
                'message' => 'Room created successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $room = Room::findOrFail($id);
            return (new RoomResource($room))->additional([
                'message' => 'Room retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Room not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        try {
            $room->update($request->validated());
            return (new RoomResource($room))->additional([
                'message' => 'Room updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return response()->json([
                'message' => 'Room deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting room',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
