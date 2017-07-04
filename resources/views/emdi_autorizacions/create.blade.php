@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
          Autorización <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
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
                        {!! Form::open(['route' => 'emdiAutorizacions.store']) !!}
                            @include('emdi_autorizacions.fields_paciente')
                            <div class="clearfix"></div>
                            <hr>
                            @include('emdi_autorizacions.fields')

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
        sw_acompanante();
        $('#cantidad').on('change',function(){   
            sw_acompanante();
        });

    });

     function sw_acompanante(){

            var cantidad = $("#cantidad").val();
            if (cantidad == '1') {
                
                $(".ac_field").val("");          
                $(".ac_field").prop('readonly', true);
                $("#ac_nombres").prop('required', false);                

            } else if (cantidad > '1') {

                $("#ac_nombres").prop('required', true);  
                $(".ac_field").prop('readonly', false);

            }  
        
    }

 </script>
@endsection
