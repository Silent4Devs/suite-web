@extends('layouts.admin')
@section('content')
    <style>

    </style>

    {{-- {{ Breadcrumbs::render('admin.entendimiento-organizacions.index') }} --}}

    <div class="">
        @foreach ($query as $foda)
            <div class="card card-foda">
                <div class="card-header">
                    title
                </div>
                <div class="card-body">
                    <p>
                        info
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
