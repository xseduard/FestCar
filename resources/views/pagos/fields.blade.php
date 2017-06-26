<!-- Cps Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('cps_id', 'Contrato prestación de servicio') !!}
    {!! Form::select('cps_id', $selectores['ContratoPrestacionServicio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Contrato Vinculacion Selector -->
<div class="form-group col-sm-12">
    {!! Form::label('contrato_vinculacion_id', 'Contrato Vinculación') !!}
    {!! Form::select('contrato_vinculacion_id', $selectores['ContratoVinculacion_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Fecha Planilla campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_planilla', 'Fecha Planilla') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_planilla', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Inicio campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Final campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_final', 'Fecha Final') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Desc Transaccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_transaccion', 'Desc Transaccion') !!}
    {!! Form::text('desc_transaccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Desc Finca Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_finca', 'Desc Finca') !!}
    {!! Form::text('desc_finca', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Desc Admin Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_admin', 'Desc Admin') !!}
    {!! Form::text('desc_admin', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cuatro Por Mil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuatro_por_mil', 'Cuatro Por Mil') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('cuatro_por_mil', false) !!}
        {!! Form::checkbox('cuatro_por_mil', '1', null) !!} 1
    </label>
</div>

<!-- Desc Sobrecosto Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_sobrecosto', 'Desc Sobrecosto') !!}
    {!! Form::text('desc_sobrecosto', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Irregularidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('irregularidad', 'Irregularidad') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('irregularidad', false) !!}
        {!! Form::checkbox('irregularidad', '1', null) !!} 1
    </label>
</div>

<!-- Subtotal Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('subtotal', 'Subtotal') !!}
    {!! Form::text('subtotal', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Total Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total') !!}
    {!! Form::text('total', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
