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
        $vehiculos = Vehiculo::with('natural')->select('vehiculos.*');
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
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'],
                'buttons' => [
                    [
                        'extend' => 'print',
                            'text'=> '<i class="fa fa-print"></i> Imprimir',
                            'titleAttr'=> 'Imprimir Tabla',
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
            'Placa'                => ['name' => 'placa', 'data' => 'placa'],
            'Interno'              => ['name' => 'numero_interno', 'data' => 'numero_interno'],
            //'id'              => ['name' => 'naturals.clase', 'data' => 'clase'], 
            'Capacidad'            => ['name' => 'capacidad', 'data' => 'capacidad'],            
            'Clase'                => ['name' => 'clase', 'data' => 'clase'],
            'modelo'               => ['name' => 'modelo', 'data' => 'modelo'],
            'Marca'                => ['name' => 'marca', 'data' => 'marca'],
            'Última_actualización' => ['name' => 'updated_at', 'data' => 'updated_at'],
            'Acciones'             => ['name' => 'acciones', 'data' => 'acciones', 'orderable' => false, 'searchable' => false],
            
            
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
