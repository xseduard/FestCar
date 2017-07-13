<table class="table table-responsive table-hover" id="contratoVinculacions-table">
    <thead>
        <th>Tipo/No.</th>
        <th>Tipo Proveedor</th>
        <th>Nit/CC</th>
        <th>Nombres/Razón Social</th>        
        <th>Vehículo</th>
        <th width="100px">Fecha Inicio</th>
        <th width="10px"></th>
        <th width="100px">Fecha Final</th>
        <th>Estado</th>                
        <th  width="110px">Acciones</th>
    </thead>
    <tbody>
    @foreach($contratoVinculacions as $contratoVinculacion)
        <tr>
            <td title="Tipo: @php 
                switch ($contratoVinculacion->tipo_contrato) {
                    case 'AF':
                       echo "Administración Flota";
                        break;
                    case 'CP':
                       echo "Contrato Proveedor";
                        break;
                    case 'CV':
                       echo "Contrato vinculación";
                        break;
                    case 'CC':
                       echo "Convenio Colaboración";
                        break;                   
                }
                @endphp
            ">
            {!! $contratoVinculacion->tipo_contrato,str_pad($contratoVinculacion->id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! $contratoVinculacion->tipo_proveedor !!}</td>
            @if ($contratoVinculacion->tipo_proveedor=='Natural')
                <td>{!! $contratoVinculacion->natural->cedula !!}</td>
                <td>{!! $contratoVinculacion->natural->fullname !!}</td>
            @else
                <td>{!! $contratoVinculacion->juridico->nit !!}</td>
                <td>{!! $contratoVinculacion->juridico->nombre !!}</td>
            @endif   
            <td><span class="label label-default">{!! $contratoVinculacion->vehiculo->placa !!}</span></td>
            <td>{!! $contratoVinculacion->fecha_inicio->format('d-m-Y') !!}</td>
            <td title="{!! $contratoVinculacion->dias_actual_diferencia !!}/{!! $contratoVinculacion->dias_diferencia !!}">
                <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $contratoVinculacion->dias_actual_diferencia !!}/{!! $contratoVinculacion->dias_diferencia !!}</span>
            </td>
            <td>{!! $contratoVinculacion->fecha_final->format('d-m-Y') !!}</td>
            <td> 
                @if ($contratoVinculacion->vigente)                    
                    @if($contratoVinculacion->aprobado)
                        <span class="badge badge-success">Vigente</span>
                    @else
                        <span class="badge badge-warning">Pendiente de Aprobación</span>
                    @endif
                @else
                    <span class="badge badge-default">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['contratoVinculacions.destroy', $contratoVinculacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('contratoVinculacions.show', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    @if(!$contratoVinculacion->aprobado)
                        <a href="{!! route('contratoVinculacions.aprobar', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Aprobar" onclick="return confirm('¿Confirma que desea Aprobar este contrato?')"><i class="fa fa-gavel" aria-hidden="true"></i></a>
                    @else
                        <a href="#" disabled="disabled" class='btn btn-success btn-xs' title="Contrato aprobado por: {!! $contratoVinculacion->usuario_aprueba->fullname !!}" target=""><i class="fa fa-check" aria-hidden="true"></i></a>
                    @endif 
                         
                    @if($contratoVinculacion->tipo_contrato != 'AF')
                        <a href="{!! route('contratoVinculacions.print', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    @else
                        <a href="#" disabled="disabled" class='btn btn-default btn-xs' title="Sin plantilla de Contrato" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    @endif
                        <a href="{!! route('contratoVinculacions.edit', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                            'title' => 'Eliminar'
                            ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>