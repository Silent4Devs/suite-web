@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('contratos-katbol_formulario') }}
    {{-- {{ Breadcrumbs::render('contratos_create') }} --}}
    @include('admin.bitacora.table')
@endsection
