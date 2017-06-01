<table class="table table-responsive" id="contratoPrestacionServicios-table">
    <thead>
        <th>Tipo Cliente</th>
        <th>Nit/CC</th>
        <th>Nombres/Razón Social</th>      
        
        <th>Fecha Inicio</th>
        <th>Fecha final</th>
       
     
        <th width="100px">Acciones</th>
    </thead>
    <tbody>
    @foreach($contratoPrestacionServicios as $contratoPrestacionServicio)
        <tr>
            <td>{!! $contratoPrestacionServicio->tipo_cliente !!}</td>
             @if ($contratoPrestacionServicio->tipo_cliente=='Natural')
                <td>{!! $contratoPrestacionServicio->natural->cedula !!}</td>
                <td>{!! $contratoPrestacionServicio->natural->nombres, " ", $contratoPrestacionServicio->natural->apellidos !!}</td>
            @else
                <td>{!! $contratoPrestacionServicio->juridico->nit !!}</td>
                <td>{!! $contratoPrestacionServicio->juridico->nombre !!}</td>
            @endif   
                        
            <td>{!! $contratoPrestacionServicio->fecha_inicio !!}</td>
            <td>{!! $contratoPrestacionServicio->fecha_final !!}</td>
           
            <td>
                {!! Form::open(['route' => ['contratoPrestacionServicios.destroy', $contratoPrestacionServicio->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    
                        <a href="{!! route('contratoPrestacionServicios.show', [$contratoPrestacionServicio->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    <a href="{!! route('contratoPrestacionServicios.edit', [$contratoPrestacionServicio->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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