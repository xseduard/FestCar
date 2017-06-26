<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Pago;

class UpdatePagoRequest extends Request
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
        return Pago::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'cps_id' => 'contrato prestación de servicio',
        'contrato_vinculacion_id' => 'contrato cinculacion / vehículo',
        'fecha_planilla' => 'fecha de planilla',
        'fecha_inicio' => 'semana inicio',
        'fecha_final' => 'semana final',
        'desc_transaccion' => 'descuento transacción',
        'desc_finca' => 'descuento finca',
        'cuatro_por_mil' => '4x100',
        'desc_sobrecosto' => 'descuento sobrecosto',
        'irregularidad' => 'irregularidades',   
        ];
    }
    /*
    $FIELDS$
    */
}
