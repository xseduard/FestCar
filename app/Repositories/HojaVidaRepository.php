<?php

namespace App\Repositories;

use App\Models\HojaVida;
use InfyOm\Generator\Common\BaseRepository;

class HojaVidaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'natural_id',
        'ciudad',
        'fecha',
        'empleo_cargo_solicitado',
        'codigo_cargo',
        'i_profesion',
        'i_anos_exp_laboral',
        'i_lugar_nacimiento',
        'i_fecha_nacimiento',
        'i_estado_civil',
        'i_direccion_domicilio',
        'i_barrio',
        'i_telefono',
        'i_libreta_militar_numero',
        'i_libreta_distrito_clase',
        'i_vivienda_propia',
        'i_nombre_arrendador',
        'i_telefono_arrendador',
        'i_valor_arriendo',
        'i_esta_trabajando_actualmente',
        'i_empresa_donde_trabaja',
        'i_empleado_independiente',
        'i_tipo_contrato',
        'ii_establecimiento_primaria',
        'ii_primaria_ciudad',
        'ii_primaria_ultimo_grado',
        'ii_primaria_fecha',
        'ii_establecimiento_bachillerato',
        'ii_bachillerato_ciudad',
        'ii_bachillerato_ultimo_grado',
        'ii_bachillerato_fecha',
        'ii_establecimiento_superior',
        'ii_superior_ciudad',
        'ii_superior_anos_cursados',
        'ii_superior_fecha',
        'ii_superior_titulo_obtenido',
        'ii_superior_tipo_formacion',
        'ii_estudios_realiza_actualmente',
        'ii_horario',
        'iii_nombre_ultima_actual_empresa',
        'iii_direccion',
        'iii_telefono',
        'iii_nombre_jefe_inmediato',
        'iii_cargo_desempenado',
        'iii_funciones_realizadas',
        'iii_fecha_ingreso',
        'iii_fecha_retiro',
        'iii_sueldo_inicial',
        'iii_sueldo_final_actual',
        'iii_motivo_retiro',
        'v_nombre_esposo',
        'v_profesion_ocupacion',
        'v_empresa_trabaja',
        'v_cargo_actual',
        'v_direccion',
        'v_telefono',
        'v_ciudad',
        'v_numero_dependen',
        'v_parentesco',
        'v_edades',
        'v_nombre_padres',
        'v_padres_profesion',
        'vi_nombre_uno',
        'vi_ocupacion_uno',
        'vi_direccion_uno',
        'vi_telefono_uno',
        'vi_nombre_dos',
        'vi_ocupacion_dos',
        'vi_direccion_dos',
        'vi_telefono_dos',
        'talla_camisa',
        'talla_pantalon',
        'talla_zapato',
        'seguridad_social',
        'examen_ingreso',
        'estatura',
        'grupo_sanguineo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HojaVida::class;
    }
}
