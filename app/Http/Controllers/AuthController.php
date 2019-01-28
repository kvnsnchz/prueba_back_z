<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class AuthController extends Controller
{   
    public function rules($id){
        return ['email' => 'required|email|unique:USUARIOS,id'.($id ? ",$id" : ''),
                'nombre' => 'required',
                'apellido' => 'required',
                'password' => 'required|string|min:8',
                'imagen' => 'filled|image',
                ];
    }

    public function signup(Request $request)
    {  
        $validator = Validator::make($request->all(),$this->rules(0));

        if ($validator->fails())
            return response()->json(['message' => $validator->errors(),'code' => BAD_REQUEST], BAD_REQUEST);
        
        $user = new User([
                'nombre'     => $request->nombre,
                'apellido' => $request->apellido,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);
        $user->save();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        return response()->json(['message' => 'created successfully','code' => SUCCESS], SUCCESS);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => 'true', 'user' => $user, 'token'=>$token], 200);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 
            'Successfully logged out']);
    }

}