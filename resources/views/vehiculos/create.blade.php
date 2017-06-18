@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Vehiculo <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
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
                        {!! Form::open(['route' => 'vehiculos.store']) !!}  

                            @include('vehiculos.fields')

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
        });hidear_campos_clear();

        $('#tipo_propietario').on('change',function(){   
            disabled_campos_tercero();
            hidear_campos_clear()
        });
         
    });
    // fuera del ready
   
    function disabled_campos_tercero(){

            var tipo_propietario = $("#tipo_propietario").val();
            if (tipo_propietario == 'Natural') {
                
                $("#juridico_id").prop('disabled', true).select2("val", "");             
                $("#natural_id").prop('disabled', false);
               

            } else if (tipo_propietario == 'Juridico') {
                
                $("#natural_id").prop('disabled', true).select2("val", "");
                $("#juridico_id").prop('disabled', false);

            }  
        
    }
    function hidear_campos_clear(){
        
        var tipo_propietario = $("#tipo_propietario").val();

        if(tipo_propietario == 'Natural'){
             $('#tercero_locked, #form_juridico').hide();
             $('#form_natural').show();
        } else if(tipo_propietario == 'Juridico'){
            $('#tercero_locked, #form_natural').hide();
             $('#form_juridico').show();
        } else {
            $('#form_natural, #form_juridico').hide();
             $('#tercero_locked').show();
        }
    }
 </script>
@endsection
