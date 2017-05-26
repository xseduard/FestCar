<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Inicio</span></a>
</li>
<!-- route('rosas.index') -->
<li ruta="generator_builder"><a href="{{ url('/generator_builder') }}"><span>Generador</span></a></li>
<li class="treeview">
<a href="#"><span>Ajustes Generales</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
	<li><a href="#"><span>Generador</span></a></li>
</ul>
</li>

<li class="{{ Request::is('triangulos*') ? 'active' : '' }}">
    <a href="{!! route('triangulos.index') !!}"><i class="fa fa-edit"></i><span>triangulos</span></a>
</li>

<li class="{{ Request::is('cuadros*') ? 'active' : '' }}">
    <a href="{!! route('cuadros.index') !!}"><i class="fa fa-edit"></i><span>cuadros</span></a>
</li>

