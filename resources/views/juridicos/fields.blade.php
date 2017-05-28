<!-- Nit Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('nit', '*Nit') !!}
    {!! Form::text('nit', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Campo de texto -->
<div class="form-group col-sm-8">
    {!! Form::label('nombre', '*Nombre o Razón Social') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>


<!-- Natural Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('natural_id', '*Representante Legal') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
</div>

<!-- Actividad Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('actividad', 'Clasificación / Actividad de la Empresa') !!}
    {!! Form::text('actividad', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Fiscal Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion_fiscal', 'Direccion Fiscal') !!}
    {!! Form::text('direccion_fiscal', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Envio Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion_envio', 'Direccion Envio') !!}
    {!! Form::text('direccion_envio', null, ['class' => 'form-control']) !!}
</div>
<!-- Telefono Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('telefono', 'Teléfono') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>
<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Selector -->
<div class="form-group col-sm-4">
    {!! Form::label('estado', '*Estado') !!}
    {!! Form::select('estado', [1=>'Activo', 2=>'Desactivado'], null, ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('juridicos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
