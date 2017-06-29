<div class="row">  
  <div class="col-sm-8">
    <canvas id="marksChart" width="600" height="400"></canvas>
<!--
    @include('vehiculos.show-simulador-tmedium')
    -->
    <div class="col-sm-6">
    	<div id="donut-alfa"></div>
    	<table class="table table-responsive table-bordered">
    		<td class="text-right"><strong>Costos Mantenimiento</strong></td>
    		<td><i class="fa fa-usd"></i> 
    		{!! number_format($sim_gasto->inversion
                    + $sim_gasto->llantas_completas 
                    + $sim_gasto->motor_caja_trasmision
                    + $sim_gasto->ajuste_pintura
                    + $sim_gasto->rodamiento
                    + $sim_gasto->cojineria_vidrios
                    + $sim_gasto->lavado
                    + $sim_gasto->carroceria, 0, '.', ',' ) !!}</td>
    	</table>   	
    </div>
    <div class="col-sm-6">
    	<div id="donut-beta"></div>
    	<table class="table table-responsive table-bordered">
    		<td class="text-right"><strong>Varios</strong></td>
    		<td><i class="fa fa-usd"></i> 
    		{!! number_format($sim_gasto->impuesto_rodamiento
                    + $sim_gasto->impuesto_semaforizacion
                    + $sim_gasto->parqueo
                    + $sim_gasto->tramites_varios
                    + $sim_gasto->administracion
                    + $sim_gasto->plan_reposicion_equipo
                    + $sim_gasto->sistema_comunicacion
                    + $sim_gasto->gps
                    + $sim_gasto->otros, 0, '.', ',' ) !!}</td>
    	</table>
    </div>
    <div class="col-sm-4">
    	<div id="donut-delta"></div>
    	<table class="table table-responsive table-bordered">
    		<td class="text-right"><strong>Costos Operación</strong></td>
    		<td><i class="fa fa-usd"></i> 
    		{!! number_format($sim_gasto->salario_conductor
                    + $sim_gasto->prestaciones_sociales
                    + $sim_gasto->seguridad_social, 0, '.', ',' ) !!}</td>
    	</table>
    </div>
    <div class="col-sm-4">
    	<div id="donut-lamda"></div>
    	<table class="table table-responsive table-bordered">
    		<td class="text-right"><strong>Costos Consumibles</strong></td>
    		<td><i class="fa fa-usd"></i> 
    		{!! number_format(($sim_gasto->acpm_galon * $sim_gasto->galones_kilometro * 10)
                    + $sim_gasto->aceites_filtros
                    + $sim_gasto->aditivos
                    + $sim_gasto->baterias, 0, '.', ',' ) !!}</td>
    	</table>
    </div>
    <div class="col-sm-4">
    	<div id="donut-omega"></div>
    	<table class="table table-responsive table-bordered">
    		<td class="text-right"><strong>Costos Seguros</strong></td>
    		<td><i class="fa fa-usd"></i> 
    		{!! number_format($sim_gasto->soat
                    + $sim_gasto->tecnicomecanica
                    + $sim_gasto->revision_bimensual
                    + $sim_gasto->contractual
                    + $sim_gasto->extracontractual, 0, '.', ',' ) !!}</td>
    	</table>
    </div>

  </div> 

  <div class="col-sm-4">
   @include('vehiculos.show-simulador-tright')
  </div> 
</div> 