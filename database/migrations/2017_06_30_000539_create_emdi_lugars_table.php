<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdiLugarsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emdi_lugars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('telefono', 50);
            $table->string('direccion', 100);
            $table->integer('municipio_id')->unsigned();
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
        Schema::drop('emdi_lugars');
    }
}
