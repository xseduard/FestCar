<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('usuario')->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('cedula', 12)->unique();
            $table->string('email');
            $table->string('password', 60);
            $table->enum('role', ['administrador', 'secretaria', 'gerencia', 'asesor', 'invitado', 'aux']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
