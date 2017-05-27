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



