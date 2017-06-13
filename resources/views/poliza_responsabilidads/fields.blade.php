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

<!-- Fecha de Inicio Vigencia campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vigencia_inicio', 'Fecha de Inicio Vigencia') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha de Final Vigencia campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vigencia_final', 'Fecha de Final Vigencia') !!}
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
    <a href="{!! route('polizaResponsabilidads.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
