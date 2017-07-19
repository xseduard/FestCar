<table class="table table-responsive table-hover" id="polizaResponsabilidads-table">
    <thead>
        <th>Vehiculo</th>
        <th>Codigo</th>
        <th>Fecha de Inicio Vigencia</th>
        <th></th>
        <th>Fecha de Final Vigencia</th>
         <th>Estado</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($polizaResponsabilidads as $polizaResponsabilidad)
        <tr 
            @if ($polizaResponsabilidad->fecha_vigencia_inicio != $polizaResponsabilidad->fecha_vigencia_final->subYear())                    
                class="danger"
            @endif
        >
            <td><span class="label label-default">{!! $polizaResponsabilidad->vehiculo->placa !!}</span></td>
            <td>{!! $polizaResponsabilidad->codigo !!}</td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td custom-title="{!! $polizaResponsabilidad->dias_actual_diferencia !!}/{!! $polizaResponsabilidad->dias_diferencia !!}">
                 <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 0, "radius": 9 }'>{!! $polizaResponsabilidad->dias_actual_diferencia !!}/{!! $polizaResponsabilidad->dias_diferencia !!}</span>            
            </td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_final->format('d-M-Y') !!}</td>
           <td>
                @if ($polizaResponsabilidad->fecha_vigencia_inicio != $polizaResponsabilidad->fecha_vigencia_final->subYear())
                    <span class="badge badge-danger" custom-title="Verfiqué los datos ingresados, {!! $polizaResponsabilidad->user->fullname !!}"><i class='fa fa fa-exclamation fa-spin fa-fw'></i> Fechas Inconsistentes</span>
                @else
                    @if ($polizaResponsabilidad->vigente)
                        <span class="badge badge-success">Vigente</span>
                    @else
                        <span class="badge badge-warning">No Vigente</span>
                    @endif
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['polizaResponsabilidads.destroy', $polizaResponsabilidad->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('polizaResponsabilidads.show', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' custom-title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('polizaResponsabilidads.edit', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' custom-title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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