<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Licencia Transito Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('licencia_transito', 'Licencia Transito') !!}
    {!! Form::text('licencia_transito', null, ['class' => 'form-control', 'placeholder'=>'Número...']) !!}
</div>

<!-- Marca Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('marca', 'Marca') !!}
    {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Linea Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('linea', 'Linea') !!}
    {!! Form::text('linea', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cilindrada Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('cilindrada', 'Cilindrada') !!}
    {!! Form::text('cilindrada', null, ['class' => 'form-control', 'placeholder'=>'9.000cc']) !!}
</div>

<!-- Color Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('color', 'Color') !!}
    {!! Form::text('color', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Servicio Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('servicio', 'Servicio') !!}
    {!! Form::text('servicio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Clase Vehiculo Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('clase_vehiculo', 'Clase Vehiculo') !!}
    {!! Form::text('clase_vehiculo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Tipo Carroceria Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_carroceria', 'Tipo Carroceria') !!}
    {!! Form::text('tipo_carroceria', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Combustible Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('combustible', 'Combustible') !!}
    {!! Form::text('combustible', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Numero Motor Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('numero_motor', 'Numero Motor') !!}
    {!! Form::text('numero_motor', null, ['class' => 'form-control', 'placeholder'=>'Número...']) !!}
</div>

<!-- Numero Serie Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('numero_serie', 'Numero Serie') !!}
    {!! Form::text('numero_serie', null, ['class' => 'form-control', 'placeholder'=>'Número...']) !!}
</div>

<!-- Numero Chasis Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('numero_chasis', 'Numero Chasis') !!}
    {!! Form::text('numero_chasis', null, ['class' => 'form-control', 'placeholder'=>'Número...']) !!}
</div>

<!-- Restriccion Movilidad Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('restriccion_movilidad', 'Restriccion Movilidad') !!}
    {!! Form::text('restriccion_movilidad', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Blindaje Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('blindaje', 'Blindaje') !!}
    {!! Form::text('blindaje', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Potencia Hp Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('potencia_hp', 'Potencia Hp') !!}
    {!! Form::text('potencia_hp', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Declaracion Importacion Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('declaracion_importacion', 'Declaracion Importacion') !!}
    {!! Form::text('declaracion_importacion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Fecha Importacion campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_importacion', 'Fecha Importacion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        {!! Form::text('fecha_importacion', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>


<!-- Puertas campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('puertas', 'Puertas') !!}
    {!! Form::number('puertas', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Fecha Matricula campo de fecha -->
<div class="form-group col-sm-3">
    {!! Form::label('fecha_matricula', 'Fecha Matricula') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        {!! Form::text('fecha_matricula', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-3">
    {!! Form::label('fecha_expedicion', 'Fecha Expedicion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        {!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd']) !!}
    </div>
</div>

<!-- Organismo Transito Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('organismo_transito', 'Organismo Transito') !!}
    {!! Form::text('organismo_transito', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('tarjetaPropiedads.index') !!}" class="btn btn-default">Cancelar</a>
</div>
