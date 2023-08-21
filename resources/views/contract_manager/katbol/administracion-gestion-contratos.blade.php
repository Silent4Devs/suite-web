@can('administracion_sistema_gestion_contratos_acceder')
    <ul class="mt-4">
        @can('katbol_ordenes_compra_acceso')
            <li><a href="{{ route('contract_manager.contratos-katbol.index') }}">
                    <div>
                        <i class="fa-regular fa-file-lines"></i><br>
                        Ordenes de Compra
                    </div>
                </a></li>
        @endcan
        @can('katbol_proveedores_ordenes_compra_acceso')
                <li><a href="{{ route('contract_manager.proveedores.index') }}">
                    <div>
                        <i class="fa-solid fa-id-badge"></i><br>
                        Proveedores de Ordenes de Compra
                    </div>
                </a></li>
        @endcan
        @can('katbol_productos_acceso')
            <li><a href="{{ route('contract_manager.productos.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Productos
                    </div>
                </a></li>
        @endcan
        @can('katbol_compradores_acceso')
                <li><a href="{{ route('contract_manager.compradores.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Compradores
                    </div>
                </a></li>
        @endcan
        @can('katbol_centro_costos_acceso')
                <li><a href="{{ route('contract_manager.centro-costos.index') }}">
                    <div>
                        <i class="fa-solid fa-id-badge"></i><br>
                        Centro de Costos
                    </div>
                </a></li>
        @endcan
        @can('katbol_sucursales_acceso')
            <li><a href="{{ route('contract_manager.sucursales.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Sucursales
                    </div>
                </a></li>
        @endcan
        @can('katbol_reportes_requisicion_acceso')
                <li><a href="{{ route('contract_manager.reportes.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Reportes de Requisicion
                    </div>
                </a></li>
        @endcan
    </ul>
@else
    <div class="row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Administracion de Contratos, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
