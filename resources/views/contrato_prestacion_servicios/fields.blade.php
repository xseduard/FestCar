<!-- Tipo Cliente Selector -->
<div class="form-group col-sm-3">
    {!! Form::label('tipo_cliente', 'Tipo de Cliente') !!}
    {!! Form::select('tipo_cliente', ['Natural' => 'Natural', 'Juridico' => 'Jurídico'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-9" id="tercero_locked">
        {!! Form::label('field_default', 'Tercero Natural/Jurídico') !!}
        <div class="input-group">
            {!! Form::text('field_default', null, ['class' => 'form-control', 'placeholder'=>'', 'disabled' => 'disabled']) !!}
            <div class="input-group-addon" title=" Seleccione un tipo de cliente para Desbloquear"><i class="fa fa-lock" aria-hidden="true"></i></div>
        </div>
    </div>

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
<!-- Origen Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('origen_id', 'Origen') !!}
    {!! Form::select('origen_id', $selectores['municipio_id'], null, ['class' => 'form-control select2_municipio', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Destino Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('destino_id', 'Destino') !!}
    {!! Form::select('destino_id', $selectores['municipio_id'], null, ['class' => 'form-control select2_municipio', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Servicio Campo de texto -->
<!--
<div class="form-group col-sm-12">
    {!! Form::label('servicio', 'Servicio(s)') !!}
    {!! Form::text('servicio', null, ['class' => 'form-control', 'placeholder'=>'Escolar, Turismo ...']) !!}
</div>
-->
<!-- $FIELD_NAME_TITLE$ Field -->
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
<div class="clearfix"></div>

<!-- Servicio Campo de texto -->
<div class="form-group col-sm-8">
    {!! Form::label('responsable_id', 'Responsable (Generalmente es el contratista)') !!}
    <div class="input-group">
        <div class="input-group-addon" title="En caso de ser selcccionado, este Aparecerá en los extractos del contrato"><i class="fa fa-shield" aria-hidden="true" ></i></div>
        {!! Form::select('responsable_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
    </div>
</div>
<div class="form-group col-sm-4">
    {!! Form::label('valor', 'Valor contrato') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'sin puntos, comas o espacios']) !!}
    </div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Servicios</strong>
    <hr  style="margin-top: 0px;">
</div>
<div class="form-group col-sm-2">
    <!-- {!! Form::label('s1', 'Servicios') !!}-->
    <label class="">
        {!! Form::hidden('s1', false) !!}
        {{ Form::checkbox('s1', 1, null, ['class' => 'field']) }} Empresarial
    </label>
</div>

<div class="form-group col-sm-2">
    <label class="">
        {!! Form::hidden('s2', false) !!}
        {{ Form::checkbox('s2', 1, null, ['class' => 'field']) }} Escolar
    </label>
</div>

<div class="form-group col-sm-2">
    <label class="">
        {!! Form::hidden('s3', false) !!}
        {{ Form::checkbox('s3', 1, null, ['class' => 'field']) }} Grupo de usuarios
    </label>
</div>

<div class="form-group col-sm-2">
    <label class="">
        {!! Form::hidden('s4', false) !!}
        {{ Form::checkbox('s4', 1, null, ['class' => 'field']) }} Salud
    </label>
</div>

<div class="form-group col-sm-2">
    <label class=""> 
        {!! Form::hidden('s5', false) !!}       
        {{ Form::checkbox('s5', 1, null, ['class' => 'field']) }} Turismo
    </label>
</div>

<div class="clearfix"></div>
<hr>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('contratoPrestacionServicios.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>

