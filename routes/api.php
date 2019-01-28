<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuarios','UsuarioController')->except(['destroy']);

Route::apiResource('articulos','ArticuloController');

Route::group(['prefix' => 'articulo/{articulo}'], function () {
    Route::apiResource('comentarios','ComentarioController');
});