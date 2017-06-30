<!-- Cedula Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('cedula', 'Cédula') !!}
    {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Nombres Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('nombres', 'Nombres') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Apellidos Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('apellidos', 'Apellidos') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Celular Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('celular', 'Celular') !!}
    {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Direccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>
<div class="clearfix"></div>
<hr>
<!-- Ac Cedula Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ac_cedula', 'Acompañante Cédula') !!}
    {!! Form::text('ac_cedula', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Nombres Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('ac_nombres', 'Acompañante Nombres') !!}
    {!! Form::text('ac_nombres', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Apellidos Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('ac_apellidos', 'Acompañante Apellidos') !!}
    {!! Form::text('ac_apellidos', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Celular Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ac_celular', 'Acompañante Celular') !!}
    {!! Form::text('ac_celular', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('emdiPacientes.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
