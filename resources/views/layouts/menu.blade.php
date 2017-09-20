<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! url('/home') !!}"><i class="fa fa-home"></i><span>Inicio</span></a>
</li>


@if(Auth::user()->role == 'administrador')
    <li class="treeview 
    @if (Request::is('departamentos*')
     or Request::is('municipios*')
     or Request::is('empresas*')
     or Request::is('simuladorGastos*')
     or Request::is('reciboProductos*')
     or Request::is('reciboDetalles*'))
    	active
    @endif">
    <a href="#"><i class="fa fa-sliders"></i><span>Ajustes Generales</span> <i class="fa fa-angle-left pull-right"></i></a>
    	<ul class="treeview-menu">
            <li class="{{ Request::is('empresas*') ? 'active' : '' }}">
                <a href="{!! route('empresas.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Empresa</span></a>
            </li>
            <li class="{{ Request::is('simuladorGastos*') ? 'active' : '' }}">
                <a href="{!! route('simuladorGastos.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Simulador de Gastos</span></a>
            </li>
    		<li class="{{ Request::is('departamentos*') ? 'active' : '' }}">
    		    <a href="{!! route('departamentos.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Departamentos</span></a>
    		</li>
    		<li class="{{ Request::is('municipios*') ? 'active' : '' }}">
    		    <a href="{!! route('municipios.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Municipios</span></a>
    		</li>
            <li class="{{ Request::is('reciboProductos*') ? 'active' : '' }}">
                <a href="{!! route('reciboProductos.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Recibo (Productos)</span></a>
            </li>     
            <li class="divider"></li>      
            <li class="header" style="color: #f5f5f5">Opciones Avanzadas</li>
             <li class="{{ Request::is('reciboDetalles*') ? 'active' : '' }}">
                <a href="{!! route('reciboDetalles.index') !!}"><i class="fa fa-cog" aria-hidden="true"></i><span>Recibo-Detalles</span></a>
            </li>
            <li class="{{ Request::is('pagoRelFacturas*') ? 'active' : '' }}">
                <a href="{!! route('pagoRelFacturas.index') !!}"><i class="fa fa-cog" aria-hidden="true"></i><span>Pago-Facturas</span></a>
            </li>            

            <li class="{{ Request::is('pagoRelRutas*') ? 'active' : '' }}">
                <a href="{!! route('pagoRelRutas.index') !!}"><i class="fa fa-cog" aria-hidden="true"></i><span>Pago-Rutas</span></a>
            </li>

    	</ul>
    </li>
    

    
{{-- <li class="{{ Request::is('generator_builder*') ? 'active' : '' }}">
    <a href="{!! url('/generator_builder') !!}"><i class="fa fa-tasks"></i><span>GUI Generador</span></a>
</li> --}}

@endif

@if(Auth::user()->role == 'secretaria' or Auth::user()->role == 'administrador')

{{-- 
<li class="{{ Request::is('triangulos*') ? 'active' : '' }}">
    <a href="{!! route('triangulos.index') !!}"><i class="fa fa-indent"></i><span>triangulos</span></a>
</li>

<li class="{{ Request::is('cuadros*') ? 'active' : '' }}">
    <a href="{!! route('cuadros.index') !!}"><i class="fa fa-indent"></i><span>cuadros</span></a>
</li>
 --}}
<li class="{{ Request::is('naturals*') ? 'active' : '' }}">
    <a href="{!! route('naturals.index') !!}"><i class="fa fa-users" aria-hidden="true"></i></i><span>Tercero Natural</span></a>
</li><li class="{{ Request::is('juridicos*') ? 'active' : '' }}">
    <a href="{!! route('juridicos.index') !!}"><i class="fa fa-building-o" aria-hidden="true"></i><span>Tercero Jurídico</span></a>
</li>

<li class="{{ Request::is('vehiculos*') ? 'active' : '' }}">
    <a href="{!! route('vehiculos.index') !!}"><i class="flaticon-transport-2"></i> <span>Vehículos</span></a>
</li>
{{-- DOCUMENTOS VEHÍCULOS --}}
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
<a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Docs. vehículos</span><i class="fa fa-angle-left pull-right"></i></a>
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
            <a href="{!! route('revisionPreventivas.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Rev. Preventivas</span></a>
        </li>

   
    </ul>
</li>
{{-- DOCUMENTOS CONDUCTORE --}}
<li class="treeview 
@if (Request::is('licenciaConduccions*') 
    or Request::is('hojaVidas*')    
    )
    active
@endif">
<a href="#"><i class="fa fa-bars" aria-hidden="true"></i></i><span>Docs. Conductores</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('licenciaConduccions*') ? 'active' : '' }}">
            <a href="{!! route('licenciaConduccions.index') !!}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Licencias</span></a>
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

<li class="{{ Request::is('recibos*') ? 'active' : '' }}">
    <a href="{!! route('recibos.index') !!}"><i class="ion-ios-cart"></i> <span>Recibos</span></a>
</li>

{{-- PAGOS --}}
<li class="treeview 
@if (Request::is('pagos*') 
    or Request::is('descuentos*')
    or Request::is('facturas*')
    or Request::is('pagoRelDescuentos*')
    )
    active
@endif">
<a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Pagos</span>
    
    {{-- <i class="fa fa-angle-left pull-right badge badge-warning"></i> --}}

    <small class="badge pull-right badge-success">
      <i class="fa fa-chevron-down"></i>
    </small>
</a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('pagos*') ? 'active' : '' }}">
            <a href="{!! route('pagos.index') !!}"><i class="fa fa-circle-o text-aqua"></i><span>Planillas</span>
              <small class="badge pull-right badge-success" data-toggle='tooltip' title='' data-original-title='Opción temporal para asignar descuentos a los pagos'>
                  Actualizado
              </small>
            </a>
        </li>  
        <li class="{{ Request::is('descuentos*') ? 'active' : '' }}">
            <a href="{!! route('descuentos.index') !!}"><i class="fa fa-circle-o"></i><span>Tipos Descuento</span></a>
        </li>

        <li class="{{ Request::is('facturas*') ? 'active' : '' }}">
            <a href="{!! route('facturas.index') !!}"><i class="fa fa-circle-o"></i><span>Facturas</span></a>
        </li>

        <li class="{{ Request::is('pagoRelDescuentos*') ? 'active' : '' }}">
            <a href="{!! route('pagoRelDescuentos.index') !!}"><i class="fa fa-cog" aria-hidden="true"></i><span>Descuentos Asignados</span></a>
        </li>

    </ul>
</li>
{{-- END PAGOS --}}

<li class="{{ Request::is('rutas*') ? 'active' : '' }}">
    <a href="{!! route('rutas.index') !!}"><i class="fa fa-circle-o"></i><span>Rutas</span></a>
</li>


<li class="{{ Request::is('informes*') ? 'active' : '' }}">
    <a href="{!! route('informes.index') !!}"><i class="fa fa-circle-o"></i><span>Informes</span>
    <span class="pull-right-container">
      <small class="badge pull-right badge-success" data-toggle='tooltip' title='' data-original-title='Nuevo informe de recibos'>Nuevo</small>
    </span>
</a>
</li>
<!-- pqrs -->
<li class="treeview 
@if (Request::is('pqrsWebs*') 
    or Request::is('pqrsSeguimientos*')
    )
    active
@endif">
<a href="#"><i class="fa fa-compass" aria-hidden="true"></i><span>Pqrs</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('pqrsWebs*') ? 'active' : '' }}">
            <a href="{!! route('pqrsWebs.index') !!}"><i class="fa fa-circle-o"></i><span>Buzon de entrada</span></a>
        </li>


        <li class="{{ Request::is('pqrsSeguimientos*') ? 'active' : '' }}">
            <a href="{!! route('pqrsSeguimientos.index') !!}"><i class="fa fa-circle-o"></i><span>Seguimientos</span></a>
        </li>


    </ul>
</li>
{{-- PQRS --}}
<li>
    <a href="http://seguitel.servertrack.co/seguitel/" target="_blank"><i class="fa fa-globe"></i><span>Gps</span>
    <span class="pull-right-container">
      <small class="badge pull-right badge-warning" custom-title="En construcción">4</small>
    </span>
    </a>
</li>


@endif

{{-- Autorizaciones Emdi --}}
@if(Auth::user()->role == 'autorizador_emdisalud' or Auth::user()->role == 'administrador') 
{{-- MENU EMDI    --}}
    <li class="treeview 
        @if ( Request::is('emdiPacientes*')
        or Request::is('emdiLugars*')
        or Request::is('emdiConductors*')
        or Request::is('emdiAutorizacions*')
            )
            active  
        @endif">
        <a href="#"><i class="fa fa-bars" aria-hidden="true"></i><span>Autorizaciones</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">

               <li class="{{ Request::is('emdiPacientes*') ? 'active' : '' }}">
                <a href="{!! route('emdiPacientes.index') !!}"><i class="fa fa-user" aria-hidden="true"></i><span>Afiliados/Pacientes</span></a>
                </li>

                <li class="{{ Request::is('emdiLugars*') ? 'active' : '' }}">
                    <a href="{!! route('emdiLugars.index') !!}"><i class="fa fa-hospital-o" aria-hidden="true"></i><span>Clinicas/Hospitales</span></a>
                </li>

                <li class="{{ Request::is('emdiConductors*') ? 'active' : '' }}">
                    <a href="{!! route('emdiConductors.index') !!}"><i class="fa fa-taxi" aria-hidden="true"></i><span>Conductores</span></a>
                </li>

                <li class="{{ Request::is('emdiAutorizacions*') ? 'active' : '' }}">
                    <a href="{!! route('emdiAutorizacions.index') !!}"><i class="fa fa-wpforms" aria-hidden="true"></i><span>Autorizaciones</span></a>
                </li>  
             </ul>
    </li> 
    {{-- MENU EMDIL    --}}  
@endif 






