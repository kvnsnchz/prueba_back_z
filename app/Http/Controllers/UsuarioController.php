<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Validator;

class UsuarioController extends Controller
{
    public function rules($id){
        return ['email' => 'required|email|unique:USUARIOS,id'.($id ? ",$id" : ''),
                'nombre' => 'required',
                'apellido' => 'required',
                'password' => 'required|string|min:8',
                'imagen' => 'filled|image',
                ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $usuarios = Usuario::paginate();
        foreach($usuarios as $u){
            $u->articulos;
        }
        return response()->json($usuarios,SUCCESS);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rules(0));

        if ($validator->fails())
            return response()->json(['message' => $validator->errors(),'code' => BAD_REQUEST], BAD_REQUEST);
        
        $usuario = Usuario::create($request->all());
        return response()->json(['message' => 'created successfully','code' => SUCCESS], SUCCESS);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        $usuario->articulos;
        return response()->json($usuario, SUCCESS);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Usuario $usuario)
    {
        $validator = Validator::make($request->all(),$this->rules($usuario->id));

        if ($validator->fails()) 
            return response()->json(['message' => $validator->errors(), 'code' => BAD_REQUEST], BAD_REQUEST);            
        
        $usuario->update($request->all());
        return response()->json(['message' => 'updated successfully','code' => SUCCESS],SUCCESS);     
    }

}
