<!-- Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Precio campo numerico -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio') !!}
    {!! Form::number('precio', 0, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Stock campo numerico -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock') !!}
    {!! Form::number('stock', 0, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('reciboProductos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
