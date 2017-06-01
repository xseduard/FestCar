<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtractosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extractos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo');
            
            $table->integer('ContratoPrestacionServicio_id')->unsigned();
            $table->foreign('ContratoPrestacionServicio_id')->references('id')->on('contrato_prestacion_servicios');

            $table->string('recorrido', 150);
            
            $table->integer('conductor_uno')->unsigned();
            $table->foreign('conductor_uno')->references('id')->on('naturales');

            $table->integer('conductor_dos');
            $table->integer('conductor_tres');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('extractos');
    }
}
