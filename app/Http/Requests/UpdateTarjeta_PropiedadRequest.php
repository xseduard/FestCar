<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Tarjeta_Propiedad;

class UpdateTarjeta_PropiedadRequest extends Request
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
        $array = Tarjeta_Propiedad::$rules;
        $array['vehiculo_id'] = "";
        return $array;

    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        "vehiculo_id" => "Vehículo",
        "licencia_transito" => "licencia de transito",
        "fecha_matricula" => "fecha de matricula",
        "fecha_expedicion" => "fecha de expedicion",
        ];
    }
    /*
    $FIELDS$
    */
}
