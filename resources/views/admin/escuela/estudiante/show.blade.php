@extends('layouts.admin')
@section('content')
    <style>
        .card {
            box-shadow: 0px 2px 3px #0000001C;
            border: 1px solid #F1F1F1;
            border-radius: 8px;
            opacity: 1;
        }

        .contenedor img {
            width: 600px;
            height: 300px;
            object-fit: cover;
        }

        .card.similar {
            /* max-width: 325px; */
            padding: 0px;
            padding-bottom: 15px;
            border-radius: 8px;
            min-height: 156px;
        }

        .btn-mas-info-c {
            background-color: var(--color-tbj);
            color: #fff;
            padding: 10px 25px;
            width: 296px;
            text-align: center;
            font: normal normal medium 14px/20px Roboto;
            letter-spacing: 0px;
            opacity: 1;

        }

        .btn-mas-info-c:hover {
            color: #fff;
        }

        .title-aprendizaje {
            text-align: left;
            font: normal normal medium 18px/21px Roboto;
            letter-spacing: 0px;
            color: black;
            opacity: 1;
        }

        .subtitle-aprendizaje {
            text-align: left;
            font: normal normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
            margin-top: 1px;
        }

        .resumen-info {
            text-align: left;
            font: normal normal normal 16px/19px Roboto;
            letter-spacing: 0px;
            color: #2E2E2E;
            opacity: 1;
        }

        .title-similar {
            text-align: left;
            font: normal normal medium 22px/27px Roboto;
            letter-spacing: 0px;
            color: var(--color-tbj);
            opacity: 1;
        }

        .instructor-similar {
            text-align: left;
            font: normal normal normal 12px/14px Roboto;
            letter-spacing: 0px;
            color: #2E2E2E;
            opacity: 1;
        }

        .btn-evaluar {
            background: #E9F1FF 0% 0% no-repeat padding-box;
            border: 1px solid #25A0E2;
            border-radius: 4px;
            opacity: 1;
        }

        .title-evaluacion {
            text-align: left;
            font: normal normal medium 18px/21px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        iframe {
            border-radius: 8px;
            height: 365px;
        }
    </style>
    @php
        $instructor = $course->instructor;
    @endphp

    <div class="row">
        <div class="col-md-8">
            <div style="max-height: 365px;">
                @if ($course && $course->lesson_introduction)
                    {!! $course->lesson_introduction !!}
                @else
                    <p>No hay video de introducción</p>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="min-height: 360px;">
                <div class="card-body" style="padding-top: 15px;">
                    <h5 style="color: #000000">{{ $course->title ? $course->title : 'Sin nombre' }}</h5>
                    {{-- <h3 class="mb-3 text-4xl">{{ $course->subtitle ? $course->subtitle : 'Sin nombre' }}</h3> --}}
                    @if ($instructor)
                        <p class="resumen-info">Instructor: {{ $instructor->name }}</p>
                    @else
                        <p class="resumen-info">Instructor: No disponible</p>
                    @endif
                    <p class="mb-2 resumen-info" style="margin-top: 40px;"><i
                            class="mr-3 fas fa-chart-line"></i>Nivel:{{ $course->level ? $course->level->name : 'Sin nombre' }}
                    </p>
                    <p class="mb-2 resumen-info"><i class="mr-3 fas fa-tags"></i>Categoría:
                        {{ $course->category ? $course->category->name : 'Sin categoría' }}</p>
                    <p class="mb-2 resumen-info"><i class="mr-3 fas fa-users"></i>Matriculados:
                        {{ $course->students_count ? $course->students_count : 'Sin categoría' }}
                    </p>
                    <div class="mt-3 d-flex justify-content-between">
                        <div style="color: #FFC400; font-size: 15px;">
                            <div>
                                <ul class="d-flex px-2" style="list-style: none; padding-left: 0px !important;">
                                    <li class="mr-1">
                                        <i class="fas fa-star"
                                            style="color: {{ $course->rating >= 1 ? '#FFC400' : 'gray' }}; font-size: 15px;">
                                        </i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star"
                                            style="color: {{ $course->rating >= 2 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star"
                                            style="color: {{ $course->rating >= 3 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star"
                                            style="color: {{ $course->rating >= 4 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star"
                                            style="color: {{ $course->rating >= 5 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                    </li>
                                    <li class="ml-3 resumen-info">
                                        <p>Valoración</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: 40px;">
                        @if ($token)
                            <a class="btn btn-outline-primary btn-mas-info-c"
                                href="{{ route('admin.curso-estudiante', $course->id) }}">Continuar con el curso</a>
                        @else
                            <form action="{{ route('admin.courses.enrolled', $course) }}" method="post">
                                @csrf
                                <button class=" btn btn-mas-info-c" type="submit">Tomar Curso</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <section class="mb-12 card">
                        <div class="card-body">
                            <h5 class="title-aprendizaje">
                                Descripción
                            </h5>
                            @if ($course->description)
                                <p class="subtitle-aprendizaje">
                                    {!! $course->description !!}
                                </p>
                            @else
                                <p class="subtitle-aprendizaje">
                                    Sin descripción
                                </p>
                            @endif
                            <h5 class="title-aprendizaje">
                                Lo que aprenderás
                            </h5>
                            @if ($course->goals->isNotEmpty())
                                <ul style="list-style: none;">
                                    @foreach ($course->goals as $goal)
                                        <li class="mr-2 subtitle-aprendizaje"><i
                                                class="mr-3 text-gray-600 fas fa-check"></i>{{ $goal->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="subtitle-aprendizaje">
                                    Metas no asignadas
                                </p>
                            @endif

                            <h5 class="title-aprendizaje">
                                Requisitos
                            </h5>
                            @if ($course->requirements->isNotEmpty())
                                <ul class="list-disc list-inside">
                                    @foreach ($course->requirements as $requirement)
                                        <li class="subtitle-aprendizaje">{{ $requirement->name }}</li>
                                    @endforeach

                                </ul>
                            @else
                                <p class="subtitle-aprendizaje">
                                    Requerimientos no asignados
                                </p>
                            @endif
                        </div>
                    </section>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="title-aprendizaje">Temario</h5>
                            @foreach ($course->sections as $section)
                                <div class=""
                                    @if ($loop->first) x-data="{open:false}"
                                                @else
                                                x-data="{open:false}" @endif>
                                    <!--Alphine: El valor de open va ser lo contrario del valor de open a traves del ! es decir si es false
                                                                                                                    se cambia a true y viceversa -->
                                    <div class=" px-4" x-on:click="open=!open"
                                        style="display: inline-block; vertical-align: middle;">
                                        <p><span class="material-symbols-outlined" style="vertical-align: middle;">
                                                expand_more
                                            </span>{{ $section->name }}</p>
                                    </div>
                                    <div class=" px-4 " x-show="open">
                                        <ul style="list-style: none;">
                                            @foreach ($section->lessons as $lesson)
                                                <li class="text-base text-gray-700">
                                                <li class="mr-2 text-gray-600 fas fa-play-circle"></li>
                                                {{ $lesson->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>
                        @livewire('escuela.courses-review', ['course' => $course])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 ">
            <div class="row">
                @foreach ($similares as $similar)
                    <div class="col-12">
                        <div class="card similar" style="padding-bottom: 0px;">
                            {{-- @isset($similar->image->url)
                                    <img class="object-cover w-40 h-32" src="{{ asset(Storage::url($similar->image->url)) }}"
                                        alt="">
                                @else
                                    <img class="object-cover w-40 h-32" src="{{ asset('img/home/imagen-estudiantes.jpg') }}"
                                        id="picture" alt="">
                                @endisset --}}
                            <div class="card-body" style="padding-bottom: 15px; padding-top:15px;">
                                <h4 class="title-similar">
                                    <a href="{{ route('admin.courses.show', $similar) }}">{{ Str::limit($similar->title, 40) }}
                                    </a>
                                </h4>
                                {{-- <div class="flex items-center">
                                        <img class="object-cover w-8 h-8 rounded-full shadow-lg"
                                            src="{{ $similar->teacher->profile_photo_url }}" alt=""> --}}
                                <p class="ml-2 text-sm text-gray-700">{{ $similar->instructor->name }}</p>
                                {{-- </div> --}}
                                <div class="mt-3 d-flex justify-content-between">
                                    <div style="color: #FFC400; font-size: 15px;">
                                        <div>
                                            <ul class="d-flex px-2" style="list-style: none; padding-left: 0px !important;">
                                                <li class="mr-1">
                                                    <i class="fas fa-star"
                                                        style="color: {{ $similar->rating >= 1 ? '#FFC400' : 'gray' }}; font-size: 15px;">
                                                    </i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star"
                                                        style="color: {{ $similar->rating >= 2 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star"
                                                        style="color: {{ $similar->rating >= 3 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star"
                                                        style="color: {{ $similar->rating >= 4 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star"
                                                        style="color: {{ $similar->rating >= 5 ? '#FFC400' : 'gray' }}; font-size: 15px;"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-users" style="font-size: 12px;"></i>
                                        ({{ $similar->students_count }})
                                    </div>
                                </div>

                                {{-- <p><i class="mr-2 fas fa-star" style="color:#E3A008;"></i>{{ $similar->rating }}
                                    </p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
