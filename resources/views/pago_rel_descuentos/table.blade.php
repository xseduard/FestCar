<table class="table table-responsive" id="pagoRelDescuentos-table">
    <thead>
        <th>Pago Id</th>
        <th>Descuento Id</th>
        <th>User Id</th>
        <th>Fecha Registro</th>
        <th>Fecha Actualización</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pagoRelDescuentos as $pagoRelDescuento)
        <tr>
            <td>{!! $pagoRelDescuento->pago_id !!}</td>
            <td>{!! $pagoRelDescuento->descuento_id !!}</td>
            <td>{!! $pagoRelDescuento->user_id !!}</td>
            <td>{!! $pagoRelDescuento->created_at !!}</td>
            <td>{!! $pagoRelDescuento->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['pagoRelDescuentos.destroy', $pagoRelDescuento->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pagoRelDescuentos.show', [$pagoRelDescuento->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pagoRelDescuentos.edit', [$pagoRelDescuento->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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