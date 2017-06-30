<table class="table table-responsive" id="emdiConductors-table">
    <thead>
        <th>Cédula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Celular</th>
        <th>Última modificación</th>
        <th>Usuario</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($emdiConductors as $emdiConductor)
        <tr>
            <td>{!! $emdiConductor->cedula !!}</td>
            <td>{!! $emdiConductor->nombres !!}</td>
            <td>{!! $emdiConductor->apellidos !!}</td>
            <td>{!! $emdiConductor->celular !!}</td>
            <td>{!! $emdiConductor->updated_at->diffForHumans() !!}</td>
            <td>{!! $emdiConductor->user->fullname !!}</td>
            <td>
                {!! Form::open(['route' => ['emdiConductors.destroy', $emdiConductor->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('emdiConductors.show', [$emdiConductor->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('emdiConductors.edit', [$emdiConductor->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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