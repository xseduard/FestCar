<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit', 20);
            $table->string('nombre_corto', 25)->comment('nombre menor a 25 caracteres');
            $table->string('razon_social');
            $table->string('rte_nombre',150)->comment('representante legal');
            $table->string('rte_apellido',150)->comment('representante legal');
            $table->string('rte_cedula',15)->comment('representante legal');
            $table->string('rte_cedula_ref',25)->comment('ciudad expedicion cedula representante legal');            
            $table->string('rte_cedula_ref_departamento',25)->comment('departamento expedicion cedula representante legal');
            $table->string('correo', 50);
            $table->string('direccion', 150);
            $table->string('direccion_corta', 25);
            $table->string('ciudad', 25)->comment('ciudad sede principal de la empresa');
            $table->string('departamento', 25)->comment('departamento sede principal de la empresa');
            $table->string('telefono', 25);
            $table->string('celular', 25);
            $table->string('cuota_admin', 2);
            $table->string('cuota_admin_valor', 10);
            $table->string('cuota_admin_valor_dos', 10);
            $table->string('pagina_web', 50);
            $table->string('version', 10);
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
        Schema::drop('empresas');
    }
}
