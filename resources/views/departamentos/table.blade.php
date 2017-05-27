<table class="table table-responsive" id="departamentos-table">
    <thead>
        <th>Nombre</th>
        <th>Fecha de creación</th>
        <th>Ultima actualización</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($departamentos as $departamento)
        <tr>
            <td>{!! $departamento->nombre !!}</td>
            <td>{!! $departamento->created_at !!}</td>
            <td>{!! $departamento->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['departamentos.destroy', $departamento->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- <a href="{!! route('departamentos.show', [$departamento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('departamentos.edit', [$departamento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Esta seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>