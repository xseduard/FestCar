<!-- Cps Id Selector -->
<div class="form-group col-sm-4 col-xl-4">
    {!! Form::label('cps_id', 'Contrato prestación de servicio') !!}
    {!! Form::select('cps_id', $selectores['ContratoPrestacionServicio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Contrato Vinculacion Selector -->
<div class="form-group col-sm-8 col-xl-8">
    {!! Form::label('contrato_vinculacion_id', 'Contrato Vinculación / Vehículo') !!}
    {!! Form::select('contrato_vinculacion_id', $selectores['ContratoVinculacion_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Fecha Planilla campo de fecha -->
<div class="form-group col-sm-2 col-xl-2">
    {!! Form::label('fecha_planilla', 'Fecha Planilla') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    	{!! Form::text('fecha_planilla', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- semana Inicio campo de fecha -->
<div class="form-group col-sm-2 col-xl-2">
    {!! Form::label('fecha_inicio', 'Semana Inicio') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    	{!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>


<!-- semana Final campo de fecha -->
<div class="form-group col-sm-2 col-xl-2">
    {!! Form::label('fecha_final', 'Semana Final') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    	{!! Form::text('fecha_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- factura -->
<div class="form-group col-sm-2 col-xl-2" id="form-factura">
    {!! Form::label('factura[]', 'Factura') !!}
    <div class="input-group">
        <span class="input-group-addon">CR0000</span>
        {!! Form::text('factura[]', null, ['class' => 'form-control texto-right', 'placeholder' => '9999', 'required']) !!}
        <!-- <span class="input-group-btn eliminar-factura">
            <button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
         </span>
         -->
    </div>
</div>
<div id="space-factura"></div>
<div class="col-sm-2 col-xl-2" style="padding-top: 25px">
    <button id="agregar-factura" name="agregar-factura" type="button" class="btn btn-default btn-flat btn-primary-inverted"><i class="fa fa-plus"></i> Agregar Factura</button>
</div>


<div class="clearfix"></div>
<br>
<div class="col-sm-12 col-xl-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa fa-bus" aria-hidden="true"></i> Rutas / Trayectos</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- /////////////////////////////////////////////// -->

<!-- Predefinido -->
<div class="rutabox">
    
<div class="form-group col-sm-4">
    {!! Form::label('ruta_nombre[]', 'Nombre Ruta') !!}
    {!! Form::select('ruta_nombre[]', $selectores['ruta_id'], null, ['id' => 'rutaname', 'class' => 'form-control select2 rutaname', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('distancia[]', 'Distancia') !!}
    <div class="input-group">        
        {!! Form::text('distancia[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}
        <span class="input-group-addon">Km</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('duracion[]', 'Duración (Ida-Vuelta)') !!}
    <div class="input-group">
        {!! Form::text('duracion[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}
        <span class="input-group-addon">minutos</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('cantidad[]', 'Cantidad') !!}
    <div class="input-group">
        {!! Form::text('cantidad[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0']) !!}
        <span class="input-group-addon">Viajes</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('valor_final[]', 'Valor C/U') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
        {!! Form::text('valor_final[]', 111111, ['class' => 'form-control texto-right', 'placeholder'=>'0']) !!}
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::hidden('predefinido', 0, ['class' => 'form-control']) !!}
</div>

</div>
<!-- ////////////////////////////////////////// -->
<div class="clearfix"></div>

<!-- /////////////////////////////////////////////// -->

<!-- Predefinido -->
<div class="rutabox">
    <div class="form-group col-sm-4">
    {!! Form::label('ruta_nombre[]', 'Nombre Ruta') !!}
    {!! Form::select('ruta_nombre[]', $selectores['ruta_id'], null, ['id' => 'rutaname', 'class' => 'form-control select2 rutaname', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('distancia[]', 'Distancia') !!}
    <div class="input-group">        
        {!! Form::text('distancia[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}
        <span class="input-group-addon">Km</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('duracion[]', 'Duración (Ida-Vuelta)') !!}
    <div class="input-group">
        {!! Form::text('duracion[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}
        <span class="input-group-addon">minutos</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('cantidad[]', 'Cantidad') !!}
    <div class="input-group">
        {!! Form::text('cantidad[]', null, ['class' => 'form-control texto-right', 'placeholder'=>'0']) !!}
        <span class="input-group-addon">Viajes</span>
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::label('valor_final[]', 'Valor C/U') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
        {!! Form::text('valor_final[]', 22222, ['class' => 'form-control texto-right', 'placeholder'=>'0']) !!}
    </div>
</div>

<div class="form-group col-sm-2">
    {!! Form::hidden('predefinido', 0, ['class' => 'form-control']) !!}
</div>

</div>
<!-- ////////////////////////////////////////// -->


<div class="clearfix"></div>
<br>
<div class="col-sm-12 col-xl-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa fa-minus" aria-hidden="true"></i> Descuentos</strong>
    <hr  style="margin-top: 0px;">
</div>

<div class="form-group col-sm-3 col-xl-2">
    {!! Form::label('text_cuatro_por_mil', '4x1000') !!}
    <div class="input-group">
      <span class="input-group-addon addon-custom" title="Habilitar / Desabilitar">
        {!! Form::hidden('cuatro_por_mil', false) !!}
        {!! Form::checkbox('cuatro_por_mil', '1', true) !!}
      </span>
      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
      {!! Form::text('text_cuatro_por_mil', null, ['class' => 'form-control texto-right', 'placeholder'=>'', 'readonly']) !!}
    </div>
</div>

<div class="form-group col-sm-3 col-xl-2 ">
    {!! Form::label('desc_sobrecosto', 'Irregularidades / Sobrecosto') !!}
    <div class="input-group">
      <span class="input-group-addon addon-custom" title="Habilitar / Desabilitar">
        {!! Form::hidden('irregularidad', false) !!}
        {!! Form::checkbox('irregularidad', '1', null) !!}
      </span>
      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
      {!! Form::text('desc_sobrecosto', 0, ['class' => 'form-control texto-right']) !!}
    </div>
</div>


<!-- Desc Transaccion Campo de texto -->
<div class="form-group col-sm-3 col-xl-2">
    {!! Form::label('desc_transaccion', 'Transacción') !!}
     <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('desc_transaccion', 3000, ['class' => 'form-control texto-right']) !!}
    </div>
</div>

<!-- Desc Finca Campo de texto -->
<div class="form-group col-sm-3 col-xl-2">
    {!! Form::label('desc_finca', 'Retención Finca') !!}
     <div class="input-group">       
        {!! Form::text('desc_finca', 3.4, ['class' => 'form-control texto-right']) !!}
        <div class="input-group-addon"><i class="fa fa-percent"></i></div>
    </div>
</div>

<!-- Desc Admin Campo de texto -->
<div class="form-group col-sm-3 col-xl-2">
    {!! Form::label('desc_admin', 'Administración') !!}
     <div class="input-group">
        {!! Form::text('desc_admin', 5, ['class' => 'form-control texto-right']) !!}
        <div class="input-group-addon"><i class="fa fa-percent"></i></div>
    </div>
</div>
<!--
<div class="form-descuento">
    <div class="form-group col-sm-6 col-xl-6">
        {!! Form::label('desc_tipo', 'Descuento') !!}
         <div class="input-group">
            <span class="input-group-addon select-addon-custom" style="width: 30% !important">
                {!! Form::select('desc_tipo[]', $selectores['descuento_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}
            </span>
             <span class="input-group-addon"><i class="fa fa-usd"></i></span>
            {!! Form::text('desc_valor[]', null, ['class' => 'form-control texto-right', 'required']) !!}
            <span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span>
        </div>
    </div>
</div>
-->

<div id="space-descuento"></div>
<div class="col-sm-2 col-xl-2" style="padding-top: 25px">
    <button id="agregar-descuento" name="agregar-descuento" type="button" class="btn btn-default btn-flat btn-primary-inverted"><i class="fa fa-plus"></i> Agregar Descuento</button>
</div>

<div class="clearfix"></div>
<br>
<div class="col-sm-12 col-xl-12">    
    <hr  style="margin-top: 0px;">
</div>



<!-- Subtotal Campo de texto -->
<div class="form-group col-sm-4 col-xl-4">
    {!! Form::label('subtotal', 'SubTotal') !!}
    {!! Form::text('subtotal', null, ['readonly', 'class' => 'form-control texto-right']) !!}
</div>

<div class="form-group col-sm-4 col-xl-4">
    {!! Form::label('total_descuentos', 'Total Descuentos') !!}
    {!! Form::text('total_descuentos', null, ['readonly', 'class' => 'form-control texto-right']) !!}
</div>


<!-- Total Campo de texto -->
<div class="form-group col-sm-4 col-xl-4">
    {!! Form::label('total', 'Total') !!}
    {!! Form::text('total', null, ['readonly', 'class' => 'form-control texto-right', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 col-xl-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
