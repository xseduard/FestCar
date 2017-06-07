<!-- Placa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('placa', 'Placa') !!}
    {!! Form::text('placa', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-6">
    {!! Form::label('natural_id', 'Propietario') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

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
