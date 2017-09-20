<!-- Pago Id Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('pago_id', 'Codigo Pago') !!}
    {!! Form::text('pago_id', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Descuento Id Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('descuento_id', 'Tipo Descuento') !!}
    {!! Form::select('descuento_id', $selectores['descuento_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}
</div>

<!-- Descuento Id Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('valor', 'Valor') !!}
	<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-usd"></i></div>
	    {!! Form::text('valor', null, ['class' => 'form-control text-right', 'placeholder'=>'']) !!}
	</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    @if ( isset($pagoRelDescuento) )
        <a href="{!! route('pagoRelDescuentos.index', ['search='.$pagoRelDescuento->pago_id]) !!}" class="btn btn-default btn-flat">Cancelar</a>
    @else
        <a href="{!! route('pagoRelDescuentos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
    @endif
</div>
