<table class="table table-responsive" id="tarjetaOperacions-table">
    <thead>
        <th>Vehiculo</th>
        <th>Codigo</th>        
        <th>Fecha Expedicion</th>
        <th>Fecha de Inicio Vigencia</th>
        <th>Fecha de Final Vigencia</th>
         <th>Estado</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($tarjetaOperacions as $tarjetaOperacion)
        <tr>
            <td><span class="label label-default">{!! $tarjetaOperacion->vehiculo->placa !!}</span></td>
            <td>{!! $tarjetaOperacion->codigo !!}</td>            
            <td>{!! $tarjetaOperacion->fecha_expedicion->format('d/F/Y') !!}</td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_inicio->format('d/F/Y') !!}</td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_final->format('d/F/Y') !!}</td>
            <td>
                @if (($fecha_actual >= $tarjetaOperacion->fecha_vigencia_inicio) and ($fecha_actual <= $tarjetaOperacion->fecha_vigencia_final))
                    <span class="label label-success">Vigente</span>
                @else
                    <span class="label label-warning">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['tarjetaOperacions.destroy', $tarjetaOperacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('tarjetaOperacions.show', [$tarjetaOperacion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('tarjetaOperacions.edit', [$tarjetaOperacion->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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