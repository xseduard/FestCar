<table class="table table-responsive" id="pagoRelFacturas-table">
    <thead>
        <th>Pago Id</th>
        <th>Factura Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pagoRelFacturas as $pagoRelFactura)
        <tr>
            <td>{!! $pagoRelFactura->pago_id !!}</td>
            <td>{!! $pagoRelFactura->factura_id !!}</td>
            <td>{!! $pagoRelFactura->created_at !!}</td>
            <td>{!! $pagoRelFactura->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['pagoRelFacturas.destroy', $pagoRelFactura->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pagoRelFacturas.show', [$pagoRelFactura->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pagoRelFacturas.edit', [$pagoRelFactura->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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