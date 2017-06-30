<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Telefono Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Teléfono') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Direccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Municipio Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('municipio_id', 'Ciudad (Opcional)') !!}
    {!! Form::select('municipio_id', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('emdiLugars.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
