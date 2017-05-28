@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Terceros Naturales <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Registrar
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'naturals.store']) !!}

                        @include('naturals.fields')

                    {!! Form::close() !!}
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
          placeholder: {
            id: '1', // posicion de la opción
            text: 'Seleccionar... '
          },      
          allowClear: true
        });
    });
 </script>
@endsection
