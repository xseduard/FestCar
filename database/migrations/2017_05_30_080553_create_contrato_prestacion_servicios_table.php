<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratoPrestacionServiciosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_prestacion_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_cliente', ['Natural','Juridico']);
            $table->integer('natural_id')->unsigned();
            $table->integer('juridico_id')->unsigned();

            $table->integer('origen_id')->unsigned();
            $table->foreign('origen_id')->references('id')->on('municipios');
            
            $table->integer('destino_id')->unsigned();
            $table->foreign('destino_id')->references('id')->on('municipios');

            $table->string('servicio', 150);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('tipo_cuenta_bancaria', 20);
            $table->string('numero_cuenta_bancaria', 20);
            $table->string('entidad_bancaria', 50);            
            $table->integer('user_id')->unsigned()->comment('usuario que crea/edita/elimina');
            $table->boolean('aprobado')->comment('Verificación de firma');
            $table->dateTime('fecha_aprobacion');
            $table->integer('usuario_aprobacion')->unsigned()->comment('Usuario que Verifica la firma');

            $table->timestamps();
            $table->softDeletes();
            
            $table->string('rl_id', 14)->default('50.914.925')->comment('Repre. legal');
            $table->string('rl_id_ref', 15)->default('Arboletes')->comment('Repre. legal');
            $table->string('rl_name', 5)->default('Tana')->comment('Repre. legal');
            $table->string('rl_lastname', 18)->default('Coronado Calderin')->comment('Repre. legal');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contrato_prestacion_servicios');
    }
}
