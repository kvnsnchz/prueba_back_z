<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloReaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ARTICULOS_REACCIONES', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_articulo')->unsigned();
            $table->integer('id_reaccion')->unsigned();
            $table->timestamps();

            $table->foreign('id_articulo')->references('id')->on('ARTICULOS')->onDelete('cascade');
            $table->foreign('id_reaccion')->references('id')->on('REACCIONES')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ARTICULOS_REACCIONES');
    }
}
