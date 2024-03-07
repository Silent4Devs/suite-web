@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('centro-atencion') }} --}}

    {{-- <h5 class="titulo_general_funcion">Centro de Atención</h5> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .caja-blue-curso {
            box-shadow: 0px 3px 6px #00000029;
            border-radius: 8px;
            opacity: 1;
        }

        .caja-cards-mis-cursos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .caja-info-card-mc {
            padding: 0px 15px;
        }

        .card.mi-curso {
            max-width: 418px;
            height: 421px;
            padding: 0px;
            padding-bottom: 15px;
            box-shadow: 0px 1px 4px #00000024;
            border: 1px solid #F1F1F1;
            border-radius: 16px;
            opacity: 1;
        }

        .card.mi-curso img {
            width: 100%;
        }

        .card.mi-curso p {
            margin: 0px;
            margin-top: 15px;
        }

        .caja-img-mi-curso {
            width: 100%;
            height: 150px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .curso-progreso-barra {
            height: 10px;
            border-radius: 100px;
            background-color: #E2E2E2;
            margin-top: 6px;
            position: relative;
        }

        .indicador-progreso-barra {
            position: absolute;
            background-color: #006DDB;
            border-radius: 100px;
            height: 100%;
        }

        .mis-c-catalogo-cursos {}

        .caja-selects-catalogo {
            margin-top: 30px;
        }

        .caja-selects-catalogo select {
            background-color: #fff;
            color: #6A6A6A;
            border-radius: 6px;
            padding: 10px 20px;
            margin-right: 20px;
            border: 1px solid #e9e9e9;
        }

        .caja-selects-catalogo form {
            display: inline;
        }

        .mi-c-catalogo-card {
            width: 320px;
        }

        .title-main-cursos {
            font-size: 18px;
            color: #345183;
        }

        .btn-mas-info-c {
            background-color: #1E94A8;
            color: #fff;
            font-size: 12px;
            padding: 10px 25px;
        }

        .btn-mas-info-c:hover {
            color: #fff;
        }

        .course-teacher {
            text-align: left;
            font: normal normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
            margin-top: 2px !important;
        }
        .course-title{
            text-align: left;
            font: normal normal medium 16px/11px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .btn-mi-course {
            background: #E9F1FF 0% 0% no-repeat padding-box;
            border: 1px solid #25A0E2;
            border-radius: 4px;
            opacity: 1;
            width: 365px;
            height: 44px;
            margin-top: 39px;
        }

        .curso-progreso-barra {
            height: 10px;
            border-radius: 100px;
            background-color: #E2E2E2;
            margin-top: 6px;
            position: relative;
        }

        .indicador-progreso-barra {
            position: absolute;
            background-color: #A3C5FF;
            /* border-radius: 100px; */
            height: 100%;
            border-radius: 8px;
            opacity: 1;
        }

        .title-advance{
            text-align: left;
            font: normal normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            color: #006DDB;
            opacity: 1;
        }
        .caja-info-card-advance {
            margin: 0px;
            padding: 0px;
        }

        iframe {
            height: 300px;
            border-radius: 8px;
            padding-right: 25px;
        }
        .title-modal {
            text-align: left;
            font: normal normal medium 22px/21px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
            margin-top: 21px;
        }

        .instructor-modal{
            text-align: left;
            font: normal normal normal 16px/19px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .aprendizaje-modal{
            text-align: left;
            font: normal normal medium 18px/21px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
            margin-top: 41px !important;
        }
        .option-fixed-admin a {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #6c6c6c !important;
            font-size: 10px;

            transition: 0.1s;
            opacity: 0;
        }

        .option-fixed-admin:hover a {
            transition: 0.3s;
            opacity: 1;
        }
    </style>
@if($usuario->can('mis_cursos_instructor'))
    <div class="option-fixed-admin">

        @if ($usuario->can('mis_cursos_instructor'))
            <a class="btn" href="{{ route('admin.courses.index') }}">
                <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
                Administrador
            </a>
        @endif
        <i class="bi bi-chevron-compact-right"
            style="position: absolute; top: 50%; transform: translateY(-50%); right: 3px;"></i>
    </div>
    @endif
        <div class="card" style="max-height: 183px;">
            <img src="{{ asset('img/escuela/imagenfondo.jpg') }} " class="card-img" alt="Imagen" style="height: 183px; border-radius: 8px; ">
            <div class="card-body" style="position: absolute; top: 0; left: 0; width: 100%; color: #fff;">
                <!-- Contenido del card-body -->
                <h2 style="font-size: 24px;">Bienvenido al Centro de Capacitación</h2>
                <p style="font-size: 17px;">
                    Aprender te mantiene a la vanguardia. Consigue las habilidades más demandadas para potenciar tu crecimiento.<br>
                    En nuestra plataforma, encontrarás una amplia variedad de cursos online de alta calidad, diseñados para ayudarte a alcanzar tus objetivos.
                </p>
            </div>
        </div>

        <h3 class="title-main-cursos">Mis Cursos</h3>

        <div class="caja-cards-mis-cursos">

            @foreach ($cursos_usuario as $cu)
            @php
                $instructor = $cu->cursos->instructor;
            @endphp
            <div class="card card-body mi-curso">
                            <div class="caja-img-mi-curso">
                                <img src="{{ asset($cu->cursos->image->url) }}" alt="">
                            </div>
                            <div class="caja-info-card-mc">
                                <p style="course-title">
                                    <strong>
                                        {{ $cu->cursos->title }}
                                    </strong>
                                </p>
                                @if ($instructor)
                                <p class="course-teacher">Un curso de {{ $instructor->name }} </p>
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
                                    <a href="{{ route('admin.curso-estudiante', $cu->cursos->id) }}" class="btn btn-mi-course">Ir a mi curso</a>
                                </div>

                            </div>
                    </div>
            @endforeach

        </div>

    @livewire('escuela.course-index')
@endsection

@section('scripts')
@endsection
