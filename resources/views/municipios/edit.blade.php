@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Municipio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($municipio, ['route' => ['municipios.update', $municipio->id], 'method' => 'patch']) !!}  

                        @include('municipios.fields')

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
      tags: "true",
      placeholder: {
        id: '-1', // the value of the option
        text: 'Seleccionar...'
      },      
      allowClear: true
    });

    $('.seltest').select2({
            // Activamos la opcion "Tags" del plugin
            tags: false,
            language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
            },
            placeholder: 'Seleccione...',
            //minimumInputLength: 3,
            tokenSeparators: [','],
            ajax: {
                dataType: 'json',
                url: '{{ route("central.sdepa") }}',
                delay: 250,
                data: function(params) {
                    console.log('params: '+params.term);
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                    console.log('darta: '+data);
                  return {
                    results: data
                  };
                },
            }
        }); 


     // terminado ready
});
  console.log($municipio);
 </script>
@endsection