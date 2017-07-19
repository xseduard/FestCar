@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Informes</h1>
        <h1 class="pull-right">
         <!-- btn -->
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('flash::message')
        </div>
        
        <div class="clearfix"></div>
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
          @include('informes.generadores')
       
          
{{-- <iframe src="http://server4.servert2a.com/triplog.sv2/?h=8150040222732&y=dTEybW0zOTQ0bGV2aTVpdG0yb3M0ZWY1azE=" style="width: 900px; height: 900px;">
  <p>Your browser does not support iframes.</p>
</iframe>
 --}}
        </div>
    </div>
    
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/peity/3.2.1/jquery.peity.min.js"></script>
    <script src="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $(document).ready(function () { 
            $("span.pie").peity("pie");
            $(".select2_without_search").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true,
               minimumResultsForSearch: -1
            });

            date_range();
        }); 


        function date_range(){
            $('.daterange_picker').daterangepicker({
               "showWeekNumbers": true,
                "ranges": {
                    "Últimos 7 dias": [
                        "{{ $dt['subDay-7'] }}",
                        "{{ $dt['hoy'] }}"
                    ],
                    "Últimos 30 dias": [                        
                        "{{ $dt['subDay-30'] }}",
                        "{{ $dt['hoy'] }}"
                    ],
                    "Este mes": [
                        "{{ $dt['this-month-start'] }}",
                        "{{ $dt['this-month-end'] }}"
                    ],
                    "Últimos 3 meses": [
                        "{{ $dt['last-3-month'] }}",
                        "{{ $dt['this-month-end'] }}"
                    ],
                    "Este año": [
                        "{{ $dt['first-this-year'] }}",
                        "{{ $dt['hoy'] }}"
                    ],
                    "El año pasado": [
                        "{{ $dt['first-day-last-year'] }}",
                        "{{ $dt['last-day-last-year'] }}"
                    ]
                },
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "a",
                    "customRangeLabel": "Personalizar",
                    "weekLabel": "S",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [ 
                        "Enero",
                        "Febrero", 
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "junio",
                        "julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                "autoUpdateInput": true,
                "startDate": "{{ $dt['this-month-start'] }}",
                "endDate": "{{ $dt['this-month-end'] }}",
                "minDate": "2016-01-01",
                "maxDate": "{{ $dt['last-this-year'] }}",
                "buttonClasses": "btn btn-sm btn-flat",
                "applyClass": "btn-primary btn-flat",
                "cancelClass": "btn-default  btn-flat"
            }, function(start, end, label) {
              console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
            });
                }
    </script>
@endsection


