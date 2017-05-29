<table class="table table-responsive" id="tecnicomecanicas-table">
    <thead>
        <th>Vehículo</th>        
        <th>Consecutivo Runt</th>
        <th>Fecha de Expedición</th>
        <th>Fecha de Vencimiento</th>
        
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($tecnicomecanicas as $tecnicomecanica)
        <tr>
            <td><span class="label label-default">{!! $tecnicomecanica->vehiculo->placa !!}</span></td>            
            <td>{!! $tecnicomecanica->fecha_expedicion !!}</td>
            <td>{!! $tecnicomecanica->fecha_vencimiento !!}</td>
            <td>
                @if (($fecha_actual >= $tecnicomecanica->fecha_expedicion) and ($fecha_actual <= $tecnicomecanica->fecha_vencimiento))
                    <span class="label label-success">Vigente</span>
                @else
                    <span class="label label-warning">No Vigente</span>
                @endif
            </td>
            
            <td>
                {!! Form::open(['route' => ['tecnicomecanicas.destroy', $tecnicomecanica->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('tecnicomecanicas.show', [$tecnicomecanica->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('tecnicomecanicas.edit', [$tecnicomecanica->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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