<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "USUARIOS";
    protected $fillable = array('nombre','apellido','email','password');
    protected $hidden = ['created_at','updated_at', 'password'];
    protected $guarded = array('id');

    public function articulos(){
       return $this->hasMany('App\Articulo','id_usuario','id');
    }
    
}
