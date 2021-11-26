@extends('layouts.frontend')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('vulnerabilidads.index') !!}">Vulnerabilidades</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Vulnerabilidad</h3>
        </div>
        <div class="card-body">
            {!! Form::model($vulnerabilidad, ['route' => ['vulnerabilidads.update', $vulnerabilidad->id], 'method' => 'patch']) !!}

            @include('frontend.vulnerabilidads.editfields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
