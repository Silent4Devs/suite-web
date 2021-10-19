@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidad</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Vulnerabilidad</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                {!! Form::open(['route' => 'admin.vulnerabilidads.store']) !!}

                @include('admin.vulnerabilidads.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
