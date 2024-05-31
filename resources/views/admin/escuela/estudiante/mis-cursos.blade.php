@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/escuela/mis-cursos.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('centro-atencion') }} --}}

    {{-- <h5 class="titulo_general_funcion">Centro de Atención</h5> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @include('admin.escuela.estudiante.menu-side', ['usuario' => $usuario])

    <div class="card" style="max-height: 183px;">
        <img src="{{ asset('img/escuela/imagenfondo.webp') }} " class="card-img" alt="Imagen"
            style="height: 183px; border-radius: 8px; ">
        <div class="card-body" style="position: absolute; top: 0; left: 0; width: 100%; color: #fff;">
            <!-- Contenido del card-body -->
            <h2 style="font-size: 24px;">Bienvenido al Centro de Capacitación</h2>
            <p style="font-size: 17px;">
                Aprender te mantiene a la vanguardia. Consigue las habilidades más demandadas para potenciar tu
                crecimiento.<br>
                En nuestra plataforma, encontrarás una amplia variedad de cursos online de alta calidad, diseñados para
                ayudarte a alcanzar tus objetivos.
            </p>
        </div>
    </div>

    <h3 class="title-main-cursos">Continuar aprendiendo</h3>

    <div class="card last-course">
        <div class="row g-0">
            <div class="col-md-4" style="padding-left:0px; padding-right:0px; ">
                <img src="{{ asset($lastCourse->cursos->image->url) }}" alt="Imagen" class="card-img"
                    style="min-height: 225px;">
            </div>
            <div class="col-md-5">
                <div class="card-body" style="padding-left:0px; padding-right:0px;">
                    <h5 class="card-title" style="color:#000000;">{{ $lastCourse->cursos->title }}</h5>
                    @if ($lastCourse->cursos->instructor)
                        <div class="d-flex align-items-center gap-1 my-4">
                            <div class="img-person">
                                <img src="{{ $lastCourse->cursos->instructor->avatar_ruta }}"
                                    alt="{{ $lastCourse->cursos->instructor->name }}">
                            </div>
                            <span class="course-teacher"> {{ $lastCourse->cursos->instructor->name }} </span>
                        </div>
                    @else
                        <p class="course-teacher">Instructor no asignado </p>
                    @endif

                    <div class="caja-info-card-advance">
                        <p class="title-advance">{{ $lastCourse->advance . '%' }} completado</p>
                        <div class="curso-progreso-barra">
                            <div class="indicador-progreso-barra" style="width: {{ $lastCourse->advance . '%' }};"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-center">
                <a href="{{ route('admin.curso-estudiante', $lastCourse->cursos->id) }}" class="btn btn-last-course">
                    Reanudar Curso
                </a>

            </div>
        </div>
    </div>


    <h3 class="title-main-cursos" style="margin-top: 30px;">Mis Cursos</h3>

    <div class="caja-cards-mis-cursos">
        @foreach ($lastThreeCourse as $cu)
            @if ($cu->status != '4')
                @php
                    $instructor = $cu->cursos->instructor;
                @endphp
                <div class="card card-body mi-curso">
                    @if (isset($cu->cursos->image->url))
                        <img src="{{ asset($cu->cursos->image->url) }}" alt="" class="card-img"
                            style="min-height: 225px; border-radius: 12px 12px 0px 0px;">
                        <div class="caja-info-card-mc">
                            <p class="course-title">
                                {{ $cu->cursos->title }}
                            </p>
                            @if ($instructor)
                                <span>Un curso de: </span><br>
                                <div class="d-flex align-items-center gap-1 mt-2">
                                    <div class="img-person">
                                        <img src="{{ $lastCourse->cursos->instructor->avatar_ruta }}"
                                            alt="{{ $lastCourse->cursos->instructor->name }}">
                                    </div>
                                    <span class="course-teacher"> {{ $lastCourse->cursos->instructor->name }} </span>
                                </div>
                            @else
                                <p class="course-teacher">Instructor no asignado </p>
                            @endif

                            <div class="caja-info-card-advance">
                                <p class="title-advance">{{ $cu->advance . '%' }} completado</p>
                                <div class="curso-progreso-barra">
                                    <div class="indicador-progreso-barra" style="width: {{ $cu->advance . '%' }};"></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.curso-estudiante', $cu->cursos->id) }}"
                                    class="btn btn-mi-course">Ir a
                                    mi
                                    curso</a>
                            </div>

                        </div>
                    @else
                        <p>Sin imagen de curso</p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.courses-inscribed') }}"
            style="display: inline-block; vertical-align: middle; color:#006DDB; margin-top:21px;">
            <span class="material-symbols-outlined" style="vertical-align: middle;">
                add
            </span>
            Ver más cursos
        </a>
    </div>
    </div>

    @livewire('escuela.course-index')
@endsection

@section('scripts')
@endsection
