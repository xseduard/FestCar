

<!-- Paciente Id Selector -->
<!--
<div class="form-group col-sm-6">
    {!! Form::label('paciente_id', 'Afiliado / Paciente / Usuario') !!}
    {!! Form::select('paciente_id', $selectores['paciente_id'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
--> 
<!-- Ruta Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('ruta', 'Ruta') !!}
    {!! Form::select('ruta',['ARBOLETES-MONTERIA (Ida y Regreso)'=>'ARBOLETES-MONTERIA (Ida y Regreso)'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}
</div>

<div class="clearfix"></div>
<hr>

<!-- Cita Fecha campo de fecha -->
<div class="form-group col-sm-3">
    {!! Form::label('cita_fecha', 'Fecha de la cita') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('cita_fecha', null, ['class' => 'form-control datepicker', 'required', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Cita Hora Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('cita_hora', 'Hora de la cita') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
        {!! Form::text('cita_hora', null, ['class' => 'form-control', 'required', 'placeholder'=>'']) !!}
    </div>
</div>

<!-- Cita Lugar Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('cita_lugar_id', 'Lugar de la cita') !!}
    {!! Form::select('cita_lugar_id', $selectores['cita_lugar_id'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<div class="clearfix"></div>
<hr>
<!-- Conductor Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('conductor_id', 'Conductor') !!}
    {!! Form::select('conductor_id', $selectores['conductor_id'], null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('emdiAutorizacions.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
