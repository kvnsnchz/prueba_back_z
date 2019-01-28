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
            $u->articulo;
        }
        return response()->json($usuarios,SUCCESS);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
