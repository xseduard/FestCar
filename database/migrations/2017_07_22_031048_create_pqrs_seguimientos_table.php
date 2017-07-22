<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePqrsSeguimientosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs_seguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pqrs_id')->unsigned();
            $table->string('asunto', 150);
            $table->text('mensaje');
            $table->string('tipo', 50)->default('respuesta');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pqrs_id')->references('id')->on('pqrs_webs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pqrs_seguimientos');
    }
}
