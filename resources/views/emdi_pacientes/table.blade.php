<table class="table table-responsive" id="emdiPacientes-table">
    <thead>
        <th>Cédula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Celular</th>
        <th>Acompañante</th>        
        <th>Última modificación</th>
        <th>Usuario</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($emdiPacientes as $emdiPaciente)
        <tr>
            <td>{!! number_format($emdiPaciente->cedula, 0, '.', '.' ) !!}</td>
            <td>{!! $emdiPaciente->nombres !!}</td>
            <td>{!! $emdiPaciente->apellidos !!}</td>
            <td>{!! $emdiPaciente->celular !!}</td>
            <td>{!! $emdiPaciente->ac_nombres !!}</td>
            
            <td>{!! $emdiPaciente->updated_at->diffForHumans() !!}</td>
            <td>{!! $emdiPaciente->user->fullname !!}</td>
            <td>
                {!! Form::open(['route' => ['emdiPacientes.destroy', $emdiPaciente->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('emdiPacientes.show', [$emdiPaciente->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('emdiPacientes.edit', [$emdiPaciente->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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