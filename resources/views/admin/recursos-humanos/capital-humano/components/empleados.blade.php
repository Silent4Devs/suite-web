<ul class="mt-4">
    <li><a href="{{ route('admin.puestos.index') }}">
            <div>
                <i class="fas fa-briefcase"></i>
                Perfiles de Puestos
            </div>
        </a></li>
    <li><a href="{{ route('admin.perfiles.index') }}">
            <div>
                <i class="fas fa-sitemap"></i>
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
                <i class="fas fa-file"></i>
                Expedientes Profesionales
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
    <li>
        <a href="#">
            <div>
                <i class="fas fa-question"></i>
                Solicitudes e Incidencias
            </div>
        </a>
    </li>
    <li>
        <a href="#">
            <div>
                <i class="fas fa-question"></i>
                Beneficios
            </div>
        </a>
    </li>
</ul>
