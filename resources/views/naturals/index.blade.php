@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> Terceros Naturales</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('naturals.create') !!}"><i class="fa fa-user-plus" aria-hidden="true"></i></i> &nbsp; Aregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @if($naturals->isEmpty())
                    <div class="well text-center">No se encontraron registros de Naturals en esta consulta.</div>
                @else
                    @include('naturals.table')
                @endif
                @include('common.paginate', ['records' => $naturals])
            </div>
        </div>
    </div>
@endsection

