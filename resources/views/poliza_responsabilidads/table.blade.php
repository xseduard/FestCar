<table class="table table-responsive" id="polizaResponsabilidads-table">
    <thead>
        <th>Vehiculo</th>
        <th>Codigo</th>
        <th>Fecha de Inicio Vigencia</th>
        <th>Fecha de Final Vigencia</th>
         <th>Estado</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($polizaResponsabilidads as $polizaResponsabilidad)
        <tr>
            <td><span class="label label-default">{!! $polizaResponsabilidad->vehiculo->placa !!}</span></td>
            <td>{!! $polizaResponsabilidad->codigo !!}</td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_inicio->format('d-M-Y') !!}</td>
            <td>{!! $polizaResponsabilidad->fecha_vigencia_final->format('d-M-Y') !!}</td>
           <td>
                @if ($polizaResponsabilidad->vigente)
                    <span class="label label-success">Vigente</span>
                @else
                    <span class="label label-warning">No Vigente</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['polizaResponsabilidads.destroy', $polizaResponsabilidad->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('polizaResponsabilidads.show', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('polizaResponsabilidads.edit', [$polizaResponsabilidad->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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