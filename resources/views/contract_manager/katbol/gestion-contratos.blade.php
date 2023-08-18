@can('sistema_de_gestion_contexto_acceder')
    <ul class="mt-4">
        {{-- @can('analisis_de_brechas_acceder') --}}
            <li><a href="{{ route('contract_manager.contratos-katbol.index') }}">
                    <div>
                        <i class="fa-regular fa-file-lines"></i><br>
                        Contratos
                    </div>
                </a></li>
        {{-- @endcan --}}
        {{-- @can('plan_de_implementacion_acceder') --}}
            <li><a href="{{ route('contract_manager.requisiciones') }}">
                    <div>
                        <i class="fa-regular fa-folder-open"></i><br>
                        Requisiciones
                    </div>
                </a></li>
        {{-- @endcan --}}
        {{-- @can('partes_interesadas_acceder') --}}
            <li><a href="{{ route('admin.partes-interesadas.index') }}">
                    <div>
                        <i class="bi bi-layout-wtf"></i><br>
                        Dashboard
                    </div>
                </a></li>
        {{-- @endcan --}}
        {{-- @can('matriz_requisitos_legales_acceder') --}}
            <li><a href="{{ route('admin.matriz-requisito-legales.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Calendario
                    </div>
                </a></li>
        {{-- @endcan --}}
        {{-- @can('analisis_foda_acceder') --}}
            <li><a href="{{ route('contract_manager.proveedor.index') }}">
                    <div>
                        <i class="fa-solid fa-id-badge"></i><br>
                        Clientes - Proveedores
                    </div>
                </a></li>
        {{-- @endcan --}}
        {{-- @can('determinacion_alcance_acceder') --}}
            <li><a href="{{ route('admin.organizacions.index') }}">
                    <div>
                        <i class="bi bi-building iconos_menu letra_blanca"></i><br>
                        Organización
                    </div>
                </a></li>
        {{-- @endcan --}}
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
                No puedes acceder al módulo de Gestion de Contratos, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
