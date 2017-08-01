<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Soat;

class UpdateSoatRequest extends Request
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
        $array = Soat::$rules;
        $array['poliza'] = "required|numeric|unique:soats,poliza,".$this->route('soats');
        return $array;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'vehiculo_id' => 'Vehículo',
        'poliza' => 'numero de poliza',
        'fecha_expedicion' => 'fecha de expedición',
        'fecha_vigencia_inicio' => 'fecha inicio de vigencia',
        'fecha_vigencia_final' => 'fecha final de vigencia',
        "" => "",    
        ];
    }
}
