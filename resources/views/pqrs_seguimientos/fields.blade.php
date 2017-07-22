<!-- Pqrs Id Campo de texto -->
{!! Form::hidden('pqrs_id', ($pqrs_id or ""), ['class' => 'form-control', 'placeholder'=>'']) !!}


<!-- Asunto Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('asunto', 'Asunto') !!}
    {!! Form::text('asunto', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Mensaje Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('mensaje', 'Mensaje') !!}
    {!! Form::textarea('mensaje', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo') !!}
    {!! Form::text('tipo', 'Respuesta', ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="fa fa-paper-plane-o"></i> enviar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('pqrsWebs.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
