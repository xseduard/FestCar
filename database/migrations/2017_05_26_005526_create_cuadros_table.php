<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecuadrosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_cuadro', 50);
            $table->integer('numero');
            $table->string('correo', 15);
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
        Schema::drop('cuadros');
    }
}
