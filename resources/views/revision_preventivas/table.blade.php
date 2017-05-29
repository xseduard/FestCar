<table class="table table-responsive" id="revisionPreventivas-table">
    <thead>
        <th>Vehiculo Id</th>
        <th>Fecha Vigencia Inicio</th>
        <th>Fecha Vigencia Final</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($revisionPreventivas as $revisionPreventiva)
        <tr>
            <td>{!! $revisionPreventiva->vehiculo_id !!}</td>
            <td>{!! $revisionPreventiva->fecha_vigencia_inicio !!}</td>
            <td>{!! $revisionPreventiva->fecha_vigencia_final !!}</td>
            <td>{!! $revisionPreventiva->user_id !!}</td>
            <td>{!! $revisionPreventiva->created_at !!}</td>
            <td>{!! $revisionPreventiva->updated_at !!}</td>
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