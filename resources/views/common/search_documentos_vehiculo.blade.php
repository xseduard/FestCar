
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
	        <span class="description">{!! $records->count() !!} de {!! $records->total() !!} Registros</span>
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
				    {!! Form::label('vehiculo_id', 'Vehículo') !!}
				    {!! Form::text('vehiculo_id', null, ['class' => 'form-control text-right', 'placeholder' => 'Placa']) !!}
				</div>
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('estado', 'Estado') !!}
				    {!! Form::select('estado',['vigente' => 'Vigente', 'no_vigente' => 'No Vigente'], null, ['class' => 'form-control select2_without_search', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
				</div>			
				<div class="form-group col-xl-2 col-sm-4">
				    {!! Form::label('order_item', 'Ordenar por') !!}
				    {!! Form::select('order_item', ['updated_at' => 'Última actualización',						
						'vehiculo_id'           => 'Vehículo',
						'fecha_vigencia_inicio' => 'Fecha Vigencia Inicio',
						'fecha_vigencia_final'  => 'Fecha Vigencia Final',
						'created_at'            => 'Fecha de Registro',
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




