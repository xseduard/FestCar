<!-- Natural Id Selector -->
<div class="form-group col-sm-8">
    {!! Form::label('natural_id', 'Conductor') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Fecha Expedicion campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_expedicion', 'Fecha de Expedición') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha_expedicion', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>
<div class="clearfix"></div>
<hr>
<!-- A1 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('a1', 'A1') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('a1', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- A2 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('a2', 'A2') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('a2', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<div class="clearfix"></div>
<hr>
<!-- B1 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('b1', 'B1') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('b1', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- B2 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('b2', 'B2') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('b2', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- B3 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('b3', 'B3') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('b3', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>
<div class="clearfix"></div>
<hr>
<!-- C1 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('c1', 'C1') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('c1', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- C2 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('c2', 'C2') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('c2', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- C3 campo de fecha -->
<div class="form-group col-sm-4">
    {!! Form::label('c3', 'C3') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('c3', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary'        
    ]) !!}
    <a href="{!! route('licenciaConduccions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
