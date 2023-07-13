@can('sistema_de_gestion_contexto_acceder')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i
            class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        @can('analisis_de_brechas_acceder')
            <li><a href="{{ url('/admin/analisisdebrechas') }}">
                    <div>
                        <i class="bi bi-binoculars"></i><br>
                        Análisis de brechas
                    </div>
                </a></li>
        @endcan
        @can('plan_de_implementacion_acceder')
            <li><a href="{{ route('admin.planTrabajoBase.index') }}">
                    <div>
                        <i class="bi bi-file-earmark-arrow-up"></i><br>
                        Plan de implementación
                    </div>
                </a></li>
        @endcan
        @can('partes_interesadas_acceder')
            <li><a href="{{ route('admin.partes-interesadas.index') }}">
                    <div>
                        <i class="bi bi-layout-wtf"></i><br>
                        Partes interesadas
                    </div>
                </a></li>
        @endcan
        @can('matriz_requisitos_legales_acceder')
            <li><a href="{{ route('admin.matriz-requisito-legales.index') }}">
                    <div>
                        <i class="fas fa-balance-scale"></i><br>
                        Matriz de requisitos legales y regulatorios
                    </div>
                </a></li>
        @endcan
        @can('analisis_foda_acceder')
            <li><a href="{{ route('admin.entendimiento-organizacions.index') }}">
                    <div>
                        <i class="bi bi-file-earmark-ruled"></i><br>
                        Análisis FODA
                    </div>
                </a></li>
        @endcan
        @can('determinacion_alcance_acceder')
            <li><a href="{{ route('admin.alcance-sgsis.index') }}">
                    <div>
                        <i class="bi bi-bookmark-heart"></i><br>
                        Determinación de alcance
                    </div>
                </a></li>
        @endcan
        {{-- <li><a href="{{ route('admin.reportes-contexto.index') }}">
                <div>
                    <i class="far fa-file-alt"></i>
                    Generar reporte
                </div>
            </a></li> --}}
    </ul>
@else
    <div class="row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Análisis de Brechas, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
