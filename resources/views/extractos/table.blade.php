<table class="table table-responsive" id="extractos-table">
    <thead>
        <th>Codigo</th>
        <th>CPS</th>
        <th>Recorrido</th>
        <th>Conductor Uno</th>
        <th>Conductor Dos</th>
        <th>Conductor Tres</th>
        
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($extractos as $extracto)
        <tr>
            <td>{!! $extracto->codigo !!}</td>
            <td>{!! "CPS",str_pad($extracto->ContratoPrestacionServicio_id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! $extracto->recorrido !!}</td>
            <td>{!! $extracto->conductor_uno !!}</td>
            <td>{!! $extracto->conductor_dos !!}</td>
            <td>{!! $extracto->conductor_tres !!}</td>            
            <td>
                {!! Form::open(['route' => ['extractos.destroy', $extracto->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('extractos.show', [$extracto->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('extractos.edit', [$extracto->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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