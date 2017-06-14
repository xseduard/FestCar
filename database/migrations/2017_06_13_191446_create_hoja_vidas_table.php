<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHojaVidasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja_vidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('natural_id')->unsigned();
            $table->integer('ciudad')->unsigned();
            $table->date('fecha');
            $table->string('empleo_cargo_solicitado');
            $table->string('codigo_cargo');
            $table->string('i_profesion');
            $table->integer('i_anos_exp_laboral');
            $table->integer('i_lugar_nacimiento')->unsigned();
            $table->date('i_fecha_nacimiento');
            $table->string('i_estado_civil');
            $table->string('i_direccion_domicilio');
            $table->string('i_barrio');
            $table->string('i_telefono');
            $table->string('i_libreta_militar_numero');
            $table->string('i_libreta_distrito_clase');
            $table->boolean('i_vivienda_propia');
            $table->string('i_nombre_arrendador');
            $table->string('i_telefono_arrendador');
            $table->string('i_valor_arriendo');
            $table->boolean('i_esta_trabajando_actualmente');
            $table->string('i_empresa_donde_trabaja');
            $table->boolean('i_empleado_independiente');
            $table->string('i_tipo_contrato');
            $table->string('ii_establecimiento_primaria');
            $table->integer('ii_primaria_ciudad')->unsigned();
            $table->string('ii_primaria_ultimo_grado', 2);
            $table->date('ii_primaria_fecha');
            $table->string('ii_establecimiento_bachillerato');
            $table->integer('ii_bachillerato_ciudad')->unsigned();
            $table->string('ii_bachillerato_ultimo_grado', 2);
            $table->date('ii_bachillerato_fecha');
            $table->string('ii_establecimiento_superior');
            $table->integer('ii_superior_ciudad')->unsigned();
            $table->string('ii_superior_anos_cursados', 2);
            $table->date('ii_superior_fecha');
            $table->string('ii_superior_titulo_obtenido');
            $table->string('ii_superior_tipo_formacion');
            $table->string('ii_estudios_realiza_actualmente');
            $table->string('ii_horario');
            $table->string('iii_nombre_ultima_actual_empresa');
            $table->string('iii_direccion');
            $table->string('iii_telefono');
            $table->string('iii_nombre_jefe_inmediato');
            $table->string('iii_cargo_desempenado');
            $table->string('iii_funciones_realizadas');
            $table->date('iii_fecha_ingreso');
            $table->date('iii_fecha_retiro');
            $table->string('iii_sueldo_inicial');
            $table->string('iii_sueldo_final_actual');
            $table->string('iii_motivo_retiro');
            $table->string('v_nombre_esposo');
            $table->string('v_profesion_ocupacion');
            $table->string('v_empresa_trabaja');
            $table->string('v_cargo_actual');
            $table->string('v_direccion');
            $table->string('v_telefono');
            $table->date('v_ciudad');
            $table->string('v_numero_dependen', 2);
            $table->string('v_parentesco');
            $table->string('v_edades', 20);
            $table->string('v_nombre_padres');
            $table->string('v_padres_profesion');
            $table->string('vi_nombre_uno');
            $table->string('vi_ocupacion_uno');
            $table->string('vi_direccion_uno');
            $table->string('vi_telefono_uno');
            $table->string('vi_nombre_dos');
            $table->string('vi_ocupacion_dos');
            $table->string('vi_direccion_dos');
            $table->string('vi_telefono_dos');
            $table->string('talla_camisa', 3);
            $table->string('talla_pantalon', 3);
            $table->string('talla_zapato', 3);
            $table->string('seguridad_social');
            $table->string('examen_ingreso');
            $table->string('estatura', 5);
            $table->string('grupo_sanguineo', 3);
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
        Schema::drop('hoja_vidas');
    }
}
