<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\RoomTypeRequest;
use App\Http\Requests\RoomType\UpdateRoomTypeRequest;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoomTypeResource::collection(RoomType::all());
        // $roomTypes = RoomType::all();

        // return response()->json([
        //     'message' => 'Room types retrieved successfully',
        //     'data' => RoomTypeResource::collection($roomTypes)
        // ], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomTypeRequest $request)
    {
        
        // $roomType = RoomType::create($request->validated());
        // return new RoomTypeResource($roomType);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('room_type_images', 'public');
            $data['image'] = $path;
        }

        $roomType = RoomType::create($data);
        return new RoomTypeResource($roomType);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $roomType = RoomType::findOrFail($id);
        return new RoomTypeResource($roomType);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($roomType->image) {
                Storage::disk('public')->delete($roomType->image);
            }
            // Subir la nueva imagen
            $path = $request->file('image')->store('room_type_images', 'public');
            $data['image'] = $path;
        }

        $roomType->update($data);
        return new RoomTypeResource($roomType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( RoomType $roomType)
    {
        if ($roomType->image) {
            Storage::disk('public')->delete($roomType->image);
        }
        $roomType->delete();
        return response(null, Response::HTTP_OK);
    }
}
