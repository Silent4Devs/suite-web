@extends('layouts.admin')
@section('content')

    <style type="text/css">
        body {
            background-color: #fff;
        }

        .info-personal .caja_img_perfil {
            border-radius: 100px;
            height: 100px;
            width: 100px;
            box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.4);
            margin: auto;
            margin-top: -50px;
            margin-bottom: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-personal img {
            height: 100px;
            clip-path: circle(50px at 50% 50%);
        }

        .info-personal .cards {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 8px;
        }



        table td i {
            font-size: 17pt;
            cursor: pointer;
            margin: 3px;
            color: #00abb2;
        }

        table td i:hover {
            opacity: 0.8;
        }

        td.opciones_iconos {
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_filter {
            overflow: hidden;
        }

        .caja_botones_secciones a {
            position: relative;
        }

        .caja_botones_secciones a span {
            position: absolute;
            right: 0;
            top: 0;
            width: 20px;
            height: 20px;
            background-color: #FF5252;
            color: #fff;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -5px;
            margin-right: -5px;
            z-index: 1;
        }

        .caja_botones_menu a{
            outline: none;
        }

    </style>

    @include('partials.flashMessages')

    <div id="inicio_usuario" class="mb-5 row" style="">
        {{-- <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                <div class="caja_img_perfil">
                    <img
                        src="{{ asset('storage/empleados/imagenes') }}/{{ $usuario->empleado ? $usuario->empleado->foto : 'user.png' }}">
                </div>
                <h5>{{ $usuario->empleado ? $usuario->empleado->name : $usuario->name }}</h5>
                <p>{{ $usuario->empleado ? ($usuario->empleado->puesto != null ? $usuario->puesto : 'Puesto no asignado') : '' }}
                </p>

            </div>
            <h4 class="mt-3" style="font-size:15pt">Avisos de publicaciones </h4>
            <hr>
            <h6>Documentos Publicados ({{ count($documentos_publicados) }})</h6>
            <ul class="list-group">
                @foreach ($documentos_publicados as $documento)
                    <a href="{{ route('admin.documentos.renderViewDocument', $documento->id) }}"
                        class="list-group-item cards text-dark">
                        <i class="mr-1 fas fa-file-pdf text-danger"></i>
                        {{ Str::limit($documento->codigo . ' - ' . $documento->nombre . '', 50, '...') }}
                        <div>
                            <span class="badge badge-dark" style="text-transform: capitalize">{{ $documento->tipo }}</span>
                            @if ($documento->macroproceso_id)
                                <span class="badge badge-primary"
                                    style="text-transform: capitalize">{{ $documento->macroproceso->nombre }}</span>
                            @endif
                            @if ($documento->proceso_id)
                                <span class="badge badge-success"
                                    style="text-transform: capitalize">{{ $documento->proceso->nombre }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </ul>
        </div> --}}
        <div class="col-lg-12 row caja_botones_secciones">
            @if ($usuario->empleado)
                <div class="col-12 caja_botones_menu">
                    <a href="#" id="datos" data-tabs="s_misDatos" class=""><i class="fas fa-user-circle"></i>
                        Mis Datos</a>
                    <a href="#" id="calendario" data-tabs="s_calendario"><i class="fas fa-calendar-alt"></i>
                        Calendario</a>
                    <a href="#" id="actividades" data-tabs="s_actividades">
                        @if ($contador_actividades)
                            <span>{{ $contador_actividades }}</span>
                        @endif
                        <i class="fas fa-stopwatch"></i>Actividades
                    </a>
                    <a href="#" id="aprobaciones" data-tabs="s_aprobaciones">
                        @if ($contador_revisiones)
                            <span>{{ $contador_revisiones }}</span>
                        @endif
                        <i class="fas fa-check"></i>Aprobaciones
                    </a>
                    {{-- <a href="#" data-tabs="evaluaciones">
                        @if ($contador_revisiones)
                            <span>{{ $contador_revisiones }}</span>
                        @endif
                        <i class="fas fa-check"></i>Evaluaciones
                    </a> --}}
                    <a href="#" id="capacitaciones" data-tabs="s_capacitaciones">
                        @if ($contador_recursos)
                            <span>{{ $contador_recursos }}</span>
                        @endif
                        <i class="fas fa-chalkboard-teacher"></i>Capacitaciones
                    </a>
                    <a href="#" id="reportes" data-tabs="s_reportes"><i class="fas fa-clipboard-list"></i>Reportes</a>
                </div>
            @endif
            <div class="caja_caja_secciones">
                @if ($usuario->empleado)
                    <div class="caja_secciones">
                        <section id="s_misDatos" data-id="datos" class="">
                            @include('admin.inicioUsuario.mis-datos')
                        </section>
                        <section id="s_calendario" data-id="calendario">
                            @include('admin.inicioUsuario.calendario')
                        </section>
                        <section id="s_actividades" data-id="actividades">
                            @include('admin.inicioUsuario.actividades')
                        </section>
                        <section id="s_aprobaciones" data-id="aprobaciones">
                            @include('admin.inicioUsuario.aprobaciones')
                        </section>
                        {{-- <section id="evaluaciones">
                            @include('admin.inicioUsuario.evaluaciones')
                        </section> --}}
                        <section id="s_capacitaciones" data-id="capacitaciones">
                            @include('admin.inicioUsuario.capacitaciones')
                        </section>
                        <section id="s_reportes" data-id="reportes">
                            @include('admin.inicioUsuario.reportes')
                        </section>
                    </div>
                @else
                    @include('admin.inicioUsuario.agenda')
                @endif
            </div>

        </div>
    </div>
@endsection


@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let tabs=document.querySelectorAll('.tabs');
            tabs.forEach(tab => {
                if(tab.classList.contains('btn_activo')){
                    tab.classList.remove('btn_activo')
                }
            });
            let cajas=document.querySelectorAll('.caja');
            cajas.forEach(caja => {
                if(caja.classList.contains('caja_tab_reveldada')){
                    caja.classList.remove('caja_tab_reveldada')
                }
            });

            let idActual=window.location.hash.replace('#','');
            document.getElementById(idActual).classList.add('btn_activo');
            document.querySelector(`[data-id="${idActual}"]`).classList.add('caja_tab_reveldada');
            setTimeout(() => {
                window.scrollTo(0,0);
                console.log('scroll')
            }, 1 );
        })
    </script>

@endsection
