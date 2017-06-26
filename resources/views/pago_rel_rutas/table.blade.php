<table class="table table-responsive" id="pagoRelRutas-table">
    <thead>
        <th>Pago Id</th>
        <th>Ruta Id</th>
        <th>Valor Final</th>
        <th>Cantidad Viajes</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pagoRelRutas as $pagoRelRuta)
        <tr>
            <td>{!! $pagoRelRuta->pago_id !!}</td>
            <td>{!! $pagoRelRuta->ruta_id !!}</td>
            <td>{!! $pagoRelRuta->valor_final !!}</td>
            <td>{!! $pagoRelRuta->cantidad_viajes !!}</td>
            <td>{!! $pagoRelRuta->user_id !!}</td>
            <td>{!! $pagoRelRuta->created_at !!}</td>
            <td>{!! $pagoRelRuta->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['pagoRelRutas.destroy', $pagoRelRuta->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pagoRelRutas.show', [$pagoRelRuta->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pagoRelRutas.edit', [$pagoRelRuta->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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