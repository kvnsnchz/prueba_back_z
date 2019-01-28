<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = "USUARIOS";
    protected $fillable = array('nombre','apellido','email','password');
    protected $hidden = ['created_at','updated_at', 'password'];
    protected $guarded = array('id');

    public function articulos(){
       return $this->hasMany('App\Articulo','id_usuario','id');
    }
    
}

