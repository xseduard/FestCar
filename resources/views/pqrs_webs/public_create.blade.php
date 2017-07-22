@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            PQRS <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Radicar
        </h1>
    </section>
    <div class="content">
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('common.errors')
            @include('flash::message')
        </div>
                <div class="box box-primary">

                <div class="box-body">
                    <div class="row">
                        {!! Form::open(['route' => 'pqrsPublic.store', 'method' => 'GET']) !!}

                            @include('pqrs_webs.public_fields')                            

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
 </script>
@endsection
