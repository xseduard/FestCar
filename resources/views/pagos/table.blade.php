<table class="table table-responsive" id="pagos-table">
    <thead>
        <th>Cps Id</th>
        <th>Contrato Vinculacion</th>
        <th>Fecha Planilla</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
        <th>Desc Transaccion</th>
        <th>Desc Finca</th>
        <th>Desc Admin</th>
        <th>Cuatro Por Mil</th>
        <th>Desc Sobrecosto</th>
        <th>Irregularidad</th>
        <th>Subtotal</th>
        <th>Total</th>
        <th>User Id</th>
        <th>Fecha Registro</th>
        <th>Fecha Actualización</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pagos as $pago)
        <tr>
            <td>{!! $pago->cps_id !!}</td>
            <td>{!! $pago->contrato_vinculacion_id !!}</td>
            <td>{!! $pago->fecha_planilla !!}</td>
            <td>{!! $pago->fecha_inicio !!}</td>
            <td>{!! $pago->fecha_final !!}</td>
            <td>{!! $pago->desc_transaccion !!}</td>
            <td>{!! $pago->desc_finca !!}</td>
            <td>{!! $pago->desc_admin !!}</td>
            <td>{!! $pago->cuatro_por_mil !!}</td>
            <td>{!! $pago->desc_sobrecosto !!}</td>
            <td>{!! $pago->irregularidad !!}</td>
            <td>{!! $pago->subtotal !!}</td>
            <td>{!! $pago->total !!}</td>
            <td>{!! $pago->user_id !!}</td>
            <td>{!! $pago->created_at !!}</td>
            <td>{!! $pago->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pagos.show', [$pago->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pagos.edit', [$pago->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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