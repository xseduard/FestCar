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

            $table->date('fecha_inicio');
            $table->date('fecha_final');
            
            $table->integer('ContratoPrestacionServicio_id')->unsigned();
            $table->foreign('ContratoPrestacionServicio_id')->references('id')->on('contrato_prestacion_servicios');

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->integer('tarjetaoperacion_id')->unsigned();
            $table->foreign('tarjetaoperacion_id')->references('id')->on('tarjeta_operacions');

            $table->integer('soat_id')->unsigned();
            $table->foreign('soat_id')->references('id')->on('soats');

            $table->integer('tecnicomecanica_id')->unsigned()->comment('si es vehiculo nuevo el valor es 0');

            $table->integer('polizaresponsabilidad_id')->unsigned();
            $table->foreign('polizaresponsabilidad_id')->references('id')->on('poliza_responsabilidads');

            $table->integer('contratovinculacion_id')->unsigned()->comment('convenio/consorcio/union temporal');

            $table->string('recorrido', 150);
            
            $table->integer('conductor_uno')->unsigned();
            $table->foreign('conductor_uno')->references('id')->on('licencia_conduccions');

            $table->integer('conductor_dos');
            $table->integer('conductor_tres');

            $table->string('f_licencia_uno', 15)->comment('fecha vigencia Licencia');
            $table->string('f_licencia_dos', 15)->comment('fecha vigencia Licencia');
            $table->string('f_licencia_tres', 15)->comment('fecha vigencia Licencia');

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
        Schema::drop('extractos');
    }
}
