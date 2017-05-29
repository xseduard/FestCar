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
        "" => "",
        "" => "",    
        ];
    }
    /*
    $FIELDS$
    */
}
