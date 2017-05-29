<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Soat;

class CreateSoatRequest extends Request
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
        return Soat::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        "vehiculo_id" => "Vehículo",        
       'fecha_expedicion' => 'fecha de expedición',
        'fecha_vigencia_inicio' => 'fecha inicio de vigencia',
        'fecha_vigencia_final' => 'fecha final de vigencia',
        "" => "",    
        ];
    }
    /*
    $FIELDS$
    */
}
