@can('administracion_sistema_gestion_contratos_acceder')
    <ul class="mt-4">
        @can('katbol_ordenes_compra_acceso')
            <li><a href="{{ route('contract_manager.orden-compra') }}">
                    <div>
                        <i class="fa-solid fa-file-invoice"></i>
                        Ordenes de Compra
                    </div>
                </a></li>
        @endcan
        @can('katbol_proveedores_ordenes_compra_acceso')
            <li><a href="{{ route('contract_manager.proveedores.index') }}">
                    <div>
                        <i class="fa-solid fa-address-card"></i>
                        Proveedores de Ordenes de Compra
                    </div>
                </a></li>
        @endcan
        @can('katbol_producto_acceso')
            <li><a href="{{ route('contract_manager.productos.index') }}">
                    <div>
                        <i class="fa-brands fa-product-hunt"></i>
                        Productos
                    </div>
                </a></li>
        @endcan
        @can('katbol_compradores_acceso')
            <li><a href="{{ route('contract_manager.compradores.index') }}">
                    <div>
                        <i class="fa-solid fa-user-tie"></i>
                        Compradores
                    </div>
                </a></li>
        @endcan
        @can('katbol_centro_costos_acceso')
            <li><a href="{{ route('contract_manager.centro-costos.index') }}">
                    <div>
                        <i class="fa-solid fa-landmark"></i>
                        Centro de Costos
                    </div>
                </a></li>
        @endcan
        @can('katbol_sucursales_acceso')
            <li><a href="{{ route('contract_manager.sucursales.index') }}">
                    <div>
                        <i class="fa-solid fa-building-user"></i>
                        Sucursales
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
