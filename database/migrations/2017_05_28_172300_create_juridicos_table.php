<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJuridicosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit', 15);
            $table->string('nombre')->comment('Nombre o Razon Social');

            $table->integer('natural_id')->unsigned()->comment('Representate Legal');
            $table->foreign('natural_id')->references('id')->on('naturales');

            $table->string('actividad');
            $table->string('telefono', 100);
            $table->string('direccion_fiscal');
            $table->string('direccion_envio');
            $table->string('email', 150);
            $table->text('observaciones');
            $table->boolean('estado')->comment('Estado de la empresa');
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
        Schema::drop('juridicos');
    }
}
