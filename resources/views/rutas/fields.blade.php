<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Distancia Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('distancia', 'Distancia') !!}
    {!! Form::text('distancia', null, ['class' => 'form-control', 'placeholder'=>'0']) !!}
</div>

<!-- Duracion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('duracion', 'Duración') !!}
    {!! Form::text('duracion', null, ['class' => 'form-control', 'placeholder'=>'0']) !!}
</div>

<!-- Valor Sugerido Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('valor_sugerido', 'Valor Sugerido') !!}
    {!! Form::text('valor_sugerido', null, ['class' => 'form-control', 'placeholder'=>'0']) !!}
</div>

<!-- Predefinido Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('predefinido', 'Predefinido') !!}
    {!! Form::hidden('predefinido', false) !!}
        {!! Form::checkbox('predefinido', '1', true) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('rutas.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
