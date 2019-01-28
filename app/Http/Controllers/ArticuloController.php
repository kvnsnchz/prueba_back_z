<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use Validator;

class ArticuloController extends Controller
{   
    public function rules($id){
        return ['titulo' => 'required',
                'contenido' => 'required',
                'id_usuario' => 'required|exists:USUARIOS,id',
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
        $articulos = Articulo::orderBy('id', 'DESC')->paginate();
        foreach($articulos as $a){
            $a->usuario;
            $a->articulos_reacciones;
            $a->comentarios;
        }
        return response()->json($articulos,SUCCESS);
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
        
        $articulo = Articulo::create($request->all());
        return response()->json(['message' => 'created successfully','code' => SUCCESS], SUCCESS);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {   
        $articulo->usuario;
        $articulo->articulos_reacciones;
        $articulo->comentarios;
        return response()->json($articulo, SUCCESS);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Articulo $articulo)
    {
        $validator = Validator::make($request->all(),$this->rules($articulo->id));

        if ($validator->fails()) 
            return response()->json(['message' => $validator->errors(), 'code' => BAD_REQUEST], BAD_REQUEST);            
        
        $articulo->update($request->all());
        return response()->json(['message' => 'updated successfully','code' => SUCCESS],SUCCESS);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {   
        $articulo->delete();
        return response()->json(['message' => 'delete successfully', 'code' => SUCCESS],SUCCESS);
    }
}
