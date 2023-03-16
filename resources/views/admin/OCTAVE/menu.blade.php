<div class="col-12" style="margin-left:-15px;">
    <div class="nav nav-tabs" id="tabsEmpleado" role="tablist">
        <a class="nav-link {{ request()->is('admin/contenedores') || request()->is('admin/contenedores/*') ? 'active' : '' }}"
            href="{{ route('admin.contenedores.index',$matriz) }}">
            <i class="fas fa-box-open mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
            Contenedores
        </a>
        <a class="nav-link {{ request()->is('admin/activosInformacion') || request()->is('admin/activosInformacion/*') ? 'active' : '' }}"
            href="{{ route('admin.activosInformacion.index',$matriz) }}">
            <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
            Activos
        </a>
        <a class="nav-link {{ request()->is('admin/procesos-octave') || request()->is('admin/procesos-octave/*') ? 'active' : '' }}"
            href="{{ route('admin.procesos-octave.index',$matriz) }}">
            <i class="fas fa-project-diagram mr-2" style="font-size:20px;"></i>Procesos
        </a>
        {{-- <a class="nav-link"  href="{{route('admin.contenedores.index')}}"  >
            <i class="fas fa-camera-retro mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
           Escenarios
        </a> --}}

        <a class="nav-link {{ request()->is('admin/octave/arbol-riesgos') || request()->is('admin/octave/arbol-riesgos/*') ? 'active' : '' }}"
            href="{{ route('admin.octave.arbol-riesgos.index' ,$matriz) }}">
            <i class="fas fa-network-wired mr-2" style="font-size:20px;" style="text-decoration:none;"></i>
            Árbol de Riesgos
        </a>
        <a class="nav-link {{ request()->is('admin/octave-graficas') || request()->is('admin/octave-graficas/*') ? 'active' : '' }}"
            href="{{ route('admin.octave-graficas',$matriz) }}">
            <i class="fas fa-chart-bar mr-2" style="font-size:20px;" style="text-decoration:none;"></i>Gráficas
        </a>
    </div>
</div>
