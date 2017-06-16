<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSimuladorGastosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulador_gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min');
            $table->integer('max');
            $table->decimal('inversion', 19, 4);
            $table->decimal('llantas_completas', 19, 4);
            $table->decimal('motor_caja_trasmision', 19, 4);
            $table->decimal('ajuste_pintura', 19, 4);
            $table->decimal('rodamiento', 19, 4);
            $table->decimal('cojineria_vidrios', 19, 4);
            $table->decimal('lavado', 19, 4);
            $table->decimal('carroceria', 19, 4);
            $table->decimal('salario_conductor', 19, 4);
            $table->decimal('prestaciones_sociales', 19, 4);
            $table->decimal('seguridad_social', 19, 4);
            $table->decimal('soat', 19, 4);
            $table->decimal('tecnicomecanica', 19, 4);
            $table->decimal('revision_bimensual', 19, 4);
            $table->decimal('contractual', 19, 4);
            $table->decimal('extracontractual', 19, 4);
            $table->decimal('acpm_galon', 19, 4);
            $table->decimal('gasolina_galon', 19, 4);
            $table->decimal('galones_kilometro', 19, 4);
            $table->decimal('aceites_filtros', 19, 4);
            $table->decimal('aditivos', 19, 4);
            $table->decimal('baterias', 19, 4);
            $table->decimal('impuesto_rodamiento', 19, 4);
            $table->decimal('impuesto_semaforizacion', 19, 4);
            $table->decimal('parqueo', 19, 4);
            $table->decimal('tramites_varios', 19, 4);
            $table->decimal('administracion', 19, 4);
            $table->decimal('plan_reposicion_equipo', 19, 4);
            $table->decimal('sistema_comunicacion', 19, 4);
            $table->decimal('gps', 19, 4);
            $table->decimal('otros', 19, 4);
            $table->integer('margen');            
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
        Schema::drop('simulador_gastos');
    }
}
