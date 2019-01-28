<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Comentario;
use Validator;

class ComentarioController extends Controller
{
    public function rules($id){
        return ['contenido' => 'required',
                'id_usuario' => 'required|exists:USUARIOS,id',
                ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index(Articulo $articulo)
    {
        $comentarios = Comentario::orderBy('id', 'DESC')->where('id_articulo',$articulo->id)->paginate();
        foreach($comentarios as $c){
            $c->usuario;
            $c->articulo;
        }
        return response()->json($comentarios,SUCCESS);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Articulo $articulo)
    {
        $validator = Validator::make($request->all(),$this->rules(0));

        if ($validator->fails())
            return response()->json(['message' => $validator->errors(),'code' => BAD_REQUEST], BAD_REQUEST);
        
        $request['id_articulo'] = $articulo->id;
        $comentario = Comentario::create($request->all());
        return response()->json(['message' => 'created successfully','code' => SUCCESS], SUCCESS);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo, Comentario $comentario)
    {
        $comentario->usuario;
        $comentario->articulo;
        return response()->json($comentario,SUCCESS);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Articulo $articulo, Comentario $comentario)
    {
        $validator = Validator::make($request->all(),$this->rules($comentario->id));

        if ($validator->fails()) 
            return response()->json(['message' => $validator->errors(), 'code' => BAD_REQUEST], BAD_REQUEST);            
        
        $request['id_articulo'] = $articulo->id;
        $comentario->update($request->all());
        return response()->json(['message' => 'updated successfully','code' => SUCCESS],SUCCESS);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo, Comentario $comentario)
    {
        $comentario->delete();
        return response()->json(['message' => 'delete successfully', 'code' => SUCCESS],SUCCESS);
    }
}
