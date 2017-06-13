@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Departamentos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary btn-flat pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('departamentos.create') !!}"><i class="fa fa-plus"></i> &nbsp; Aregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @if($departamentos->isEmpty())
            <div class="well text-center">No se encontraron registros de departamentos en esta consulta.</div>
        @else
            @include('departamentos.table')

        @endif
         @include('common.paginate', ['records' => $departamentos])
            </div>
            
        </div>
    </div>
@endsection

