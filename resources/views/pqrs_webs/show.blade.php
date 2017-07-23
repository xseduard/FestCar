@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pqrs Consulta
        </h1>
    </section>
    <div class="content">
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="col-sm-12">
                                <a href="{!! route('pqrsPublic.consulta') !!}" class="btn btn-default">Atrás</a>
                            </div>
            <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">No. Radicado <a href="" custom-title="Radicado"><b class="text-aqua">{!! $pqrsWeb->easy_token !!}</b></a></h3>
                        <span class="pull-right" custom-title="{!! $pqrsWeb->created_at !!}">{!! $pqrsWeb->created_at->diffForHumans() !!}</span>
                    </div>  
                    <div class="box-body">
                        <div class="row" style="padding-left: 20px">                            
                            @include('pqrs_webs.show_fields')
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
             <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
                            @include('pqrs_webs.show_fields_seguimiento')
            </div>
        </div>
    </div>
@endsection
