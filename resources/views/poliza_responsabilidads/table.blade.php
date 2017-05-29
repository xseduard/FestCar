<table class="table table-responsive" id="polizaResponsabilidads-table">
    <thead>
        <th>Vehiculo Id</th>
        <th>Codigo</th>
        <th>Fecha Vigencia Inicio</th>
        <th>Fecha Vigencia Final</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($polizaResponsabilidads as $polizaResponsabilidad)
        <tr>
            <td>{!! $polizaResponsabilidad->vehiculo_id !!}</td>
            <td>{!! $polizaResponsabilidad->codigo !!}</td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_inicio !!}</td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_final !!}</td>
            <td>{!! $polizaResponsabilidad->user_id !!}</td>
            <td>{!! $polizaResponsabilidad->created_at !!}</td>
            <td>{!! $polizaResponsabilidad->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['polizaResponsabilidads.destroy', $polizaResponsabilidad->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('polizaResponsabilidads.show', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('polizaResponsabilidads.edit', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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