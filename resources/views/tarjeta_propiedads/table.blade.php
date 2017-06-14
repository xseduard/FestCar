<table class="table table-responsive" id="tarjetaPropiedads-table">
    <thead>
        <th>Placa Vehículo</th>
        <th>Licencia Transito</th>
        <th>Marca</th>
        <th>Linea</th>
        <th>Color</th>
        <th>Fecha matricula</th>        
        <th>Fecha expedición</th>
        <th width="90px">Acciones</th>
    </thead>
    <tbody>
    @foreach($tarjetaPropiedads as $tarjetaPropiedad)
        <tr>
            <td><span class="label label-default">{!! $tarjetaPropiedad->vehiculo->placa !!}</span></td>
            <td>{!! $tarjetaPropiedad->licencia_transito !!}</td>
            <td>{!! strtoupper($tarjetaPropiedad->vehiculo->marca) !!}</td>
            <td>{!! strtoupper($tarjetaPropiedad->linea) !!}</td>
            <td>{!! $tarjetaPropiedad->color !!}</td>
            <td>{!! $tarjetaPropiedad->fecha_matricula->format('d-M-Y') !!}</td>
            <td>{!! $tarjetaPropiedad->fecha_expedicion->format('d-M-Y') !!}</td>
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