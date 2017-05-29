<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTarjetaPropiedadsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta_propiedads', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->string('licencia_transito', 12);
            $table->string('marca', 100);
            $table->string('linea', 100);
            $table->string('cilindrada', 5);
            $table->string('color', 50);
            $table->string('servicio', 50);
            $table->string('clase_vehiculo', 50);
            $table->string('tipo_carroceria', 50);
            $table->string('combustible', 10);
            $table->string('numero_motor', 30);
            $table->string('numero_serie', 30);
            $table->string('numero_chasis', 30);
            $table->string('restriccion_movilidad', 50);
            $table->string('blindaje', 10);
            $table->string('potencia_hp', 10);
            $table->string('declaracion_importacion', 10);
            $table->date('fecha_importacion');
            $table->string('puertas', 2);
            $table->date('fecha_matricula');
            $table->date('fecha_expedicion');
            $table->string('organismo_transito', 50);
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
        Schema::drop('tarjeta_propiedads');
    }
}
