<!-- Recibo Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('recibo_id', 'Recibo Id') !!}
    {!! Form::text('recibo_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Recibo Producto Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('recibo_producto_id', 'Recibo Producto Id') !!}
    {!! Form::text('recibo_producto_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cantidad Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad') !!}
    {!! Form::text('cantidad', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Precio Final Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_final', 'Precio Final') !!}
    {!! Form::text('precio_final', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('reciboDetalles.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
