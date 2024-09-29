<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        if($users->isEmpty()){
            $data=[
                'message'=>'No se encontraron usuarios',
                'status'=>404,
            ];
            return response()->json($data,404);
        }
        
        $data = [
            'users'=>$users,
            'status'=>200,
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
            'name'=>[
                    'required', 
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'last_name'=>[
                    'required', 
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'nationality_id' => [
                'required',
                'integer', 
                'exists:nationalities,id', 
            ],
            'identity_number'=>[
                'regex:/^[0-9]{1,10}$/'
            ],
            'birthday' => [
                        'required',
                        'date',
                        function ($attribute, $value, $fail) {
                            $birthday = Carbon::parse($value);
                            $today = Carbon::now();
                            $age = $birthday->age;

                            if ($age < 18) {
                                $fail('Debe tener al menos 18 años.');
                            } elseif ($age > 88) {
                                $fail('Debe tener como máximo 88 años.');
                            }
                        },],  
            'phone'=>[
                'required',
                'regex:/^[0-9]{1,10}$/'],
            'email'=>[
                'required',
                'unique:users,email',
                'email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]).*$/'],
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=>422
            ];
            return response()->json($data,422);
        }

        $users =  User::create([
            'name'=> $request->name,
            'last_name'=> $request->last_name,
            'nationality_id'=> $request->nationality_id,
            'identity_number'=>$request->identity_number,
            'birthday'=> $request->birthday,
            'rol_id'=>3,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(!$users){
            $data=[
                'message'=>'Error al crear el usuario',
                'status'=> 500
            ];

            return response()->json($data,500);
        }


        $data = [
            'user'=> $users,
            'message'=>'usuario agregado correctamente',
            'status'=> 201
        ];

        return response()->json($data,201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $users = User::find($id);
        if(!$users){
            $data=[
                'message'=>'usuario no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $data=[
            'users'=>$users,
            'status'=>200
        ];

        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $users= User::find($id);
        
        if(!$users){
            $data=[
                'message'=>'Usuario no encontrado',
                'Status'=>404,
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            'name'=>[
                    'required', 
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'last_name'=>[
                    'required', 
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'birthday' => [
                        'required',
                        'date',
                        function ($attribute, $value, $fail) {
                            $birthday = Carbon::parse($value);
                            $today = Carbon::now();
                            $age = $birthday->age;

                            if ($age < 18) {
                                $fail('Debe tener al menos 18 años.');
                            } elseif ($age > 88) {
                                $fail('Debe tener como máximo 88 años.');
                            }
                        },],  
            'nationality_id' => [
                'required',
                'integer', 
                'exists:nationalities,id'],
            'identity_number'=>[
                'regex:/^[0-9]{1,10}$/'
            ],
            'rol_id'=>[
                'required',
                'integer'],
            'phone'=>[
                'required',
                'regex:/^[0-9]{1,10}$/'
            ],
            'email'=>'unique:users,email'. $users->id,
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]).*$/'],
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=>422
            ];
            return response()->json($data,422);
        }

        $users->name = $request->name;
        $users->last_name = $request->last_name;
        $users->nationality_id = $request->nationality_id;
        $users->identity_number=$request->identity_number;
        $users->birthday = $request->birthday;
        $users->rol_id = $request->rol_id;
        $users->phone=$request->phone;
        $users->email=$request->email;
        $users->password=$request->password;


        if(!$users){
            $data=[
                'message'=>'Error al actualizar el usuario',
                'status'=> 500
            ];

            return response()->json($data,500);
        }

        $users->save();

        $data = [
            'message'=>'Usuario Actualizado',
            'status'=> 202
        ];

        return response()->json($data,202);
    }
    
    public function updatePartial(Request $request, $id)
    {
        $users= User::find($id);
        
        if(!$users){
            $data=[
                'message'=>'Usuario no encontrado',
                'Status'=>404,
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            'name'=>[
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'last_name'=>[
                    'string', 
                    'max:255', 
                    'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'nationality_id' => [
                'integer', 
                'exists:nationalities,id'],
            'identity_number'=>[
                'regex:/^[0-9]{1,10}$/'
            ],
            'birthday' => [
                        'date',
                        function ($attribute, $value, $fail) {
                            $birthday = Carbon::parse($value);
                            $today = Carbon::now();
                            $age = $birthday->age;

                            if ($age < 18) {
                                $fail('Debe tener al menos 18 años.');
                            } elseif ($age > 88) {
                                $fail('Debe tener como máximo 88 años.');
                            }
                        },],  
            'rol_id'=>'integer',
            'phone'=>['regex:/^[0-9]{1,10}$/'],
            'email'=>'unique:users,email'. $users->id,
            'password' => [
                'string',
                'min:8',
                'regex:/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]).*$/'],
        ]);

        if($validator->fails()){
            $data=[
                'message'=>'Error en la validación de datos',
                'errors'=> $validator->errors(),
                'status'=>422
            ];
            return response()->json($data,422);
        }

        if($request->has('name')){
            $users->name = $request->name;
        }
        if($request->has('last_name')){
            $users->last_name = $request->last_name;
        }
        if($request->has('birthday')){
            $users->birthday = $request->birthday;
        }
        if($request->has('nationality_id')){
            $users->nationality_id = $request->nationality_id;
        }
        if($request->has('nationality_id')){
            $users->identity_number = $request->identity_number;
        }
        if($request->has('rol_id')){
            $users->rol_id = $request->rol_id;
        }
        
        if($request->has('phone')){
            $users->phone = $request->phone;
        }
        
        if($request->has('email')){
            $users->email = $request->email;
        }
        
        if($request->has('password')){
            $users->password = $request->password;
        }
        
        $users->save();

        if(!$users->save()){
            $data=[
                'message'=>'Error al actualizar el usuario',
                'status'=> 500
            ];
            return response()->json($data,500);
        }

        $data = [
            'message'=>'Usuario Actualizado',
            'users'=> $users,
            'status'=> 202
        ];

        return response()->json($data,202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $users= User::find($id);
        if(!$users){
            $data=[
                'message'=>'Usuario no encontrado',
                'Status'=>404,
            ];
            return response()->json($data,404);
        }

        $users->delete();
        $data=[
            'message'=>'Usuario eliminado',
            'Status'=>204,
        ];

        return response()->json($data,204);
    }
}
