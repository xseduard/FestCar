@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Pagos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary btn-flat pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pagos.create') !!}"><i class="fa fa-plus"></i> &nbsp; Aregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('flash::message')
        </div>
        {!! Form::open(['route' => 'pagos.index', 'method' => 'GET']) !!}  
            @include('pagos.search')
         {!! Form::close() !!}

        <div class="clearfix"></div>
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="box box-primary">
                <div class="box-body table-responsive">
                    @if($pagos->isEmpty())
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i>Sistema de Información</h4>
                           No se encontraron registros de Pagos en esta consulta.
                      </div>                    
                    @else
                        @include('pagos.table')
                    @endif
                    @include('common.paginate', ['records' => $pagos])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   
    <script>
        $(document).ready(function () {            
            $(".select2_without_search").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true,
               minimumResultsForSearch: -1
            });
            $('.datepicker').datepicker({             
                format: 'yyyy-mm-dd',        
                language: 'es',
            });
        }); 
    </script>
@endsection


