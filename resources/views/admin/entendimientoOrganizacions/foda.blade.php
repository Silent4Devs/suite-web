@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.entendimiento-organizacions.index') }}
    <h5 class="col-12 titulo_general_funcion">Entendimiento de Organización (FODA)</h5>
    <div class="mt-5 card">
        <div class="card-body">
            @if (session('success'))
                <div class="mb-3 row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Bien hecho!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                    <strong>INTERNAS</strong>
                </div>
                <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                    style="border-right: dashed 1px gray; border-bottom: dashed 1px gray; min-height: 150px">
                    <h5><i class="mr-2 fas fa-thumbs-up" style="color: #3f5cc7; text-shadow: 1px 1px 1px black;"></i>
                        <strong>FORTALEZAS</strong>
                        <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#fortalezas_modal"
                            style="float: right;">
                            <i class="fas fa-question-circle" style="font-size: 13px"></i>
                        </button>
                    </h5>
                    <div style="text-align: left" class="px-3">
                        @if ($obtener_FODA)
                            {!! $obtener_FODA->fortalezas !!}
                        @else
                            Sin analizar
                        @endif
                    </div>
                </div>
                <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                    style=" border-bottom: dashed 1px gray;min-height: 150px">
                    <h5><i class="mr-2 fas fa-thumbs-down" style="color: #e3ff73; text-shadow: 1px 1px 1px black;"></i>
                        <strong>
                            DEBILIDADES
                        </strong>
                        <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#debilidades_modal"
                            style="float: right;">
                            <i class="fas fa-question-circle" style="font-size: 13px"></i>
                        </button>
                    </h5>
                    <div style="text-align: left" class="px-3">
                        @if ($obtener_FODA)
                            {!! $obtener_FODA->debilidades !!}
                        @else
                            Sin analizar
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                    <strong>EXTERNAS</strong>
                </div>
                <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                    style="border-right: dashed 1px gray; min-height: 150px">
                    <h5 class="mt-3"><i class="mr-2 fas fa-lightbulb"
                            style="color: #41c541; text-shadow: 1px 1px 1px black;"></i>
                        <strong>OPORTUNIDADES</strong>
                        <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#oportunidades_modal"
                            style="float: right;">
                            <i class="fas fa-question-circle" style="font-size: 13px"></i>
                        </button>
                    </h5>
                    <div style="text-align: left" class="px-3">
                        @if ($obtener_FODA)
                            {!! $obtener_FODA->oportunidades !!}
                        @else
                            Sin analizar
                        @endif
                    </div>
                </div>
                <div class="p-0 text-center col-md-5 col-12 col-sm-5" style="min-height: 150px">
                    <h5 class="mt-3"> <i class="mr-2 fas fa-bomb"
                            style="color: #dd2e2e; text-shadow: 1px 1px 1px black;"></i>
                        <strong>AMENAZAS</strong>
                        <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#amenazas_modal"
                            style="float: right;">
                            <i class="fas fa-question-circle" style="font-size: 13px"></i>
                        </button>
                    </h5>
                    <div style="text-align: left" class="px-3">
                        @if ($obtener_FODA)
                            {!! $obtener_FODA->amenazas !!}
                        @else
                            Sin analizar
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                @if ($obtener_FODA)
                    <a href="{{ route('admin.entendimiento-organizacions.edit', $obtener_FODA->id) }}"
                        class="mr-5 btn btn-primary"><i class="fas fa-pen"></i> Editar Análisis FODA</a>
                @else

                    <a href="{{ route('admin.entendimiento-organizacions.create') }}" class="mr-5 btn btn-success"><i
                            class="fas fa-pen"></i> Realizar Análisis FODA</a>

                @endif
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="fortalezas_modal" tabindex="-1" aria-labelledby="fortalezas_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fortalezas_modalLabel">
                        <i class="mr-3 fas fa-thumbs-up" style="color: #3f5cc7; text-shadow: 1px 1px 1px black;"></i>
                        <strong>FORTALEZAS</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Debemos añadir los atributos o puntos positivos que nos pueden servir para alcanzar nuestros objetivos.
                    Están relacionados tanto a los recursos materiales y su condición de uso como a los recursos humanos y
                    su nivel de capacitación para generar los mejores resultados.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="oportunidades_modal" tabindex="-1" aria-labelledby="oportunidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oportunidades_modalLabel">
                        <i class="mr-3 fas fa-lightbulb" style="color: #41c541; text-shadow: 1px 1px 1px black;"></i>
                        <strong>OPORTUNIDADES</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    En este cuadrante debemos de añadir lo que es perjudicial o los factores que pueden ser desfavorables
                    para nuestro objetivo. Son factores internos, por lo que la opinión del personal juega un papel
                    fundamental, y como es algo que se refleja al exterior, también cuenta la opinión de los clientes.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="debilidades_modal" tabindex="-1" aria-labelledby="debilidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="debilidades_modalLabel">
                        <i class="mr-3 fas fa-thumbs-down" style="color: #e3ff73; text-shadow: 1px 1px 1px black;"></i>
                        <strong>
                            DEBILIDADES
                        </strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Aquí debemos tener en cuenta las condiciones externas, revisando la industria y otros factores como las
                    regulaciones que pueden afectar de forma positiva a nuestro objetivo. Son aspectos que, aunque no
                    podemos controlar, sí podemos aprovechar para mejorar o hacer crecer nuestra empresa.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="amenazas_modal" tabindex="-1" aria-labelledby="amenazas_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="amenazas_modalLabel">
                        <i class="mr-3 fas fa-bomb" style="color: #dd2e2e; text-shadow: 1px 1px 1px black;"></i>
                        <strong>AMENAZAS</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Añadiremos lo perjudicial, todo lo que puede amenazar nuestra supervivencia y la potencial ganancia de
                    resultados de forma externa. Estos aspectos no lo podemos controlar, pero sí podemos contraatacar para
                    enfrentarlos.
                </div>
            </div>
        </div>
    </div>
@endsection
