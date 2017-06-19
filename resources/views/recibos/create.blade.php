@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Recibo <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
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
            <div class="col-lg-8">
                <div class="box box-primary">

                <div class="box-body">
                    <div class="row">
                        {!! Form::open(['route' => 'recibos.store']) !!}

                            @include('recibos.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
 <script>
    $(document).ready(function () {  
        $('.money-mask').inputmask({'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'});        
        $(".select2").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Seleccionar...',      
          allowClear: true
        });
        //select especial para los articulos
        $(".select_art").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: '',      
          allowClear: true
        });        
        $('.datepicker').datepicker({             
            format: 'yyyy-mm-dd',        
            language: 'es',
        });

        $('.cant, .price').on('change',function(){     
            change_value();             
        });
        $('.cant, .price').on('keyup',function(){     
            change_value();             
        });


    });

     function change_value(){
            var subtotal;
            //var total;
            subtotal = ( $('#cantidad_1').val() * $('#precio_1').val() )
                     + ( $('#cantidad_2').val() * $('#precio_2').val() ) 
                     + ( $('#cantidad_3').val() * $('#precio_3').val() )
                     + ( $('#cantidad_4').val() * $('#precio_4').val() ); 


            $('#subtotal, #total').val(subtotal);
           


        }
 </script>
@endsection
