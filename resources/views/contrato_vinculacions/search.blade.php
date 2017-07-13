<div class="row">
	<div class="col-md-12">
	  <!-- Box Comment -->
	  <div class="box box-widget collapsed-box">
	    <div class="box-header with-border">
	      <div class="user-block cursor-pointer"  data-widget="collapse">
	        <!--<img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">-->
	       <i class="fa fa-search fa-3x fa_enlinea"></i></button>
	        <span class="username">Buscador</span> 
	        <span class="pull-right text-muted">{!! $contratoVinculacions->count() !!} de {!! $contratoVinculacions->total() !!} Registros</span>
	        <span class="description">Filtros </span>

	      </div>
	      <!-- /.user-block -->
	      <div class="box-tools">	
	      <!--        
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus fa-2x"></i>
	        </button>
	        
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times fa-2x"></i></button>
	        -->
	      </div>
	      <!-- /.box-tools -->
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">

	    	<div class="row">

		    	<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('codigo', 'Codigo') !!}
				    <div class="input-group">
				        <div class="input-group-addon">XX000</i></div>
				    	{!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Sin Prefijo']) !!}
				    </div>
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
	    	</div>
			<div class="clearfix"></div>
	      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar</button>
	     
	      
	    </div>
	   
	   
	    <!-- /.box-footer -->
	  </div>
	  <!-- /.box -->
	</div>
</div>




