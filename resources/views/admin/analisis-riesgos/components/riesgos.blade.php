<ul class="mt-2">
    @can('amenazas_acceder')
        <li>
            <a href="{{ route('admin.amenazas.index') }}">
                <div>
                    <i class="bi bi-radioactive"></i> <br>
                    Amenazas
                </div>
            </a>
        </li>
    @endcan
    @can('vulnerabilidades_acceder')
        <li>
            <a href="{{ route('admin.vulnerabilidads.index') }}">
                <div>
                    <i class="bi bi-shield-x"></i> <br>
                    Vulnerabilidades
                </div>
            </a>
        </li>
    @endcan
    @can('matriz_de_riesgo_acceder')
        <li>
            <a href="{{ route('admin.analisis-riesgos.index') }}">
                <div>
                    <i class="bi bi-table"></i> <br>
                    Matríz de Riesgos
                </div>
            </a>
        </li>
    @endcan

        {{-- <li>
            <a href="{{ route('admin.carta-aceptacion.index') }}">
                <div>
                    <i class="far fa-file-alt" style="font-size: 35pt;"></i><br>
                    Cartas de Aceptación
                </div>
            </a>
        </li> --}}

        {{-- <li>
            <a href="{{ route('admin.tabla-impacto.index') }}">
                <div>
                <i class="fa-solid fa-chart-line"></i>
                <br>
                    Tabla de impacto
                </div>
            </a>
        </li> --}}

</ul>
