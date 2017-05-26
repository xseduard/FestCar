@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Triangulo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($triangulo, ['route' => ['triangulos.update', $triangulo->id], 'method' => 'patch']) !!}

                        @include('triangulos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection