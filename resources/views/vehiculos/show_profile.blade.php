
        <div class="box box-warning">
            <div class="box-body box-profile">
              <img class="vehicle-profile img-responsive img-circle" src="{{ asset('/multimedia/vehiculo-default.jpg') }}" alt="User profile picture">

              <h3 class="profile-username text-center"><span class="placa">
              {!! substr($vehiculo->placa, 0, 3),"&nbsp;&nbsp;",substr($vehiculo->placa, -3, 3) !!}
              </span></h3>

              <p class="text-muted text-center">
                @if($vehiculo->tipo_propietario == 'Natural')
                    {!! $vehiculo->natural->fullname !!}
                @else
                    {!! $vehiculo->juridico->nombre !!}
                @endif</p>                

                <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{!! $vehiculo->modelo !!}</h5>
                    <span class="description-text">Modelo</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"> {!! $vehiculo->capacidad !!} </h5>
                    <span class="description-text">capacidad</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">
                    @if($vehiculo->numero_interno > 0)
                        {!! $vehiculo->numero_interno !!}
                    @else
                     N/D
                    @endif
                    </h5>
                    <span class="description-text">Interno</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>

              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                  <i class="fa fa-bar-chart text-blue" aria-hidden="true"></i> <b>Rutas realizadas</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <i class="fa fa-tachometer text-blue" aria-hidden="true"></i> <b>Kilometros recorridos</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <i class="fa fa-clock-o text-blue" aria-hidden="true"></i> <b>Tiempo de Uso</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <i class="ion ion-clipboard text-blue"></i> <b>Extractos</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                 <i class="fa fa-money text-blue" aria-hidden="true"></i> <b>Planillas de pago</b> <a class="pull-right">0</a>
                </li>
              </ul>
              <p class="text-muted text-center">
                    {!! $vehiculo->clase," - ",$vehiculo->marca," " !!}
                </p>

            </div>
            <!-- /.box-body -->
          </div>    
            <!-- final profile --> 
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tarjeta de propiedad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">              
            @if(!$documentos['tarjetapropiedad'] == 'notfound')
                          
                  <p class="text-muted text-yellow">  <i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i> No se ha Registrado</p>
             @else
                <div class="row">
                   <div class="col-sm-6">
                      <strong> Licencia transito</strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->licencia_transito !!}</p>
                      
                      <strong> Cilindrada </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->cilindrada !!}</p>

                      <strong> Color </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->color !!}</p>

                      <strong> Servicio </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->servicio !!}</p>

                      <strong> Tipo de carroceria </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->tipo_carroceria !!}</p>

                      <strong> combustible </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->combustible !!}</p>

                      <strong> Número de motor </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->numero_motor !!}</p>

                      <strong> Número de serie </strong>
                      <p class="text-muted">{!! $documentos['tarjetapropiedad']->numero_serie !!}</p>

                   </div>
                   <div class="col-sm-6">
                      <strong> Linea</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->linea !!}</p>
                       
                       <strong> Número de chasis</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->numero_chasis !!}</p>
                       
                       <strong> Blindaje</strong>
                       <p class="text-muted">N/D</p>
                       
                       <strong> Potencia</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->potencia_hp !!} HP</p>
                       
                       <strong> Puertas</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->puertas !!}</p>
                       
                       <strong> Fecha de matricula</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->fecha_matricula->format('d-F-Y') !!}</p>
                       
                       <strong> Fecha de expedición</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->fecha_expedicion->format('d-F-Y') !!}</p>

                       <strong> Organismo de transito</strong>
                       <p class="text-muted">{!! $documentos['tarjetapropiedad']->organismo_transito !!}</p>
                   </div>
                </div>
            
            @endif
            <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Observaciones</strong>
              <p class="text-muted">
                  @if (!empty($vehiculo->observaciones))
                      {!! $vehiculo->observaciones !!}
                  @else
                      Sin observaciones
                  @endif
              </p>

              <hr>
              <small class="text-muted">Última Actualiación</small>
              <small><p class="text-muted">{!! $vehiculo->updated_at !!} por {!! $vehiculo->user->fullname !!}</p></small>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        