<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\EmdiLugar;

class CreateEmdiLugarRequest extends Request
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
        $array = EmdiLugar::$rules;
        $array['nombre'] = "required|unique:emdi_lugars";
         return $array;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        "" => "",
        "" => "",    
        ];
    }
    /*
    $FIELDS$
    */
}
