<!-- Tipo Contrato Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_contrato', 'Tipo Contrato') !!}
    {!! Form::select('tipo_contrato',['AF' => 'Administración Flota', 'CP' => 'Contrato Proveedor', 'CV' => 'Contrato vinculación', 'CC' => 'Convenio Colaboración'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Tipo Proveedor Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_proveedor', 'Tipo Proveedor') !!}
    {!! Form::select('tipo_proveedor',['Natural' => 'Natural', 'Juridico' => 'Jurídico'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Natural Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('natural_id', 'Tercero natural') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Juridico Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('juridico_id', 'Tercero Jurídico') !!}
    {!! Form::select('juridico_id', $selectores['juridico_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Servicio Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('servicio', 'Servicio(s)') !!}
    {!! Form::text('servicio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Fecha Inicio campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha de Inicio') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Final campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_final', 'Fecha de Final') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('contratoVinculacions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
