<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLicenciaConduccionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licencia_conduccions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('natural_id')->unsigned();
            $table->foreign('natural_id')->references('id')->on('naturales');
            $table->date('fecha_expedicion');
            $table->date('a1');
            $table->date('a2');
            $table->date('b1');
            $table->date('b2');
            $table->date('b3');
            $table->date('c1');
            $table->date('c2');
            $table->date('c3');
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
        Schema::drop('licencia_conduccions');
    }
}
