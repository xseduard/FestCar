@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tercero Jurídico</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary btn-flat pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('juridicos.create') !!}"><i class="fa fa-plus"></i> &nbsp; Aregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('flash::message')
        </div>

        <div class="clearfix"></div>
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="box box-primary">
                <div class="box-body">
                    {!!  Form::open(['route' => 'juridicos.index', 'method' => 'GET']) !!}
                     <div class="col-lg-4 pull-right">  
                        <div class="input-group">
                          <input name="search" type="text" class="form-control" placeholder="Buscar...">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <hr>
                    @if($juridicos->isEmpty())
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i>Sistema de Información</h4>
                           No se encontraron registros de Terceros Jurídicos en esta consulta.
                      </div>                    
                    @else
                        @include('juridicos.table')
                    @endif
                    @include('common.paginate', ['records' => $juridicos])
                </div>
            </div>
        </div>
    </div>
@endsection

