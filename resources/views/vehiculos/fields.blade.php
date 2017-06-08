<!-- Placa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('placa', 'Placa') !!}
    {!! Form::text('placa', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>
<!-- Tipo Propietario Selector -->
<div class="form-group col-sm-3">
    {!! Form::label('tipo_propietario', 'Tipo de Propietario') !!}
    {!! Form::select('tipo_propietario', ['Natural' => 'Natural', 'Juridico' => 'Jurídico'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-9" id="tercero_locked">
        {!! Form::label('field_default', 'Tercero Natural/Jurídico') !!}
        <div class="input-group">
            {!! Form::text('field_default', null, ['class' => 'form-control', 'placeholder'=>'', 'disabled' => 'disabled']) !!}
            <div class="input-group-addon" title=" Seleccione un tipo de Propietario para Desbloquear"><i class="fa fa-lock" aria-hidden="true"></i></div>
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
<div class="clearfix"></div>
<!-- Numero Interno Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('numero_interno', 'Numero Interno') !!}
    {!! Form::text('numero_interno', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('capacidad', 'Capacidad') !!}
    {!! Form::number('capacidad', null, ['class' => 'form-control', 'placeholder'=>'Cantidad Maxima de Ocupantes']) !!}
</div>
<!-- campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('modelo', 'Modelo') !!}
    {!! Form::number('modelo', null, ['class' => 'form-control', 'placeholder'=>'1990']) !!}
</div>
<!-- campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('marca', 'Marca') !!}
    {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('clase', 'Clase') !!}
    {!! Form::text('clase', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- $FIELD_NAME_TITLE$ Field -->
<!-- $FIELD_NAME_TITLE$ Selector -->
<div class="form-group col-sm-4">
    {!! Form::label('propiedad', '¿Propiedad de Transeba?') !!}
    {!! Form::select('propiedad',[false=>'No', true=>'Si'], false, ['class' => 'form-control']) !!}
</div>
<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('vehiculos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
