<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rols = Rol::all();

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
     * Display the specified resource.
     */
    public function show($id)
    {
        $rols = rol::find($id);

        if(!$rols){
            $data = [
                'message'=>'Rol no encontrado',
                'status'=>404
            ];

            return response()->json($data,404);
        }

        $data=[
            'rol'=>$rols,
            'status'=>200,
        ];

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('rols', 'name'),
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'            ]
        ]);

        if($validator->fails()){
            $data=[
                'messege'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=> 422
            ];
            return response()->json($data,422);
        }

        $rols =  Rol::create([
            'name'=> $request->name
        ]);

        if(!$rols){
            $data=[
                'messege'=>'Error al crear el rol',
                'status'=> 500
            ];
            return response()->json($data,500);
        }

        $data = [
            'rol'=> $rols,
            'message'=>'rol creado correctamente',
            'status'=> 201
        ];

        return response()->json($data,201);
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
        $rols = Rol::find($id);

        if(!$rols){
            $data=[
                'message'=>'No se encontraron roles',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $validator = validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('rols', 'name')->ignore($id),
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'
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

        $rols->name=$request->name;

        if(!$rols->save()){
            $data=[
                'message'=>'Error al actualizar el rol',
                'status'=>500
            ];
        }

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
        $rols = Rol::find($id);
        
        if(!$rols){
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
