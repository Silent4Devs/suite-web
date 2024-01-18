<style>
    .lds-facebook {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-facebook div {
        display: inline-block;
        position: absolute;
        left: 8px;
        width: 16px;
        background: rgb(24, 24, 24);
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }

    .lds-facebook div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }

    .lds-facebook div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }

    .lds-facebook div:nth-child(3) {
        left: 56px;
        animation-delay: 0;
    }

    @keyframes lds-facebook {
        0% {
            top: 8px;
            height: 64px;
        }

        50%,
        100% {
            top: 24px;
            height: 32px;
        }
    }
</style>
<style>
    .circle-total-evaluaciones {
        position: relative;
        top: 3px;
        padding: 5px;
        border-radius: 100%;
        background: #3086AF;
        width: 16px;
        height: 16px;
        font-size: 10px;
        display: inline-block;
        color: white;
    }

    .display-almacenando {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        margin-left: 0px;
        background: #0000000d;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .display-almacenando h1 {
        font-size: 50px;
    }

    .display-almacenando p {
        font-size: 30px;
    }

    .img-profile {
        width: 130px;
        height: 130px;
        clip-path: circle(65px at 50% 50%);
    }

    .img-profile-sm {
        width: 50px;
        clip-path: circle(25px at 50% 50%);
    }

    .img-profile-secondary {
        width: 50px;
        clip-path: circle(25px at 50% 50%);
    }

    p.new-badge {
        display: inline-block;
        padding: 3px;
        border-radius: 4px;
        font-size: 8px;
        font-weight: 600;
        margin: 0;
    }

    p.new-badge-primary {
        background: rgb(57, 60, 255);
        color: white;
    }

    p.new-badge-dark {
        background: rgb(29, 29, 29);
        color: white;
    }

    span.btn-lista-acciones {
        position: absolute;
        bottom: 26px;
        right: 23px;
        text-shadow: 2px 2px 14px black;
        cursor: pointer;
        font-size: 9px;
    }

    .lista-acciones {
        position: absolute;
        bottom: -18px;
        right: 0px;
        z-index: 1;
    }

    .lista-acciones a {
        padding: 2px;
        font-size: 10px;
        background: white;
        border: 1px solid #3e3e3e;
    }

    .lista-toggle {
        display: none;
        transition: all 0.5s ease-out;
    }

    hr.hr-custom-title {
        width: 100%;
        margin: 8px 0;
        border-top: 1px solid #1E94A8;
    }

    .title-info-personal {
        color: #3086AF;
        text-transform: capitalize;
    }

    h6.title-mi-info {
        color: #3e3e3e;
        text-transform: capitalize;
    }

    .cuadro_verde_con_before {
        background: #788BAC;
        position: absolute;
        width: 100%;
        height: 120px;
        top: 0;
        z-index: 0;
        overflow: hidden;
        border-top-right-radius: 6px;
        border-top-left-radius: 6px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cuadro_verde_con_before img {
        width: 100%;
    }

    .gorro {
        position: absolute;
        width: 60px;
        z-index: 1;
        left: 50%;
        margin-top: -20px;
        transform: rotate(25deg);
    }

    .regalo {
        width: 30px;
        position: absolute;
        top: 150px;
        right: 0px;
        animation: regalo 0.35s alternate infinite ease-out;
        cursor: pointer;
        opacity: 0.5;
    }

    .regalo:hover {
        transform: scale(1.15);
    }

    @keyframes regalo {
        0% {
            top: 150;
        }

        100% {
            top: 157px;
        }
    }

    .comentarios_felicidades {
        padding: 0;
        list-style: none;
        width: 100%;
    }

    .comentarios_felicidades li {
        width: 90%;
        margin: auto;
        background: rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .comentario_caja {
        background: #fff;
        padding: 10px;
        border-radius: 7px;
        color: #888;
        margin-top: 10px;
        max-height: 300px;
        overflow-y: auto;
    }

    .card_data_mis_datos {
        margin-bottom: 20px;
    }

    .card_margin_b_n {
        margin-bottom: 20px !important;
    }

    .pb-personzalizado,
    .card_margin_b_n {
        padding: 20px !important;
    }

    hr {
        margin-bottom: 0px !important;
    }

    .img_empleado_presentacion_mis_datos {
        clip-path: circle(70px at 50% 50%);
        width: 140px !important;
        height: 140px !important;
        min-width: 140px !important;
        max-width: 140px !important;

        max-height: 140px !important;
        min-height: 140px !important;
    }

    .img_empleado_competencia {
        clip-path: circle(70px at 50% 50%);
        width: 50px !important;
        height: 50px !important;
        min-width: 50px !important;
        max-width: 50px !important;

        max-height: 50px !important;
        min-height: 50px !important;
    }
</style>

<style>
    .logo {
        position: absolute;
        width: 150px;
        top: 25px;
        left: 330px;
        z-index: 1;
    }

    .pastel {
        z-index: -1;
    }
</style>


@php
if (!is_null($organizacion)) {
    $logotipo = $organizacion->logotipo;
} else {
    $logotipo = 'logotipo-tabantaj.png';
}
@endphp
@if ($cumpleaños_usuario != null && $cumpleaños_usuario == \Carbon\Carbon::now()->format('d-m'))
    @php
        $pastel = true;
    @endphp
    <div class="modal fade" id="modal_cumple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:1px solid #BFD6FF !important;">
                    <h6 class="modal-title" id="exampleModalLabel"><i class="fas fa-birthday-cake iconos-crear"></i>
                        Feliz Cumpleaños <strong>{{ $usuario->empleado->name }}</strong></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="color: #345183; font-size:13pt;" class="text-right"
                        title="
                @foreach ($cumpleaños_felicitados_like_usuarios as $usuarios_like) {{ $usuarios_like->felicitador->name }}&#013; @endforeach
            ">
                        <i class="fas fa-thumbs-up"></i> {{ $cumpleaños_felicitados_like_contador }}</div>

                    <ul class="comentarios_felicidades">
                        <li>
                            <strong>


                                <img class="img_empleado" src="{{ asset($logotipo) }}">
                                {{ $organizacion->empresa }}
                            </strong>
                            <div class="comentario_caja">
                                ¡Feliz cumpleaños <strong>{{ $usuario->empleado->name }}</strong>! a nombre de
                                <strong>{{ $organizacion->empresa }}</strong> te deseamos otro año de grandes
                                oportunidades, logros y crecimiento personal.
                            </div>
                        </li>
                        @foreach ($cumpleaños_felicitados_comentarios as $coment_cumple)
                            <li>
                                <strong><img class="img_empleado"
                                        src="{{ asset('storage/empleados/imagenes') }}/{{ $coment_cumple->felicitador ? $coment_cumple->felicitador->avatar : 'user.png' }}">
                                    {{ $coment_cumple->felicitador->name }}</strong>
                                <div class="comentario_caja">
                                    {!! html_entity_decode($coment_cumple->comentarios) !!}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@else
    @php
        $pastel = false;
    @endphp
@endif


<div class="card-body">
    <div class="row">
        <div id="Pastel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">
                        <img src="{{ asset($logotipo) }}" class="logo">
                        <img class="img-responsive pastel" src="{{ asset('img/pastel.gif') }}" style="width: 100%;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 card_data_mis_datos">
                        <div class="card card_margin_b_n"
                            style="position:relative; height: 480px !important; padding: 0 !important;">
                            @if ($cumpleaños_usuario != null && $cumpleaños_usuario == \Carbon\Carbon::now()->format('d-m'))
                                <img src="https://images.vexels.com/media/users/3/143347/isolated/preview/c418aa571078b11dcb69704acf1077c4-icono-de-sombrero-de-cumpleanos-3d.png"
                                    class="gorro">
                            @endif
                            <div class="cuadro_verde_con_before">
                                @if ($cumpleaños_usuario != null && $cumpleaños_usuario == \Carbon\Carbon::now()->format('d-m'))
                                    <img src="https://i.makeagif.com/media/1-22-2017/6A8xEd.gif">
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="text-center d-flex flex-column align-items-center"
                                    style="position:relative;">
                                    <img class="img_empleado_presentacion_mis_datos" style="position: relative;"
                                        src="{{ asset('storage/empleados/imagenes') }}/{{ $usuario->empleado ? $usuario->empleado->avatar : 'user.png' }}">
                                    <div class="mt-3">
                                        <h5 style="color: #2E2E2E; margin-top:42px;">{{ $usuario->empleado->name }}
                                        </h5>
                                        <p class="mb-1 text-secondary">{{ $usuario->empleado->puesto }}</p>
                                        <p class="text-muted font-size-sm">{{ $usuario->empleado->area->area }}</p>
                                        {{-- <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button> --}}
                                    </div>
                                    @if ($cumpleaños_usuario != null && $cumpleaños_usuario == \Carbon\Carbon::now()->format('d-m'))
                                        <img src="{{ asset('img/regalo.svg') }}" class="regalo" data-toggle="modal"
                                            data-target="#modal_cumple" title="Tus felicitaciones">
                                    @endif
                                    @can('mi_perfil_mis_datos_ver_perfil_profesional')
                                        @if ($usuario->empleado)
                                            @if ($usuario->empleado->puesto)
                                                <a href="{{ route('admin.miCurriculum', $usuario->empleado->id) }}"
                                                    style="">
                                                    Ver Perfil Profesional
                                                </a>
                                            @endif
                                        @endif
                                    @endcan
                                    @can('mi_perfil_mis_datos_ver_perfil_de_puesto')
                                        @if ($usuario->empleado)
                                            <a href="{{ route('admin.inicio-Usuario.perfil-puesto') }}" class="mt-2">
                                                Ver Perfil de Puesto
                                            </a>
                                        @endif
                                    @endcan
                                    @can('mi_perfil_mis_datos_ver_mi_expediente')
                                        @if ($usuario->empleado)
                                            <a href="{{ route('admin.inicio-Usuario.expediente', auth()->user()->empleado->id) }}"
                                                class="mt-2">
                                                Mi Expediente
                                            </a>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                        {{-- <div class="p-34 card card_margin_b_n" x-data="{show:false}">
                            <h5 class="mb-0"><i class="fas fa-award mr-2"></i>Mi Perfil Profesional
                                <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                        class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                            </h5>
                            <hr class="hr-custom-title">
                            <div class="row align-items-center" id="listaCompetenciaCV" x-show="show"
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                <div class="container text-center mt-1">

                                </div>
                            </div>
                        </div> --}}
                        @can('mi_perfil_mis_datos_ver_mi_equipo')
                            <div class="card" x-data="{ show: false }" style="padding:20px;">
                                <h5 class="mb-0"><i class="bi bi-people mr-2" style="transform:scale(1.15);"></i>Mi Equipo

                                    <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                            class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                </h5>
                                <hr class="hr-custom-title">
                                <div class="row align-items-center" id="listaEquipo" x-show="show"
                                    x-transition:enter.duration.500ms x-transition:leave.duration.400ms
                                    style="margin-top: 15px;">
                                    <div class="scroll_estilo" style="height: 500px; overflow:auto">
                                        @forelse ($equipo_a_cargo as $empleado)
                                            <div class="col-md-12">
                                                <div class="card" style="position:relative;">
                                                    <div class="card-body" style="position:relative">
                                                        <div class="text-center d-flex flex-column align-items-center">

                                                            <img class="img-fluid img-profile-sm"
                                                                style="position: relative;z-index: 1;"
                                                                src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                                            <div class="mt-3">
                                                                <h5 style="font-size:1vw;font-weight: bold">
                                                                    {{ $empleado->name }}
                                                                </h5>
                                                                {{-- <p class="mb-1 text-secondary">
                                                                    {{ $empleado->puesto }}
                                                                </p> --}}
                                                            </div>
                                                            <div>
                                                                <div class="row mb-2">
                                                                    <a href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                        target="_blank" class="col-4 text-success">
                                                                        <p class="m-0 fab fa-whatsapp"></p>
                                                                    </a>
                                                                    <a href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                        class="col-4">
                                                                        <p class="m-0 fas fa-mobile-alt"></p>
                                                                    </a>
                                                                    <a href="mailto:{{ $empleado->email }}"
                                                                        class="col-4 text-muted">
                                                                        <p class="m-0 fas fa-envelope"></p>
                                                                    </a>
                                                                </div>
                                                                <a class="btn btn-sm btn-light"
                                                                    style="font-size: 10px; width:150px;"
                                                                    href="{{ route('admin.ev360-objetivos-empleado.create', $empleado) }}">
                                                                    <i class="mr-1 fas fa-dot-circle"></i>Objetivos</a>
                                                                <a type="button"
                                                                    href="{{ route('admin.ev360-evaluaciones.evaluacionesDelEmpleado', $empleado) }}"
                                                                    class="btn btn-sm btn-light mt-2"
                                                                    style="font-size: 10px; width:150px"
                                                                    aria-current="true"><i class="fas fa-book"></i>
                                                                    Evaluaciones
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div
                                                            style="width:100%;height: 80px;position: absolute;top: 0;left: 0;background: #f1f1f1;z-index: 0;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            @foreach ($equipo_trabajo as $empleado)
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body" style="position:relative">
                                                            <div class="text-center d-flex flex-column align-items-center">

                                                                <img class="img-fluid img-profile-sm"
                                                                    style="position: relative;z-index: 1;"
                                                                    src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                                                <div class="mt-3">
                                                                    <h5 style="font-size:1vw;font-weight: bold">
                                                                        {{ $empleado->name }}
                                                                    </h5>
                                                                    {{-- <p class="mb-1 text-secondary">
                                                                    {{ $empleado->puesto }}
                                                                </p> --}}
                                                                </div>
                                                                <div class="row">
                                                                    <a href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                        target="_blank" class="col-4 text-success">
                                                                        <p class="m-0 fab fa-whatsapp"></p>
                                                                    </a>
                                                                    <a href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                        class="col-4">
                                                                        <p class="m-0 fas fa-mobile-alt"></p>
                                                                    </a>
                                                                    <a href="mailto:{{ $empleado->email }}"
                                                                        class="col-4 text-muted">
                                                                        <p class="m-0 fas fa-envelope"></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="width:100%;height: 80px;position: absolute;top: 0;left: 0;background: #f1f1f1;z-index: 0;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('mi_perfil_mis_datos_ver_mis_activos')
                            <div class="card card_margin_b_n" x-data="{ show: false }" style="padding:20px;">
                                <h5 class="mb-0"><i class="bi bi-laptop mr-2"></i>Mis Activos
                                    <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                            class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                </h5>
                                <hr class="hr-custom-title">
                                <div class="row align-items-center" id="listaEquipo" x-show="show"
                                    x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                    <div class="container" style="padding-top: 10px;">
                                        {{-- @if (is_null($activos)) --}}
                                        @if (count($activos) === 0)
                                            Sin activos asignados actualmente
                                        @else
                                            <div class="row" style="margin-top: 1px;">
                                                <div class="col-12 text-muted scroll_estilo" style="overflow:auto;">
                                                    <table id="dom"
                                                        class="table table-bordered w-100 datatable-glosario"
                                                        style="width: 100%; border: none !important;">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-bottom: none !important;">ID</th>
                                                                <th style="border-bottom: none !important;">Activo</th>
                                                                <th
                                                                    style="text-align: center !important; border-bottom: none !important;">
                                                                    N. Serie</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($activos as $activo)
                                                                <tr>
                                                                    <td style="vertical-align: middle;">
                                                                        {{ $activo->id }}
                                                                    </td>
                                                                    <td
                                                                        style="vertical-align: middle; text-align: left !important;">
                                                                        {{ $activo->nombreactivo }}</td>
                                                                    <td
                                                                        style="text-align: center !important; vertical-align: middle;">
                                                                        {{ $activo->descripcion }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('mi_perfil_mis_datos_ver_mis_competencias')
                            <div class="card card_margin_b_n" x-data="{ show: false }" style="padding:20px;">
                                <h5 class="mb-0"><i class="bi bi-bookmark-star mr-2"></i>Mis Competencias
                                    <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                            class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>

                                </h5>
                                <hr class="hr-custom-title">
                                <div class="row align-items-center" id="listaEquipo" x-show="show"
                                    x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                    <div class="container" style="padding-top: 10px;">
                                        @if (count($competencias) === 0)
                                            No se han definido competencias actualmente
                                        @else
                                            <div class="row" style="margin-top: 1px;">
                                                <div class="col-12 text-muted scroll_estilo" style=" max-height: 250px; overflow: auto;">
                                                    <table id="dom"
                                                        class="table table-bordered w-100 datatable-glosario"
                                                        style="width: 100%; border: none !important;">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-bottom: none !important;">Logo</th>
                                                                <th style="border-bottom: none !important;">Competencia
                                                                </th>
                                                                <th
                                                                    style="text-align: center !important; border-bottom: none !important;">
                                                                    Nivel&nbsp;Esperado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($competencias as $competencia)
                                                                @if ($competencia->competencia)
                                                                    <tr data-toggle="modal"
                                                                        data-target="#modal_competencia{{ $competencia->competencia->id }}"
                                                                        style="cursor: pointer;">
                                                                        <td style="vertical-align: middle;"><img
                                                                                class="img_empleado"
                                                                                style="transform: scale(0.7);"
                                                                                src="{{ $competencia->competencia->imagen_ruta }}">
                                                                        </td>
                                                                        <td
                                                                            style="vertical-align: middle; text-align: left !important;">
                                                                            {{ $competencia->competencia->nombre }}</td>
                                                                        <td
                                                                            style="text-align: center !important; vertical-align: middle;">
                                                                            {{ $competencia->nivel_esperado }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                    @if (count($competencias))
                        @foreach ($competencias as $competencia)
                            @if ($competencia->competencia)
                                <div id="modal_competencia{{ $competencia->competencia->id }}"
                                    class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header"
                                                style="display: flex; justify-content: space-between; align-items:center; color: #fff; background-color:#345183; font-size:20px;">
                                                <span><img class="img_empleado mr-4"
                                                        src="{{ $competencia->competencia->imagen_ruta }}">
                                                    <strong>{{ $competencia->competencia->nombre }}</strong></span>
                                                <span class="mr-2">Tipo:
                                                    {{ $competencia->competencia->tipo ? $competencia->competencia->tipo->nombre : '' }}</span>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mt-3">
                                                    <strong>Descripción: </strong>
                                                    <p style="text-align: justify;">
                                                        {{ $competencia->competencia->descripcion }}
                                                    </p>
                                                </div>

                                                <div>
                                                    <strong style="font-size: 15px;">Conductas</strong>

                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>Nivel</td>
                                                                <td>Conducta esperada</td>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if ($competencia->competencia->opciones)
                                                                @foreach ($competencia->competencia->opciones as $conducta)
                                                                    <tr>
                                                                        <td>{{ $conducta->ponderacion }}</td>
                                                                        <td>{!! htmlspecialchars_decode($conducta->definicion) !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="col-md-8">
                        <div class="card_data_mis_datos card" style="height: 480px !important;">
                            <div class="card-body" style="padding-bottom: 14px !important;">
                                <h5 class="mb-0 d-inline-block"><i class="bi bi-file-text mr-2"></i>Información
                                    General
                                </h5>
                                <hr class="hr-custom-title">
                                <div class="row"
                                    style="margin-top: 15px; color: #3086AF !important; font-weight:bold; font-size:14px;">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->n_empleado)
                                            <div class="col-3 title-info-personal">N° Empleado</div>
                                        @endif

                                        @if ($panel_rules->email)
                                            <div class="col-3 title-info-personal">Email</div>
                                        @endif
                                        @if ($panel_rules->fecha_ingreso)
                                            <div class="col-3 title-info-personal">Fecha Ingreso</div>
                                        @endif
                                        @if ($panel_rules->jefe_inmediato)
                                            <div class="col-3 title-info-personal">Jefe Inmediato</div>
                                        @endif
                                    @endif

                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->n_empleado)
                                            <div class="col-3 text-muted" style="font-size:12px; margin-top: 5px;">
                                                {{ $usuario->empleado->n_empleado }}</div>
                                        @endif
                                        @if ($panel_rules->email)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->email }}</div>
                                        @endif
                                        @if ($panel_rules->fecha_ingreso)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ \Carbon\Carbon::parse($usuario->empleado->antiguedad)->format('d-m-Y') }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->jefe_inmediato)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->supervisor ? $usuario->empleado->supervisor->name : 'Sin Jefe Inmediato' }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row"
                                    style="margin-top: 40px; color: #3086AF; font-weight:bold; font-size:14px;">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->area)
                                            <div class="col-3 title-info-personal">Área</div>
                                        @endif
                                        @if ($panel_rules->puesto)
                                            <div class="col-3 title-info-personal">Puesto</div>
                                        @endif
                                        @if ($panel_rules->sede)
                                            <div class="col-3 title-info-personal">Sede</div>
                                        @endif
                                        @if ($panel_rules->telefono)
                                            <div class="col-3 title-info-personal">Teléfono</div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->area)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->area ? $usuario->empleado->area->area : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->puesto)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->puesto ? $usuario->empleado->puesto : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->sede)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->sede ? $usuario->empleado->sede->sede : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->telefono)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->telefono ? $usuario->empleado->telefono : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row"
                                    style="margin-top: 40px; color: #3086AF; font-weight:bold; font-size:14px;">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->cumpleaños)
                                            <div class="col-3 title-info-personal">Cumpleaños</div>
                                        @endif
                                        @if ($panel_rules->perfil)
                                            <div class="col-3 title-info-personal">Perfil</div>
                                        @endif
                                        {{-- @if ($panel_rules->cumpleaños)
                                                                <div class="col-3 title-info-personal">Sede</div>
                                                            @endif --}}
                                    @endif
                                    @if ($panel_rules->genero)
                                        <div class="col-3 title-info-personal">Género</div>
                                    @endif
                                    @if ($panel_rules->estatus)
                                        <div class="col-3 title-info-personal">Estatus</div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($panel_rules->cumpleaños)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ \Carbon\Carbon::parse($usuario->empleado->cumpleaños)->format('d-m-Y') ?: 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->perfil)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->perfil ? $usuario->empleado->perfil->nombre : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->genero)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->genero ? $usuario->empleado->genero : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->estatus)
                                        <div class="col-3 text-muted text-uppercase" style="font-size:12px">
                                            {{ $usuario->empleado->estatus ? $usuario->empleado->estatus : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row"
                                    style="margin-top: 40px; color: #3086AF; font-weight:bold; font-size:14px;">
                                    @if ($panel_rules->direccion)
                                        <div class="col-3 title-info-personal">Dirección</div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($panel_rules->direccion)
                                        <div class="col-12 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->direccion ? $usuario->empleado->direccion : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            @can('mi_perfil_mis_datos_ver_mis_objetivos')
                                <div class="card_data_mis_datos col-sm-12">
                                    <div class="mb-0 card h-100">
                                        <div class="pb-personzalizado card-body scroll_estilo" x-data="{ show: false }">
                                            <div class="row">
                                                <div class="col-5">
                                                    <h5 class="mb-0"><i class="bi bi-bullseye mr-2"></i>Mis
                                                        Objetivos
                                                    </h5>
                                                </div>
                                                <div class="col-7" style="font-size: 15px;text-align: end">
                                                    <a class="mr-1 text-dark"
                                                        href="{{ route('admin.ev360-objetivos-empleado.show', ['empleado' => auth()->user()->empleado->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if (auth()->user()->empleado)
                                                        <a class="mr-1 text-dark"
                                                            href="{{ route('admin.ev360-objetivos-empleado.create', auth()->user()->empleado->id) }}"><i
                                                                class="fas fa-pencil"></i></a>
                                                    @endif
                                                    <span style="cursor: pointer" @click="show=!show"><i class="fas"
                                                            :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                                </div>
                                            </div>
                                            <hr class="hr-custom-title">
                                            <div class="scroll_estilo"
                                                style="padding-top: 25px; max-height: 200px; overflow: auto; "
                                                x-show="show" x-transition:enter.duration.500ms
                                                x-transition:leave.duration.400ms>
                                                @foreach ($mis_objetivos as $objetivo)
                                                    <div class="card" style="position:relative">
                                                        <div class="card-body"
                                                            style="z-index: 1;margin-top: 23px;margin-bottom: -12px; padding: 20px !important;">
                                                            <div><strong>Meta:</strong>
                                                                <span>{{ $objetivo->objetivo->meta }}
                                                                    {{ $objetivo->objetivo->metrica->definicion }}</span>
                                                                <span class="px-2">|</span>
                                                                <span>
                                                                    <span style="font-weight: bold">KPI:</span>
                                                                    {{ $objetivo->objetivo->KPI }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            style="width: 100%;height: 38px;position: absolute;top: 0;left: 0;background: #f1f1f1;z-index: 0;">
                                                            <div>
                                                                <img src="{{ $objetivo->objetivo->tipo->imagen_ruta }}"
                                                                    class="d-inline-block"
                                                                    style="clip-path: circle(9px at 50% 50%);width: 18px;position: absolute;top: 9px;left: 20px;">
                                                                <h6 class="d-inline-block"
                                                                    style="padding-left: 41px;font-weight: bold;margin-top: 10px;">
                                                                    {{ $objetivo->objetivo->nombre }}</h6>
                                                                <span
                                                                    style="float: right;margin-top: 12px;margin-right: 7px;"
                                                                    class="badge badge-success">{{ $objetivo->objetivo->tipo->nombre }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('mi_perfil_mis_datos_ver_mi_autoevaluacion')
                                <div class="card_data_mis_datos col-sm-12">
                                    <div class="mb-0 card h-100 mt-1">
                                        <div class="pb-personzalizado card-body" x-data="{ show: false }"
                                            style="padding-top:17px !important; padding-bottom:17px !important;">
                                            <h5 class="mb-0 d-inline-block"><i class="bi bi-person-badge mr-2"></i>Mi
                                                Autoevaluación
                                                @if (!is_null($mis_evaluaciones) && is_object($mis_evaluaciones))
                                                    @if (isset($mis_evaluaciones->evaluado))
                                                        @if (!$mis_evaluaciones->evaluado)
                                                            <div class="circle-total-evaluaciones"
                                                                style="top:-5px !important;">
                                                                <span style="position: absolute;top: 3px;">1</span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            </h5>

                                            @if ($last_evaluacion)
                                                @include('admin.inicioUsuario.info_card_evaluacion')
                                            @endif
                                            <hr class="hr-custom-title">
                                            <div id="evaluacionesRealizar" x-show="show"
                                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                                <div class="card" style="position:relative; margin-top:25px;">
                                                    <div class="card-body" style="z-index: 1;">
                                                        @if ($last_evaluacion)
                                                            <div class="text-center" style="margin-top:20px;">
                                                                <a class="btn btn-sm btn-light"
                                                                    href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $last_evaluacion->id, 'evaluado' => auth()->user()->empleado->id, 'evaluador' => auth()->user()->empleado->id]) }}">
                                                                    Autoevaluarme</a>
                                                                <a class="btn btn-sm btn-light"
                                                                    href="{{ route('admin.ev360-evaluaciones.misEvaluaciones', ['evaluacion' => $last_evaluacion->id, 'evaluado' => auth()->user()->empleado->id]) }}">Ver
                                                                    mis Autoevaluaciones</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div
                                                        style="width: 100%;height: 38px;position: absolute;top: 0;left: 0;background: #f1f1f1;z-index: 0;">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('mi_perfil_mis_datos_ver_mis_evaluaciones_a_realizar')
                                <div class="card_data_mis_datos col-sm-12">
                                    <div class="mb-0 card h-100 mt-1">
                                        <div class="pb-personzalizado mb-0 card-body" x-data="{ show: false }"
                                            style="padding-top:17px !important; padding-bottom:17px !important;">
                                            <h5 class="mb-0 d-inline-block"><i
                                                    class="bi bi-person-badge-fill mr-2"></i>Evaluaciones a
                                                Realizar
                                                @if ($evaluaciones->count() > 0)
                                                    <div class="circle-total-evaluaciones" style="top:-5px !important;">
                                                        <span
                                                            style="position: absolute;top: 3px;">{{ $evaluaciones->count() }}</span>
                                                    </div>
                                                @endif
                                            </h5>
                                            @if ($last_evaluacion)
                                                @include('admin.inicioUsuario.info_card_evaluacion')
                                            @endif
                                            <hr class="hr-custom-title">

                                                <div id="evaluacionesRealizar" class="row" x-show="show"
                                                    x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                                    @if ($evaluaciones->count())
                                                        <div class="text-right col-12">
                                                            @if ($last_evaluacion)
                                                                @if ($esLider)
                                                                    <div class="col-12">
                                                                        <a href="{{ route('admin.ev360-evaluaciones.evaluacionesDeMiEquipo', ['evaluacion' => $last_evaluacion, 'evaluador' => auth()->user()->empleado->id]) }}"
                                                                            class="btn btn-xs btn-light mt-3">Evaluaciones de
                                                                            mi equipo</a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        @foreach ($evaluaciones as $evaluacion)
                                                            <div class="col-md-6">
                                                                <div class="card" style="margin: ; margin-top:25px;">
                                                                    <div class="card-body"
                                                                        style="position:relative; padding: 10px !important;">
                                                                        <div
                                                                            class="text-center d-flex flex-column align-items-center">

                                                                            <img class="img-fluid img-profile-sm"
                                                                                style="position: relative;z-index: 1;"
                                                                                src="{{ asset('storage/empleados/imagenes') }}/{{ $evaluacion->empleado_evaluado->avatar }}">
                                                                            <div class="mt-3">
                                                                                <h5 style="font-size:1vw;font-weight: bold">

                                                                                    {{ Str::limit($evaluacion->empleado_evaluado->name, 20, '...') }}
                                                                                </h5>
                                                                                <p class="mb-1 text-secondary">

                                                                                    {{ Str::limit($evaluacion->empleado_evaluado->puesto, 20, '...') }}
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <a class="btn btn-sm btn-light"
                                                                                    href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->empleado_evaluado, 'evaluador' => $evaluacion->evaluador]) }}">
                                                                                    Evaluar</a>
                                                                                {{-- @if ($evaluacion->empleado_evaluado->supervisor)
                                                                                            @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->supervisor->id)
                                                                                                <span
                                                                                                    style="position: absolute;top: 7px;z-index: 1;right: 7px;"
                                                                                                    class="badge badge-success">Eres su
                                                                                                    supervisor</span>
                                                                                                <span
                                                                                                    class="btn btn-sm btn-light sendInvitacion">
                                                                                                    <i data-evaluacion={{ $evaluacion->evaluacion->id }}
                                                                                                        data-evaluado={{ $evaluacion->empleado_evaluado->id }}
                                                                                                        data-evaluador={{ $evaluacion->evaluador->id }}
                                                                                                        title="Solicitar reunión"
                                                                                                        class="fas fa-envelope-open-text"
                                                                                                        style="font-size:11px;"></i>
                                                                                                    Reunión
                                                                                                </span>
                                                                                            @endif
                                                                                        @endif --}}
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            style="width:100%;height: 50px;position: absolute;top: 0;left: 0;background: #f1f1f1;z-index: 0;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    {{-- @foreach ($evaluaciones as $evaluacion)
                                                                    <small>{{ $evaluacion->empleado_evaluado->name }}
                                                                        @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->id)
                                                                            <span class="badge badge-primary">Autoevaluación</span>
                                                                        @endif
                                                                        @if ($evaluacion->empleado_evaluado->supervisor)
                                                                            @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->supervisor->id)
                                                                                <span class="badge badge-success">Supervisor</span>
                                                                                <i data-evaluacion={{ $evaluacion->evaluacion->id }}
                                                                                    data-evaluado={{ $evaluacion->empleado_evaluado->id }}
                                                                                    data-evaluador={{ $evaluacion->evaluador->id }}
                                                                                    title="Solicitar reunión"
                                                                                    class="fas fa-envelope-open-text sendInvitacion"
                                                                                    style="font-size:11px;"></i>
                                                                            @endif
                                                                        @endif
                                                                    </small>
                                                                    <a
                                                                        href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->empleado_evaluado, 'evaluador' => $evaluacion->evaluador]) }}"><i
                                                                            class="fas fa-link" style="font-size:11px;"></i></a>
                                                                    @if ($evaluacion->evaluacion->include_competencias)
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                                role="progressbar"
                                                                                style="width: {{ $evaluacion->progreso_competencias }}%;"
                                                                                aria-valuenow="{{ $evaluacion->progreso_competencias }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ $evaluacion->progreso_competencias }}%
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if ($evaluacion->evaluacion->include_objetivos)
                                                                        <div class="mt-2 progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                                role="progressbar"
                                                                                style="width: {{ $evaluacion->progreso_objetivos }}%;"
                                                                                aria-valuenow="{{ $evaluacion->progreso_objetivos }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ $evaluacion->progreso_objetivos }}%
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach --}}
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="invitacionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="invitacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invitacionModalLabel"><i class="mr-2 fas fa-plus"></i>Crear Reunión
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.ev360-evaluaciones.invitacion-reunion-evaluacion') }}"
                    id="formInvitacion">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Nombre<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nombre">
                            <small class="errores error_nombre text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha Inicio<span class="text-danger">*</span></label>
                            <input class="form-control" type="datetime-local" name="fecha_inicio">
                            <small class="errores error_fecha_inicio text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha Fin<span class="text-danger">*</span></label>
                            <input class="form-control" type="datetime-local" name="fecha_fin">
                            <small class="errores error_fecha_fin text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="1"></textarea>
                            <small class="errores error_descripcion text-danger"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnEnviarInvitacion">Enviar</button>
            </div>
            <div class="display-almacenando row" id="displayAlmacenandoUniversal" style="display: none">
                <div class="col-12">
                    <h1>
                        <div class="lds-facebook">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>
    </div>

</div>
@section('scripts')
    @parent
    <script>
        let pastel = @json($pastel);
        if (pastel) {
            $(window).on('load', function() {
                if (!window.sessionStorage.getItem("mostrarModal")) {
                    window.sessionStorage.setItem("mostrarModal", "no");
                    $('#Pastel').modal('show');
                }
            });
        }
    </script>
    <script>
        let listaAcciones = document.getElementById('listaEquipo');
        listaAcciones.addEventListener('click', function(e) {
            // document.getElementById('listaAcciones').classList.toggle('lista-toggle');
            if (e.target && e.target.tagName == 'I') {
                e.preventDefault();
                e.target.parentNode.nextElementSibling.classList.toggle('lista-toggle');
            } else {
                console.log(e.target);
            }
        })
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('evaluacionesRealizar').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('sendInvitacion')) {
                    e.preventDefault();
                    const evaluacion = e.target.getAttribute('data-evaluacion');
                    const evaluado = e.target.getAttribute('data-evaluado');
                    const evaluador = e.target.getAttribute('data-evaluador');
                    $('#invitacionModal').modal('show');
                    // e.target.parentNode.nextElementSibling.classList.toggle('lista-toggle');

                    $('#btnEnviarInvitacion').replaceWith($('#btnEnviarInvitacion')
                        .clone()); //Evitar creacion multiple de eventos click
                    document.getElementById('btnEnviarInvitacion').addEventListener('click', function(e) {
                        e.preventDefault();
                        limpiarErrores();
                        mostrarValidando();
                        let formulario = document.getElementById('formInvitacion');
                        let formData = new FormData(formulario);
                        formData.append('evaluacion', evaluacion);
                        formData.append('evaluado', evaluado);
                        formData.append('evaluador', evaluador);
                        $.ajax({
                            type: "POST",
                            url: formulario.getAttribute('action'),
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function(response) {
                                toastr.success('Enlace de reunión enviado con éxito');
                                $('#invitacionModal').modal('hide');
                                formulario.reset();
                                ocultarValidando();
                            },
                            error: function(request, status, error) {
                                document.querySelectorAll('.errors').forEach(error => {
                                    error.innerHTML = "";
                                });
                                ocultarValidando();
                                $.each(request.responseJSON.errors, function(
                                    indexInArray, valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`small.error_${indexInArray}`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    })
                }
            });
        })

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errores');
            errores.forEach(error => {
                error.innerHTML = "";
            });
        }

        function mostrarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'grid';
        }

        function ocultarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'none';
        }
    </script>
@endsection
