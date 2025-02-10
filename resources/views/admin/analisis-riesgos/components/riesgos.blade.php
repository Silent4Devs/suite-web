<ul class="menu-modulos">
    @can('amenazas_acceder')
        <li>
            <a href="{{ route('admin.amenazas.index') }}">
                <i class="bi bi-radioactive"></i>
                <span>
                    Amenazas
                </span>
            </a>
        </li>
    @endcan
    @can('vulnerabilidades_acceder')
        <li>
            <a href="{{ route('admin.vulnerabilidads.index') }}">
                <i class="bi bi-shield-x"></i>
                <span>
                    Vulnerabilidades
                </span>
            </a>
        </li>
    @endcan
    @can('matriz_de_riesgo_acceder')
        <li>
            <a href="{{ route('admin.analisis-riesgos.index') }}">
                <i class="bi bi-table"></i>
                <span>
                    Matríz de Riesgos
                </span>
            </a>
        </li>
    @endcan
</ul>
