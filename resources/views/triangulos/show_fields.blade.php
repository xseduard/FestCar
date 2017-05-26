<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $triangulo->id !!}</p>
</div>

<!-- Texto Field -->
<div class="form-group">
    {!! Form::label('texto', 'Texto:') !!}
    <p>{!! $triangulo->texto !!}</p>
</div>

<!-- Numero Field -->
<div class="form-group">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{!! $triangulo->numero !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $triangulo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $triangulo->updated_at !!}</p>
</div>

