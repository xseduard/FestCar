<table class="table table-responsive" id="facturas-table">
    <thead>
        <th>Codigo</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
        <th>Total</th>
        <th>Observacion</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($facturas as $factura)
        <tr>
            <td>{!! $factura->codigo !!}</td>
            <td>{!! $factura->fecha_inicio !!}</td>
            <td>{!! $factura->fecha_final !!}</td>
            <td>{!! $factura->total !!}</td>
            <td>{!! $factura->observacion !!}</td>
            <td>{!! $factura->created_at !!}</td>
            <td>{!! $factura->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('facturas.show', [$factura->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('facturas.edit', [$factura->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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