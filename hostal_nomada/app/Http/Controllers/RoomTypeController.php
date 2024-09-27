<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\RoomTypeRequest;
use App\Http\Requests\RoomType\UpdateRoomTypeRequest;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    public function index()
    {
        try {
            $roomTypes = RoomType::all();
            return RoomTypeResource::collection($roomTypes)->additional([
                'message' => 'Room types retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(RoomTypeRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('room_type_images', 'public');
                $data['image'] = $path;
            }

            $roomType = RoomType::create($data);
            return (new RoomTypeResource($roomType))->additional([
                'message' => 'Room type created successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating room type',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $roomType = RoomType::findOrFail($id);
            return (new RoomTypeResource($roomType))->additional([
                'message' => 'Room type retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Room type not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($roomType->image) {
                    Storage::disk('public')->delete($roomType->image);
                }
                $path = $request->file('image')->store('room_type_images', 'public');
                $data['image'] = $path;
            }

            $roomType->update($data);
            return (new RoomTypeResource($roomType))->additional([
                'message' => 'Room type updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating room type',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(RoomType $roomType)
    {
        try {
            if ($roomType->image) {
                Storage::disk('public')->delete($roomType->image);
            }
            $roomType->delete();
            return response()->json([
                'message' => 'Room type deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting room type',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
