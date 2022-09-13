<ul class="mt-2">
    @can('matriz_bia_cuestionario_acceder')
        <li>
            <a href="{{ route('admin.analisis-impacto.index') }}">
                <div>
                    <i class="fas fa-clipboard-list"></i><br>
                    Cuestionarios
                </div>
            </a>
        </li>
    @endcan
    @can('matriz_bia_matriz')
        <li>
            <a href="{{ route('admin.analisis-impacto.matriz') }}">
                <div>
                    <i class="fas fa-border-none"></i><br>
                    Matriz BIA
                </div>
            </a>
        </li>
    @endcan

</ul>
