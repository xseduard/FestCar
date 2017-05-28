<table class="table table-responsive" id="naturals-table">
    <thead>
        <th>Cédula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Fecha de creación</th>
        <th>Usuario creador</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($naturals as $natural)
        <tr>
            <td>{!! $natural->cedula !!}</td>
            <td>{!! $natural->nombres !!}</td>
            <td>{!! $natural->apellidos !!}</td>
            <td>{!! $natural->correo !!}</td>
            <td>{!! $natural->telefono !!}</td>
            <td>{!! $natural->created_at !!}</td>
            <td>{!! $natural->user->nombres," ", $natural->user->apellidos !!}</td>
            <td>
                {!! Form::open(['route' => ['naturals.destroy', $natural->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('naturals.show', [$natural->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('naturals.edit', [$natural->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>', [
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