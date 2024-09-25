<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employees = Employee::all();
            return EmployeeResource::collection($employees)->additional([
                'message' => 'Employees retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->validated());
            return (new EmployeeResource($employee))->additional([
                'message' => 'Employee created successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating employee',
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
            $employee = Employee::findOrFail($id);
            return (new EmployeeResource($employee))->additional([
                'message' => 'Employee retrieved successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Employee not found',
                'status' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update($request->validated());
            return (new EmployeeResource($employee))->additional([
                'message' => 'Employee updated successfully',
                'status' => Response::HTTP_OK,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error updating employee',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return response()->json([
                'message' => 'Employee deleted successfully',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting employee',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
