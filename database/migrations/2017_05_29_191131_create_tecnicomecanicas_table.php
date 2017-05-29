<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTecnicomecanicasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicomecanicas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->string('codigo_control', 10);
            $table->string('cda_nombre', 100);
            $table->string('cda_nit', 15);
            $table->string('consecutivo_runt', 15);
            $table->date('fecha_expedicion');
            $table->date('fecha_vencimiento');            
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
        Schema::drop('tecnicomecanicas');
    }
}
