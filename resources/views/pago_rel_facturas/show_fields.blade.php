<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pagoRelFactura->id !!}</p>
</div>

<!-- Pago Id Field -->
<div class="form-group">
    {!! Form::label('pago_id', 'Pago Id:') !!}
    <p>{!! $pagoRelFactura->pago_id !!}</p>
</div>

<!-- Factura Id Field -->
<div class="form-group">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    <p>{!! $pagoRelFactura->factura_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $pagoRelFactura->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $pagoRelFactura->updated_at !!}</p>
</div>

