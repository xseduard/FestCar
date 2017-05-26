<?php

namespace App\DataTables;

use App\Models\cuadro;
use Form;
use Yajra\Datatables\Services\DataTable;

class cuadroDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'cuadros.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $cuadros = cuadro::query();

        return $this->applyScopes($cuadros);
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
            'nombre_cuadro' => ['name' => 'nombre_cuadro', 'data' => 'nombre_cuadro'],
            'numero' => ['name' => 'numero', 'data' => 'numero'],
            'correo' => ['name' => 'correo', 'data' => 'correo'],
            'created_at' => ['name' => 'created_at', 'data' => 'created_at'],
            'updated_at' => ['name' => 'updated_at', 'data' => 'updated_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cuadros';
    }
}
