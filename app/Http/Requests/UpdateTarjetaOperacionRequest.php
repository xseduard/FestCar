<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\TarjetaOperacion;

class UpdateTarjetaOperacionRequest extends Request
{

    /**
     * Determine si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Obtienes las reglas que se aplican a la solicitud (Request).
     *
     * @return array
     */
    public function rules()
    {
        return TarjetaOperacion::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
       'vehiculo_id' => 'vehículo',
        'codigo' => 'codigo',
        'modalidad_servicio' => 'modalidad de servicio',
        'radio_accion' => 'radio de acción',
        'razon_social_empresa' => 'razón social',
        'nit' => 'nit',
        'direccion' => 'dirección',
        'entidad_expide' => 'entida que expide',
        'fecha_expedicion' => 'fecha de expedición',
        'fecha_vigencia_inicio' => 'fecha vigencia incial',
        'fecha_vigencia_final' => 'fecha vigencia final',     
        ];
    }
    /*
    $FIELDS$
    */
}
