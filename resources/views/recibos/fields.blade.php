<!-- Natural Id Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('natural_id', 'Cliente') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<!-- Modo Pago Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('modo_pago', 'Metodo de Pago') !!}
    {!! Form::select('modo_pago', ['Efectivo' => 'Efectivo','Transferencia Bancaria' => 'Transferencia Bancaria'], 'Efectivo', ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>
<div class="clearfix"></div>
<hr>
<!-- cuerpo recibo -->
<div class="form-group col-sm-8">
    {!! Form::label('art_1', 'Articulos') !!}
    {!! Form::select('art_1', $selectores['recibo_producto_id'], 1, ['class' => 'form-control select_art', 'id' => 'art_1', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>


<div class="form-group col-sm-1">
    {!! Form::label('cantidad_1', 'Cant.') !!}    
    {!! Form::number('cantidad_1', 1, ['class' => 'form-control cant', 'id' => 'cantidad_1', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}       
</div>

<div class="form-group col-sm-3">
    {!! Form::label('precio_1', 'Precio') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
            {!! Form::number('precio_1', 10000, ['class' => 'form-control price', 'id' => 'precio_1', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}
        </div>
</div>


<div class="form-group col-sm-8">
    {!! Form::select('art_2', $selectores['recibo_producto_id'], null, ['class' => 'form-control select_art', 'id' => 'art_2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-1">    
    {!! Form::number('cantidad_2', 0, ['class' => 'form-control cant', 'id' => 'cantidad_2', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}       
</div>

<div class="form-group col-sm-3">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
            {!! Form::number('precio_2', 0, ['class' => 'form-control price', 'id' => 'precio_2', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}
        </div>
</div>

<div class="form-group col-sm-8">
    {!! Form::select('art_3', $selectores['recibo_producto_id'], null, ['class' => 'form-control select_art', 'id' => 'art_3', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-1">    
    {!! Form::number('cantidad_3', 0, ['class' => 'form-control cant', 'id' => 'cantidad_3', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}       
</div>

<div class="form-group col-sm-3">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
            {!! Form::number('precio_3', 0, ['class' => 'form-control price', 'id' => 'precio_3', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}
        </div>
</div>

<div class="form-group col-sm-8">
    {!! Form::select('art_4', $selectores['recibo_producto_id'], null, ['class' => 'form-control select_art', 'id' => 'art_4', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-1">    
    {!! Form::number('cantidad_4', 0, ['class' => 'form-control cant', 'id' => 'cantidad_4', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}       
</div>

<div class="form-group col-sm-3">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
            {!! Form::number('precio_4', 0, ['class' => 'form-control price', 'id' => 'precio_4', 'style' => 'text-align: right;', 'placeholder'=>'']) !!}
        </div>
</div>

<div class="form-group col-sm-4 col-sm-offset-8">   
    <div class="input-group">
        <div class="input-group-addon">SubTotal</div>
            {!! Form::text('subtotal', 10000, ['class' => 'form-control money-mask', 'id' => 'subtotal', 'style' => 'text-align: right;', 'disabled' => true]) !!}
        </div>
</div>

<div class="clearfix"></div>
<hr>


<!-- Observaciones Field -->
<div class="form-group col-sm-8 col-lg-8">
    {!! Form::label('observaciones', 'Observaciones') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '4']) !!}
</div>



<!-- Descuento Campo de texto -->
<div class="form-group col-sm-4 ">
    {!! Form::label('descuento', 'Descuento') !!}
    <div class="input-group">
            <div class="input-group-addon">%</div>
            {!! Form::text('descuento', 0, ['class' => 'form-control', 'id' => 'descuento', 'style' => 'text-align: right;', 'disabled' => true]) !!}
    </div>
    {!! Form::label('incremento', 'Incremento') !!}
        <div class="input-group">
            <div class="input-group-addon">%</div>
            {!! Form::text('incremento', 0, ['class' => 'form-control', 'id' => 'incremento', 'style' => 'text-align: right;', 'disabled' => true]) !!}
    </div>
</div>

<div class="form-group col-sm-4  col-sm-offset-8">
    {!! Form::label('total', 'Total a Pagar') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
            {!! Form::text('total', 10000, ['class' => 'form-control money-mask', 'id' => 'total', 'style' => 'text-align: right;', 'disabled' => true]) !!}
        </div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('recibos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
