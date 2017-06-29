<table class="table table-responsive table-hover">
  		<th class="text-center text-aqua" colspan="2" style="font-size: 16px">LISTA DE GASTOS POR DÍA</th>
<tr>
	<td><strong>Inversión</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->inversion, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Llantas completas</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->llantas_completas, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Motor caja de trasmisión</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->motor_caja_trasmision, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Ajuste de pintura</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->ajuste_pintura, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Rodamiento</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->rodamiento, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Cojineria / vidrios</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->cojineria_vidrios, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Lavado</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->lavado, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Carroceria</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->carroceria, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Salario conductor</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->salario_conductor, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Prestaciones sociales</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->prestaciones_sociales, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Seguridad social</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->seguridad_social, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Soat</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->soat, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Técnicomecánica</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->tecnicomecanica, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Revisión bimensual</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->revision_bimensual, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Contractual</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->contractual, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Extracontractual</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->extracontractual, 0, '.', ',' ) !!}</td>
</tr>
<!--
<tr>
	<td><strong>Acpm</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->acpm_galon, 0, '.', ',' ) !!} / galon</td>
</tr>
<tr>
	<td><strong>Gasolina</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->gasolina_galon, 0, '.', ',' ) !!}</td>
</tr>
-->
<tr>
	<td><strong>Combustible</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->galones_kilometro*10*$sim_gasto->acpm_galon, 0, '.', ',' ) !!} (10km)</td>
</tr>
<tr>
	<td><strong>Aceites / Filtros</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->aceites_filtros, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Aditivos</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->aditivos, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Baterias</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->baterias, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Impuesto rodamiento</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->impuesto_rodamiento, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Impuesto semaforización</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->impuesto_semaforizacion, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Parqueo</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->parqueo, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Tramites varios</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->tramites_varios, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Administración</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->administracion, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Plan reposición equipo</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->plan_reposicion_equipo, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Sistema comunicación</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->sistema_comunicacion, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Gps</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->gps, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>Otros</strong></td>
	<td class="text-right"><i class="fa fa-usd"></i> {!! number_format($sim_gasto->otros, 0, '.', ',' ) !!}</td>
</tr>
<tr>
	<td><strong>SubTotal</strong></td>
	<td class="text-right"> <i class="fa fa-usd"></i> {!! number_format($valores['subtotal'], 0, '.', ',' ) !!}  </td>
</tr>
<tr>
	<td><strong>Margen</strong></td>
	<td class="text-right"> <i class="fa fa-usd"></i> {!! number_format($valores['margen'], 0, '.', ',' ) !!} ({!! $sim_gasto->margen !!} <i class="fa fa-percent"></i>) </td>
</tr>
<tr style="background-color: #eee;">
	<td class="text-center text-aqua" colspan="1" style="font-size: 16px">TOTAL</td>
<td>
	 <i class="fa fa-usd"></i> {!! number_format($valores['total'], 0, '.', ',' ) !!} / Día
</td>
</tr>

  		</table>