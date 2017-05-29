<table class="table table-responsive" id="tarjetaPropiedads-table">
    <thead>
        <th>Placa Vehículo</th>
        <th>Licencia Transito</th>
        <th>Marca</th>
        <th>Linea</th>        
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($tarjetaPropiedads as $tarjetaPropiedad)
        <tr>
            <td>{!! $tarjetaPropiedad->vehiculo->placa !!}</td>
            <td>{!! $tarjetaPropiedad->licencia_transito !!}</td>
            <td>{!! $tarjetaPropiedad->marca !!}</td>
            <td>{!! $tarjetaPropiedad->linea !!}</td>
            <td>
                {!! Form::open(['route' => ['tarjetaPropiedads.destroy', $tarjetaPropiedad->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    
                        <a href="{!! route('tarjetaPropiedads.show', [$tarjetaPropiedad->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    <a href="{!! route('tarjetaPropiedads.edit', [$tarjetaPropiedad->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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