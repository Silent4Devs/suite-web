@section('styles')
    <style>
        .menu-slider {
            width: 900px;
            color: #306BA9;
            margin: 0px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-menu-ar {
            border: none;
            outline: none;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90px;
            color: #698eb3;
            background-color: rgba(0, 0, 0, 0);
        }

        .caja-items-menu-slider {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 50px;
            padding: 20px 0px;

            overflow: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .item-ms {
            scroll-snap-align: center;
            min-width: 68px;
            /* height: 68px; */
        }

        .item-ms a {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
            color: #306BA9;
            text-decoration: none !important;
            padding-top: 6px;
        }

        .item-ms span {
            font-size: 10px;
            text-align: center;
            margin-top: 7px;
        }

        .item-ms i {
            font-size: 55px;
            margin-top: 7px;
        }

        .item-ms.active {
            transform: scale(1.25);
            border-radius: 16px;
            background-color: #b3d3f3;
        }

        .caja-items-menu-slider::-webkit-scrollbar {
            width: 0px;
            height: 0px;
        }
    </style>
@endsection
<div class="menu-slider">
    <button class="btn-menu-ar" onclick="menuSileder('retreat');">
        <i class="material-symbols-outlined">arrow_back_ios</i>
    </button>
    <div class="caja-items-menu-slider">
        {{-- @can('control_documentar_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.documentos.index') }}">
                    <i class="material-symbols-outlined">description</i>
                    <span>Documentos</span>
                </a>
            </div>
        @endcan
        @can('escuela_estudiante')
            <div class="item-ms">
                <a href="{{ asset('/admin/mis-cursos') }}">
                    <i class="material-symbols-outlined">school</i>
                    <span>Capacitaciones</span>
                </a>
            </div>
        @endcan
        @can('mi_perfil_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.solicitud') }}">
                    <i class="material-symbols-outlined">assignment_turned_in</i>
                    <span>Solicitudes</span>
                </a>
            </div>
        @endcan --}}
        {{-- @can('mi_perfil_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.inicio-Usuario.index') }}">
                    <i class="material-symbols-outlined">account_circle</i>
                    <span>Perfil</span>
                </a>
            </div>
        @endcan
        @can('timesheet_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.timesheet-inicio') }}">
                    <i class="material-symbols-outlined">date_range</i>
                    <span>Timesheet</span>
                </a>
            </div>
        @endcan
        @can('calendario_organizacional_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.systemCalendar') }}">
                    <i class="material-symbols-outlined">calendar_today</i>
                    <span>Calendario</span>
                </a>
            </div>
        @endcan
        @can('katbol_requisiciones_acceso')
            <div class="item-ms">
                <a href="{{ asset('contract_manager/requisiciones') }}">
                    <i class="material-symbols-outlined">contract</i>
                    <span>Requisiciones </span>
                </a>
            </div>
        @endcan --}}
        @can('mi_organizacion_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.organizacions.index') }}">
                    <i class="material-symbols-outlined">corporate_fare</i>
                    <span>Organización</span>
                </a>
            </div>
        @endcan
        @can('sedes_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.sedes.index') }}">
                    <i class="material-symbols-outlined">home_pin</i>
                    <span>Sedes</span>
                </a>
            </div>
        @endcan
        @can('crear_area_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.areas.index') }}">
                    <i class="material-symbols-outlined">mitre</i>
                    <span>Áreas</span>
                </a>
            </div>
        @endcan
        @can('portal_de_comunicaccion_acceder')
            <div class="item-ms active">
                <a href="{{ route('admin.portal-comunicacion.index') }}">
                    <i class="material-symbols-outlined">home</i>
                    <span>Inicio</span>
                </a>
            </div>
        @endcan
        @can('documentos_publicados_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.documentos.publicados') }}">
                    <i class="material-symbols-outlined">description</i>
                    <span>Documentos Publicados</span>
                </a>
            </div>
        @endcan
        @can('politica_sistema_gestion_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.politica-sgsis/visualizacion') }}">
                    <i class="material-symbols-outlined">local_library</i>
                    <span>Políticas</span>
                </a>
            </div>
        @endcan
        @can('comformacion_comite_seguridad_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.comiteseguridads.index') }}">
                    <i class="material-symbols-outlined">partner_exchange</i>
                    <span>Comités</span>
                </a>
            </div>
        @endcan
        @can('portal_comunicacion_mostrar_mapa_de_procesos')
            <div class="item-ms">
                <a href="{{ route('admin.procesos.mapa') }}">
                    <i class="material-symbols-outlined">flowsheet</i>
                    <span>Mapa de procesos</span>
                </a>
            </div>
        @endcan
        @can('portal_comunicacion_mostrar_reportar')
            <div class="item-ms">
                <a href="{{ asset('admin/portal-comunicacion/reportes') }}">
                    <i class="material-symbols-outlined">flag</i>
                    <span>Reportar</span>
                </a>
            </div>
        @endcan
        @can('organigrama_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.organigrama.index') }}">
                    <i class="material-symbols-outlined">schema</i>
                    <span>Organigrama</span>
                </a>
            </div>
        @endcan
        @can('analisis_foda_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.foda-organizacions') }}">
                    <i class="material-symbols-outlined">border_all</i>
                    <span>FODA</span>
                </a>
            </div>
        @endcan
        @can('portal_comunicacion_mostrar_directorio')
            <div class="item-ms">
                <a href="{{ route('admin.directorio.index') }}">
                    <i class="material-symbols-outlined">person_book</i>
                    <span>Directorio</span>
                </a>
            </div>
        @endcan
        @can('determinacion_alcance_acceder')
            <div class="item-ms">
                <a href="{{ route('admin.alcance-sgsis/visualizacion') }}">
                    <i class="material-symbols-outlined">table_chart_view</i>
                    <span>Alcances</span>
                </a>
            </div>
        @endcan
    </div>
    <button class="btn-menu-ar" onclick="menuSileder('advance');">
        <i class="material-symbols-outlined">arrow_forward_ios</i>
    </button>
</div>
<script>
    function menuSileder(tipo) {
        if (tipo == 'advance') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft += 100;
        }
        if (tipo == 'retreat') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft -= 100;
        }
    }
</script>
