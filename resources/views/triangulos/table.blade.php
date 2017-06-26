<table class="table table-responsive table-hover" id="triangulos-table">
    <thead>
        <th>Texto</th>
        <th>Numero</th>
        <th>Fecha Registro</th>
        <th>Fecha Actualización</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($triangulos as $triangulo)
        <tr>
            <td>{!! $triangulo->texto !!}</td>
            <td>{!! $triangulo->numero !!}</td>
            <td>{!! $triangulo->created_at !!}</td>
            <td>{!! $triangulo->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['triangulos.destroy', $triangulo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('triangulos.show', [$triangulo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('triangulos.edit', [$triangulo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>