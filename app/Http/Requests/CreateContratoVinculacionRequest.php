<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\ContratoVinculacion;

class CreateContratoVinculacionRequest extends Request
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
     * Obtienes las reglas que se aplican a la solicitud (Request).
     *
     * @return array
     */
    public function rules()
    {
        return ContratoVinculacion::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'tipo_contrato' => 'tipo contrato',
        'tipo_proveedor' => 'tipo proveedor',
        'natural_id' => 'tercero natural',
        'juridico_id' => 'tercero jurídico',
        'vehiculo_id' => 'vehículo',
        'servicio' => 'servicio',
        'fecha_inicio' => 'fecha inicio',
        'fecha_final' => 'fecha final'          
        ];
    }
    /*
    $FIELDS$
    */
}
