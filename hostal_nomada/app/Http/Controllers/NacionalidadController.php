<?php

namespace App\Http\Controllers;

use App\Models\nacionalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nacionalidades = nacionalidad::all();
        if($nacionalidades->isEmpty()){
            $data=[
                'message'=>'No se encontraron nacionalidades registradas',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $data=[
            'nacionalidades'=>$nacionalidades,
            'status'=>200
        ];

        return response()->json($data,200);

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
        $validator = Validator::make($request->all(),[
            'nombre'=>[
                'required',
                'string',
                'regex:/^[A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\s\-]+( (de|del|la|el|y|e|o|un|una|los|las|y|entre|con))? [A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\-]+$/'
            ]
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validacion',
                'error'=>$validator->errors(),
                'status'=>422
            ];
        }

        $nacionalidades = nacionalidad::create([
            'nombre'->$request->nombre
        ]);


        if(!$nacionalidades){
            $data=[
                'message'=>'Error al ingresar país',
                'status'=>500
            ];

            return response()->json($data,500);
        }

        $data=[
            'nacionalidad'=>$nacionalidades,
            'message'=>'Nacionalidad Agregada correctamente',
            'status'=>201
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nacionalides = nacionalidad::find($id);

        if($nacionalides->isEmpty()){
            $data = [
                'message'=>'país no encontrado',
                'status'=>404
            ];

            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            'nombre'=>[
                'required',
                'string',
                'regex:/^[A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\s\-]+( (de|del|la|el|y|e|o|un|una|los|las|y|entre|con))? [A-Z][a-zA-ZÁÉÍÓÚÑÇáéíóúñç\-]+$/'
            ]
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validacion',
                'error'=>$validator->errors(),
                'status'=>422
            ];
        }

        $nacionalides->nombre = $request->nombre;

        if(!$nacionalides){
            $data = [
                'message'=>'Error al actualizar el nombre del país',
                'status'=>500
            ];
            return response()->json($data,500);
        }

        $nacionalides->save();

        $data=[
            'message'=>'Nombre del país actualizado correctamente',
            'status'=>202
        ];

        return response()->json($data,202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nacionalides = nacionalidad::find($id);

        if($nacionalides->isEmpty()){
            $data = [
                'message'=>'país no encontrado',
                'status'=>404
            ];

            return response()->json($data,404);
        }

        $nacionalides->delete();

        $data=[
            'message'=>'el país se ha eliminado correctamente',
            'Status'=>204,
        ];

        return response()->json($data,204);
    }
}