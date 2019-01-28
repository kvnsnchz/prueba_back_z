<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "COMENTARIOS";
    protected $fillable = array('contenido','id_usuario', 'id_articulo');
    protected $hidden = ['created_at','updated_at'];
    protected $guarded = array('id');

    public function usuario(){
        return $this->belongsTo('App\Usuario','id_usuario','id');
    }

    public function articulo(){
        return $this->belongsTo('App\Articulo','id_articulo','id');
    }
}
