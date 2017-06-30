@extends('layouts.app')

@section('content')
 <section class="content-header">
        <h1>
            INICIO
        </h1>
    </section>
    <div class="content">
    <div class="clearfix"></div>

        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('flash::message')
        </div>

        <div class="clearfix"></div>
        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('common.errors')
        </div>
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
           <!-- contenido -->
     
        <div class="row">
		      

             <div class="col-sm-9 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                 <h2 class="text-center">Hola, {!!  Auth::user()->nombres !!} </h2>
                 <h4 class="text-center">Transeba S.A.S ha puesto a su disposición las siguientes herramientas</h4>
                 <h5 class="text-center">Version 1.3 Beta, para errores por favor contactenos mediante el correo <a href="mailto:sistemas@transeba.com">sitemas@transeba.com</a></h5>
                </div>
                
                
              </div>
            </div>

              <div class="col-sm-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>0%</h3>

                  <p>Integridad de Datos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">
                 Mas Información <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

      </div>

      <div class="row">
        <div class="col-sm-12">
        
              <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Guia Rápida</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>

                <div class="box-body">
                  <h4><b>Para iniciar el proceso de Autorización debe tener encuenta las siguietnes indicaciones:</b></h4>
                  <ul>
                    <li>Debe registrar con aterioridad la Información del afiliado / Paciente</li>
                    <li>Debe registrar con aterioridad el Lugar de destino a seguir por el vehículo</li>
                    <li>Las rutas solo pueden ser Registradas y/o Modificadas por un usuario administrador</li>
                    <li>No todos los campos de los formularios son requeridos</li>
                    <li>Todo registro y/o modificación quedara registrada a su nombre (En el modulo autorizaciones aparecerá su nombre como firma del autorizador)</li>
                  </ul>

                  <h4><b>Pasos para registrar una autorización</b></h4>

                  <p><b style="font-size: 18px" class="text-blue">1.</b> Registrar Afiliado/Paciente y su Acompañante (Si lo tiene) a travez del menú  <b  class="text-blue">Afiliado/Paciente</b> y posteriormente en el boton <b  class="text-blue">Agregar</b> de la esquina superior derecha.</p>
                  <p><b style="font-size: 18px" class="text-blue">2.</b> Registrar el nombre del lugar donde deberá ir el Afiliado/Paciente a cumplir su cita a travez del menú  <b  class="text-blue">Clinicas/Hospitales</b> y posteriormente en el boton <b  class="text-blue">Agregar</b> de la esquina superior derecha.</p>

                  <p><b style="font-size: 18px" class="text-blue">3.</b> Registre la Autorización travez del menú  <b  class="text-blue">Autorizaciones</b> y posteriormente en el boton <b  class="text-blue">Agregar</b> de la esquina superior derecha.</p>

                  <p><b style="font-size: 18px" class="text-blue">4.</b> Genere la Autorización travez de la opción <a href="#" class="btn btn-success-inverted btn-sm btn-flat" title="boton de muestra"><i class="fa fa-print" aria-hidden="true"></i></a> ubicada en la tabla de <b  class="text-blue">Autorizaciones</b>.</p>



                </div>
              </div>
          
      </div>
      </div>

      
        </div>
    </div>



	

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
@endsection
