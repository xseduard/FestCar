<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNaturalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('naturales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 12)->unique();

            $table->integer('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('municipios');

            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->enum('genero', ['masculino', 'femenino']);
            $table->string('direccion',150);
            $table->integer('direccion_municipio')->unsigned();
            $table->string('correo', 100);
            $table->string('telefono', 15);
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
        Schema::drop('naturales');
    }
}
