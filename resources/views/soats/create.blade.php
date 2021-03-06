@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Soat <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
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
                        {!! Form::open(['route' => 'soats.store']) !!}  

                            @include('soats.fields')

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
/*
    $('#fecha_vigencia_inicio').on('focus',function(){
        
        var cadena = $('#fecha_vigencia_inicio').val();
        console.log("cadena: "+cadena);
        var ms = Date.parse(cadena);
        console.log("fecha ini: "+ms);
        var fecha = new Date(cadena);
        // fecha.setHours(fecha.getHours()+1);
                console.log("fecha es: "+fecha);
    });
    */
 </script>
@endsection
