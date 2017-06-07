<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\ContratoPrestacionServicio;

class CreateContratoPrestacionServicioRequest extends Request
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
        return ContratoPrestacionServicio::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'tipo_cliente' => 'tipo de cliente',
        'natural_id' => 'tercero natural',
        'juridico_id' => 'tercero jurídico',
        'origen_id' => 'origen',
        'destino_id' => 'destino',
        'servicio' => 'servicio',
        'tipo_cuenta_bancaria' => 'tipo de cuenta',
        'numero_cuenta_bancaria' => 'numero de cuenta',
        'entidad_bancaria' => 'entidad bancaria',        
        'fecha_inicio' => 'fecha de inicio',
        'fecha_final' => 'fecha final',
        'responsable_id' => 'responsable',
        
        ];
    }
    /*
    $FIELDS$
    */
}
