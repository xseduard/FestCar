<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $reciboDetalle->id !!}</p>
</div>

<!-- Recibo Id Field -->
<div class="form-group">
    {!! Form::label('recibo_id', 'Recibo Id:') !!}
    <p>{!! $reciboDetalle->recibo_id !!}</p>
</div>

<!-- Recibo Producto Id Field -->
<div class="form-group">
    {!! Form::label('recibo_producto_id', 'Recibo Producto Id:') !!}
    <p>{!! $reciboDetalle->recibo_producto_id !!}</p>
</div>

<!-- Cantidad Field -->
<div class="form-group">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{!! $reciboDetalle->cantidad !!}</p>
</div>

<!-- Precio Final Field -->
<div class="form-group">
    {!! Form::label('precio_final', 'Precio Final:') !!}
    <p>{!! $reciboDetalle->precio_final !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $reciboDetalle->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $reciboDetalle->updated_at !!}</p>
</div>

