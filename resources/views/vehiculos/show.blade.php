@extends('layouts.app')

@section('content')
    <section class="content-header">        
        <h1 class="pull-left">
            Vehículo <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Vista Individual
        </h1>
        <h1 class="pull-right">
            <a href="{!! route('vehiculos.index') !!}" class="btn btn-default btn-flat btn-primary-inverted"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
         <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
               <div class="row">
                    <div class="col-md-3">
                        @include('vehiculos.show_profile')
                    </div>
                    <div class="col-md-9">
                        @include('vehiculos.tabs')
                    </div>
              </div>
         </div>    
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/peity/3.2.1/jquery.peity.min.js"></script>

    <script>
        $(document).ready(function () { 
            $("span.pie").peity("pie")
            sidebar_colapsado();
        }); 
    </script>
@endsection
