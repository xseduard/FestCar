<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdiAutorizacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emdi_autorizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta', 100);

            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('emdi_pacientes');

            $table->date('cita_fecha');
            $table->string('cita_hora', 25);

            $table->integer('cita_lugar_id')->unsigned();
            $table->foreign('cita_lugar_id')->references('id')->on('emdi_lugars');

            $table->integer('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('emdi_conductors');
            
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
        Schema::drop('emdi_autorizacions');
    }
}
