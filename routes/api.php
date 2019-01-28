<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'AuthController@logout');

    Route::apiResource('usuarios','UsuarioController')->except(['destroy','store']);

    Route::apiResource('articulos','ArticuloController');

    Route::group(['prefix' => 'articulo/{articulo}'], function () {
        Route::apiResource('comentarios','ComentarioController');
    });
});


Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@signup');