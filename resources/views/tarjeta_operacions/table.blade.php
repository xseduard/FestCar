<table class="table table-responsive" id="tarjetaOperacions-table">
    <thead>
        <th>Vehiculo Id</th>
        <th>Codigo</th>
        <th>Modalidad Servicio</th>
        <th>Radio Accion</th>
        <th>Razon Social Empresa</th>
        <th>Nit</th>
        <th>Direccion</th>
        <th>Fecha Expedicion</th>
        <th>Fecha Vigencia Inicio</th>
        <th>Fecha Vigencia Final</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($tarjetaOperacions as $tarjetaOperacion)
        <tr>
            <td>{!! $tarjetaOperacion->vehiculo_id !!}</td>
            <td>{!! $tarjetaOperacion->codigo !!}</td>
            <td>{!! $tarjetaOperacion->modalidad_servicio !!}</td>
            <td>{!! $tarjetaOperacion->radio_accion !!}</td>
            <td>{!! $tarjetaOperacion->razon_social_empresa !!}</td>
            <td>{!! $tarjetaOperacion->nit !!}</td>
            <td>{!! $tarjetaOperacion->direccion !!}</td>
            <td>{!! $tarjetaOperacion->fecha_expedicion !!}</td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_inicio !!}</td>
            <td>{!! $tarjetaOperacion->fecha_vigencia_final !!}</td>
            <td>{!! $tarjetaOperacion->user_id !!}</td>
            <td>{!! $tarjetaOperacion->created_at !!}</td>
            <td>{!! $tarjetaOperacion->updated_at !!}</td>
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