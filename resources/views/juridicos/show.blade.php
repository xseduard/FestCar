@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Tercero Jurídico
        </h1>
        <h1 class="pull-right">
            <a href="{!! route('juridicos.index') !!}" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</a>
        </h1>
    </section>
   

    <div class="content">
    <div class="clearfix"></div>
     <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
       <div class="row">
        <div class="col-md-4">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active" style="">         
              <h3 class="widget-user-username">{!! $juridico->nombre !!}</h3>
              <h5 class="widget-user-desc">{!! $juridico->nit !!}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{ asset('/multimedia/juridico-profile-default.jpg') }}" alt="User Avatar">
            </div>            
            <div class="box-footer">
             <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3</h5>
                    <span class="description-text">Contratos</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">26</h5>
                    <span class="description-text">Extractos</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">1</h5>
                    <span class="description-text">Vehiculos</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Actividad / Clasificación</strong>
              <p class="text-muted">
               {!! $juridico->actividad !!}
               @if ($juridico->estado)
                    <span class="label label-success">Activo</span>
                @else
                    <span class="label label-default">Desactivado</span>
                @endif
              </p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>
              <p class="text-muted">{!! $juridico->direccion_fiscal !!}</p>
              <hr>

              <strong><i class="fa fa-phone" aria-hidden="true"></i> Teléfonos</strong>
              <p class="text-muted">{!! $juridico->telefono !!}</p>
              <hr>

              <strong><i class="fa fa-envelope" aria-hidden="true"></i> e-mail</strong>
              <p class="text-muted">{!! $juridico->email !!}</p>
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Observaciones</strong>
              <p class="text-muted">
                  @if (!empty($juridico->observaciones))
                      {!! $juridico->observaciones !!}
                  @else
                      Sin observaciones
                  @endif
              </p>

              <hr>
              <small class="text-muted">Última Actualiación</small>
              <small><p class="text-muted">{!! $juridico->updated_at !!} por {!! $juridico->user->fullname !!}</p></small>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">              
              <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Linea de Tiempo</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Ajustes</a></li>
            </ul>
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          27 Mayo. 2017
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Equipo de soporte </a> Enviar un correo</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Leer más</a>
                        <a class="btn btn-danger btn-xs">Eliminar</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> Hace 5 minutos</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> Hace 27 minutos</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          12 Mayo. 2017
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> Hace 2 dias</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> Subio imagenes</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        </div>
    </div>
@endsection
