@section('css')
    @include('layouts.datatables_css')
@endsection
	{{-- {!! $dataTable->table(['width' => '100%']) !!} --}}
	{!! $dataTable->table(['class' => 'table table-hover dt-responsive nowrap', 'id' => 'table-id', 'cellspacing' => '0', 'width' => '100%']) !!}
	
@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection