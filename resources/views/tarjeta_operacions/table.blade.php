<table class="table table-responsive table-hover" id="tarjetaOperacions-table">
    <thead>
        <th>Vehiculo</th>
        <th>Codigo</th>        
        <th>Fecha Expedicion</th>
        <th width="120px">Fecha de Inicio Vigencia</th>
        <th width="10px"></th>
        <th width="120px">Fecha de Final Vigencia</th>
         <th>Estado</th>
        <th width="70px">Acciones</th>
    </thead>
    <tbody>
    @foreach($tarjetaOperacions as $tarjetaOperacion)
        <tr>
            <td><span class="label label-default">{!! $tarjetaOperacion->vehiculo->placa !!}</span></td>
            <td>{!! $tarjetaOperacion->codigo !!}</td>            
            <td>{!! $tarjetaOperacion->fecha_expedicion->format('d-M-Y') !!}</td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td custom-title="{!! $tarjetaOperacion->dias_actual_diferencia !!}/{!! $tarjetaOperacion->dias_diferencia !!}">
                 <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $tarjetaOperacion->dias_actual_diferencia !!}/{!! $tarjetaOperacion->dias_diferencia !!}</span>            
            </td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_final->format('d-M-Y') !!}</td>
            <td>
                @if ($tarjetaOperacion->vigente)
                    <span class="badge badge-success">Vigente</span>
                @else
                    <span class="badge badge-warning">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['tarjetaOperacions.destroy', $tarjetaOperacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('tarjetaOperacions.show', [$tarjetaOperacion->id]) !!}" class='btn btn-default btn-xs' custom-title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('tarjetaOperacions.edit', [$tarjetaOperacion->id]) !!}" class='btn btn-default btn-xs' custom-title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                        'custom-title' => 'Eliminar'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>