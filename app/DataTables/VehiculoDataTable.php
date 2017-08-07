<?php

namespace App\DataTables;

use App\Models\Vehiculo;
use Form;
use Yajra\Datatables\Services\DataTable;

class VehiculoDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('acciones', 'vehiculos.datatables_actions')
            ->addColumn('documento', function($vehiculos) {
                    if ($vehiculos->tipo_propietario == 'Natural') {
                      return number_format($vehiculos->natural['cedula'], 0, '.', '.' );
                    } else {
                        return $vehiculos->juridico['nit'];
                    }
                    
                })
            ->addColumn('propietario', function($vehiculos) {
                    if ($vehiculos->tipo_propietario == 'Natural') {
                      return $vehiculos->natural['fullname'];
                    } else {
                        return $vehiculos->juridico['nombre'];
                    }
                    
                })
            ->addColumn('contratovinculacion', function($vehiculos) {
                  //return ($vehiculos->contratovinculacion->isEmpty());
                  $sw_exist = null;
                    if ($vehiculos->contratovinculacion->isEmpty()) {
                       return "Sin contrato";
                    } else { 
                     foreach ($vehiculos->contratovinculacion as $key => $value) {
                            if ($value->vigente) {
                                return $value->tipo_contrato.str_pad($value->id, 4, "0", STR_PAD_LEFT);
                                $sw_exist = true;
                                //break;
                            }                                               
                    }                     
                    if (is_null($sw_exist)) {
                            return "Contrato Vencido";
                         } 

                    }                  
                    
                })
            ->editColumn('updated_at', function ($vehiculos) {
                return $vehiculos->updated_at->diffForHumans();
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        //$vehiculos = Vehiculo::with('natural')->select('vehiculos.*');
        $vehiculos = Vehiculo::with('natural')->with('juridico')->with('contratovinculacion');
        //$vehiculos = Vehiculo::query();
        //dd($vehiculos);

        return $this->applyScopes($vehiculos);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            //->addAction(['width' => '140px'])
            ->ajax('')
            ->parameters([
                'dom' => '<"col-sm-12 col-lg-6"B> <"col-sm-12 col-lg-2"l> <"col-sm-12 col-lg-3 pull-right"f> <"col-sm-12"t> <"col-sm-12 col-lg-4"i> <"col-sm-12 col-lg-8"p>',
                'scrollX' => false,
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'],
                'responsive' => true,
                'columnDefs' => [
                     ['responsivePriority' => 1, 'targets' => 0 ],
                     ['responsivePriority' => 2, 'targets' => -1], 
                     ['responsivePriority' => 3, 'targets' => 2] 
                ],
                'order'   => [[0, 'asc']],
                'buttons' => [
                    [
                        'extend' => 'print',
                            'text'=> '<i class="fa fa-bars"></i> Vista Completa',
                            'titleAttr'=> 'Ver todos los vehículos',
                            'className'=> '',
                    ],
                    [
                    'extend' => 'reset',                          
                        'text' => '<i class="fa fa-repeat  fa-flip-horizontal"></i> Reiniciar',
                    ],
                    [
                    'extend' => 'reload',                          
                        'text' => '<i class="fa fa-refresh"></i> Recargar',
                    ],
                    
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Exportar',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    [
                    'extend' => 'colvis',                          
                        'text' => 'Columnas visibles',
                    ],
                                        
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            
            'placa'               => ['name' => 'placa', 'data' => 'placa'],
            'documento'           => ['name' => 'documento', 'data' => 'documento', 'title' => 'CC/Nit', 'orderable' => false, 'searchable' => false, 'exportable' => true, 'printable' => true],
            'propietario'         => ['name' => 'propietario', 'data' => 'propietario', 'title' => 'Propietario', 'orderable' => false, 'searchable' => false, 'exportable' => true, 'printable' => true],
            'contratovinculacion' => ['name' => 'contratovinculacion', 'data' => 'contratovinculacion', 'title' => 'Contrato', 'orderable' => false, 'searchable' => false, 'exportable' => true, 'printable' => true],
            'numero_interno'      => ['name' => 'numero_interno', 'data' => 'numero_interno', 'title' => 'Interno'],
            'capacidad'           => ['name' => 'capacidad', 'data' => 'capacidad'],            
            'clase'               => ['name' => 'clase', 'data' => 'clase'],
            'modelo'              => ['name' => 'modelo', 'data' => 'modelo'],
            'marca'               => ['name' => 'marca', 'data' => 'marca'],
            'updated_at'          => ['name' => 'updated_at', 'data' => 'updated_at','title' => 'Última actualización', 'orderable' => true, 'searchable' => false, 'exportable' => false, 'printable' => false],
            'acciones'            => ['name' => 'acciones', 'data' => 'acciones', 'title' => 'Acciones', 'orderable' => false, 'searchable' => false, 'exportable' => false, 'printable' => false],
            //'propietario'       => ['name' => 'natural.nombres', 'data' => 'natural.nombres', 'title' => 'Propietario', 'orderable' => false, 'searchable' => false, 'exportable' => true, 'printable' => true],
            //'id'                => ['name' => 'naturals.clase', 'data' => 'clase'], 
            
            
        ];
    }
    /*
    'capacidad' => ['name' => 'capacidad', 'data' => 'capacidad'],
            'modelo' => ['name' => 'modelo', 'data' => 'modelo']
    */

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'vehiculos';
    }
}
