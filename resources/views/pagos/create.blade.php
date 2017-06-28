@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pago <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
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
                        {!! Form::open(['route' => 'pagos.store']) !!}

                            @include('pagos.fields')

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
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $(function(){
        // Crea el elemento factura
        $("#agregar-factura").on('click', function(){
            var elemento = $('<div class="form-group col-sm-3" id="form-factura">{!! Form::label('factura[]', 'Factura') !!}<div class="input-group"><span class="input-group-addon">CR0000</span>{!! Form::text('factura[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento.appendTo('#space-factura');
            //console.log(elemento);
        });
     
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar-factura",function(){
            var parent = $(this).parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });

        // Crea el elemento descuento
         $("#agregar-descuento").on('click', function(){
            var elemento = $('<div class="form-descuento"><div class="form-group col-sm-6 col-xl-6">{!! Form::label('desc_tipo', 'Tipo / Valor (Descuento)') !!}<div class="input-group"><span class="input-group-addon select-addon-custom" style="width: 30% !important">{!! Form::select('desc_tipo[]', $selectores['descuento_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}</span><span class="input-group-addon"><i class="fa fa-usd"></i></span>{!! Form::text('desc_valor[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento.appendTo('#space-descuento');
            //console.log(elemento);
            //reactivar select2
            $(".select2").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true
            });

        });
         // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar-descuento",function(){
            var parent = $(this).parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });

        //$("input[name*='ruta_nombre']").on('change',function(){ 
        $(".rutaname").on('change',function(){ 
             $(".rutabox").each(function (index) 
            { 
               // console.log($(this));

                //console.log($(this).children("input[name='valor_final[]']"));
                console.log($(this).children('div').children('div').children('input'));
                /*
                $(this).removeClass();
                $(this).addClass("parrafo"); 
                $(this).text('Parrafo ' + index);
                */
            }) 

            //var variable = $('#valor_final').val();
            //console.log(variable);
            buscar_ruta();             
        });

       


    });

    function buscar_ruta(){
        console.log('inicio cambio'); 
        var id = '1';
         $.ajax({
            data: "id="+id+"&_token={{ csrf_token()}}",
            type: "POST",
            dataType: "json",
            url: "{{ route('ruta.buscarid')}}",
        })
         .done(function( data, textStatus, jqXHR ) {
             if ( console && console.log ) {
                 console.log( "La solicitud se ha completado correctamente." );
                 console.log(data);
                 console.log(data['valor_sugerido']);
             }
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
             if ( console && console.log ) {
                 console.log( "La solicitud a fallado: " +  textStatus);
             }
        });
    }

 </script>
@endsection
