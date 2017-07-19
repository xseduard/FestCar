<?php

namespace App\Repositories;

use App\Models\Vehiculo;
use InfyOm\Generator\Common\BaseRepository;
use Caron\Carbon;
use DB;

class VehiculoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'placa',
        'propietario_nombre',
        'propietario_cedula',
        'poseedor_nombre',
        'poseedor_cedula',
        'numero_interno',
        'capacidad',
        'modelo',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vehiculo::class;
    }

    public function consulta_vehiculo($type = null, $placa = null)
    {
        $query = DB::table('vehiculos as vh')
        //->select('vh.placa')
        ->select("vh.placa")
        /*
        ->addSelect(DB::raw("CONCAT (cv.tipo_contrato, LPAD(cv.id,4,'0')) as cvinculado"))
        ->addSelect(DB::raw("CONCAT ('CPS', LPAD(cps.id,4,'0')) as cps_cod"))
        ->addSelect("pg.id as pg_id")
        ->addSelect("rt.nombre as ruta")
        ->addSelect("rt.distancia")
        ->addSelect("rt.duracion")
        ->addSelect("rt.valor_sugerido")
        ->addSelect("prr.cantidad_viajes")
        ->addSelect("prr.valor_final")
        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.distancia) as  decimal(16,1)) AS suma_km"))
        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.duracion/60) as  decimal(16,2)) AS total_duracion_horas"))
        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)) as total_pagados"))
        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)/SUM(prr.cantidad_viajes*rt.distancia)) as dinner_km"))
        ->addSelect(DB::raw("count(DISTINCT pg.id) as cont_pagos"))
        ->addSelect(DB::raw("count(DISTINCT prr.ruta_id) as cont_prr"))
        ->addSelect(DB::raw("round(SUM(cps.s1*prr.cantidad_viajes)) as empresarial"))
        ->addSelect(DB::raw("round(SUM(cps.s2*prr.cantidad_viajes)) as escolar"))
        ->addSelect(DB::raw("round(SUM(cps.s3*prr.cantidad_viajes)) as grupo_usuarios"))
        ->addSelect(DB::raw("round(SUM(cps.s4*prr.cantidad_viajes)) as salud"))
        ->addSelect(DB::raw("round(SUM(cps.s5*prr.cantidad_viajes)) as turismo"))
        */
        ->leftJoin('contrato_vinculaciones as cv', 'cv.vehiculo_id', '=', 'vh.id')
        ->leftJoin('pagos as pg', 'pg.contrato_vinculacion_id', '=', 'cv.id')
        ->leftJoin('contrato_prestacion_servicios as cps', 'cps.id', '=', 'pg.cps_id')
        ->leftJoin('pago_rel_rutas as prr', 'prr.pago_id', '=', 'pg.id')
        ->leftJoin('rutas as rt', 'rt.id', '=', 'prr.ruta_id')

        ->whereNull('vh.deleted_at')
        ->whereNull('cv.deleted_at')
        ->whereNull('pg.deleted_at')
        ->whereNull('prr.deleted_at');

        //->groupBy('vh.placa');
        //->orderBy('vh.placa', 'asc');

        switch ($type) {
            case null:
                return 'No se ha seleccionado ningun tipo de informe';
                break;
            case 'show_vehiculo':
                if (!is_null($placa)) {
                        $query->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.distancia) as  decimal(16,1)) AS suma_km"))
                        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.duracion/60) as  decimal(16,2)) AS total_duracion_horas"))
                        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)) as total_pagados"))
                        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes)) as cont_viajes"))
                        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)/SUM(prr.cantidad_viajes*rt.distancia)) as dinner_km"))
                        ->addSelect(DB::raw("count(DISTINCT pg.id) as cont_pagos"))
                        ->addSelect(DB::raw("count(DISTINCT prr.ruta_id) as cont_prr"))
                        ->addSelect(DB::raw("round(SUM(cps.s1*prr.cantidad_viajes)) as empresarial"))
                        ->addSelect(DB::raw("round(SUM(cps.s2*prr.cantidad_viajes)) as escolar"))
                        ->addSelect(DB::raw("round(SUM(cps.s3*prr.cantidad_viajes)) as grupo_usuarios"))
                        ->addSelect(DB::raw("round(SUM(cps.s4*prr.cantidad_viajes)) as salud"))
                        ->addSelect(DB::raw("round(SUM(cps.s5*prr.cantidad_viajes)) as turismo"));
                        
                        $query->where('vh.placa', $placa)
                                ->groupBy('vh.placa');

                        return $query->first(); 

                } else {
                    return 'Seleccione placa'; 
                }
                break;
            case 'vehiculos_servicios':
                $query->addSelect(DB::raw("round(SUM(cps.s1*prr.cantidad_viajes)) as empresarial"))
                        ->addSelect(DB::raw("round(SUM(cps.s2*prr.cantidad_viajes)) as escolar"))
                        ->addSelect(DB::raw("round(SUM(cps.s3*prr.cantidad_viajes)) as grupo_usuarios"))
                        ->addSelect(DB::raw("round(SUM(cps.s4*prr.cantidad_viajes)) as salud"))
                        ->addSelect(DB::raw("round(SUM(cps.s5*prr.cantidad_viajes)) as turismo"));                        

                $query ->whereNotNull('pg.id')
                        ->groupBy('vh.placa');

                return $query->get();
                break;
            default:
                return 'Mensaje por defecto';
                break;
        }       
         
                       
    }
}
