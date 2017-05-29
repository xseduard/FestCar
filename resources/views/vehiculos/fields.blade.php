<!-- Placa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('placa', 'Placa') !!}
    {!! Form::text('placa', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>
<!-- Propietario Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('propietario_nombre', 'Nombre Propietario') !!}
    {!! Form::text('propietario_nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Propietario Cedula Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('propietario_cedula', 'Cédula Propietario') !!}
    {!! Form::text('propietario_cedula', null, ['class' => 'form-control']) !!}
</div>

<!-- Poseedor Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('poseedor_nombre', 'Nombre Poseedor') !!}
    {!! Form::text('poseedor_nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Poseedor Cedula Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('poseedor_cedula', 'Cédula Poseedor') !!}
    {!! Form::text('poseedor_cedula', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Interno Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('numero_interno', 'Numero Interno') !!}
    {!! Form::text('numero_interno', null, ['class' => 'form-control', 'placeholder'=>'En caso de ser propiedad empresarial']) !!}
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
