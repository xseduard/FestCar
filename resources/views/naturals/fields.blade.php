<!-- Cedula Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('cedula', '*Documento de Identidad') !!}
    {!! Form::text('cedula', null, ['class' => 'form-control']) !!}
</div>
<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('municipio_id', '*Lugar de Expedición') !!}
     {!! Form::select('municipio_id', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Nombres Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', '*Nombres') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div>

<!-- Apellidos Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('apellidos', '*Apellidos') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
</div>
<!-- genero Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('genero', '*Genero') !!}
     {!! Form::select('genero', ['masculino'=>'Masculino','femenino'=>'Femenino'], null, ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
</div>
<!-- Correo Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo') !!}
    {!! Form::text('correo', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('naturals.index') !!}" class="btn btn-default">Cancelar</a>
</div>
