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
		        <div class="col-xl-3 col-sm-4 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h3>{!! $cont['vehiculo'] !!}</h3>

		              <p>Vehículos</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bus" aria-hidden="true"></i>
		            </div>
		            <a href="{!! route('vehiculos.index') !!}" class="small-box-footer">
		             Mas Información <i class="fa fa-arrow-circle-right"></i>
		            </a>
		          </div>
		        </div>
          
		        <!-- ./col -->
		        <div class="col-xl-3 col-sm-4 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-blue">
		            <div class="inner">
		              <h3>{!! $cont['natural'] !!}</h3>

		              <p>Naturales Registrados</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-person-add"></i>
		            </div>
		            <a href="{!! route('naturals.index') !!}" class="small-box-footer">
		             Mas Información <i class="fa fa-arrow-circle-right"></i>
		            </a>
		          </div>
		        </div>
		        <!-- ./col -->
		        <!-- ./col -->
		        <div class="col-xl-3 col-sm-4 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-blue">
		            <div class="inner">
		              <h3>{!! $cont['juridico'] !!}</h3>

		              <p>Empresas Registradas</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-building" aria-hidden="true"></i>
		            </div>
		            <a href="{!! route('juridicos.index') !!}" class="small-box-footer">
		             Mas Información <i class="fa fa-arrow-circle-right"></i>
		            </a>
		          </div>
		        </div>
		        
		       
      </div>

      <div class="row">
          <div class="col-sm-4 col-xl-2">
              <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title">Contratos Vinculación</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>

                <div class="box-body">                   

                    <!-- chart -->
                   <div style="height: 30%; margin: auto;">
                        <canvas id="chart_contratos" width="200" height="200"></canvas>
                   </div>

                       <div class="row text-center m-t-30">
                            <div class="col-xs-4">
                                <h3 data-plugin="counterup">{!! $cont['cv-total'] !!}</h3>
                                <p class="text-muted text-overflow">Registrados</p>
                            </div>
                            <div class="col-xs-4">
                                <h3 data-plugin="counterup">{!! $cont['cv-vigente'] !!}</h3>
                                <p class="text-muted text-overflow" title="Open Compaign">Vigentes</p>
                            </div>
                            <div class="col-xs-4">
                                <h3 data-plugin="counterup">0%</h3>
                                <p class="text-muted text-overflow">Rel</p>
                            </div>
                        </div>
                </div>
              </div>
          </div>
  
           <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sección uno</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <!-- Content -->
              <!--
              	<div><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                <canvas id="lineChart" height="355" style="display: block; width: 762px; height: 355px;" width="762"></canvas>
                            </div>
              -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          
        	</div>
        </div>
    </div>



	

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    @include('home_script') 
@endsection
