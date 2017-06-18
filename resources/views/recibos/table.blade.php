<table class="table table-responsive" id="recibos-table">
    <thead>
        <th>Natural Id</th>
        <th>Modo Pago</th>
        <th>Descuento</th>
        <th>Incremento</th>
        <th>Observaciones</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($recibos as $recibo)
        <tr>
            <td>{!! $recibo->natural_id !!}</td>
            <td>{!! $recibo->modo_pago !!}</td>
            <td>{!! $recibo->descuento !!}</td>
            <td>{!! $recibo->incremento !!}</td>
            <td>{!! $recibo->observaciones !!}</td>
            <td>{!! $recibo->created_at !!}</td>
            <td>{!! $recibo->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['recibos.destroy', $recibo->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('recibos.show', [$recibo->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('recibos.edit', [$recibo->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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