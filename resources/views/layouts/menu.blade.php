<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Inicio</span></a>
</li>
<!--
<li class="{{ Request::is('generator_builder*') ? 'active' : '' }}">
    <a href="{!! url('/generator_builder') !!}"><i class="fa fa-tasks"></i><span>GUI Generador</span></a>
</li>
-->
<!-- route('rosas.index') -->
<li class="treeview 
@if (Request::is('departamentos*') or Request::is('municipios*'))
	active
@endif">
<a href="#"><i class="fa fa-sliders"></i><span>Ajustes Generales</span> <i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('departamentos*') ? 'active' : '' }}">
		    <a href="{!! route('departamentos.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Departamentos</span></a>
		</li>
		<li class="{{ Request::is('municipios*') ? 'active' : '' }}">
		    <a href="{!! route('municipios.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Municipios</span></a>
		</li>	
	</ul>
</li>
<!--
<li class="{{ Request::is('triangulos*') ? 'active' : '' }}">
    <a href="{!! route('triangulos.index') !!}"><i class="fa fa-indent"></i><span>triangulos</span></a>
</li>

<li class="{{ Request::is('cuadros*') ? 'active' : '' }}">
    <a href="{!! route('cuadros.index') !!}"><i class="fa fa-indent"></i><span>cuadros</span></a>
</li>
-->
<li class="{{ Request::is('naturals*') ? 'active' : '' }}">
    <a href="{!! route('naturals.index') !!}"><i class="fa fa-users" aria-hidden="true"></i></i><span>Tercero Natural</span></a>
</li><li class="{{ Request::is('juridicos*') ? 'active' : '' }}">
    <a href="{!! route('juridicos.index') !!}"><i class="fa fa-building-o" aria-hidden="true"></i><span>Tercero Jurídico</span></a>
</li>

<li class="{{ Request::is('vehiculos*') ? 'active' : '' }}">
    <a href="{!! route('vehiculos.index') !!}"><i class="flaticon-transport-2"></i> <span>Vehículos</span></a>
</li>
<!-- documentos vehiculos -->
<li class="treeview 
@if (Request::is('tarjetaPropiedads*') 
    or Request::is('soats*')
    or Request::is('tecnicomecanicas*')
    or Request::is('tarjetaOperacions*')
    or Request::is('polizaResponsabilidads*')
    or Request::is('revisionPreventivas*')
    )
    active
@endif">
<a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Documentos vehículos</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('tarjetaPropiedads*') ? 'active' : '' }}">
            <a href="{!! route('tarjetaPropiedads.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Tarjetas de Propiedad</span></a>
        </li>

        <li class="{{ Request::is('soats*') ? 'active' : '' }}">
            <a href="{!! route('soats.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Soat</span></a>
        </li>

        <li class="{{ Request::is('tecnicomecanicas*') ? 'active' : '' }}">
            <a href="{!! route('tecnicomecanicas.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Técnico Mecánicas</span></a>
        </li>

        <li class="{{ Request::is('tarjetaOperacions*') ? 'active' : '' }}">
            <a href="{!! route('tarjetaOperacions.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Tarjetas de Operación</span></a>
        </li>

        <li class="{{ Request::is('polizaResponsabilidads*') ? 'active' : '' }}">
            <a href="{!! route('polizaResponsabilidads.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Polizas de Responsabilidad</span></a>
        </li>

        <li class="{{ Request::is('revisionPreventivas*') ? 'active' : '' }}">
            <a href="{!! route('revisionPreventivas.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Revisiones de Preventivas</span></a>
        </li>

   
    </ul>
</li>
<!-- documentos conductores -->
<li class="treeview 
@if (Request::is('licenciaConduccions*') 
    or Request::is('hojaVidas*')    
    )
    active
@endif">
<a href="#"><i class="fa fa-bars" aria-hidden="true"></i></i><span>Documentos Conductores</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('licenciaConduccions*') ? 'active' : '' }}">
            <a href="{!! route('licenciaConduccions.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Licencias de Conducción</span></a>
        </li>   
        <li class="{{ Request::is('hojaVidas*') ? 'active' : '' }}">
            <a href="{!! route('hojaVidas.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Hojas de Vida</span></a>
        </li>

    </ul>
</li>

<li class="treeview 
@if (Request::is('contratoVinculacions*') or Request::is('contratoPrestacionServicios*'))
    active
@endif">
<a href="#"><i class="fa fa-contao" aria-hidden="true"></i><span>Contratación</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('contratoVinculacions*') ? 'active' : '' }}">
            <a href="{!! route('contratoVinculacions.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Vinculación</span></a>
        </li>

        <li class="{{ Request::is('contratoPrestacionServicios*') ? 'active' : '' }}">
            <a href="{!! route('contratoPrestacionServicios.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Prestación de Servicios</span></a>
        </li>  
    </ul>
</li>




<li class="{{ Request::is('extractos*') ? 'active' : '' }}">
    <a href="{!! route('extractos.index') !!}"><i class="ion ion-clipboard"></i><span>Extractos</span></a>
</li>




