<table class="table table-responsive table-hover" id="reciboProductos-table">
    <thead>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Fecha de Creación</th>
        <th>Fecha de Actualización</th>
        <th width="70px">Acciones</th>
    </thead>
    <tbody>
    @foreach($reciboProductos as $reciboProducto)
        <tr>
            <td>{!! $reciboProducto->nombre !!}</td>
            <td>{!! $reciboProducto->precio !!}</td>
            <td>{!! $reciboProducto->stock !!}</td>
            <td>{!! $reciboProducto->created_at->format('d-m-Y') !!}</td>
            <td>{!! $reciboProducto->updated_at->format('d-m-Y') !!}</td>
            <td>
                {!! Form::open(['route' => ['reciboProductos.destroy', $reciboProducto->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('reciboProductos.show', [$reciboProducto->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('reciboProductos.edit', [$reciboProducto->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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