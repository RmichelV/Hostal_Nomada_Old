<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\SalaryRequest;
use App\Http\Requests\Salary\UpdateSalaryRequest;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $salaries = Salary::all();
            return SalaryResource::collection($salaries)->additional([
                'message' => 'Salaries retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryRequest $request)
    {
        try {
            $salary = Salary::create($request->validated());
            return (new SalaryResource($salary))->additional([
                'message' => 'Salary created successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating salary',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $salary = Salary::findOrFail($id);
            return (new SalaryResource($salary))->additional([
                'message' => 'Salary retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Salary not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        try {
            $salary->update($request->validated());
            return (new SalaryResource($salary))->additional([
                'message' => 'Salary updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating salary',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        try {
            $salary->delete();
            return response()->json([
                'message' => 'Salary deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting salary',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

