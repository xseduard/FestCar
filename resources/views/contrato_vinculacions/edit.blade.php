@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Contrato de Vinculación <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Editar
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
         <div class="box box-primary">
             <div class="box-body">
                 <div class="row">
                     {!! Form::model($contratoVinculacion, ['route' => ['contratoVinculacions.update', $contratoVinculacion->id], 'method' => 'patch']) !!} {{ csrf_field() }}

                          @include('contrato_vinculacions.fields')

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
        $(".select2").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Seleccionar...',      
          allowClear: true
        });

        $('.datepicker').datepicker({             
            format: 'yyyy-mm-dd',        
            language: 'es',
        });

        // para evitar el clear de las validaciones  
         verificar_tipo_contrato(); 
         hidear_campos_clear();     
        //
        $('#tipo_contrato').on('change',function(){
            verificar_tipo_contrato();            
        });
       
        $('#tipo_proveedor').on('change',function(){            
            disabled_campos_tercero()
            hidear_campos_clear();
        });
                 
    });
    // fuera del ready
    function disabled_campos_tercero(){
        var tipo_proveedor = $('#tipo_proveedor').val();

        if (tipo_proveedor == 'Natural') {                
                $("#juridico_id").prop('disabled', true).select2("val", "");             
                $("#natural_id").prop('disabled', false);               

            } else if (tipo_proveedor == 'Juridico') {
                
                $("#natural_id").prop('disabled', true).select2("val", "");
                $("#juridico_id").prop('disabled', false);
            }             
    }
    function verificar_tipo_contrato(){

            if ($('#tipo_contrato').val() == 'CC') {
                $("#tipo_proveedor").val("Juridico").trigger('change');
                $('#form_tipo_proveedor').hide();
                $('#tipo_proveedor_locked').show();
                                
            } else {
                $("#tipo_proveedor").prop('disabled', false);
                $('#tipo_proveedor_locked').hide();
                $('#form_tipo_proveedor').show();                
            }           
        }

    function hidear_campos_clear(){
        
        var tipo_proveedor = $("#tipo_proveedor").val();

        if(tipo_proveedor == 'Natural'){
             $('#tercero_locked, #form_juridico').hide();
             $('#form_natural').show();
        } else if(tipo_proveedor == 'Juridico'){
            $('#tercero_locked, #form_natural').hide();
             $('#form_juridico').show();
        } else {
            $('#form_natural, #form_juridico').hide();
             $('#tercero_locked').show();
        }
    }

 </script>
        
@endsection
