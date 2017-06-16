<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Codigo Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Modalidad Servicio Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('modalidad_servicio', 'Modalidad de Servicio') !!}
    {!! Form::select('modalidad_servicio', ['Especial' => 'Especial', 'Otro' => 'Otro'], 'Especial', ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Radio Accion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('radio_accion', 'Radio de Acción') !!}
    {!! Form::select('radio_accion', ['Municipal' => 'Municipal', 'Urbana' => 'Urbana', 'Nacional' => 'Nacional'], 'Nacional', ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Razon Social Empresa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social_empresa', 'Razón Social de la Empresa') !!}
    {!! Form::text('razon_social_empresa', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Nit Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nit', 'Nit') !!}
    {!! Form::text('nit', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Direccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('entidad_expide', 'Entidad que expide') !!}
    {!! Form::text('entidad_expide', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<clear class="clearfix"></clear>
<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_expedicion', 'Fecha de Expedición') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Vigencia Inicio campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_vigencia_inicio', 'Fecha Inicio de vigencia') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Final de vigencia campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_vigencia_final', 'Fecha Final de vigencia') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('tarjetaOperacions.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
