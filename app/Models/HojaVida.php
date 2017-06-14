<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HojaVida
 * @package App\Models
 * @version June 13, 2017, 7:14 pm COT
 */
class HojaVida extends Model
{
    use SoftDeletes;

    public $table = 'hoja_vidas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'natural_id' => 'integer',
        'ciudad' => 'integer',
        'fecha' => 'date',
        'empleo_cargo_solicitado' => 'string',
        'codigo_cargo' => 'string',
        'i_anos_exp_laboral' => 'integer',
        'i_lugar_nacimiento' => 'integer',
        'i_fecha_nacimiento' => 'date',
        'i_estado_civil' => 'string',
        'i_direccion_domicilio' => 'string',
        'i_barrio' => 'string',
        'i_telefono' => 'string',
        'i_libreta_militar_numero' => 'string',
        'i_libreta_distrito_clase' => 'string',
        'i_vivienda_propia' => 'boolean',
        'i_nombre_arrendador' => 'string',
        'i_telefono_arrendador' => 'string',
        'i_valor_arriendo' => 'string',
        'i_esta_trabajando_actualmente' => 'boolean',
        'i_empresa_donde_trabaja' => 'string',
        'i_empleado_independiente' => 'boolean',
        'i_tipo_contrato' => 'string',
        'ii_establecimiento_primaria' => 'string',
        'ii_primaria_ciudad' => 'integer',
        'ii_primaria_ultimo_grado' => 'string',
        'ii_primaria_fecha' => 'integer',
        'ii_establecimiento_bachillerato' => 'string',
        'ii_bachillerato_ciudad' => 'integer',
        'ii_bachillerato_ultimo_grado' => 'string',
        'ii_bachillerato_fecha' => 'integer',
        'ii_establecimiento_superior' => 'string',
        'ii_superior_ciudad' => 'integer',
        'ii_superior_anos_cursados' => 'string',
        'ii_superior_fecha' => 'integer',
        'ii_superior_titulo_obtenido' => 'string',
        'ii_superior_tipo_formacion' => 'string',
        'ii_estudios_realiza_actualmente' => 'string',
        'ii_horario' => 'string',
        'iii_nombre_ultima_actual_empresa' => 'string',
        'iii_nombre_jefe_inmediato' => 'string',
        'iii_cargo_desempenado' => 'string',
        'iii_funciones_realizadas' => 'string',
        'iii_fecha_ingreso' => 'date',
        'iii_fecha_retiro' => 'date',
        'iii_sueldo_inicial' => 'string',
        'iii_sueldo_final_actual' => 'string',
        'iii_motivo_retiro' => 'string',
        'v_nombre_esposo' => 'string',
        'v_profesion_ocupacion' => 'string',
        'v_empresa_trabaja' => 'string',
        'v_cargo_actual' => 'string',
        'v_direccion' => 'string',
        'v_telefono' => 'string',
        'v_ciudad' => 'integer',
        'v_numero_dependen' => 'string',
        'v_parentesco' => 'string',
        'v_edades' => 'string',
        'v_nombre_padres' => 'string',
        'v_padres_profesion' => 'string',
        'vi_nombre_uno' => 'string',
        'vi_ocupacion_uno' => 'string',
        'vi_direccion_uno' => 'string',
        'vi_telefono_uno' => 'string',
        'vi_nombre_dos' => 'string',
        'vi_ocupacion_dos' => 'string',
        'vi_direccion_dos' => 'string',
        'vi_telefono_dos' => 'string',
        'talla_camisa' => 'string',
        'talla_pantalon' => 'string',
        'talla_zapato' => 'string',
        'seguridad_social' => 'string',
        'examen_ingreso' => 'string',
        'estatura' => 'string',
        'grupo_sanguineo' => 'string'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'natural_id' => 'required',
        'i_barrio' => '',
        'v_nombre_padres' => '',
        'talla_camisa' => ''
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }

    /**
     * Funciones Especiales
     */
}
