<table class="table table-responsive" id="reciboDetalles-table">
    <thead>
        <th>Recibo Id</th>
        <th>Recibo Producto Id</th>
        <th>Cantidad</th>
        <th>Precio Final</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($reciboDetalles as $reciboDetalle)
        <tr>
            <td>{!! $reciboDetalle->recibo_id !!}</td>
            <td>{!! $reciboDetalle->recibo_producto_id !!}</td>
            <td>{!! $reciboDetalle->cantidad !!}</td>
            <td>{!! $reciboDetalle->precio_final !!}</td>
            <td>{!! $reciboDetalle->created_at !!}</td>
            <td>{!! $reciboDetalle->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['reciboDetalles.destroy', $reciboDetalle->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('reciboDetalles.show', [$reciboDetalle->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('reciboDetalles.edit', [$reciboDetalle->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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