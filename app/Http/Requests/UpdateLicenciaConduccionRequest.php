<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\LicenciaConduccion;

class UpdateLicenciaConduccionRequest extends Request
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
        return LicenciaConduccion::$rules;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        "natural_id" => "conductor",
        "fecha_expedicion" => "fecha de expedición",    
        ];
    }
    /*
    $FIELDS$
    */
}
