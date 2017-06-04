<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiculosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa', 6)->unique();            
            $table->string('propietario_nombre')->comment('Dueño segun la tarjeta de propiedad');
            $table->string('propietario_cedula', 12);
            $table->string('poseedor_nombre');
            $table->string('poseedor_cedula', 12);
            $table->string('numero_interno', 3)->comment('Numero indicado por la empresa');
            $table->string('capacidad', 2)->comment('capacidad ocupantes/pasajeros');
            $table->string('modelo', 4)->comment('modelo año');
            $table->string('marca', 20);
            $table->string('clase', 20);
            $table->boolean('propiedad')->comment('Veridicar si es de la empresa');
            $table->text('observaciones');
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
        Schema::drop('vehiculos');
    }
}
