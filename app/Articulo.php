<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = "ARTICULOS";
    protected $fillable = array('titulo','contenido','id_usuario');
    protected $hidden = ['created_at','updated_at'];
    protected $guarded = array('id');

    public function usuario(){
        return $this->belongsTo('App\Usuario','id_usuario','id');
    }

    public function articulos_reacciones(){
        return $this->hasMany('App\Articulo_Reaccion','id_articulo','id');
    }

    public function comentarios(){
    return $this->hasMany('App\Comentario','id_articulo','id');
    }
}
