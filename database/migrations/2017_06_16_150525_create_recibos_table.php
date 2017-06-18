<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecibosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('natural_id')->unsigned();
            $table->foreign('natural_id')->references('id')->on('naturales');
            $table->string('modo_pago');
            $table->decimal('descuento', 19, 2);
            $table->decimal('incremento', 19, 2);
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
        Schema::drop('recibos');
    }
}
