@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.components.menu')

    <div class="content-pasarela">
        @include('admin.pasarelaPago.components.btn-regresar')

        @include('admin.pasarelaPago.components.portada')

        <h4 class="mb-5">Nuevas Actualizaciones</h4>

        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="material-symbols-outlined icon-background icon-lg" style="background-color: #FCB4BC;">gpp_maybe</i>

                <div>
                    <h2>Gestor de Riesgos</h2>
                    <p>Seguridad</p>
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
                La gestión de riesgos es una parte fundamental de cualquier empresa exitosa. En Silent4Business,
                entendemos la importancia de la gestión de riesgos y ofrecemos soluciones personalizadas para
                ayudarte a identificar, evaluar y mitigar los riesgos en tu empresa.
            </p>
            <p>
                Nuestro equipo de expertos en gestión de riesgos está capacitado para evaluar los riesgos
                potenciales en cada área de tu empresa, desde la seguridad de los empleados hasta los riesgos
                financieros. A partir de esta evaluación, podemos desarrollar estrategias y planes de mitigación
                personalizados para minimizar el impacto de los riesgos en tu empresa.
            </p>
            <p>
                Además, nuestra plataforma de gestión de riesgos te permite monitorear y actualizar continuamente
                tus estrategias de mitigación de riesgos. De esta manera, puedes estar seguro de que siempre estás
                protegiendo a tu empresa de los riesgos potenciales.
            </p>
            <hr>

            <h5 class="mt-4">Características</h5>
            <p>
                Nuestra aplicación destaca por ofrecer características como evaluación de riesgos detallada,
                análisis de seguridad exhaustivo, generación de informes automatizados, seguimiento continuo de
                riesgos, y cumplimiento con los estándares de seguridad más rigurosos, proporcionando a las empresas
                las herramientas necesarias para proteger sus activos digitales y garantizar la seguridad de la
                información de manera efectiva.
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
