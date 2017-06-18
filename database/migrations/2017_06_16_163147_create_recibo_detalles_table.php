<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReciboDetallesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recibo_id')->unsigned();
            $table->foreign('recibo_id')->references('id')->on('recibos');

            $table->integer('recibo_producto_id')->unsigned();
            $table->foreign('recibo_producto_id')->references('id')->on('recibo_productos');

            $table->integer('cantidad')->unsigned();
            $table->decimal('precio_final', 19, 2);

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
        Schema::drop('recibo_detalles');
    }
}
