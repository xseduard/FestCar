<table class="table table-responsive" id="contratoVinculacions-table">
    <thead>
        <th>Tipo/No.</th>
        <th>Tipo Proveedor</th>
        <th>Nit/CC</th>
        <th>Nombres/Razón Social</th>        
        <th>Vehículo</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
                
        <th  width="90px">Acciones</th>
    </thead>
    <tbody>
    @foreach($contratoVinculacions as $contratoVinculacion)
        <tr>
            <td title="Tipo: @php 
                switch ($contratoVinculacion->tipo_contrato) {
                    case 'AF':
                       echo "Administración Flota";
                        break;
                    case 'CP':
                       echo "Contrato Proveedor";
                        break;
                    case 'CV':
                       echo "Contrato vinculación";
                        break;
                    case 'CC':
                       echo "Convenio Colaboración";
                        break;                   
                }
                @endphp
            ">
            {!! $contratoVinculacion->tipo_contrato,str_pad($contratoVinculacion->id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! $contratoVinculacion->tipo_proveedor !!}</td>
            @if ($contratoVinculacion->tipo_proveedor=='Natural')
                <td>{!! $contratoVinculacion->natural->cedula !!}</td>
                <td>{!! $contratoVinculacion->natural->nombres, " ", $contratoVinculacion->natural->apellidos !!}</td>
            @else
                <td>{!! $contratoVinculacion->juridico->nit !!}</td>
                <td>{!! $contratoVinculacion->juridico->nombre !!}</td>
            @endif   
            <td><span class="label label-default">{!! $contratoVinculacion->vehiculo->placa !!}</span></td>         
            <td>{!! $contratoVinculacion->fecha_inicio !!}</td>
            <td>{!! $contratoVinculacion->fecha_final !!}</td>
            <td>
                {!! Form::open(['route' => ['contratoVinculacions.destroy', $contratoVinculacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('contratoVinculacions.show', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('contratoVinculacions.print', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    <a href="{!! route('contratoVinculacions.edit', [$contratoVinculacion->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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