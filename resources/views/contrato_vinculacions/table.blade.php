<table class="table table-responsive" id="contratoVinculacions-table">
    <thead>
        <th>Tipo Contrato</th>
        <th>Tipo Proveedor</th>
        <th>Natural Id</th>
        <th>Juridico Id</th>
        <th>Vehiculo Id</th>
        <th>Servicio</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
        <th>User Id</th>
        <th>Aprobado</th>
        <th>Fecha Aprobacion</th>
        <th>Usuario Aprobacion</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($contratoVinculacions as $contratoVinculacion)
        <tr>
            <td>{!! $contratoVinculacion->tipo_contrato !!}</td>
            <td>{!! $contratoVinculacion->tipo_proveedor !!}</td>
            <td>{!! $contratoVinculacion->natural_id !!}</td>
            <td>{!! $contratoVinculacion->juridico_id !!}</td>
            <td>{!! $contratoVinculacion->vehiculo_id !!}</td>
            <td>{!! $contratoVinculacion->servicio !!}</td>
            <td>{!! $contratoVinculacion->fecha_inicio !!}</td>
            <td>{!! $contratoVinculacion->fecha_final !!}</td>
            <td>{!! $contratoVinculacion->user_id !!}</td>
            <td>{!! $contratoVinculacion->aprobado !!}</td>
            <td>{!! $contratoVinculacion->fecha_aprobacion !!}</td>
            <td>{!! $contratoVinculacion->usuario_aprobacion !!}</td>
            <td>{!! $contratoVinculacion->created_at !!}</td>
            <td>{!! $contratoVinculacion->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['contratoVinculacions.destroy', $contratoVinculacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('contratoVinculacions.show', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
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