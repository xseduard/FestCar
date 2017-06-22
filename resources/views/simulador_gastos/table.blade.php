<table class="table table-responsive table-hover" id="simuladorGastos-table">
    <thead>
        <th>Min</th>
        <th>Max</th>
        <th>Inversion</th>
        <th>Llantas Completas</th>
        <th>Motor Caja Trasmision</th>
        <th>Ajuste Pintura</th>
        <th>Rodamiento</th>
        <th>Cojineria Vidrios</th>
        <th>Lavado</th>
        <th>Carroceria</th>
        <th>Salario Conductor</th>
        <th>Prestaciones Sociales</th>
        <th>Seguridad Social</th>
        <th>Soat</th>
        <th>Tecnicomecanica</th>
        <th>Revision Bimensual</th>
        <th>Contractual</th>
        <th>Extracontractual</th>
        <th>Acpm Galon</th>
        <th>Gasolina Galon</th>
        <th>Galones Kilometro</th>
        <th>Aceites Filtros</th>
        <th>Aditivos</th>
        <th>Baterias</th>
        <th>Impuesto Rodamiento</th>
        <th>Impuesto Semaforizacion</th>
        <th>Parqueo</th>
        <th>Tramites Varios</th>
        <th>Administracion</th>
        <th>Plan Reposicion Equipo</th>
        <th>Sistema Comunicacion</th>
        <th>Gps</th>
        <th>Margen</th>
        <th>Otros</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($simuladorGastos as $simuladorGasto)
        <tr>
            <td>{!! $simuladorGasto->min !!}</td>
            <td>{!! $simuladorGasto->max !!}</td>
            <td>{!! $simuladorGasto->inversion !!}</td>
            <td>{!! $simuladorGasto->llantas_completas !!}</td>
            <td>{!! $simuladorGasto->motor_caja_trasmision !!}</td>
            <td>{!! $simuladorGasto->ajuste_pintura !!}</td>
            <td>{!! $simuladorGasto->rodamiento !!}</td>
            <td>{!! $simuladorGasto->cojineria_vidrios !!}</td>
            <td>{!! $simuladorGasto->lavado !!}</td>
            <td>{!! $simuladorGasto->carroceria !!}</td>
            <td>{!! $simuladorGasto->salario_conductor !!}</td>
            <td>{!! $simuladorGasto->prestaciones_sociales !!}</td>
            <td>{!! $simuladorGasto->seguridad_social !!}</td>
            <td>{!! $simuladorGasto->soat !!}</td>
            <td>{!! $simuladorGasto->tecnicomecanica !!}</td>
            <td>{!! $simuladorGasto->revision_bimensual !!}</td>
            <td>{!! $simuladorGasto->contractual !!}</td>
            <td>{!! $simuladorGasto->extracontractual !!}</td>
            <td>{!! $simuladorGasto->acpm_galon !!}</td>
            <td>{!! $simuladorGasto->gasolina_galon !!}</td>
            <td>{!! $simuladorGasto->galones_kilometro !!}</td>
            <td>{!! $simuladorGasto->aceites_filtros !!}</td>
            <td>{!! $simuladorGasto->aditivos !!}</td>
            <td>{!! $simuladorGasto->baterias !!}</td>
            <td>{!! $simuladorGasto->impuesto_rodamiento !!}</td>
            <td>{!! $simuladorGasto->impuesto_semaforizacion !!}</td>
            <td>{!! $simuladorGasto->parqueo !!}</td>
            <td>{!! $simuladorGasto->tramites_varios !!}</td>
            <td>{!! $simuladorGasto->administracion !!}</td>
            <td>{!! $simuladorGasto->plan_reposicion_equipo !!}</td>
            <td>{!! $simuladorGasto->sistema_comunicacion !!}</td>
            <td>{!! $simuladorGasto->gps !!}</td>
            <td>{!! $simuladorGasto->margen !!}</td>
            <td>{!! $simuladorGasto->otros !!}</td>
            <td>{!! $simuladorGasto->created_at !!}</td>
            <td>{!! $simuladorGasto->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['simuladorGastos.destroy', $simuladorGasto->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('simuladorGastos.show', [$simuladorGasto->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('simuladorGastos.edit', [$simuladorGasto->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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