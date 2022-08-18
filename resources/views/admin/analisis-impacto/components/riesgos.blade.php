<ul class="mt-2">
    @can('amenazas_acceder')
        <li>
            <a href="{{ route('admin.analisis-impacto.index') }}">
                <div>
                    <i class="fas fa-clipboard-list"></i><br>
                    Cuestionarios
                </div>
            </a>
        </li>
    @endcan
    @can('vulnerabilidades_acceder')
        <li>
            <a href="{{ route('admin.vulnerabilidads.index') }}">
                <div>
                    <i class="fas fa-border-none"></i><br>
                  Matriz BIA
                </div>
            </a>
        </li>
    @endcan
   
</ul>
