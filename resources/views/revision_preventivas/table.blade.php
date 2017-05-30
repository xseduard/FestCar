<table class="table table-responsive" id="revisionPreventivas-table">
    <thead>
        <th>Vehiculo</th>
        <th>Fecha de Inicio Vigencia</th>
        <th>Fecha de Final Vigencia</th>
        <th>Estado</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($revisionPreventivas as $revisionPreventiva)
        <tr>
            <td><span class="label label-default">{!! $revisionPreventiva->vehiculo->placa !!}</span></td>
            <td>{!! $revisionPreventiva->fecha_vigencia_inicio !!}</td>
            <td>{!! $revisionPreventiva->fecha_vigencia_final !!}</td>
            <td>
                @if (($fecha_actual >= $revisionPreventiva->fecha_vigencia_inicio) and ($fecha_actual <= $revisionPreventiva->fecha_vigencia_final))
                    <span class="label label-success">Vigente</span>
                @else
                    <span class="label label-warning">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['revisionPreventivas.destroy', $revisionPreventiva->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('revisionPreventivas.show', [$revisionPreventiva->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('revisionPreventivas.edit', [$revisionPreventiva->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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