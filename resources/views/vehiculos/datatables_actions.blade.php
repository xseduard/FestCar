{!! Form::open(['route' => ['vehiculos.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('vehiculos.show', $id) }}" class='btn btn-default btn-xs'  title="Ver detalle">
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('vehiculos.edit', $id) }}" class='btn btn-default btn-xs'  title="Editar">
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Desea eliminar?')",
        'title' => 'Eliminar'
    ]) !!}
</div>
{!! Form::close() !!}
