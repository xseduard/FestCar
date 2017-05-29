<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Tecnicomecanica;

class UpdateTecnicomecanicaRequest extends Request
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
        return Tecnicomecanica::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'vehiculo_id' => 'Vehículo',        
        'fecha_expedicion' => 'fecha de expedición',
        'fecha_vencimiento' => 'fecha final de vigencia',
        'cda_nombre' => 'centro de diagnostico automotor',
        'cda_nit' => 'cda Nit',
        'codigo' => 'codigo de control',
        '' => '',     
        ];
    }
    /*
    $FIELDS$
    */
}
