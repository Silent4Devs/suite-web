<ul class="mt-4">
    <li><a href="{{ route('admin.puestos.index') }}">
            <div>
                <i class="fas fa-briefcase"></i>
                Perfiles de Puestos
            </div>
        </a></li>
    <li><a href="{{ route('admin.perfiles.index') }}">
            <div>
                <span class="material-icons material-modulos">
                    stairs
                </span>
                Niveles Jerárquicos
            </div>
        </a></li>
    <li><a href="{{ route('admin.empleados.index') }}">
            <div>
                <i class="fas fa-user"></i>
                Empleados
            </div>
        </a></li>
    <li><a href="{{ route('admin.capital.expedientes-profesionales') }}">
            <div>
                <span class="material-icons material-modulos">
                    folder_shared
                </span>
                Expedientes Profesionales
            </div>
        </a></li>
    <li><a href="{{ route('admin.organigrama.index') }}">
            <div>
                <i class="fas fa-sitemap"></i>
                Organigrama
            </div>
        </a></li>
    <li><a href="#" data-ventana="capacitaciones" data-ruta="Capacitaciones" class="btn_ventana_menu">
            <div>
                <i class="fas fa-chalkboard-teacher"></i>
                Capacitaciones
            </div>
        </a></li>
    <div class="ventana_menu" id="capacitaciones" style="color:#008186 !important">
        <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="capacitaciones"
            style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
        <h3 class="text-center"><strong>Capacitaciones</strong></h3>
        <ul>
            <li><a href="{{ route('admin.categoria-capacitacion.index') }}">
                    <div>
                        <i class="fas fa-layer-group"></i>
                        Categorías
                    </div>
                </a></li>
            <li><a href="{{ route('admin.recursos.index') }}">
                    <div>
                        <i class="fas fa-graduation-cap"></i>
                        Capacitaciones
                    </div>
                </a></li>
        </ul>
    </div>
    <li><a href="{{ route('admin.tipos-contratos-empleados.index') }}">
            <div>
                <span class="material-icons material-modulos">
                    description
                </span>
                Tipos de contratos
            </div>
        </a>
    </li>
    <li><a href="{{ route('admin.entidades-crediticias.index') }}">
            <div>
                <span class="material-icons material-modulos">
                    account_balance
                </span>
                Entidades Crediticias
            </div>
        </a>
    </li>
    <li>
        <a href="#">
            <div>
                <span class="material-icons material-modulos">
                    beach_access
                </span>
                Solicitudes e Incidencias
            </div>
        </a>
    </li>
    <li>
        <a href="#">
            <div>
                <span class="material-icons material-modulos">
                    loyalty
                </span>
                Beneficios
            </div>
        </a>
    </li>
</ul>
