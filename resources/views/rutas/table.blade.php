<table class="table table-responsive" id="rutas-table">
    <thead>
        <th>Nombre</th>
        <th>Distancia</th>
        <th>Duración</th>
        <th>Valor</th>
        <th>Predefinido</th>
        <th>Fecha Actualización</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($rutas as $ruta)
        <tr>
            <td>{!! $ruta->nombre !!}</td>
            <td>{!! $ruta->distancia !!} Km</td>
            <td>{!! $ruta->duracion !!} Mins</td>
            <td>{!! "$".number_format($ruta->valor_sugerido, 2, '.', ',' ) !!}</td>
            <td>
                @if($ruta->predefinido)
                  Si
                @else
                  No
                @endif
            </td>
            <td>{!! $ruta->updated_at->format('d-m-Y h:m:s A') !!}</td>
            <td>
                {!! Form::open(['route' => ['rutas.destroy', $ruta->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('rutas.show', [$ruta->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('rutas.edit', [$ruta->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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