<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagoRelDescuentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_rel_descuentos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pagos');

            $table->integer('descuento_id')->unsigned();
            $table->foreign('descuento_id')->references('id')->on('descuentos');

            $table->integer('valor')->unsigned();

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
        Schema::drop('pago_rel_descuentos');
    }
}
