
<div class="form-group col-sm-2">
    {!! Form::label('cantidad', 'Cantidad de Pasajeros') !!}
    {!! Form::select('cantidad',['1'=>'1','2'=>'2'], 1, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}
</div>

<!-- Cedula Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('cedula', 'Cédula') !!}
    {!! Form::text('cedula', null, ['class' => 'form-control', 'required', 'pattern' => '[0-9]{5,12}', 'placeholder'=>'']) !!}
</div>

<!-- Nombres Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('nombres', 'Nombres') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control', 'required', 'placeholder'=>'']) !!}
</div>

<!-- Apellidos Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('apellidos', 'Apellidos') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control', 'required', 'placeholder'=>'']) !!}
</div>

<!-- Celular Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('celular', 'Celular') !!}
    {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder'=>'Opcional']) !!}
</div>



<div class="clearfix"></div>
<hr>
<!-- Ac Cedula Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ac_cedula', 'Cédula (Acompañante)') !!}
    {!! Form::text('ac_cedula', null, ['class' => 'form-control ac_field',  'pattern' => '[0-9]{5,12}', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Nombres Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('ac_nombres', 'Nombres (Acompañante)') !!}
    {!! Form::text('ac_nombres', null, ['class' => 'form-control ac_field', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Apellidos Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('ac_apellidos', 'Apellidos (Acompañante)') !!}
    {!! Form::text('ac_apellidos', null, ['class' => 'form-control ac_field', 'placeholder'=>'Opcional']) !!}
</div>

<!-- Ac Celular Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ac_celular', 'Celular (Acompañante)') !!}
    {!! Form::text('ac_celular', null, ['class' => 'form-control ac_field', 'placeholder'=>'Opcional']) !!}
</div>
