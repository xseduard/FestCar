<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Codigo Control Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo_control', 'Codigo de Control') !!}
    {!! Form::text('codigo_control', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cda Nombre Campo de texto -->
<div class="form-group col-sm-8">
    {!! Form::label('cda_nombre', 'Centro de Diagnostico Automotor (CDA)') !!}
    {!! Form::text('cda_nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cda Nit Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('cda_nit', 'CDA Nit') !!}
    {!! Form::text('cda_nit', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Consecutivo Runt Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('consecutivo_runt', 'Consecutivo Runt') !!}
    {!! Form::text('consecutivo_runt', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_expedicion', 'Fecha de Expedicion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Fecha Vencimiento campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_vencimiento', 'Fecha de Vencimiento') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vencimiento', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('tecnicomecanicas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
