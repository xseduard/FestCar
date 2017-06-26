<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cps_id')->unsigned();
            $table->integer('contrato_vinculacion_id')->unsigned();
            $table->date('fecha_planilla');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('desc_transaccion')->unsigned();
            $table->integer('desc_finca')->unsigned();
            $table->decimal('desc_admin', 3, 2);
            $table->integer('desc_sobrecosto')->unsigned();
            $table->boolean('cuatro_por_mil')->default(true);            
            $table->boolean('irregularidad')->default(false);
            $table->decimal('subtotal', 19, 2);
            $table->decimal('total', 19, 2);
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
        Schema::drop('pagos');
    }
}
