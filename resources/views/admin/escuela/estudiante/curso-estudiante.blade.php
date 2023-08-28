@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Mis Cursos</h5>

    <style>
        /* Estilos base para el switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            display: none;
        }

        /* Estilos para el slider del switch */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: 0.4s;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: 0.4s;
            transition: 0.4s;
            border-radius: 50%;
        }

        /* Estilos para cambiar el estado activo/desactivado del switch */
        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
    </style>

    <div class="d-flex" style="gap: 20px;">
        <div style="width: 100%;">
            <div>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/n61ULEU7CO0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <p>
                Lección 1
            </p>
            <div class="card card-body d-flex justify-space-between">
                <a href=""><i class="fa-solid fa-chevron-left"></i> Tema anterior</a>

                <a href=""><i class="fa-solid fa-chevron-right"></i> Siguiente tema</a>
            </div>

            <div class="custom-control custom-switch text-right">
                <label class="custom-control-label" for="customSwitch1">Marcar esta lección como terminada</label>
                <input type="checkbox" class="custom-control-input mr-4" id="customSwitch1">
            </div>
        </div>

        <div class="card card-body" style="width: 320px;">
            <h5>Seguridad en Redes</h5>
            <div class="d-flex">
                <div><img src="" alt=""></div>
                <div>
                    <p>Jorge Rámirez</p>
                    <p><small>Ciberseguridad</small></p>
                </div>
            </div>
            <div>
                <p>32% Completada</p>

                <div>
                    {barra}
                </div>
            </div>
            <hr>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This panel is shown by default, thanks
                            to the <code>.show</code> class.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Collapsible Group Item #2
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the second accordion panel. This panel is hidden by default.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Collapsible Group Item #3
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            And lastly, the placeholder content for the third and final accordion panel. This panel is
                            hidden by default.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
