{!! Form::open(['route' => ['cuadros.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('cuadros.show', $id) }}" class='btn btn-default btn-xs' title="Ver detalle">
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('cuadros.edit', $id) }}" class='btn btn-default btn-xs' title="Editar">
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Confirma que Desea eliminar?')",
        'title' => 'Eliminar'
    ]) !!}
</div>
{!! Form::close() !!}
