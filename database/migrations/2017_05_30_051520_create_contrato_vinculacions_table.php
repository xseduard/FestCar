<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratoVinculacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_vinculaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_contrato', ['AF', 'CP', 'CV', 'CC'])->comment('Administración Flota, Contrato Proveedor, Contrato vinculación, Convenio Colaboración');
            $table->enum('tipo_proveedor', ['Juridico', 'Natural']);

            $table->integer('natural_id')->unsigned();

            $table->integer('juridico_id')->unsigned();

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->string('servicio', 150);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('user_id')->unsigned()->comment('usuario que crea/edita/elimina');
            $table->boolean('aprobado')->comment('Verificación de firma');
            $table->timestamp('fecha_aprobacion');
            $table->integer('usuario_aprobacion')->unsigned()->comment('Usuario que Verifica la firma');
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
        Schema::drop('contrato_vinculaciones');
    }
}
