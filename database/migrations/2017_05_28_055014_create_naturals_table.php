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
        Schema::create('naturals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 12)->unique();
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->enum('genero', ['masculino', 'femenino']);
            $table->string('correo', 100);
            $table->string('telefono', 15);
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
        Schema::drop('naturals');
    }
}
