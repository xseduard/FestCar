<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRutasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->decimal('distancia', 5, 2)->comment('km');
            $table->integer('duracion')->unsigned()->comment('minutos');
            $table->integer('valor_sugerido')->unsigned();
            $table->boolean('predefinido')->default(false);
            $table->text('descripcion');
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
        Schema::drop('rutas');
    }
}
