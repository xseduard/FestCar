<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePqrsWebsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_documento', 3);
            $table->string('cedula', 15);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('celular', 30);
            $table->string('ciudad', 50);
            $table->string('correo', 50);
            $table->string('motivo', 30);
            $table->string('servicio', 30);
            $table->string('estado', 50)->default('pendiente');            
            $table->text('observacion');
            $table->integer('easy_token')->unsigned();
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
        Schema::drop('pqrs_webs');
    }
}
