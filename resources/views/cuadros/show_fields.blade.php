<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $cuadro->id !!}</p>
</div>

<!-- Nombre Cuadro Field -->
<div class="form-group">
    {!! Form::label('nombre_cuadro', 'Nombre Cuadro:') !!}
    <p>{!! $cuadro->nombre_cuadro !!}</p>
</div>

<!-- Numero Field -->
<div class="form-group">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{!! $cuadro->numero !!}</p>
</div>

<!-- Correo Field -->
<div class="form-group">
    {!! Form::label('correo', 'Correo:') !!}
    <p>{!! $cuadro->correo !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $cuadro->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $cuadro->updated_at !!}</p>
</div>

