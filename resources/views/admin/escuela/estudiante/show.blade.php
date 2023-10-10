@extends('layouts.admin')
@section('content')
        <style>
            .contenedor img {
                width: 600px;
                height: 300px;
                object-fit: cover;
            }

            .card.similar {
            max-width: 325px;
            padding: 0px;
            padding-bottom: 15px;
            border-radius: 8px;
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
        </style>
    <section class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-3" style="max-width: auto;">
                <div class="row no-gutters">
                  <div class="col-8 contenedor">
                    @isset($course->image->url)
                            <img src="{{ Storage::url($course->image->url) }}"
                                id="picture" alt="">
                        @else
                            <img src="{{ asset('img/home/imagen-estudiantes.jpg') }}" id="picture"
                                alt="" style="width: 100%; heigth:100%">
                        @endisset
                  </div>
                  <div class="col-4">
                    <div class="card-body">
                        <h2>{{ $course->title ? $course->title : 'Sin nombre' }}</h2>
                        <h3 class="mb-3 text-4xl">{{ $course->subtitle ? $course->subtitle : 'Sin nombre' }}</h3>
                        <p class="mb-2"><i
                                class="mr-3 fas fa-chart-line"></i>Nivel:{{ $course->level ? $course->level->name : 'Sin nombre' }}
                        </p>
                        <p class="mb-2"><i class="mr-3 fas fa-tags"></i>Categoría:
                            {{ $course->category ? $course->category->name : 'Sin categoría' }}</p>
                        <p class="mb-2"><i class="mr-3 fas fa-users"></i>Matriculados:
                            {{ $course->students_count ? $course->students_count : 'Sin categoría' }}</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-4 mb-4">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <section class="mb-12 card shadow-sm ">
                            <div class="card-body">
                                <h4 class="mb-2">Lo que aprenderás</h4>
                                <ul style="list-style: none;">

                                    @foreach ($course->goals as $goal)
                                        <li class="mr-2"><i
                                                class="mr-3 text-gray-600 fas fa-check"></i>{{ $goal->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div class="col-12">
                        <section class="mb-2">
                            <h2 class="mb-2">Temario</h2>
                            @foreach ($course->sections as $section)
                                <div class="card mb-4 shadow-none"
                                    @if ($loop->first) x-data="{open:true}"
                                            @else
                                            x-data="{open:false}" @endif>
                                    <!--Alphine: El valor de open va ser lo contrario del valor de open a traves del ! es decir si es false
                                                se cambia a true y viceversa -->
                                    <div class="card-header px-4 py-2" x-on:click="open=!open" style="border: 1px solid #D8D8D8;">
                                        <h3>{{ $section->name }}</h3>
                                    </div>
                                    <div class="card-body px-4 py-2" x-show="open" style="border: 1px solid #D8D8D8;">
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
                        </section>
                    </div>
                    <div class="col-12">
                        <section class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800">Requisitos</h2>
                            <ul class="list-disc list-inside">
                                @foreach ($course->requirements as $requirement)
                                    <li class="text-base text-gray-700">{{ $requirement->name }}</li>
                                @endforeach

                            </ul>
                        </section>
                    </div>
                    <div class="col-12">
                        <section>
                            <h2>Descripción</h2>
                            <h5>
                                {!! $course->description !!}
                            </h5>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-4 ">
                    <div class="mb-4 card shadow-sm ">
                        <div class="card-body">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <h4 class="">Instructor: {{ $course->teacher->name }}</h4>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                @if($token)
                                    <a class="mt-4 btn btn-mas-info-c" href="{{ route('admin.curso-estudiante', $course->id) }}">Continuar
                                        con el curso</a>
                                @else
                                    <form action="{{ route('admin.courses.enrolled', $course) }}" method="post">
                                        @csrf
                                        <button class="mt-4 btn btn-mas-info-c" type="submit">Tomar Curso</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <aside>
                        @foreach ($similares as $similar)
                            <div class="card shadow-sm similar">
                                @isset($similar->image->url)
                                    <img class="object-cover w-40 h-32" src="{{ Storage::url($similar->image->url) }}"
                                        alt="">
                                @else
                                    <img class="object-cover w-40 h-32" src="{{ asset('img/home/imagen-estudiantes.jpg') }}"
                                        id="picture" alt="">
                                @endisset
                                <div class="ml-3">
                                    <h1>
                                        <a class="mb-3" style="color:#1E94A8;"
                                            href="{{ route('admin.courses.show', $similar) }}">{{ Str::limit($similar->title, 40) }}</a>
                                    </h1>
                                    <div class="flex items-center mb-2">
                                        <img class="object-cover w-8 h-8 rounded-full shadow-lg"
                                            src="{{ $similar->teacher->profile_photo_url }}" alt="">
                                        <p class="ml-2 text-sm text-gray-700">{{ $similar->teacher->name }}</p>
                                    </div>

                                    <p ><i class="mr-2 fas fa-star" style="color:#E3A008;"></i>{{ $similar->rating }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </aside>
            </div>
        </div>

        @livewire('escuela.courses-review', ['course' => $course])
    </div>
@endsection
