<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo_Reaccion extends Model
{
    protected $table = "ARTICULOS_REACCIONES";
    protected $fillable = array('id_articulo', 'id_reaccion');
    protected $hidden = ['created_at','updated_at'];
    protected $guarded = array('id');

    public function articulo(){
        return $this->belongsTo('App\Articulo','id_articulo','id');
    }

    public function reaccion(){
        return $this->belongsTo('App\Reaccion','id_reaccion','id');
    }

}
