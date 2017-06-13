<table class="table table-responsive" id="contratoPrestacionServicios-table">
    <thead>
        <th>No.</th>
        <th>Tipo Cliente</th>
        <th>Nit/CC</th>
        <th>Nombres/Razón Social</th>  
        <th>Fecha Inicio</th>
        <th>Fecha final</th>
        <th>Estado</th>
       
     
        <th width="110px">Acciones</th>
    </thead>
    <tbody>
    @foreach($contratoPrestacionServicios as $contratoPrestacionServicio)
        <tr>
        <td>
            {!! "CPS",str_pad($contratoPrestacionServicio->id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! $contratoPrestacionServicio->tipo_cliente !!}</td>
             @if ($contratoPrestacionServicio->tipo_cliente=='Natural')
                <td>{!! $contratoPrestacionServicio->natural->cedula !!}</td>
                <td>{!! $contratoPrestacionServicio->natural->nombres, " ", $contratoPrestacionServicio->natural->apellidos !!}</td>
            @else
                <td>{!! $contratoPrestacionServicio->juridico->nit !!}</td>
                <td>{!! $contratoPrestacionServicio->juridico->nombre !!}</td>
            @endif   
                        
           <td>{!! $contratoPrestacionServicio->fecha_inicio->format('d-m-Y') !!}</td>
            <td>{!! $contratoPrestacionServicio->fecha_final->format('d-m-Y') !!}</td>
            <td> 
                @if ($contratoPrestacionServicio->vigente)                    
                    @if($contratoPrestacionServicio->aprobado)
                        <span class="label label-success">Vigente</span>
                    @else
                        <span class="label label-warning">Pendiente de Aprobación</span>
                    @endif
                @else
                    <span class="label label-default">No Vigente</span>
                @endif
            </td>
           
            <td>
                {!! Form::open(['route' => ['contratoPrestacionServicios.destroy', $contratoPrestacionServicio->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>

                @if(!$contratoPrestacionServicio->aprobado)
                    <a href="{!! route('contratoPrestacionServicios.aprobar', [$contratoPrestacionServicio->id]) !!}" class='btn btn-default btn-xs' title="Aprobar" onclick="return confirm('¿Confirma que desea Aprobar este contrato?')"><i class="fa fa-gavel" aria-hidden="true"></i></a>
                @else
                    <a href="#" disabled="disabled" class='btn btn-success btn-xs' title="Contrato aprobado por: {!! $contratoPrestacionServicio->usuario_aprueba->fullname !!}" target=""><i class="fa fa-check" aria-hidden="true"></i></a>
                @endif 

                @if ($contratoPrestacionServicio->tipo_cliente=='Natural')
                        <a href="{!! route('contratoPrestacionServicios.print', [$contratoPrestacionServicio->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                @else
                    <a href="#" disabled="disabled" class='btn btn-default btn-xs' title="Sin plantilla de Contrato" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                @endif
                <!--
                        <a href="{!! route('contratoPrestacionServicios.show', [$contratoPrestacionServicio->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
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