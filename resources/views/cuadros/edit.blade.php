@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cuadro
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cuadro, ['route' => ['cuadros.update', $cuadro->id], 'method' => 'patch']) !!}  

                        @include('cuadros.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection