<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->string('poliza', 12)->unique()->comment('Codigo/Número de poliza');
            $table->date('fecha_expedicion');
            $table->date('fecha_vigencia_inicio')->comment('Fecha Inicio Vigencia Soat');
            $table->date('fecha_vigencia_final')->comment('Fecha Final Vigencia Soat');
            $table->string('entidad')->comment('Entidad expide SOAT');
            $table->string('tomador_nombre');
            $table->string('tomador_cedula', 12);
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
        Schema::drop('soats');
    }
}
