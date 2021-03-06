<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Poliza Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('poliza', 'Número de Poliza') !!}
    {!! Form::text('poliza', null, ['class' => 'form-control', 'placeholder'=>'# Soat...']) !!}
</div>

<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_expedicion', 'Fecha de Expedicion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Vigencia Inicio campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_vigencia_inicio', 'Fecha inicio de Vigencia') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_inicio', null, ['disabled' => true,  'class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Vigencia Final campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_vigencia_final', 'Fecha fin de Vigencia') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_vigencia_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Tomador Cedula Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('tomador_cedula', 'Cédula del Tomador') !!}
    {!! Form::text('tomador_cedula', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- Tomador Nombre Campo de texto -->
<div class="form-group col-sm-8">
    {!! Form::label('tomador_nombre', 'Nombres / Apellidos del Tomador') !!}
    {!! Form::text('tomador_nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Entidad Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('entidad', 'Entidad Expide SOAT') !!}
    {!! Form::select('entidad', 
        ['Aseguradora Solidaria' => 'Aseguradora Solidaria',
        'Seguros del Estado S.A' => 'Seguros del Estado S.A',
        'Allianz Seguros' => 'Allianz Seguros',
        'AIG Seguros' => 'AIG Seguros',
        'SURA' => 'SURA',
        'AXA Colpatria Seguros' => 'AXA Colpatria Seguros',
        'Alico' => 'Alico',
        'Mapfre' => 'Mapfre',
        'RSA Seguros' => 'RSA Seguros',
        'Equidad Seguros' => 'Equidad Seguros',
        'Liberty Seguros' => 'Liberty Seguros',
        'Generali Seguros' => 'Generali Seguros',
        'Charis' => 'Charis',
        'Chubb' => 'Chubb',
        'Confianza' => 'Confianza',
        'Mundial Seguros' => 'Mundial Seguros',
        'QBE' => 'QBE',
        'Generali' => 'Generali',
        'Seguros Bolivar' => 'Seguros Bolivar',
        'BNP Paribas Cardif' => 'BNP Paribas Cardif',
        'Previsora' => 'Previsora',
        'Otra' => 'Otra'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('soats.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
