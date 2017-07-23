@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            PQRS <small><i class="fa fa-angle-right" aria-hidden="true"></i></small> Consulta
        </h1>
    </section>
    <div class="content">
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
        <div class="animsition" data-animsition-in-class="zoom-in-sm" data-animsition-in-duration="1500" data-animsition-out-class="zoom-out-sm" data-animsition-out-duration="800">
            @include('common.errors')
            @include('flash::message')
        </div>
                <div class="box box-info">

                <div class="box-body">
                    <div class="row">
                        {!! Form::open(['route' => 'pqrsPublic.seguimiento', 'method' => 'GET']) !!}
                             <div class="form-group col-sm-12 col-lg-12">
                               <p>
                                    Recuerde que puede solicitar asistencia / soporte si lo requiere, o o bien contactarnos mediante los telefonos presentes en la pagina de principal de {{ $enterprise_public->short_name or "Transporte Digital" }}.
                               </p> 
                             </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('radicado', 'Radicado') !!}
                                <div class="input-group">                                 
                                  {!! Form::text('radicado', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Ingrese Radicado...']) !!}
                                  <span class="input-group-btn">
                                    <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Consultar</button>
                                  </span>
                                </div><!-- /input-group -->
                                  {!! $errors->first('radicado', '<span class="text-red">:message</span>') !!}
                              </div><!-- /.col-lg-6 -->
                              <div class="form-group col-sm-12 col-lg-12">
                                {!! csrf_field() !!}
                                {!! Recaptcha::render() !!}
                            </div>                    

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
 <script>
    $(document).ready(function () {  
        $(".select2").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Seleccionar...',      
          allowClear: true
        });
        $('.datepicker').datepicker({             
            format: 'yyyy-mm-dd',        
            language: 'es',
        });
    });
 </script>
@endsection
