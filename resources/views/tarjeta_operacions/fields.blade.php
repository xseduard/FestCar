<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehiculo Id') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Codigo Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Modalidad Servicio Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('modalidad_servicio', 'Modalidad Servicio') !!}
    {!! Form::text('modalidad_servicio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Radio Accion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('radio_accion', 'Radio Accion') !!}
    {!! Form::text('radio_accion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Razon Social Empresa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social_empresa', 'Razon Social Empresa') !!}
    {!! Form::text('razon_social_empresa', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Nit Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nit', 'Nit') !!}
    {!! Form::text('nit', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Direccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_expedicion', 'Fecha Expedicion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Fecha Vigencia Inicio campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vigencia_inicio', 'Fecha Vigencia Inicio') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Fecha Vigencia Final campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vigencia_final', 'Fecha Vigencia Final') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('tarjetaOperacions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
