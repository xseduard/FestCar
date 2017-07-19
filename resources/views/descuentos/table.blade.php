<table class="table table-responsive" id="descuentos-table">
    <thead>
        <th>Descuento</th>
        <th>Descripción</th>
        <th>Fecha Registro</th>
        <th>Fecha Actualización</th>
        <th colspan="3" class="text-right">Acciones</th>
    </thead>
    <tbody>
    @foreach($descuentos as $descuento)
        <tr>
            <td>{!! $descuento->nombre !!}</td>
            <td>{!! $descuento->descripcion !!}</td>
            <td>{!! $descuento->created_at !!}</td>
            <td>{!! $descuento->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['descuentos.destroy', $descuento->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('descuentos.show', [$descuento->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('descuentos.edit', [$descuento->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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