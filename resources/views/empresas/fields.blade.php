<!-- Nit Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('nit', 'Nit') !!}
    {!! Form::text('nit', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Nombre Corto Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_corto', 'Nombre Corto') !!}
    {!! Form::text('nombre_corto', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Razon Social Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social', 'Razon Social') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> REPRESENTANTE LEGAL</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- Rte Nombre Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('rte_nombre', 'Nombres') !!}
    {!! Form::text('rte_nombre', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Rte Apellido Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('rte_apellido', 'Apellidos') !!}
    {!! Form::text('rte_apellido', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Rte Cedula Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('rte_cedula', 'Cédula') !!}
    {!! Form::text('rte_cedula', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Rte Cedula Ref Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('rte_cedula_ref', 'Lugar expedición (Ciudad)') !!}
    {!! Form::text('rte_cedula_ref', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Rte Cedula Ref Departamento Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('rte_cedula_ref_departamento', 'Lugar expedición (Departamento)') !!}
    {!! Form::text('rte_cedula_ref_departamento', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> INFORMACIÓN CONTACTO</strong>
    <hr  style="margin-top: 0px;">
</div>



<!-- Direccion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección completa') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Direccion Corta Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('direccion_corta', 'Dirección Corta') !!}
    {!! Form::text('direccion_corta', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ciudad Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ciudad', 'Ciudad') !!}
    {!! Form::text('ciudad', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Departamento Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('departamento', 'Departamento') !!}
    {!! Form::text('departamento', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>


<!-- Telefono Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('telefono', 'Teléfono') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Celular Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('celular', 'Celular') !!}
    {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Correo Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('correo', 'Correo') !!}
    {!! Form::text('correo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- Pagina Web Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('pagina_web', 'Pagina Web') !!}
    {!! Form::text('pagina_web', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> VALORES POR DEFAULT EN EL GENERADOR DE CONTRATOS</strong>
    <hr  style="margin-top: 0px;">
</div>
<!-- Cuota Admin campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('cuota_admin', 'Cuota Administración (Porcentaje)') !!}
    {!! Form::number('cuota_admin', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cuota Admin Valor campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('cuota_admin_valor', 'Cuota Administración (Valor Uno)') !!}
    {!! Form::number('cuota_admin_valor', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Cuota Admin Valor Dos campo numerico -->
<div class="form-group col-sm-4">
    {!! Form::label('cuota_admin_valor_dos', 'Cuota Administración (Valor Dos)') !!}
    {!! Form::number('cuota_admin_valor_dos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('empresas.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
