<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control ']) !!}
</div>

<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('id_departamento', 'id_departamento') !!}
     {!! Form::select('id_departamento', $selectores['id_departamento'], null, ['class' => 'form-control seltest', 'style' => 'width: 100%']) !!}
</div>

<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('id_departamento', 'Departamento') !!}
     {!! Form::select('id_departamento', $selectores['id_departamento'], null, ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('municipios.index') !!}" class="btn btn-default">Cancelar</a>
</div>
