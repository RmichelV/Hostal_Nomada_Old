<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class NationalityController extends Controller
{
    
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $nationalities = Nationality::all();
        if($nationalities->isEmpty()){
            $data=[
                'message'=>'No se encontraron nacionalidades registradas',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $data=[
            'nationalities'=>$nationalities,
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
     * Display the specified resource.
     */
    public function show($id)
    {
        $nationalities = Nationality::find($id);
        if(!$nationalities){
            $data=[
                'message'=>'País no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $data=[
            'nationality'=>$nationalities,
            'status'=>200
        ];

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>[
                'required',
                'unique:nationalities,name',
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'
            ]
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validacion',
                'error'=>$validator->errors(),
                'status'=>422
            ];

            return response()->json($data,422);
        }

        $nationalities = Nationality::create([
            'name'=>$request->name
        ]);


        if(!$nationalities){
            $data=[
                'message'=>'Error al ingresar país',
                'status'=>500
            ];

            return response()->json($data,500);
        }
        
        $data=[
            'nationality'=>$nationalities,
            'message'=>'Nacionalidad Agregada correctamente',
            'status'=>201
        ];
        
        return response()->json($data,201);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nacionalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nationalities = Nationality::find($id);

        if(!$nationalities){
            $data = [
                'message'=>'país no encontrado',
                'status'=>404
            ];

            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('nationalities', 'name')->ignore($id),
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'
                ]
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validacion',
                'error'=>$validator->errors(),
                'status'=>422
            ];

            return response()->json($data,422);
        }

        $nationalities->name = $request->name;

        if(!$nationalities->save()){
            $data = [
                'message'=>'Error al actualizar el nombre del país',
                'status'=>500
            ];
            return response()->json($data,500);
        }

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
        $nationalities = Nationality::find($id);

        if(!$nationalities){
            $data = [
                'message'=>'país no encontrado',
                'status'=>404
            ];

            return response()->json($data,404);
        }

        $nationalities->delete();

        $data=[
            'message'=>'el país se ha eliminado correctamente',
            'Status'=>204,
        ];
        
        return response()->json($data,204);
    }
}
