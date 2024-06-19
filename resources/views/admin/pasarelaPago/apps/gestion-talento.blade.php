@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.menu')

    <div class="content-pasarela">

        <div class="d-flex portada-pasarela">
            <img src="{{ asset('img/pasarelaPago/portada-inicio.png') }}" alt="">
            <div class="text-white portada-pasarela-info p-5">
                <h3>Software Integral de Gestión Empresarial</h3>
                <p class="p-3">
                    Planifica, y analiza las operaciones contables de la compañía.
                </p>
                <p class="mt-5">
                    <strong>
                        Elige tus aplicaciones
                    </strong>
                </p>
            </div>
        </div>

        <h4 class="my-5">Nuevas Actualizaciones</h4>

        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="material-symbols-outlined icon-background icon-lg" style="background-color: #FFD3BF;">id_card</i>

                <div>
                    <h2>Gestión de Talento</h2>
                    <p>Gestión</p>
                    <a href="" class="btn btn-primary">Abrir</a>
                </div>
                <div class="box-apps-stars ml-5">
                    <i class="material-symbols-outlined">kid_star</i>
                    <i class="material-symbols-outlined">kid_star</i>
                    <i class="material-symbols-outlined">kid_star</i>
                    <i class="material-symbols-outlined">kid_star</i>
                    <i class="material-symbols-outlined">kid_star</i>

                    <span class="ml-2">
                        5
                        (055)
                        Califica tu aplicación
                    </span>
                </div>
            </div>

            <div class="mt-5">
                <span class="link">Descricpión</span>
            </div>

            <h5 class="mt-5">Introducción</h5>
            <p>
                Descubre, desarrolla y retiene el talento de tu equipo con nuestra completa aplicación de gestión de
                talento. Desde la identificación y reclutamiento de talentos hasta la planificación de carreras y la
                evaluación del desempeño, nuestra plataforma te proporciona las herramientas necesarias para
                impulsar el crecimiento de tu empresa. Con características como análisis de competencias,
                evaluaciones 360 grados y planes de desarrollo personalizados, estamos aquí para ayudarte a
                construir un equipo excepcional. ¡Descarga ahora y desbloquea el potencial de tu talento humano!
            </p>
            <hr>

            <h5 class="mt-4">Características</h5>
            <p>
                Nuestra aplicación destaca por ofrecer características como reclutamiento y selección de talento,
                evaluación del desempeño, gestión del desarrollo y capacitación, planificación de sucesiones,
                análisis de competencias, herramientas de retroalimentación y seguimiento del progreso,
                proporcionando a los usuarios las herramientas necesarias para identificar, desarrollar y retener el
                talento dentro de la organización, promoviendo el crecimiento y el éxito a largo plazo.
            </p>
            <hr>

            <h5 class="mt-5">Reseñas</h5>
            <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                style="padding: 100px 0px;">
                <div style="font-size: 20px">
                    <strong style="font-size: 28px">5</strong>/5
                    (055 calificaiones)
                </div>
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <span>5 estrellas</span>
                        <div class="progress" style="height: 20px; width: 200px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span>4 estrellas</span>
                        <div class="progress" style="height: 20px; width: 200px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span>3 estrellas</span>
                        <div class="progress" style="height: 20px; width: 200px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span>2 estrellas</span>
                        <div class="progress" style="height: 20px; width: 200px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span>1 estrellas</span>
                        <div class="progress" style="height: 20px; width: 200px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
