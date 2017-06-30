<!-- Cedula Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('cedula', 'Cédula') !!}
    {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Nombres Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Apellidos Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('apellidos', 'Apellidos') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Celular Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular') !!}
    {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('emdiConductors.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
