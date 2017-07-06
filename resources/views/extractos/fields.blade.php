
<!-- Contratoprestacionservicio Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('ContratoPrestacionServicio_id', 'Contrato') !!}
    {!! Form::select('ContratoPrestacionServicio_id', $selectores['ContratoPrestacionServicio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Vehiculo Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehículo') !!}
    {!! Form::select('vehiculo_id', $selectores['vehiculo_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha de Inicio') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        {!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Fecha Final campo de fecha -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_final', 'Fecha de Final') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        {!! Form::text('fecha_final', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>
<!-- Recorrido Campo de texto -->
<div class="form-group col-sm-12">
    {!! Form::label('recorrido', 'Recorrido') !!}
    {!! Form::text('recorrido', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Conductor Uno Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('conductor_uno', 'Conductor Uno') !!}
    {!! Form::select('conductor_uno', $selectores['conductor_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Conductor Dos Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('conductor_dos', 'Conductor Dos') !!}
    {!! Form::select('conductor_dos', $selectores['conductor_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Conductor Tres Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('conductor_tres', 'Conductor Tres') !!}
    {!! Form::select('conductor_tres', $selectores['conductor_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('extractos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
