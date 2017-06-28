@foreach($simuladorGastos as $simuladorGasto)
<style type="text/css">
    /*tr>td{ text-align: right;}*/
    tr>td { text-align: right;}
</style>
<div class="box box-primary">
                            <div class="box-body">
<table class="table table-responsive  table-bordered" id="simuladorGastos-table">
    <tbody style="">
        <tr>
            <td rowspan="1"><strong>Capacidad</strong></td>
           
            <td class="text-center"><strong>Inversion</strong></td>
            <td class="text-center"><strong>Llantas Completas</strong></td>
            <td class="text-center"><strong>Motor Caja Trasmisión</strong></td>
            <td class="text-center"><strong>Ajuste Pintura</strong></td>
            <td class="text-center"><strong>Rodamiento</strong></td>
            <td class="text-center"><strong>Cojineria Vidrios</strong></td>
            <td class="text-center"><strong>Lavado</strong></td>
            <td class="text-center"><strong>Carroceria</strong></td>
            <td class="text-center"><strong>Salario Conductor</strong></td>                      
            
            <td rowspan="1">Acciones</td>        
        </tr>
        <tr>
            <td rowspan="7" class="text-center">
                @if($simuladorGasto->max < 31) 
                    {!! $simuladorGasto->min,"-",$simuladorGasto->max !!}
                @else
                     + {!! $simuladorGasto->min !!}
                @endif
            </td>
            <td class="text-right">$ {!! $simuladorGasto->inversion !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->llantas_completas !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->motor_caja_trasmision !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->ajuste_pintura !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->rodamiento !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->cojineria_vidrios !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->lavado !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->carroceria !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->salario_conductor !!}</td>
            <td rowspan="7">
                {!! Form::open(['route' => ['simuladorGastos.destroy', $simuladorGasto->id], 'method' => 'delete']) !!}
                <div class=' pull-right'>
                    <!-- 
                        <a href="$ {!! route('simuladorGastos.show', [$simuladorGasto->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->                    
                    <a href="{!! route('simuladorGastos.edit', [$simuladorGasto->id]) !!}" class='btn btn-app bg-aqua btn-flat' title="Editar"> <i class="fa fa-edit"></i>Editar</a>
                    <br>
                    <br>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> ', [
                        'type' => 'submit',
                        'class' => 'btn btn-app bg-maroon btn-flat',
                        'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                        'title' => 'Eliminar'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        <tr>
            <td class="text-center"><strong>Prestaciones Sociales</strong></td>
            <td class="text-center"><strong>Seguridad Social</strong></td>
            <td class="text-center"><strong>Soat</strong></td>
            <td class="text-center"><strong>Tecnicomecanica</strong></td>
            <td class="text-center"><strong>Revision Bimensual</strong></td>
            <td class="text-center"><strong>Contractual</strong></td>
            <td class="text-center"><strong>Extracontractual</strong></td>
            <td class="text-center"><strong>Acpm Galon</strong></td>
            <td class="text-center"><strong>Gasolina Galon</strong></td>
        </tr>
        <tr>
            <td class="text-right">$ {!! $simuladorGasto->prestaciones_sociales !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->seguridad_social !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->soat !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->tecnicomecanica !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->revision_bimensual !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->contractual !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->extracontractual !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->acpm_galon !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->gasolina_galon !!}</td>
        </tr>
        
        <tr>
            <td class="text-center"><strong>Galones/Km</strong></td>
            <td class="text-center"><strong>Aceites Filtros</strong></td>
            <td class="text-center"><strong>Aditivos</strong></td>
            <td class="text-center"><strong>Baterias</strong></td>
            <td class="text-center"><strong>Impuesto Rodamiento</strong></td>
            <td class="text-center"><strong>Impuesto Semaforización</strong></td>
            <td class="text-center"><strong>Parqueo</strong></td>
            <td class="text-center"><strong>Tramites Varios</strong></td>
            <td class="text-center"><strong>Administración</strong></td>
        </tr>

        <tr>
             <td class="text-right">{!! $simuladorGasto->galones_kilometro !!} g/Km</td>
            <td class="text-right">$ {!! $simuladorGasto->aceites_filtros !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->aditivos !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->baterias !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->impuesto_rodamiento !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->impuesto_semaforizacion !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->parqueo !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->tramites_varios !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->administracion !!}</td>
        </tr>
        <tr>
            
            <td class="text-center"><strong>Plan Reposicion Equipo</strong></td>
            <td class="text-center"><strong>Sistema Comunicacion</strong></td>
            <td class="text-center"><strong>Gps</strong></td>
            <td class="text-center"><strong>Margen</strong></td>
            <td class="text-center"><strong>Otros</strong></td>
            <td class="text-center" colspan="2"><strong>Fecha Registro</strong></td>
            <td class="text-center" colspan="2"><strong>Fecha Actualización</strong></td>
        </tr>
 
        <tr>  
            <td class="text-right">$ {!! $simuladorGasto->plan_reposicion_equipo !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->sistema_comunicacion !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->gps !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->margen !!}</td>
            <td class="text-right">$ {!! $simuladorGasto->otros !!}</td>
            <td class="text-right" colspan="2"> {!! $simuladorGasto->created_at !!}</td>
            <td class="text-right" colspan="2"> {!! $simuladorGasto->updated_at->diffForHumans() !!}</td>
            
        </tr>
    
    </tbody>
</table>
        </div>
</div>
@endforeach