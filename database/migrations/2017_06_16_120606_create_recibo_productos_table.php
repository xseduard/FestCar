<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReciboProductosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->decimal('precio', 19, 2);            
            $table->integer('stock')->unsigned();

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
        Schema::drop('recibo_productos');
    }
}
