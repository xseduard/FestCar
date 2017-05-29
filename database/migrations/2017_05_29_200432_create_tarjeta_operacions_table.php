<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTarjetaOperacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta_operacions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->string('codigo', 10);
            $table->string('modalidad_servicio', 50);
            $table->string('radio_accion', 50);
            $table->string('razon_social_empresa');
            $table->string('nit', 15);
            $table->string('direccion');
            $table->date('fecha_expedicion');
            $table->date('fecha_vigencia_inicio');
            $table->date('fecha_vigencia_final');
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
        Schema::drop('tarjeta_operacions');
    }
}
