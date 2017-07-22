<table class="table table-responsive" id="pqrsWebs-table">
    <thead>
        <th>Tipo Documento</th>
        <th>Cedula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Celular</th>
        <th>Ciudad</th>
        <th>Correo</th>
        <th>Motivo</th>
        <th>Servicio</th>
        <th>Observacion</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pqrsWebs as $pqrsWeb)
        <tr>
            <td>{!! $pqrsWeb->tipo_documento !!}</td>
            <td>{!! $pqrsWeb->cedula !!}</td>
            <td>{!! $pqrsWeb->nombres !!}</td>
            <td>{!! $pqrsWeb->apellidos !!}</td>
            <td>{!! $pqrsWeb->celular !!}</td>
            <td>{!! $pqrsWeb->ciudad !!}</td>
            <td>{!! $pqrsWeb->correo !!}</td>
            <td>{!! $pqrsWeb->motivo !!}</td>
            <td>{!! $pqrsWeb->servicio !!}</td>
            <td>{!! $pqrsWeb->observacion !!}</td>
            <td>{!! $pqrsWeb->user_id !!}</td>
            <td>{!! $pqrsWeb->created_at !!}</td>
            <td>{!! $pqrsWeb->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['pqrsWebs.destroy', $pqrsWeb->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pqrsWebs.show', [$pqrsWeb->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pqrsWebs.edit', [$pqrsWeb->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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