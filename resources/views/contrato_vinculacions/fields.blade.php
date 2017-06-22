<!-- Tipo Contrato Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_contrato', 'Tipo Contrato') !!}
    {!! Form::select('tipo_contrato',['AF' => 'Administración Flota', 'CP' => 'Contrato Proveedor', 'CV' => 'Contrato vinculación', 'CC' => 'Convenio Colaboración'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<div class="clearfix"></div>
<!-- Tipo Proveedor Selector -->
<div class="form-group col-sm-3" id="form_tipo_proveedor">
    {!! Form::label('tipo_proveedor', 'Tipo Proveedor') !!}
    {!! Form::select('tipo_proveedor',['Natural' => 'Natural', 'Juridico' => 'Jurídico'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- campos blocks -->
    <div class="form-group col-sm-3" id="tipo_proveedor_locked">
        {!! Form::label('field_bloquedo_proveedor_into', 'Tipo Proveedor') !!}
        <div class="input-group">
            {!! Form::text('field_bloquedo_proveedor_into', null, ['class' => 'form-control', 'placeholder'=>'Jurídico', 'disabled' => 'disabled']) !!}
            <div class="input-group-addon" title=" Contrato Convenio de Colaboración solo permite terceros Jurídicos"><i class="fa fa-lock" aria-hidden="true"></i></div>
        </div>
    </div>

    <div class="form-group col-sm-9" id="tercero_locked">
        {!! Form::label('field_default', 'Tercero Natural/Jurídico') !!}
        <div class="input-group">
            {!! Form::text('field_default', null, ['class' => 'form-control', 'placeholder'=>'', 'disabled' => 'disabled']) !!}
            <div class="input-group-addon" title=" Seleccione un tipo de proveedor para Desbloquear"><i class="fa fa-lock" aria-hidden="true"></i></div>
        </div>
    </div>
<!-- fin  campos block -->

<!-- Natural Id Selector -->
<div class="form-group col-sm-9" id="form_natural">
    {!! Form::label('natural_id', 'Tercero Natural') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Juridico Id Selector -->
<div class="form-group col-sm-9" id="form_juridico">
    {!! Form::label('juridico_id', 'Tercero Jurídico') !!}
    {!! Form::select('juridico_id', $selectores['juridico_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="clearfix"></div>
<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    <div class="input-group">
        <div class="input-group-addon" title="Ayudas: Vehículo que prestará el servicio"><i class="flaticon-transport-2"></i></div>
        {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
    </div>
</div>

<!-- Servicio Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('servicio', 'Servicio(s)') !!}
    {!! Form::text('servicio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<div class="clearfix"></div>
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

<div class="clearfix"></div>
<br>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Información de Pago</strong>
    <hr  style="margin-top: 0px;">
</div>


<!-- Entidad Bancaria Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('entidad_bancaria', 'Entidad Bancaria') !!}
    {!! Form::select('entidad_bancaria', [
'BANCO DE LA REPÚBLICA'     => 'BANCO DE LA REPÚBLICA',
'BANCO DE BOGOTÁ'           => 'BANCO DE BOGOTÁ',
'BANCO POPULAR'             => 'BANCO POPULAR',
'BANCO CORPBANCA COLOMBIA S.A.' => 'BANCO CORPBANCA COLOMBIA S.A.',
'BANCOLOMBIA S.A.'          => 'BANCOLOMBIA S.A.',
'CITIBANK COLOMBIA'         => 'CITIBANK COLOMBIA',
'BANCO GNB COLOMBIA S.A.'   => 'BANCO GNB COLOMBIA S.A.',
'BANCO GNB SUDAMERIS COLOMBIA' => 'BANCO GNB SUDAMERIS COLOMBIA',
'BBVA COLOMBIA'             => 'BBVA COLOMBIA',
'HELM BANK'                 => 'HELM BANK',
'RED MULTIBANCA COLPATRIA S.A.' => 'RED MULTIBANCA COLPATRIA S.A.',
'BANCO DE OCCIDENTE'        => 'BANCO DE OCCIDENTE',
'BANCO DE COMERCIO EXTERIOR DE COLOMBIA S.A.' => 'BANCO DE COMERCIO EXTERIOR DE COLOMBIA S.A.',
'BANCO CAJA SOCIAL - BCSC S.A.' => 'BANCO CAJA SOCIAL - BCSC S.A.',
'BANCO AGRARIO DE COLOMBIA S.A.' => 'BANCO AGRARIO DE COLOMBIA S.A.',
'BANCO DAVIVIENDA S.A.'     => 'BANCO DAVIVIENDA S.A.',
'BANCO AV VILLAS'           => 'BANCO AV VILLAS',
'BANCO WWB S.A.'            => 'BANCO WWB S.A.',
'BANCO PROCREDIT'           => 'BANCO PROCREDIT',
'BANCAMIA'                  => 'BANCAMIA',
'BANCO PICHINCHA S.A.'      => 'BANCO PICHINCHA S.A.',
'BANCOOMEVA'                => 'BANCOOMEVA',
'BANCO FALABELLA S.A.'      => 'BANCO FALABELLA S.A.',
'BANCO FINANDINA S.A.'      => 'BANCO FINANDINA S.A.',
'BANCO SANTANDER DE NEGOCIOS COLOMBIA S.A.' => 'BANCO SANTANDER DE NEGOCIOS COLOMBIA S.A.',
'BANCO COOPERATIVO COOPCENTRAL' => 'BANCO COOPERATIVO COOPCENTRAL',
],
    null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Tipo Cuenta Bancaria Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_cuenta_bancaria', 'Tipo de Cuenta') !!}
    {!! Form::select('tipo_cuenta_bancaria', ['Ahorro' => 'Ahorro', 'Corriente' => 'Corriente'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Numero Cuenta Bancaria Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_cuenta_bancaria', 'Número Cuenta Bancaria') !!}
    <div class="input-group">
        <div class="input-group-addon">#</div>
    {!! Form::text('numero_cuenta_bancaria', null, ['class' => 'form-control', 'placeholder'=>'000-000-000-00']) !!}
    </div>
</div>
<!-- Fecha Inicio campo de fecha -->
<div class="clearfix"></div>
<hr>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('contratoVinculacions.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
