<!-- Pago Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('pago_id', 'Pago Id') !!}
    {!! Form::text('pago_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ruta Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ruta_id', 'Ruta Id') !!}
    {!! Form::text('ruta_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Valor Final Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('valor_final', 'Valor Final') !!}
    {!! Form::text('valor_final', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cantidad Viajes Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_viajes', 'Cantidad Viajes') !!}
    {!! Form::text('cantidad_viajes', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pagoRelRutas.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
