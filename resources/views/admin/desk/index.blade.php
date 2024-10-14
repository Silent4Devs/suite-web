@extends('layouts.admin')
@section('css')
    @vite(['resources/css/centroAtencion.css'])
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Centro de Atención</h5>

    @include('partials.flashMessages')
    <div class="">

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- @can('centro_atencion_incidentes_de_seguridad_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="incidentes-tab" data-bs-toggle="tab" href="#incidentes" role="tab"
                        aria-controls="incidentes" aria-selected="true" style="background-color: #4A98FF !important;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Incidentes de seguridad</span>
                    </a>
                </li>
            @endcan --}}
            @can('centro_atencion_riesgos_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="riesgos-tab" data-bs-toggle="tab" href="#riesgos" role="tab"
                        aria-controls="riesgos" aria-selected="false" style="background-color: #4A98FF !important;">
                        <i class="fas fa-shield-alt"></i>
                        <span>Riesgos</span>
                    </a>
                </li>
            @endcan
            @can('centro_atencion_quejas_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="quejas-tab" data-bs-toggle="tab" href="#quejas" role="tab"
                        aria-controls="quejas" aria-selected="false" style="background-color: #FF8F55 !important;">
                        <i class="fas fa-frown"></i>
                        <span> Quejas</span>
                    </a>
                </li>
            @endcan
            @can('centro_atencion_quejas_clientes_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="quejasClientes-tab" data-bs-toggle="tab" href="#quejasClientes" role="tab"
                        aria-controls="quejasClientes" aria-selected="false" style="background-color: #78BB50 !important;">
                        <i class="fas fa-thumbs-down"></i>
                        <span> Quejas Clientes</span>
                    </a>
                </li>
            @endcan
            @can('centro_atencion_denuncias_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="denuncias-tab" data-bs-toggle="tab" href="#denuncias" role="tab"
                        aria-controls="denuncias" aria-selected="false" style="background-color: #BE74FF !important;">
                        <i class="fas fa-hand-paper"></i>
                        <span> Denuncias</span>
                    </a>
                </li>
            @endcan
            @can('centro_atencion_mejoras_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="mejoras-tab" data-bs-toggle="tab" href="#mejoras" role="tab"
                        aria-controls="mejoras" aria-selected="false" style="background-color: #7A7A7A !important;">
                        <i class="fas fa-rocket"></i>
                        <span> Mejoras</span>
                    </a>
                </li>
            @endcan
            @can('centro_atencion_sugerencias_acceder')
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="sugerencias-tab" data-bs-toggle="tab" href="#sugerencias" role="tab"
                        aria-controls="sugerencias" aria-selected="false" style="background-color: #FE5661 !important;">
                        <i class="fas fa-lightbulb"></i>
                        <span> Sugerencias</span>
                    </a>
                </li>
            @endcan
        </ul>

        {{-- <div class="card card-body box-sentimientos">
            <div class="card-sentimiento">
                <div>
                    <span>No prioritario</span><br>
                    <strong>10</strong>
                </div>
                <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji">
            </div>
            <div class="card-sentimiento">
                <div>
                    <span>Bajo</span><br>
                    <strong>20</strong>
                </div>
                <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji">
            </div>
            <div class="card-sentimiento">
                <div>
                    <span>Medio</span><br>
                    <strong>40</strong>
                </div>
                <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji">
            </div>
            <div class="card-sentimiento">
                <div>
                    <span>Alto</span><br>
                    <strong>80</strong>
                </div>
                <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji">
            </div>
            <div class="card-sentimiento">
                <div>
                    <span>Urgente</span><br>
                    <strong>100</strong>
                </div>
                <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji">
            </div>
        </div> --}}

        <!-- Tabs Content -->
        <div class="tab-content" id="myTabContent">
            {{-- @can('centro_atencion_incidentes_de_seguridad_acceder')
                <div class="tab-pane fade" id="incidentes" role="tabpanel" aria-labelledby="incidentes-tab">
                    @include('admin.desk.seguridad.seguridad')
                </div>
            @endcan --}}
            @can('centro_atencion_riesgos_acceder')
                <div class="tab-pane fade show active" id="riesgos" role="tabpanel" aria-labelledby="riesgos-tab">
                    @include('admin.desk.riesgos.riesgos')
                </div>
            @endcan
            @can('centro_atencion_quejas_acceder')
                <div class="tab-pane fade" id="quejas" role="tabpanel" aria-labelledby="quejas-tab">
                    @include('admin.desk.quejas.quejas')
                </div>
            @endcan
            @can('centro_atencion_quejas_clientes_acceder')
                <div class="tab-pane fade" id="quejasClientes" role="tabpanel" aria-labelledby="quejasClientes-tab">
                    @include('admin.desk.clientes.clientes')
                </div>
            @endcan
            @can('centro_atencion_denuncias_acceder')
                <div class="tab-pane fade" id="denuncias" role="tabpanel" aria-labelledby="denuncias-tab">
                    @include('admin.desk.denuncias.denuncias')
                </div>
            @endcan
            @can('centro_atencion_mejoras_acceder')
                <div class="tab-pane fade" id="mejoras" role="tabpanel" aria-labelledby="mejoras-tab">
                    @include('admin.desk.mejoras.mejoras')
                </div>
            @endcan
            @can('centro_atencion_sugerencias_acceder')
                <div class="tab-pane fade" id="sugerencias" role="tabpanel" aria-labelledby="sugerencias-tab">
                    @include('admin.desk.sugerencias.sugerencias')
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'incidentes';
            const permisoIncidente = @json(Auth::user()->can('incidentes_seguridad_access'));
            const permisoRiesgo = @json(Auth::user()->can('riesgos_access'));
            const permisoQueja = @json(Auth::user()->can('quejas_access'));
            const permisoDenuncia = @json(Auth::user()->can('denuncias_access'));
            const permisoMejora = @json(Auth::user()->can('mejoras_access'));
            const permisoSugerencia = @json(Auth::user()->can('sugerencias_access'));
            const permisoQuejaCliente = true;
            console.log(localStorage.getItem('menu-desk'));
            if (permisoIncidente) {
                // localStorage.setItem('menu-desk', 'incidentes');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'incidentes';
            } else if (permisoRiesgo) {
                // localStorage.setItem('menu-desk', 'riesgos');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'riesgos';
            } else if (permisoQueja) {
                // localStorage.setItem('menu-desk', 'quejas');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'quejas';
            } else if (permisoQuejaCliente) {
                // localStorage.setItem('menu-desk', 'quejasClientes');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'quejasClientes';
            } else if (permisoDenuncia) {
                // localStorage.setItem('menu-desk', 'denuncias');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'denuncias';
            } else if (permisoMejora) {
                // localStorage.setItem('menu-desk', 'mejoras');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'mejoras';
            } else if (permisoSugerencia) {
                // localStorage.setItem('menu-desk', 'sugerencias');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'sugerencias';
            }
            console.log(menu);

            if (document.querySelector('.caja_tab_reveldada')) {
                document.querySelector('.caja_tab_reveldada').classList.remove('caja_tab_reveldada');
            }
            if (document.querySelector('.btn_activo')) {
                document.querySelector('.btn_activo').classList.remove('btn_activo');
            }
            if (document.querySelector(`[data-tabs=${menu}]`)) {
                document.getElementById(menu).classList.add('caja_tab_reveldada');
                document.querySelector(`[data-tabs=${menu}]`).classList.add('btn_activo');
            }
            document.querySelector('.caja_botones_menu').addEventListener('click', function(e) {
                let elemento = e.target;
                if (elemento.tagName == 'I') {
                    elemento = elemento.closest('a');
                }
                if (elemento.getAttribute('data-tabs')) {
                    localStorage.setItem('menu-desk', elemento.getAttribute('data-tabs'))
                }
            })
            window.menuActive = function(item) {
                localStorage.setItem('menu-desk', item)
            }
        })
    </script>
@endsection
