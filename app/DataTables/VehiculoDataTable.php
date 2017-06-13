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
            ->addColumn('action', 'vehiculos.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $vehiculos = Vehiculo::query();

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
            ->addAction(['width' => '10%'])
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
            'placa' => ['name' => 'placa', 'data' => 'placa'],
            'numero_interno' => ['name' => 'numero_interno', 'data' => 'numero_interno'],            
            'capacidad' => ['name' => 'capacidad', 'data' => 'capacidad'],            
            'clase' => ['name' => 'clase', 'data' => 'clase'],
            'modelo' => ['name' => 'modelo', 'data' => 'modelo'],
            'marca' => ['name' => 'marca', 'data' => 'marca'],
            
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
