
<div class="col-sm-4">
    <!-- Motivo Field -->
    <div class="form-group">
        {!! Form::label('motivo', 'Motivo:') !!}
        <p>{!! $pqrsWeb->type_motivo !!}</p>
    </div>

    <!-- Servicio Field -->
    <div class="form-group">
        {!! Form::label('servicio', 'Servicio:') !!}
        <p>{!! $pqrsWeb->type_servicio !!}</p>
    </div>
     <!-- Correo Field -->
    <div class="form-group">
        {!! Form::label('correo', 'Correo:') !!}
        <p>{!! $pqrsWeb->correo !!}</p>
    </div>

</div>
<div class="col-sm-4">
    <!-- Tipo Documento Field -->
    <div class="form-group">
        {!! Form::label('documento', 'Documento:') !!}
        <p>{!! $pqrsWeb->tipo_documento," ", $pqrsWeb->cedula !!}</p>
    </div>

    <!-- Nombres Field -->
    <div class="form-group">
        {!! Form::label('nombres', 'Nombres y Apellidos:') !!}
        <p>{!! $pqrsWeb->fullname !!}</p>
    </div>
    
    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Fecha de radicación:') !!}
        <p>{!! $pqrsWeb->created_at !!}</p>
    </div>
</div>
<div class="col-sm-4">
    <!-- Celular Field -->
    <div class="form-group">
        {!! Form::label('celular', 'Celular:') !!}
        <p>{!! $pqrsWeb->celular !!}</p>
    </div>

    <!-- Ciudad Field -->
    <div class="form-group">
        {!! Form::label('ciudad', 'Ciudad:') !!}
        <p>{!! $pqrsWeb->ciudad !!}</p>
    </div>
</div>

<div class="col-sm-12">
    <!-- Observacion Field -->
    <div class="form-group">
        {!! Form::label('observacion', 'Observacion:') !!}
        <p>{!! $pqrsWeb->observacion !!}</p>
    </div>
</div>


