<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdiPacientesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emdi_pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 12);
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('celular', 50);
            $table->string('direccion', 150);
            $table->string('ac_cedula', 15);
            $table->string('ac_nombres', 150);
            $table->string('ac_apellidos', 150);
            $table->string('ac_celular', 50);
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
        Schema::drop('emdi_pacientes');
    }
}
