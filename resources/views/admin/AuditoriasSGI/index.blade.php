@extends('layouts.admin')


@section('content')
    {{ Breadcrumbs::render('admin.system-calendar') }}
    @livewire('dashboard.auditorias-s-g-i')
@endsection
