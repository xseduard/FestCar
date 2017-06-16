<!-- Min campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('min', 'Capacidad minima') !!}
    {!! Form::number('min', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Max campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('max', 'Capacidad maxima') !!}
    {!! Form::number('max', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- DIVIDER -->
<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="ion-ios-pricetags" aria-hidden="true"></i>  Costos Mantenimiento</strong>
    <hr  style="margin-top: 0px;">
</div>
<!-- Max campo numerico -->
<div class="form-group col-sm-3">
    {!! Form::label('inversion', 'Inversion') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('inversion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('llantas_completas', 'Llantas completas') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('llantas_completas', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('motor_caja_trasmision', 'Motor/Caja/Trasmision') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('motor_caja_trasmision', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('ajuste_pintura', 'Ajuste pintura') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('ajuste_pintura', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('rodamiento', 'Rodamiento') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('rodamiento', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('cojineria_vidrios', 'Cojineria y vidrios') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('cojineria_vidrios', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('lavado', 'Lavado/limpieza') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('lavado', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('carroceria', 'Carroceria') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('carroceria', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<!-- DIVIDER -->
<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="ion-ios-pricetags" aria-hidden="true"></i>  Costos Operación</strong>
    <hr  style="margin-top: 0px;">
</div>

<div class="form-group col-sm-4">
    {!! Form::label('salario_conductor', 'Salario del conductor') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('salario_conductor', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-4">
    {!! Form::label('prestaciones_sociales', 'Prestaciones sociales') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('prestaciones_sociales', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-4">
    {!! Form::label('seguridad_social', 'Seguridad social') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('seguridad_social', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<!-- DIVIDER -->
<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="ion-ios-pricetags" aria-hidden="true"></i>  Costos Seguros</strong>
    <hr  style="margin-top: 0px;">
</div>
<div class="form-group col-sm-2">
    {!! Form::label('soat', 'soat') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('soat', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('tecnicomecanica', 'Técnicomecánica') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('tecnicomecanica', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('revision_bimensual', 'Revisión bimensual') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('revision_bimensual', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('contractual', 'P.Res.Civil Contractual') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('contractual', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('extracontractual', 'P.Res.Civil Extracontractual') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('extracontractual', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>

<!-- DIVIDER -->
<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="ion-ios-pricetags" aria-hidden="true"></i>  Consumibles</strong>
    <hr  style="margin-top: 0px;">
</div>

<div class="form-group col-sm-2">
    {!! Form::label('acpm_galon', 'Costo ACPM/galon') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('acpm_galon', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('gasolina_galon', 'Costo Gasolina/galon') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('gasolina_galon', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('galones_kilometro', 'Consumo Galones/km') !!}
    <div class="input-group">
        <div class="input-group-addon">#</div>
        {!! Form::text('galones_kilometro', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('aceites_filtros', 'Aceites y filtros') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('aceites_filtros', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('aditivos', 'Aditivos') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('aditivos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('baterias', 'Baterias') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('baterias', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>

<!-- DIVIDER -->
<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="ion-ios-pricetags" aria-hidden="true"></i> Varios</strong>
    <hr  style="margin-top: 0px;">
</div>

<div class="form-group col-sm-2">
    {!! Form::label('impuesto_rodamiento', 'Impuesto rodamiento') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('impuesto_rodamiento', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('impuesto_semaforizacion', 'Impuesto semaforización') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('impuesto_semaforizacion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('parqueo', 'Parking') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('parqueo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('tramites_varios', 'Tramites varios/papeleria') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('tramites_varios', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('administracion', 'Administración') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('administracion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('plan_reposicion_equipo', 'Plan reposicion de equipo') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('plan_reposicion_equipo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('sistema_comunicacion', 'Sistema comunicación') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('sistema_comunicacion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('gps', 'GPS') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('gps', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<div class="form-group col-sm-2">
    {!! Form::label('otros', 'Otros') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
        {!! Form::text('otros', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
    </div>
</div>
<!-- Margen campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('margen', 'Margen') !!}
    {!! Form::number('margen', null, ['class' => 'form-control', 'placeholder'=>'']) !!}    
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('simuladorGastos.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
