@section('css')
    @include('admin.datatable.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('scripts')
    @include('admin.datatable.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
