@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Afiliados/Pacientes</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary btn-flat pull-right" style="margin-top: -10px;margin-bottom: 5px" href="#" disabled ><i class="fa fa-plus"></i> &nbsp; Aregar</a>
           <!--
           <a class="btn btn-primary btn-flat pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('emdiPacientes.create') !!}" ><i class="fa fa-plus"></i> &nbsp; Aregar</a>
           -->
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
                <div class="box-body table-responsive">

                {!!  Form::open(['route' => 'emdiPacientes.index', 'method' => 'GET']) !!}
                @include('common.buscar_form')
                {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <hr>
                    @if($emdiPacientes->isEmpty())
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i>Sistema de Información</h4>
                           No se encontraron registros de Afiliados / Usuarios en esta consulta.
                      </div>                    
                    @else
                        @include('emdi_pacientes.table')
                    @endif
                    @include('common.paginate', ['records' => $emdiPacientes])
                </div>
            </div>
        </div>
    </div>
@endsection

