<table class="table table-responsive table-hover" id="revisionPreventivas-table">
    <thead>
        <th>Vehiculo</th>
        <th>Fecha de Inicio Vigencia</th>
        <th></th>
        <th>Fecha de Final Vigencia</th>
        <th>Estado</th>
        <th width="70px">Acciones</th>
    </thead>
    <tbody>
    @foreach($revisionPreventivas as $revisionPreventiva)
        <tr 
            @if ($revisionPreventiva->fecha_vigencia_inicio != $revisionPreventiva->fecha_vigencia_final->subMonth(2))                    
                class="danger"
            @endif
        >
            <td><span class="label label-default">{!! $revisionPreventiva->vehiculo->placa !!}</span></td>
            <td>{!! $revisionPreventiva->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td title="{!! $revisionPreventiva->dias_actual_diferencia !!}/{!! $revisionPreventiva->dias_diferencia !!}">
                 <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $revisionPreventiva->dias_actual_diferencia !!}/{!! $revisionPreventiva->dias_diferencia !!}</span>            
            </td>
            <td>{!! $revisionPreventiva->fecha_vigencia_final->format('d-M-Y') !!}</td>
            <td>
                @if ($revisionPreventiva->fecha_vigencia_inicio != $revisionPreventiva->fecha_vigencia_final->subMonth(2))                   
                        <span class="badge badge-danger" title="Verfiqué los datos ingresados, {!! $revisionPreventiva->user->fullname !!}"><i class='fa fa fa-exclamation fa-spin fa-fw'></i> Fechas Inconsistentes</span>
                @else
                    @if ($revisionPreventiva->vigente)
                        <span class="badge badge-success">Vigente</span>
                    @else
                        <span class="badge badge-warning">No Vigente</span>
                    @endif
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['revisionPreventivas.destroy', $revisionPreventiva->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('revisionPreventivas.show', [$revisionPreventiva->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('revisionPreventivas.edit', [$revisionPreventiva->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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