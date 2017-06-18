@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Recibo Producto
        </h1>
    </section>
    <div class="content">
        <div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row" style="padding-left: 20px">
                        @include('recibo_productos.show_fields')
                        <a href="{!! route('reciboProductos.index') !!}" class="btn btn-default">Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
