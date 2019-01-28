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
       /* $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(20);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);*/
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();//obtenemos el usuario logueado
            $success['token'] =  $user->createToken('MyApp')->accessToken; //creamos el token
            return response()->json(['success' => $success], 200);//se lo enviamos al usuario
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