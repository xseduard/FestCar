
<br>
<div class="row">

	<div class="col-sm-12 col-xl-12">
	  <!-- Box Comment -->

	  <div class="box box-default collapsed-box">

	    <div class="box-header with-border">

	      <div class="user-block cursor-pointer hovered-text" data-widget="collapse">
	        <!--<img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">-->	       
	       <!--<i class="fa fa-search fa-3x fa_enlinea"></i>-->
	       <span class="ion-ios-search fa_enlinea" style="font-size: 32px; text-align: center"></span>
	        <span class="username">Buscador</span> 
	        <span class="description">{!! $contratoVinculacions->count() !!} de {!! $contratoVinculacions->total() !!} Registros</span>
	      </div>

	      <!-- /.user-block -->	 
	      <!--    
	      <div class="box-tools">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus fa-2x"></i></button>	        
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times fa-2x"></i></button>	       
	      </div>
	      -->
	      <!-- /.box-tools -->
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
 		
	    	<div class="row">
		    	<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('codigo', 'Codigo') !!}
				    <div class="input-group">
				        <span class="input-group-addon">No.</span>
				    	{!! Form::text('codigo', null, ['class' => 'form-control text-right', 'placeholder' => 'Sin Prefijo']) !!}
				    </div>
				</div>

				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('vehiculo_id', 'Vehículo') !!}
				    {!! Form::text('vehiculo_id', null, ['class' => 'form-control text-right', 'placeholder' => 'Placa']) !!}
				</div>

				

	    		<div class="form-group col-xl-2 col-sm-4" id="form_tipo_proveedor">
				    {!! Form::label('tipo_proveedor', 'Tipo de Proveedor') !!}
				    {!! Form::select('tipo_proveedor',['Natural' => 'Natural', 'Juridico' => 'Jurídico'], null, ['class' => 'form-control select2_without_search', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('tipo_contrato', 'Tipo de Contrato') !!}
				    {!! Form::select('tipo_contrato',['AF' => 'Administración Flota', 'CP' => 'Contrato Proveedor', 'CV' => 'Contrato vinculación', 'CC' => 'Convenio Colaboración'], null, ['class' => 'form-control select2_without_search', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('estado', 'Estado') !!}
				    {!! Form::select('estado',['vigente' => 'Vigente',
				     'finalizado' => 'No Vigente',
				      'no_iniciado' => 'No iniciado',
				       'pendiente_aprobacion' => 'Pendiente de aprobación'], null, ['class' => 'form-control select2_without_search', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('cc_nit', 'Cédula / Nit') !!}
				    {!! Form::text('cc_nit', null, ['class' => 'form-control text-right', 'placeholder' => '']) !!}
				</div>
				<div class="form-group col-xl-4 col-sm-4">
				    {!! Form::label('fullname', 'Nombres / Razón Social') !!}
				    {!! Form::text('fullname', null, ['class' => 'form-control', 'placeholder' => '']) !!}
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('order_item', 'Ordenar por') !!}
				    {!! Form::select('order_item', ['updated_at' => 'Última actualización',
						'created_at'     => 'Fecha de Creación',
						'id'             => 'Codigo',
						'tipo_contrato'  => 'Tipo de contrato',
						'tipo_proveedor' => 'Tipo de Proveedor',
						'vehiculo_id'    => 'Vehículo',
						'fecha_inicio'   => 'Fecha de Inicio',
						'fecha_final'    => 'Fecha Final',
						'aprobado'       => 'Aprobación',

				      ], 'updated_at', ['class' => 'form-control select2_without_search', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}		    
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('order_type', 'Tipo de orden') !!}
				    {!! Form::select('order_type',['desc' => 'Descendente', 'asc' => 'Ascendente'], 'desc', ['class' => 'form-control select2_without_search','required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}		    
				</div>	
				<div class="form-group col-xl-1 col-sm-2">
				    {!! Form::label('per_page', 'Cant. Registros') !!}
				    {!! Form::number('per_page', null, ['class' => 'form-control text-right', 'placeholder' => '15']) !!}
				</div>			
	    	</div>
			<div class="clearfix"></div>
	      

	   
	    </div>
	    <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Aplicar Filtros</button>
         </div>
	    <!-- /.box-footer -->
	  </div>
	  <!-- /.box -->
	</div>

</div>




