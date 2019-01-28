<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaccion extends Model
{
    protected $table = "REACCIONES";
    protected $fillable = array('descripcion','url_imagen');
    protected $hidden = ['created_at','updated_at'];
    protected $guarded = array('id');

    public function articulos_reacciones(){
       return $this->hasMany('App\Articulo_Reaccion','id_reaccion','id');
    }
}
