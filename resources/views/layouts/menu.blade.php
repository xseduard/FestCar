<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Inicio</span></a>
</li>
<li class="{{ Request::is('generator_builder*') ? 'active' : '' }}">
    <a href="{!! url('/generator_builder') !!}"><i class="fa fa-tasks"></i><span>GUI Generador</span></a>
</li>
<!-- route('rosas.index') -->
<li class="treeview 
@if (Request::is('departamentos*') or Request::is('municipios*'))
	active
@endif">
<a href="#"><i class="fa fa-sliders"></i><span>Ajustes Generales</span> <i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('departamentos*') ? 'active' : '' }}">
		    <a href="{!! route('departamentos.index') !!}"><i class="fa fa-angle-right"></i><span>Departamentos</span></a>
		</li>
		<li class="{{ Request::is('municipios*') ? 'active' : '' }}">
		    <a href="{!! route('municipios.index') !!}"><i class="fa fa-angle-right"></i><span>Municipios</span></a>
		</li>	
	</ul>
</li>

<li class="{{ Request::is('triangulos*') ? 'active' : '' }}">
    <a href="{!! route('triangulos.index') !!}"><i class="fa fa-indent"></i><span>triangulos</span></a>
</li>

<li class="{{ Request::is('cuadros*') ? 'active' : '' }}">
    <a href="{!! route('cuadros.index') !!}"><i class="fa fa-indent"></i><span>cuadros</span></a>
</li>
<li class="{{ Request::is('naturals*') ? 'active' : '' }}">
    <a href="{!! route('naturals.index') !!}"><i class="fa fa-users" aria-hidden="true"></i></i><span>Tercero Natural</span></a>
</li><li class="{{ Request::is('juridicos*') ? 'active' : '' }}">
    <a href="{!! route('juridicos.index') !!}"><i class="fa fa-building-o" aria-hidden="true"></i><span>Tercero Jurídico</span></a>
</li>

<li class="{{ Request::is('vehiculos*') ? 'active' : '' }}">
    <a href="{!! route('vehiculos.index') !!}"><i class="fa fa-bus" aria-hidden="true"></i><span>Vehículos</span></a>
</li>

<li class="{{ Request::is('tarjetaPropiedads*') ? 'active' : '' }}">
    <a href="{!! route('tarjetaPropiedads.index') !!}"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Tarjetas de Propiedad</span></a>
</li>

<li class="{{ Request::is('soats*') ? 'active' : '' }}">
    <a href="{!! route('soats.index') !!}"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Soats</span></a>
</li>

<li class="{{ Request::is('tecnicomecanicas*') ? 'active' : '' }}">
    <a href="{!! route('tecnicomecanicas.index') !!}"><i class="fa fa-edit"></i><span>Tecnicomecanicas</span></a>
</li>

<li class="{{ Request::is('tarjetaOperacions*') ? 'active' : '' }}">
    <a href="{!! route('tarjetaOperacions.index') !!}"><i class="fa fa-edit"></i><span>TarjetaOperacions</span></a>
</li>

<li class="{{ Request::is('polizaResponsabilidads*') ? 'active' : '' }}">
    <a href="{!! route('polizaResponsabilidads.index') !!}"><i class="fa fa-edit"></i><span>PolizaResponsabilidads</span></a>
</li>

<li class="{{ Request::is('revisionPreventivas*') ? 'active' : '' }}">
    <a href="{!! route('revisionPreventivas.index') !!}"><i class="fa fa-edit"></i><span>RevisionPreventivas</span></a>
</li>

