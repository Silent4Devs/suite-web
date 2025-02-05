@can('administracion_sistema_gestion_contratos_acceder')
    <ul class="menu-modulos">
        @can('katbol_ordenes_compra_acceso')
            <li>
                <a href="{{ route('contract_manager.orden-compra') }}">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>
                        Ordenes de Compra
                    </span>
                </a>
            </li>
        @endcan
        @can('katbol_proveedores_ordenes_compra_acceso')
            <li>
                <a href="{{ route('contract_manager.proveedores.index') }}">
                    <i class="fa-solid fa-address-card"></i>
                    <span>
                        Proveedores de Ordenes de Compra
                    </span>
                </a>
            </li>
        @endcan
        @can('katbol_producto_acceso')
            <li>
                <a href="{{ route('contract_manager.productos.index') }}">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>
                        Productos
                    </span>
                </a>
            </li>
        @endcan
        @can('katbol_compradores_acceso')
            <li>
                <a href="{{ route('contract_manager.compradores.index') }}">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>
                        Compradores
                    </span>
                </a>
            </li>
        @endcan
        @can('katbol_centro_costos_acceso')
            <li>
                <a href="{{ route('contract_manager.centro-costos.index') }}">
                    <i class="fa-solid fa-landmark"></i>
                    <span>
                        Centro de Costos
                    </span>
                </a>
            </li>
        @endcan
        @can('katbol_sucursales_acceso')
            <li>
                <a href="{{ route('contract_manager.sucursales.index') }}">
                    <i class="fa-solid fa-building-user"></i>
                    <span>
                        Razón Social
                    </span>
                </a>
            </li>
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
