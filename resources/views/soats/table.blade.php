<table class="table table-responsive" id="soats-table">
    <thead>
        <th>Vehiculo</th>
        <th>Poliza</th>
        <th>Fecha Expedicion</th>
        <th>Fecha Vigencia Inicio</th>
        <th>Fecha Vigencia Final</th>
        <th>Estado</th>        
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($soats as $soat)
        <tr>
            <td><span class="label label-default">{!! $soat->vehiculo->placa !!}</span></td>
            <td>{!! $soat->poliza !!}</td>
            <td>{!! $soat->fecha_expedicion !!}</td>
            <td>{!! $soat->fecha_vigencia_inicio !!}</td>
            <td>{!! $soat->fecha_vigencia_final !!}</td>
            <td>
                @if (($fecha_actual >= $soat->fecha_vigencia_inicio) and ($fecha_actual <= $soat->fecha_vigencia_final))
                    <span class="label label-success">Vigente</span>
                @else
                    <span class="label label-warning">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['soats.destroy', $soat->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('soats.show', [$soat->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('soats.edit', [$soat->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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