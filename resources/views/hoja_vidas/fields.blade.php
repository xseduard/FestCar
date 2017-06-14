<!-- Natural Id Selector -->
<div class="form-group col-sm-4">
    {!! Form::label('natural_id', 'Natural') !!}
    {!! Form::select('natural_id', $selectores['natural_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ciudad Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ciudad', 'Ciudad') !!}
    {!! Form::select('ciudad', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Fecha campo de fecha -->
<div class="form-group col-sm-2">
    {!! Form::label('fecha', 'Fecha') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('fecha', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Empleo Cargo Solicitado Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('empleo_cargo_solicitado', 'Empleo Cargo Solicitado') !!}
    {!! Form::text('empleo_cargo_solicitado', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Codigo Cargo Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('codigo_cargo', 'Codigo Cargo') !!}
    {!! Form::text('codigo_cargo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> I. DATOS PERSONALES</strong>
    <hr  style="margin-top: 0px;">
</div>

<div class="form-group col-sm-3">
    {!! Form::label('i_profesion', 'Profesión, ocupación u oficio') !!}
    {!! Form::text('i_profesion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Anos Exp Laboral campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('i_anos_exp_laboral', 'Años de Exp. Laboral') !!}
    {!! Form::number('i_anos_exp_laboral', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Lugar Nacimiento Selector -->
<div class="form-group col-sm-3">
    {!! Form::label('i_lugar_nacimiento', 'Lugar de Nacimiento') !!}
    {!! Form::select('i_lugar_nacimiento', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Fecha Nacimiento campo de fecha -->
<div class="form-group col-sm-2">
    {!! Form::label('i_fecha_nacimiento', 'Fecha de Nacimiento') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('i_fecha_nacimiento', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- I Estado Civil Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_estado_civil', 'Estado Civil') !!}
    {!! Form::select('i_estado_civil', 
        ['Soltero'   =>  'Soltero',
        'Casado'    =>  'Casado',
        'Viudo' =>  'Viudo',
        'Union libre'   =>  'Union libre'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Direccion Domicilio Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('i_direccion_domicilio', 'Dirección Domicilio') !!}
    {!! Form::text('i_direccion_domicilio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Barrio Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_barrio', 'Barrio') !!}
    {!! Form::text('i_barrio', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Telefono Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_telefono', 'Teléfono') !!}
    {!! Form::text('i_telefono', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Libreta Militar Numero Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_libreta_militar_numero', 'Libreta Militar Nº') !!}
    {!! Form::text('i_libreta_militar_numero', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Libreta Distrito Clase Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_libreta_distrito_clase', 'Distrito Clase') !!}
    {!! Form::select('i_libreta_distrito_clase', ['Primera clase'   =>  'Primera clase',
'Segunda clase' =>  'Segunda clase'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Vivienda Propia Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_vivienda_propia', '¿Vivienda Propia?') !!}
    {!! Form::select('i_vivienda_propia', ['Si' =>  'Si', 'No'    =>  'No'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Nombre Arrendador Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('i_nombre_arrendador', 'Nombre del Arrendador') !!}
    {!! Form::text('i_nombre_arrendador', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Telefono Arrendador Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_telefono_arrendador', 'Teléfono Arrendador') !!}
    {!! Form::text('i_telefono_arrendador', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Valor Arriendo Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_valor_arriendo', 'Valor Arriendo') !!}
    {!! Form::text('i_valor_arriendo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Esta Trabajando Actualmente Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_esta_trabajando_actualmente', '¿Esta Trabajando Actualmente?') !!}
    {!! Form::select('i_esta_trabajando_actualmente', ['Si' =>  'Si', 'No'    =>  'No'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Empresa Donde Trabaja Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('i_empresa_donde_trabaja', '¿En qué Empresa?') !!}
    {!! Form::text('i_empresa_donde_trabaja', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- I Empleado Independiente Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_empleado_independiente', 'Tipo') !!}
    {!! Form::select('i_empleado_independiente', ['Empleado'    =>  'Empleado', 'Independiente' =>  'Independiente'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- I Tipo Contrato Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('i_tipo_contrato', 'Tipo Contrato') !!}
    {!! Form::select('i_tipo_contrato', ['Indefinido'   =>  'Indefinido', 'Inferior a un año' =>  'Inferior a un año', 'Prestacion de servicio'    =>  'Prestacion de servicio'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> II. EDUCACIÓN Y APTITUDES</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- Ii Establecimiento Primaria Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ii_establecimiento_primaria', 'Establecimiento donde curso Primaria') !!}
    {!! Form::text('ii_establecimiento_primaria', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Primaria Ciudad Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_primaria_ciudad', 'Ciudad') !!}
    {!! Form::select('ii_primaria_ciudad', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ii Primaria Ultimo Grado campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_primaria_ultimo_grado', 'Ultimo grado cursado') !!}
    {!! Form::number('ii_primaria_ultimo_grado', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Primaria Fecha Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_primaria_fecha', 'Fecha') !!}
    {!! Form::text('ii_primaria_fecha', null, ['class' => 'form-control datepicker',  'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="clearfix"></div>
<!-- Ii Establecimiento Bachillerato Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ii_establecimiento_bachillerato', 'Establecimiento donde curso Bachillerato') !!}
    {!! Form::text('ii_establecimiento_bachillerato', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Bachillerato Ciudad Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_bachillerato_ciudad', 'Ciudad') !!}
    {!! Form::select('ii_bachillerato_ciudad', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ii Bachillerato Ultimo Grado campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_bachillerato_ultimo_grado', 'Ultimo grado cursado') !!}
    {!! Form::number('ii_bachillerato_ultimo_grado', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Bachillerato Fecha Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_bachillerato_fecha', 'Fecha') !!}
    {!! Form::text('ii_bachillerato_fecha',  null, ['class' => 'form-control datepicker ',  'placeholder'=>'Seleccione...*']) !!}
</div>

<div class="clearfix"></div>

<!-- Ii Establecimiento Superior Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ii_establecimiento_superior', 'Establecimiento donde curso Educación Superior') !!}
    {!! Form::text('ii_establecimiento_superior', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Superior Ciudad Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_superior_ciudad', 'Ciudad') !!}
    {!! Form::select('ii_superior_ciudad', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ii Superior Anos Cursados campo numerico -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_superior_anos_cursados', 'Años cursados') !!}
    {!! Form::number('ii_superior_anos_cursados', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Superior Fecha Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_superior_fecha', 'Fecha') !!}
    {!! Form::text('ii_superior_fecha',  null, ['class' => 'form-control datepicker',  'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ii Superior Titulo Obtenido Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_superior_titulo_obtenido', 'Titulo obtenido y/o especialidad') !!}
    {!! Form::text('ii_superior_titulo_obtenido', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Superior Tipo Formacion Selector -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_superior_tipo_formacion', 'Tipo Formación') !!}
    {!! Form::select('ii_superior_tipo_formacion', ['Tecnica'   =>  'Técnica', 'Tecnologia'    =>  'Tecnológia', 'Profesional'   =>  'Profesional'
], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- Ii Estudios Realiza Actualmente Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('ii_estudios_realiza_actualmente', '¿Qué estudios realiza actualmente?') !!}
    {!! Form::text('ii_estudios_realiza_actualmente', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Ii Horario Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('ii_horario', 'Horario') !!}
    {!! Form::text('ii_horario', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> III. EXPERIENCIA LABORAL</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- Iii Nombre Ultima Actual Empresa Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('iii_nombre_ultima_actual_empresa', 'Nombre de la última o actual empresa') !!}
    {!! Form::text('iii_nombre_ultima_actual_empresa', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('iii_direccion', 'Dirección') !!}
    {!! Form::text('iii_direccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('iii_telefono', 'Teléfono') !!}
    {!! Form::text('iii_telefono', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Nombre Jefe Inmediato Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('iii_nombre_jefe_inmediato', 'Nombre de su jefe inmediato') !!}
    {!! Form::text('iii_nombre_jefe_inmediato', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Cargo Desempenado Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('iii_cargo_desempenado', 'Cargo(s) Desempenado(s) por usted') !!}
    {!! Form::text('iii_cargo_desempenado', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Funciones Realizadas Campo de texto -->
<div class="form-group col-sm-12">
    {!! Form::label('iii_funciones_realizadas', 'Funciones realizadas') !!}
    {!! Form::text('iii_funciones_realizadas', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Fecha Ingreso campo de fecha -->
<div class="form-group col-sm-3">
    {!! Form::label('iii_fecha_ingreso', 'Fecha Ingreso') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('iii_fecha_ingreso', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Iii Fecha Retiro campo de fecha -->
<div class="form-group col-sm-3">
    {!! Form::label('iii_fecha_retiro', 'Fecha Retiro') !!}
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    	{!! Form::text('iii_fecha_retiro', null, ['class' => 'form-control datepicker', 'placeholder' => 'AAAA-MM-DD']) !!}
    </div>
</div>

<!-- Iii Sueldo Inicial Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('iii_sueldo_inicial', 'Sueldo Inicial') !!}
    {!! Form::text('iii_sueldo_inicial', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Sueldo Final Actual Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('iii_sueldo_final_actual', 'Sueldo Final o Actual') !!}
    {!! Form::text('iii_sueldo_final_actual', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Iii Motivo Retiro Campo de texto -->
<div class="form-group col-sm-12">
    {!! Form::label('iii_motivo_retiro', 'Motivo Retiro') !!}
    {!! Form::text('iii_motivo_retiro', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> V. INFORMACIÓN FAMILIAR</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- V Nombre Esposo Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('v_nombre_esposo', 'Nombre esposa(o) o compañera(o)') !!}
    {!! Form::text('v_nombre_esposo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Profesion Ocupacion Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('v_profesion_ocupacion', 'Profesión, ocupación u oficio') !!}
    {!! Form::text('v_profesion_ocupacion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Empresa Trabaja Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('v_empresa_trabaja', 'Empresa donde trabaja') !!}
    {!! Form::text('v_empresa_trabaja', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Cargo Actual Campo de texto -->
<div class="form-group col-sm-3">
    {!! Form::label('v_cargo_actual', 'Cargo actual') !!}
    {!! Form::text('v_cargo_actual', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Direccion Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('v_direccion', 'Dirección') !!}
    {!! Form::text('v_direccion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Telefono Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('v_telefono', 'Telefono') !!}
    {!! Form::text('v_telefono', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Ciudad Selector -->
<div class="form-group col-sm-3">
    {!! Form::label('v_ciudad', 'Ciudad') !!}
    {!! Form::select('v_ciudad', $selectores['municipio_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
</div>

<!-- V Numero Dependen campo numerico -->
<div class="form-group col-sm-6">
    {!! Form::label('v_numero_dependen', 'Número de personas que dependen económicamente del solicitante') !!}
    {!! Form::number('v_numero_dependen', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Parentesco Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('v_parentesco', 'Parentesco') !!}
    {!! Form::text('v_parentesco', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Edades Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('v_edades', 'Edades') !!}
    {!! Form::text('v_edades', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Nombre Padres Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('v_nombre_padres', 'Nombre Padres') !!}
    {!! Form::text('v_nombre_padres', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- V Padres Profesion Campo de texto -->
<div class="form-group col-sm-6">
    {!! Form::label('v_padres_profesion', 'Profesión, ocupación u oficio') !!}
    {!! Form::text('v_padres_profesion', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> VI. REFERENCIAS PERSONALES</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- Vi Nombre Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('vi_nombre_uno', 'Nombre') !!}
    {!! Form::text('vi_nombre_uno', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Ocupacion Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('vi_ocupacion_uno', 'Ocupación') !!}
    {!! Form::text('vi_ocupacion_uno', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Direccion Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('vi_direccion_uno', 'Dirección') !!}
    {!! Form::text('vi_direccion_uno', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Telefono Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('vi_telefono_uno', 'Teléfono') !!}
    {!! Form::text('vi_telefono_uno', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Nombre Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('vi_nombre_dos', 'Nombre') !!}
    {!! Form::text('vi_nombre_dos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Ocupacion Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('vi_ocupacion_dos', 'Ocupación') !!}
    {!! Form::text('vi_ocupacion_dos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Direccion Campo de texto -->
<div class="form-group col-sm-4">
    {!! Form::label('vi_direccion_dos', 'Dirección') !!}
    {!! Form::text('vi_direccion_dos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Vi Telefono Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('vi_telefono_dos', 'Teléfono') !!}
    {!! Form::text('vi_telefono_dos', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <strong class="text-muted" style="padding-bottom: 0px;"><i class="fa  fa-caret-right" aria-hidden="true"></i> Extra</strong>
    <hr  style="margin-top: 0px;">
</div>

<!-- Talla Camisa Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('talla_camisa', 'Talla Camisa') !!}
    {!! Form::text('talla_camisa', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Talla Pantalon Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('talla_pantalon', 'Talla Pantalon') !!}
    {!! Form::text('talla_pantalon', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Talla Zapato Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('talla_zapato', 'Talla Zapato') !!}
    {!! Form::text('talla_zapato', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Seguridad Social Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('seguridad_social', 'Seguridad Social') !!}
    {!! Form::text('seguridad_social', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Estatura Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('estatura', 'Estatura') !!}
    {!! Form::text('estatura', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>

<!-- Grupo Sanguineo Campo de texto -->
<div class="form-group col-sm-2">
    {!! Form::label('grupo_sanguineo', 'Grupo Sanguineo') !!}
    {!! Form::text('grupo_sanguineo', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
</div>
<!-- Examen Ingreso Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('examen_ingreso', 'Examen Ingreso') !!}
    {!! Form::textarea('examen_ingreso', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Guardar', [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-flat'        
    ]) !!}
    <a href="{!! route('hojaVidas.index') !!}" class="btn btn-default btn-flat">Cancelar</a>
</div>
