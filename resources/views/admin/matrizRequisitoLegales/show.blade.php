@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.matrizRequisitoLegale.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">

                <a class="btn btn-default" href="{{ route('admin.matriz-requisito-legales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.id') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.nombrerequisito') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->nombrerequisito }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->fechaexpedicion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->fechavigor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->requisitoacumplir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->evaluaciones[0]->cumplerequisito ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.formacumple') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->formacumple }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento') }}
                        </th>
                        <td>
                            {{ $matrizRequisitoLegale->periodicidad_cumplimiento }}
                        </td>
                    </tr>

                </tbody>
            </table>

            @if ($result == false)
                <div class=" bg-warning col-12">

                    <p class="card-text" style="color:black; text-align:center">Este requisito aun no ha sido evaluado
                    </p>
                    {{-- <h6 class="card-title" style="color:black; text-align:center"> Este requisito aun no ha sido evaluado</h6> --}}

                </div><br>
            @else
                <div class="form-group col-12">
                    <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                        Evaluaciones</p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Fecha de verificacion</th>
                            <th scope="col">Cumple</th>
                            <th scope="col">Reviso</th>
                            <th scope="col">Puesto</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $evaluacion)
                            <tr>
                                {{-- <th scope="row">{{ $evaluacion->id }}</th> --}}
                                <td>{{ $evaluacion->fechaverificacion }}</td>
                                <td>{{ $evaluacion->cumplerequisito }}</td>
                                <td>
                                    @if ($evaluacion->evaluador)
                                        {{ $evaluacion->evaluador->name }}
                                    @else
                                        Sin evaluador
                                    @endif
                                </td>
                                <td>
                                    @if ($evaluacion->evaluador && $evaluacion->evaluador->puestoRelacionado)
                                        {{ $evaluacion->evaluador->puestoRelacionado->puesto }}
                                    @else
                                        Sin evaluador
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal{{ $evaluacion->id }}">
                                        Mas información
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $evaluacion->id }}" tabindex="-1"
                                aria-labelledby="exampleModal{{ $evaluacion->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal{{ $evaluacion->id }}Label">
                                                {{ $matrizRequisitoLegale->nombrerequisito }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            ID
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->id }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Fecha de verificación
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->fechaverificacion }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Cumple
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->cumplerequisito }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Revisó
                                                        </div>
                                                        <div class="col-6">
                                                            @if ($evaluacion->evaluador)
                                                                {{ $evaluacion->evaluador->name }}
                                                            @else
                                                                Sin evaluador
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Puesto
                                                        </div>
                                                        <div class="col-6">
                                                            @if ($evaluacion->evaluador && $evaluacion->evaluador->puestoRelacionado)
                                                                {{ $evaluacion->evaluador->puestoRelacionado->puesto }}
                                                            @else
                                                                Sin evaluador
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Área
                                                        </div>
                                                        <div class="col-6">
                                                            @if ($evaluacion->evaluador && $evaluacion->evaluador->area)
                                                                {{ $evaluacion->evaluador->area->area }}
                                                            @else
                                                                Sin evaluador
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Método utilizado de verificación
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->metodo }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Descripción del cumplimiento / incumplimiento
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->descripcion_cumplimiento }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Comentarios / observaciones
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $evaluacion->comentarios }}
                                                        </div>
                                                    </div>
                                                </li>
                                                {{-- <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                           Evidencia
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3 col-10 d-flex justify-content-right">
                                                                <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary"
                                                                    data-toggle="modal" data-target="#largeModal{{ $evaluacion->id }}">
                                                                    <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar
                                                                    Documentos
                                                                </span>
                                                            </div>

                                                            <div class="modal fade" id="largeModal{{ $evaluacion->id }}" tabindex="-1" role="dialog"
                                                                aria-labelledby="basicModal{{ $evaluacion->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            @if (count($matrizRequisitoLegale->evidencias_matriz))
                                                                                <!-- carousel -->
                                                                                <div id='carouselExampleIndicators' class='carousel slide'
                                                                                    data-ride='carousel'>
                                                                                    <ol class='carousel-indicators'>
                                                                                        @foreach ($evaluacion->evidencias_matriz as $idx => $evidencia)
                                                                                            <li data-target=#carouselExampleIndicators
                                                                                                data-slide-to={{ $idx }}></li>
                                                                                        @endforeach

                                                                                    </ol>
                                                                                    <div class='carousel-inner'>
                                                                                        @foreach ($evaluacion->evidencias_matriz as $idx => $evidencia)
                                                                                            <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                                                <iframe style="width:100%;height:300px;" seamless
                                                                                                    class='img-size'
                                                                                                    src="{{ asset('storage/matriz_evidencias') }}/{{ $evidencia->evidencia }}"></iframe>
                                                                                            </div>
                                                                                        @endforeach


                                                                                    </div>
                                                                                    <a class='carousel-control-prev' href='#carouselExampleIndicators'
                                                                                        role='button' data-slide='prev'>
                                                                                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                                                                        <span class='sr-only'>Previous</span>
                                                                                    </a>
                                                                                    <a class='carousel-control-next' href='#carouselExampleIndicators'
                                                                                        role='button' data-slide='next'>
                                                                                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                                                                        <span class='sr-only'>Next</span>
                                                                                    </a>
                                                                                </div>
                                                                            @else
                                                                                <div class="text-center">
                                                                                    <h3 style="text-align:center" class="mt-3">Sin
                                                                                        archivo agregado</h3>
                                                                                    <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                                                                        style="width:350px !important">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.matriz-requisito-legales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
