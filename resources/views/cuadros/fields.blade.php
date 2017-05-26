<!-- Nombre Cuadro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_cuadro', 'Nombre Cuadro:') !!}
    {!! Form::text('nombre_cuadro', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Correo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo:') !!}
    {!! Form::email('correo', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('cuadros.index') !!}" class="btn btn-default">Cancelar</a>
</div>
