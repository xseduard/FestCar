<!-- Pago Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('pago_id', 'Pago Id') !!}
    {!! Form::text('pago_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Descuento Id Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('descuento_id', 'Descuento Id') !!}
    {!! Form::text('descuento_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pagoRelDescuentos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
