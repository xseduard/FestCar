<table class="table table-responsive table-hover" id="extractos-table">
    <thead>
        <th>Consecutivo FUEC</th>
        <th>CPS</th>
        <th>Vehículo</th>
        <th>Contratista</th>
        <th>Recorrido</th>
        <th>Conductor Ppal</th>
        <th>Usuario Creador</th>
        
        <th width="100px">Acciones</th>
    </thead>
    <tbody>
    @foreach($extractos as $extracto)
        <tr>
            <td>305-075-12-<b>{!! $extracto->created_at->format('Y'),"-",str_pad($extracto->ContratoPrestacionServicio_id, 4, "0", STR_PAD_LEFT),"-",str_pad($extracto->codigo, 4, "0", STR_PAD_LEFT) !!}</b></td>
            <td>{!! "CPS",str_pad($extracto->ContratoPrestacionServicio_id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td><span class="label label-default">{!! $extracto->vehiculo->placa !!}</span></td>
            <td>
                @if($extracto->cps->tipo_cliente == 'Natural')
                    {!! $extracto->cps->natural->fullname !!}
                @else
                    @if($extracto->cps->tipo_cliente == 'Juridico')
                        {!! $extracto->cps->juridico->nombre !!}
                    @endif
                @endif
            </td>
            <td>{!! $extracto->recorrido !!}</td>
            <td>{!! $extracto->conductoruno->natural->fullname !!}</td>   
            <td>{!! $extracto->user->fullname !!}</td>        
            <td>
                {!! Form::open(['route' => ['extractos.destroy', $extracto->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('extractos.show', [$extracto->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('extractos.print', [$extracto->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
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