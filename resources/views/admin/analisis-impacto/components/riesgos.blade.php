<ul class="mt-2">
    @can('matriz_bia_cuestionario_acceder')
        <li>
            <a href="{{ route('admin.analisis-impacto.menu-BIA') }}">
                <div>
                    <i class="fas fa-clipboard-list"></i><br>
                   BIA
                </div>
            </a>
        </li>
    @endcan
    @can('matriz_bia_matriz')
        <li>
            <a href="{{ route('admin.analisis-impacto.menu-AIA') }}">
                <div>
                    <i class="fas fa-border-none"></i><br>
                    AIA
                </div>
            </a>
        </li>
    @endcan

</ul>
