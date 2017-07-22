<!-- Tipo Documento Selector -->
<!-- Motivo Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('motivo', 'Motivo') !!}
    {!! Form::select('motivo', $selectores['tipo_pqrs'], null, ['required', 'class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Servicio Selector -->
<div class="form-group col-sm-6">
    {!! Form::label('servicio', 'Servicio') !!}
    {!! Form::select('servicio', $selectores['tipo_servicio'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('tipo_documento', 'Tipo de Documento') !!}
    {!! Form::select('tipo_documento', $selectores['tipo_documento'], 'CC', ['required', 'class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Cedula Campo de texto -->
<div class="form-group col-sm-8">
    {!! Form::label('cedula', 'Cédula') !!}
    {!! Form::text('cedula', null, ['required', 'class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<div class="clearfix"></div>
<!-- Nombres Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres') !!}
    {!! Form::text('nombres', null, ['required', 'class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Apellidos Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('apellidos', 'Apellidos') !!}
    {!! Form::text('apellidos', null, ['required', 'class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Celular Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('celular', 'Celular') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
        {!! Form::text('celular', null, ['required', 'class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>

<!-- Ciudad Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('ciudad', 'Ciudad') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
        {!! Form::text('ciudad', 'Apartado', ['required', 'class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>

<!-- Correo Field -->
<div class="form-group col-sm-4">
    {!! Form::label('correo', 'Correo*') !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        {!! Form::email('correo', null, ['required', 'class' => 'form-control', 'placeholder'=>'mail@mail.com']) !!}
    </div>
</div>



<!-- Observacion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observacion', 'Observaciones / Comentarios') !!}
    {!! Form::textarea('observacion', null, ['required', 'class' => 'form-control', 'placeholder'=>'Utilice este campo para describir brevemente su solicitud incluyendo fechas, datos del vehículo y/o conductor si lo requiere.']) !!}
</div>
<div class="form-group col-sm-12 col-lg-12">
    {!! Recaptcha::render() !!}
</div>
<div class="form-group col-sm-12 col-lg-12">
    <p align="justify">Antes de enviar su solicitud de contacto, sírvase leer con detenimiento la siguiente <b>NOTA SOBRE PROTECCION DE DATOS PERSONALES</b>: Conforme a <a href="https://www.mintic.gov.co/portal/604/articles-4274_documento.pdf">la Ley 1581 de 2012 de Protección de datos Personales</a>, en el momento en que usted envíe esta solicitud junto con sus datos personales en él incorporado, se entiende que, de manera previa, expresa e inequívoca, nos autoriza para tratar dichos datos con la finalidad de dar respuesta a su solicitud y seguimiento de la misma. De igual manera, se entiende que ha consultado y aceptado en todos sus términos la Política de Tratamiento de la Información que hemos adoptado en {{ $empresa_only_name or "Transporte Digital" }}; Recuerde que puede consultar el estado de su PQRS haciendo <a href="{{ route('pqrsPublic.consulta') }}">click aquí</a>.</p>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="fa fa-paper-plane-o"></i> Enviar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-block btn-flat btn-lg'        
    ]) !!}
    {{-- <a href="{!! route('/') !!}" class="btn btn-default btn-flat">Cancelar</a> --}}
</div>
