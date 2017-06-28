@section('css')
    @include('layouts.datatables_css')
@endsection

<!--{!! $dataTable->table(['width' => '100%']) !!}-->
{!! $dataTable->table(['class' => 'table table-hover', 'id' => 'table-id', 'width' => '100%']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection