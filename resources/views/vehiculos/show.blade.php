@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section('content')
    <section class="content-header">        
        <h1 class="pull-left">
            Vehículo <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Vista Individual
        </h1>
        <h1 class="pull-right">
            <a href="{!! route('vehiculos.index') !!}" class="btn btn-default btn-flat btn-primary-inverted"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
         <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
               <div class="row">               
                    <div class="col-md-3">
                        @include('vehiculos.show_profile')
                    </div>
                    <div class="col-md-9">
                        @include('vehiculos.tabs')
                    </div>
              </div>
         </div>    
    </div>    
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/peity/3.2.1/jquery.peity.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
    <script src="{!! asset('/bower_components/jquery.counterup/jquery.counterup.min.js') !!}"></script>
    

    <script>
        $(document).ready(function () { 
            $("span.pie").peity("pie")
            sidebar_colapsado();
            @include('vehiculos.show_scripts_graficas')  
            contadores_vh();     
        });         

        function contadores_vh(){
          console.log('Inicio busqueda');          
          $.ajax({
              data: "placa={{ $vehiculo->placa }}&type=show_vehiculo&_token={{ csrf_token()}}",
              type: "POST",
              dataType: "json",
              url: "{{ route('vehiculo.cont_show_profile')}}",
          })
           .done(function( data, textStatus, jqXHR ) {
               if ( console && console.log ) {
                   console.log( ">> La solicitud se ha completado correctamente." );               
                   $("#trt").text(data['cont_viajes']);
                   $("#tkm").text(data['suma_km']);
                   $("#tdu").text(data['total_duracion_horas']);
                   $("#rckm").text(data['dinner_km']);
                   $("#tpg").text(data['cont_pagos']);

                   animar_contadores();
               }            
           })
           .fail(function( jqXHR, textStatus, errorThrown ) {
               if ( console && console.log ) {
                   console.log( "La solicitud a fallado: " +  textStatus);
               }
          });  
           //return ruta_response;

         }

         function animar_contadores(){
          $('.counter').counterUp({
              delay: 15,
              time: 2000,
          });
         }
      
        

    </script>
@endsection
