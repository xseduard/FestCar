<table class="table table-responsive" id="emdiLugars-table">
    <thead>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Última modificación</th>
        <th>Usuario</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($emdiLugars as $emdiLugar)
        <tr>
            <td>{!! $emdiLugar->nombre !!}</td>
            <td>{!! $emdiLugar->telefono !!}</td>
            <td>{!! $emdiLugar->direccion !!}</td>
            <td>{!! $emdiLugar->updated_at->diffForHumans() !!}</td>
            <td>{!! $emdiLugar->user->fullname !!}</td>
            <td>
                

                @if(Auth::user()->role != 'autorizador_emdisalud')
                    {!! Form::open(['route' => ['emdiLugars.destroy', $emdiLugar->id], 'method' => 'delete']) !!}
                    <div class='btn-group pull-right'>
                        <!-- 
                            <a href="{!! route('emdiLugars.show', [$emdiLugar->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                        -->
                        <a href="{!! route('emdiLugars.edit', [$emdiLugar->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                            'title' => 'Eliminar'
                            ]) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    <a href="{!! route('emdiLugars.edit', [$emdiLugar->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class='btn btn-danger btn-xs' disabled title="Bloqueado"><i class="glyphicon glyphicon-trash"></i></a>
                       
                @endif 
            </td>
        </tr>
    @endforeach
    </tbody>
</table>