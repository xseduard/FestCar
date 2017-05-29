@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Vehiculo <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Editar
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
                     {!! Form::model($vehiculo, ['route' => ['vehiculos.update', $vehiculo->id], 'method' => 'patch']) !!}

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
        $("#placa").prop('disabled', true);
    });
 </script>
@endsection
