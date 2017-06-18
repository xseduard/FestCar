<table class="table table-responsive" id="tecnicomecanicas-table">
    <thead>
        <th>Vehículo</th>        
        <th>Consecutivo Runt</th>
        <th>Fecha de Expedición</th>
        <th></th>
        <th>Fecha de Vencimiento</th>
        <th>Estado</th>
        
        <th width="90px">Acciones</th>
    </thead>
    <tbody>
    @foreach($tecnicomecanicas as $tecnicomecanica)
        <tr 
            @if ($tecnicomecanica->fecha_vigencia_inicio != $tecnicomecanica->fecha_vigencia_final->subYear())                    
                class="danger"
            @endif
        >
            <td><span class="label label-default">{!! $tecnicomecanica->vehiculo->placa !!}</span></td> <td>{!! $tecnicomecanica->consecutivo_runt !!}</td>           
            <td>{!! $tecnicomecanica->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td title="{!! $tecnicomecanica->dias_actual_diferencia !!}/{!! $tecnicomecanica->dias_diferencia !!}">
                 <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $tecnicomecanica->dias_actual_diferencia !!}/{!! $tecnicomecanica->dias_diferencia !!}</span>            
            </td>
            <td>{!! $tecnicomecanica->fecha_vigencia_final->format('d-M-Y') !!}</td>
            <td>
                @if ($tecnicomecanica->fecha_vigencia_inicio != $tecnicomecanica->fecha_vigencia_final->subYear())                   
                        <span class="badge badge-danger" title="Verfiqué los datos ingresados, {!! $tecnicomecanica->user->fullname !!}"><i class='fa fa fa-exclamation fa-spin fa-fw'></i> Fechas Inconsistentes</span>
                @else
                    @if ($tecnicomecanica->vigente)
                        <span class="badge badge-success">Vigente</span>
                    @else
                        <span class="badge badge-warning">No Vigente</span>
                    @endif
                @endif
            </td>
            
            <td>
                {!! Form::open(['route' => ['tecnicomecanicas.destroy', $tecnicomecanica->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('tecnicomecanicas.show', [$tecnicomecanica->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('tecnicomecanicas.edit', [$tecnicomecanica->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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