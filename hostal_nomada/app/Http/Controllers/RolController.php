<?php

namespace App\Http\Controllers;

use App\Models\rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rols = rol::all();

        return response()->json($rols, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'nombre'=>'required',
        ]);

        if($validator->fails()){
            $data=[
                'messege'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }

        $rols =  rol::create([
            'nombre'=> $request->nombre,


        ]);

        if(!$rols){
            $data=[
                'messege'=>'Error al crear el usuario',
                'status'=> 500
            ];

            return response()->json($data,500);
        }

        $data = [
            'rols'=> $rols,
            'status'=> 201
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rol $rol)
    {
        //
    }
}
