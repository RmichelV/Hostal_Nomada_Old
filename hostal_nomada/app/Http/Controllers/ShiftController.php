<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shift\ShiftRequest;
use App\Models\Shift;
use Illuminate\Http\Response;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Shift::all(),
            'message' => 'Shifts retrieved successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request)
    {
        try {
            $shift = Shift::create($request->validated());
            return response()->json([
                'data' => $shift,
                'message' => 'Shift created successfully'
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating shift',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shift = Shift::find($id);
        if (!$shift) {
            return response()->json([
                'message' => 'Shift not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'data' => $shift,
            'message' => 'Shift retrieved successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftRequest $request, Shift $shift)
    {
        try {
            $shift->update($request->validated());
            return response()->json([
                'data' => $shift,
                'message' => 'Shift updated successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating shift',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        try {
            $shift->delete();
            return response()->json([
                'message' => 'Shift deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting shift',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
