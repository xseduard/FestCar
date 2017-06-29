<table class="table table-responsive table-bordered">
    	<thead>
    		<th>Costos Mantenimiento</th>
    		<th>Costos Operación</th>
    		<th>Costos Seguros</th>
    		<th>Consumibles</th>
    		<th>Varios</th>    		
    	</thead>
    	<tbody>
    		<td class="text-right">
    		<i class="fa fa-usd"></i> {!! 
                    number_format($sim_gasto->inversion
                    + $sim_gasto->llantas_completas 
                    + $sim_gasto->motor_caja_trasmision
                    + $sim_gasto->ajuste_pintura
                    + $sim_gasto->rodamiento
                    + $sim_gasto->cojineria_vidrios
                    + $sim_gasto->lavado
                    + $sim_gasto->carroceria, 2, '.', ',' )
                !!}
            </td>
            <td class="text-right">
            	<i class="fa fa-usd"></i> {!! 
                    number_format($sim_gasto->salario_conductor
                    + $sim_gasto->prestaciones_sociales
                    + $sim_gasto->seguridad_social, 2, ',', '.' )
                 !!}
            </td>
            <td class="text-right">
            	<i class="fa fa-usd"></i> {!! 
                    number_format($sim_gasto->soat
                    + $sim_gasto->tecnicomecanica
                    + $sim_gasto->revision_bimensual
                    + $sim_gasto->contractual
                    + $sim_gasto->extracontractual, 2, '.', ',' )
                 !!}
            </td>
            <td class="text-right">
            	<i class="fa fa-usd"></i> {!! 
                    number_format(($sim_gasto->acpm_galon * $sim_gasto->galones_kilometro * 10)
                    + $sim_gasto->aceites_filtros
                    + $sim_gasto->aditivos
                    + $sim_gasto->baterias, 2, '.', ',' )
                 !!}
            </td>
            <td class="text-right">
            	<i class="fa fa-usd"></i> {!! 
                    number_format($sim_gasto->impuesto_rodamiento
                    + $sim_gasto->impuesto_semaforizacion
                    + $sim_gasto->parqueo
                    + $sim_gasto->tramites_varios
                    + $sim_gasto->administracion
                    + $sim_gasto->plan_reposicion_equipo
                    + $sim_gasto->sistema_comunicacion
                    + $sim_gasto->gps
                    + $sim_gasto->otros, 2, '.', ',' )
                 !!}
            </td>
    	</tbody>
    </table>