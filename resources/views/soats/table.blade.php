<table class="table table-responsive table-hover" id="soats-table">
    <thead>
        <th>Vehículo</th>
        <th>Poliza</th>
        <th>Fecha de Expedición</th>
        <th width="100px">Inicio Vigencia</th>
        <th width="10px"></th>
        <th width="100px">Final Vigencia</th>
        <th></th>
        <th>Estado</th>        
        <th width="70px">Acciones</th>
    </thead>
    <tbody>
    @foreach($soats as $soat)
        <tr 
            @if ($soat->fecha_vigencia_inicio != $soat->fecha_vigencia_final->subYear()->addDay())                    
                class="danger"
            @endif
        >
            <td><span class="label label-default">{!! $soat->vehiculo->placa !!}</span></td>
            <td>{!! $soat->poliza !!}</td>
            <td>{!! $soat->fecha_expedicion->format('d-M-Y') !!}</td>
            <td>{!! $soat->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td custom-title="{!! $soat->dias_actual_diferencia !!}/{!! $soat->dias_diferencia !!}">
                 <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $soat->dias_actual_diferencia !!}/{!! $soat->dias_diferencia !!}</span>            
            </td>
            <td>{!! $soat->fecha_vigencia_final->format('d-M-Y') !!}</td>
            <td>
               
            </td>
            <td>
                @if ($soat->fecha_vigencia_inicio != $soat->fecha_vigencia_final->subYear()->addDay())                   
                        <span class="badge badge-danger" custom-title="Verfiqué los datos ingresados, {!! $soat->user->fullname !!}"><i class='fa fa fa-exclamation fa-spin fa-fw'></i> Fechas Inconsistentes</span>
                @else
                    @if ($soat->vigente)
                        <span class="badge badge-success">Vigente</span>
                    @else
                        <span class="badge badge-warning">No Vigente</span>
                    @endif
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['soats.destroy', $soat->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('soats.show', [$soat->id]) !!}" class='btn btn-default btn-xs' custom-title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('soats.edit', [$soat->id]) !!}" class='btn btn-default btn-xs' custom-title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                        'custom-title' => 'Eliminar'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

