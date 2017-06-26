@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pago Rel Ruta
        </h1>
    </section>
    <div class="content">
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row" style="padding-left: 20px">
                        @include('pago_rel_rutas.show_fields')
                        <a href="{!! route('pagoRelRutas.index') !!}" class="btn btn-default">Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
