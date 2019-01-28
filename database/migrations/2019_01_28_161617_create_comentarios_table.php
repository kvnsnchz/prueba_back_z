<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('COMENTARIOS', function (Blueprint $table) {
            $table->increments('id');
            $table->text('contenido');
            $table->integer('id_articulo')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();

            $table->foreign('id_articulo')->references('id')->on('ARTICULOS')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('USUARIOS')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('COMENTARIOS');
    }
}
