@foreach($empresas as $empresa)
    
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-blue">
          <div class="widget-user-image">
            <img class="img-circle" src="{!! url('/favicon/apple-icon-180x180.png') !!}" alt="User Avatar">
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username">{!! $empresa->nombre_corto !!} <a href="{!! route('empresas.edit', [$empresa->id]) !!}" class='pull-right' style="margin-right: 10px;" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></h3> 
          <h5 class="widget-user-desc">{!! $empresa->razon_social !!}</h5>
        </div>
        <div class="box-footer no-padding">
          <div class="col-sm-4">
              <ul class="nav nav-stacked">
                <li><a href="#">Nombres<span class="pull-right">{!! $empresa->rte_nombre !!}</span></a></li>
                <li><a href="#">Apellidos <span class="pull-right">{!! $empresa->rte_apellido !!}</span></a></li>
                <li><a href="#">Cédula<span class="pull-right">{!! $empresa->rte_cedula !!}</span></a></li>
                <li><a href="#">Lugar de expedición <span class="pull-right">{!! $empresa->lugar_expedicion !!}</span></a></li>
              </ul>
          </div>
        <div class="col-sm-4">
              <ul class="nav nav-stacked">
                <li><a href="#">Dirección (corta)<span class="pull-right">{!! $empresa->direccion_corta !!}</span></a></li>
                <li><a href="#">Dirección<span class="pull-right ">{!! $empresa->direccion !!}</span></a></li>
                <li><a href="#">Domicilio<span class="pull-right">{!! $empresa->domicilio !!}</span></a></li>
                <li><a href="#">Teléfono <span class="pull-right ">{!! $empresa->telefono !!}</span></a></li>
              </ul>
          </div>
          <div class="col-sm-4">
              <ul class="nav nav-stacked">
                <li><a href="#">E-mail<span class="pull-right">{!! $empresa->correo !!}</span></a></li>
                <li><a href="#">Celular<span class="pull-right ">{!! $empresa->celular !!}</span></a></li>
                <li><a href="#">Pagina web<span class="pull-right">{!! $empresa->pagina_web !!}</span></a></li>
                <li><a href="#">Ultima actualización <span class="pull-right ">{!! $empresa->updated_at !!}</span></a></li>
              </ul>
          </div>
          <p>{!! $empresa->observaciones !!}</p>
          <p>
            {!! Form::open(['route' => ['empresas.destroy', $empresa->id], 'method' => 'delete']) !!}
            <div class='btn-group pull-right'>
                <!-- 
                    <a href="{!! route('empresas.show', [$empresa->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                -->
                
                <!--
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                    'title' => 'Eliminar'
                    ]) !!}
                    -->
            </div>
            {!! Form::close() !!}</p>

        </div>
      </div>
      <!-- /.widget-user -->
    

@endforeach
  