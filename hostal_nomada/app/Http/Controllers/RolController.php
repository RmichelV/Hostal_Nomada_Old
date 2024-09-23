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

        if($rols->isEmpty()){
            $data=[
                'message'=>'Roles no encontrados',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $data = [
            'rols' => $rols,
            'status'=>200
        ];
        return response()->json($data, 200);
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
            'nombre'=>[
                'required',
                'string',
                'regex:/^[A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\s\-]+( (de|del|la|el|y|e|o|un|una|los|las|y|entre|con))? [A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\-]+$/'
            ]
        ]);

        if($validator->fails()){
            $data=[
                'messege'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=> 422
            ];
            return response()->json($data,422);
        }

        $rols =  rol::create([
            'nombre'=> $request->nombre
        ]);

        if(!$rols){
            $data=[
                'messege'=>'Error al crear el rol',
                'status'=> 500
            ];
            return response()->json($data,500);
        }

        $data = [
            'rol creado correctamente',
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
    public function update(Request $request, $id)
    {
        $rols = rol::find($id);

        if($rols->isEmpty()){
            $data=[
                'message'=>'No se encontraron roles',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $validator = validator::make($request->all(),[
            'nombre'=>[
                'required',
                'string',
                'regex:/^[A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\s\-]+( (de|del|la|el|y|e|o|un|una|los|las|y|entre|con))? [A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\-]+$/'
            ]
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error al realizar las validaciones',
                'error'=>$validator->errors(),
                'status'=>422
            ];

            return response()->json($data,422);
        }

        $rols->nombre=$request->nombre;

        if(!$rols){
            $data=[
                'message'=>'Error al actualizar el rol',
                'status'=>500
            ];
        }

        $rols->save();

        $data=[
            'message'=>'Se actualizo correctamente el rol',
            'status'=>202
        ];

        return response()->json($data,202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rols = rol::find($id);
        if($rols->isEmpty()){
            $data = [
                'message'=>'No se encontraron los roles',
                'status'=>404
            ];
        }
        $rols->delete();

        $data=[
            'message'=>'El rol se elimino correctamente',
            'status'=>204
        ];

        return response()->json($data,204);
    }
}
