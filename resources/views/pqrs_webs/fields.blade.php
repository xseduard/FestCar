<!-- Tipo Documento Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_documento', 'Tipo de Documento') !!}
    {!! Form::select('tipo_documento', $selectores['tipo_documento'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

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

<!-- Ciudad Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ciudad', 'Ciudad') !!}
    {!! Form::text('ciudad', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Correo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo') !!}
    {!! Form::email('correo', null, ['class' => 'form-control']) !!}
</div>

<!-- Motivo Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('motivo', 'Motivo') !!}
    {!! Form::select('motivo', $selectores['tipo_pqrs'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Servicio Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('servicio', 'Servicio') !!}
    {!! Form::select('servicio', $selectores['tipo_servicio'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observacion', 'Observaciones / Comentarios') !!}
    {!! Form::textarea('observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pqrsWebs.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
