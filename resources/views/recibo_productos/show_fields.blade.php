<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $reciboProducto->id !!}</p>
</div>

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $reciboProducto->nombre !!}</p>
</div>

<!-- Precio Field -->
<div class="form-group">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{!! $reciboProducto->precio !!}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{!! $reciboProducto->stock !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $reciboProducto->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $reciboProducto->updated_at !!}</p>
</div>

