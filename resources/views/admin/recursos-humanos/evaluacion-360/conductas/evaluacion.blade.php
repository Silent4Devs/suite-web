@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong>Evaluación: </strong>{{ $evaluacion->nombre }}</h3>
        </div>
        <div class="card-body">
            <div class="border w-100" style="border-radius: 5px">
                <div class="w-100 bg-light" style="padding:15px 10px;">
                    <span style="font-size:15px;" class="mr-2">{{ $evaluacion->nombre }}</span><span
                        class="badge" style="background: {{ $evaluacion->color_estatus }}">
                        <span style="border-radius: 100%; padding:10px;"></span>{{ $evaluacion->estatus_formateado }}
                    </span>
                </div>
                <ul class="list-group list-group-horizontal w-100">
                    <li class="list-group-item w-100" style="border:none;">
                        <p class="m-0 text-muted">Autor</p>
                        <p class="m-0" style="font-weight: bold;">
                            <img alt="{{ $evaluacion->autor->name }}"
                                src="{{ asset('storage/empleados/imagenes/' . $evaluacion->autor->avatar) }}"
                                class="rounded-circle"
                                style="clip-path: circle(15px at 50% 50%);height: 30px;margin-left: -6px;" />
                            {{ $evaluacion->autor->name }}
                        </p>
                    </li>
                    <li class="list-group-item w-100" style="border:none;">
                        <p class="m-0 text-muted">Comineza En</p>
                        <p class="m-0" style="font-weight: bold;"></p>
                    </li>
                    <li class="list-group-item w-100" style="border:none;">
                        <p class="m-0 text-muted">Finaliza En</p>
                        <p class="m-0" style="font-weight: bold;"></p>
                    </li>
                    <li class="list-group-item w-100" style="border:none;">
                        <p class="m-0 text-muted">Participación</p>
                        <p class="m-0" style="font-weight: bold;"></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
