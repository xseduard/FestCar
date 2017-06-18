@extends('layouts.app')
@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Contrato Prestación de Servicio <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Editar
        </h1>
   </section>
   <div class="content">
       <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
          @include('common.errors')
       </div>
       <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
         <div class="box box-primary">
             <div class="box-body">
                 <div class="row">
                     {!! Form::model($contratoPrestacionServicio, ['route' => ['contratoPrestacionServicios.update', $contratoPrestacionServicio->id], 'method' => 'patch']) !!}  

                          @include('contrato_prestacion_servicios.fields')

                     {!! Form::close() !!}
                 </div>
             </div>
         </div>
        </div>
   </div>
@endsection

@section('scripts')
 <script>
    $(document).ready(function () {  
        $('input').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue',
          increaseArea: '20%' // optional
        });
        $(".select2").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Seleccionar...',      
          allowClear: true
        });
        $(".select2_municipio").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Municipio, Departamento...',      
          allowClear: true
        });
        $('.datepicker').datepicker({             
            format: 'yyyy-mm-dd',        
            language: 'es',
        });
   
        hidear_campos_clear();

        $('#tipo_cliente').on('change',function(){   
            disabled_campos_tercero();
            hidear_campos_clear()
        });
         
    });
    // fuera del ready
   
    function disabled_campos_tercero(){

            var tipo_cliente = $("#tipo_cliente").val();
            if (tipo_cliente == 'Natural') {
                
                $("#juridico_id").prop('disabled', true).select2("val", "");             
                $("#natural_id").prop('disabled', false);
               

            } else if (tipo_cliente == 'Juridico') {
                
                $("#natural_id").prop('disabled', true).select2("val", "");
                $("#juridico_id").prop('disabled', false);

            }  
        
    }
    function hidear_campos_clear(){
        
        var tipo_cliente = $("#tipo_cliente").val();

        if(tipo_cliente == 'Natural'){
             $('#tercero_locked, #form_juridico').hide();
             $('#form_natural').show();
        } else if(tipo_cliente == 'Juridico'){
            $('#tercero_locked, #form_natural').hide();
             $('#form_juridico').show();
        } else {
            $('#form_natural, #form_juridico').hide();
             $('#tercero_locked').show();
        }
    }
 </script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
@endsection
