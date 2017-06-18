<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $recibo->id !!}</p>
</div>

<!-- Natural Id Field -->
<div class="form-group">
    {!! Form::label('natural_id', 'Natural Id:') !!}
    <p>{!! $recibo->natural_id !!}</p>
</div>

<!-- Modo Pago Field -->
<div class="form-group">
    {!! Form::label('modo_pago', 'Modo Pago:') !!}
    <p>{!! $recibo->modo_pago !!}</p>
</div>

<!-- Descuento Field -->
<div class="form-group">
    {!! Form::label('descuento', 'Descuento:') !!}
    <p>{!! $recibo->descuento !!}</p>
</div>

<!-- Incremento Field -->
<div class="form-group">
    {!! Form::label('incremento', 'Incremento:') !!}
    <p>{!! $recibo->incremento !!}</p>
</div>

<!-- Observaciones Field -->
<div class="form-group">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    <p>{!! $recibo->observaciones !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $recibo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $recibo->updated_at !!}</p>
</div>

