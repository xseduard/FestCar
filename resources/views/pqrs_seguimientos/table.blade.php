<table class="table table-responsive" id="pqrsSeguimientos-table">
    <thead>
        <th>Pqrs radicado</th>
        <th>Asunto</th>
        <th>Mensaje</th>
        <th>Tipo</th>
        <th>Por</th>
        <th>Fecha respuesta</th>
        {{-- <th colspan="3">Acciones</th> --}}
    </thead>
    <tbody>
    @foreach($pqrsSeguimientos as $pqrsSeguimiento)
        <tr>
            <td>{!! $pqrsSeguimiento->pqrs->easy_token !!}</td>
            <td>{!! $pqrsSeguimiento->asunto !!}</td>
            <td>{!! $pqrsSeguimiento->mensaje !!}</td>
            <td>{!! $pqrsSeguimiento->tipo !!}</td>
            <td>{!! $pqrsSeguimiento->user->fullname !!}</td>
            <td>{!! $pqrsSeguimiento->created_at->diffForHumans() !!}</td>
            {{-- <td>
                {!! Form::open(['route' => ['pqrsSeguimientos.destroy', $pqrsSeguimiento->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    
                        <a href="{!! route('pqrsSeguimientos.show', [$pqrsSeguimiento->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                    <a href="{!! route('pqrsSeguimientos.edit', [$pqrsSeguimiento->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                        'title' => 'Eliminar'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>