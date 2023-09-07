@extends('layouts.admin')
@section('content')
        <style>
            .contenedor {
                max-width: 400px;
                max-height: 300px
            }

            .contenedor img {
                max-height : 300px;
                width: 100%;
            }
        </style>
    <section style="border: 1px solid #D8D8D8;">
        <div class="container row">
            <div class="col-8">
                <div class="contenedor">
                    @isset($course->image->url)
                        <img src="{{ Storage::url($course->image->url) }}"
                            id="picture" alt="">
                    @else
                        <img src="{{ asset('img/home/imagen-estudiantes.jpg') }}" id="picture"
                            alt="">
                    @endisset
                </div>
            </div>
            <div class="col-4">
                <div>
                    <h1 class="text-4xl">{{ $course->title ? $course->title : 'Sin nombre' }}</h1>
                    <h2 class="mb-3 text-4xl">{{ $course->subtitle ? $course->subtitle : 'Sin nombre' }}</h2>
                    <p class="mb-2"><i
                            class="mr-3 fas fa-chart-line"></i>Nivel:{{ $course->level ? $course->level->name : 'Sin nombre' }}
                    </p>
                    <p class="mb-2"><i class="mr-3 fas fa-tags"></i>Categoría:
                        {{ $course->category ? $course->category->name : 'Sin categoría' }}</p>
                    <p class="mb-2"><i class="mr-3 fas fa-users"></i>Matriculados:
                        {{ $course->students_count ? $course->students_count : 'Sin categoría' }}</p>
                    {{-- <p class="mb-2"><i class="mr-3 fas fa-star"></i>Calificación: {{$course->raiting}}</p> --}}
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-8 row">
                <div class="col-12">
                    <section class="mb-12 card ">
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
                        <h6>
                            {!! $course->description !!}
                        </h6>
                    </section>
                </div>
            </div>
            <div class="col-4">
                <div class="order-1 lg:order-2">
                    <section class="mb-4 card ">
                        <div class="card-body">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <h4 class="">Instructor: {{ $course->teacher->name }}</h4>
                                </div>
                            </div>
                            @if($token)
                                <a class="mt-4 btn btn-danger btn-block" href="{{ route('admin.curso-estudiante', $course->id) }}">Continuar
                                    con el curso</a>
                            @else
                                <form action="{{ route('admin.courses.enrolled', $course) }}" method="post">
                                    @csrf
                                    <button class="mt-4 btn btn-danger btn-block" type="submit">Tomar Curso</button>
                                </form>
                            @endif
                        </div>
                    </section>
                    <aside class="hidden lg:block">
                        @foreach ($similares as $similar)
                            <article class="flex mb-6">
                                @isset($similar->image->url)
                                    <img class="object-cover w-40 h-32" src="{{ Storage::url($similar->image->url) }}"
                                        alt="">
                                @else
                                    <img class="object-cover w-40 h-32" src="{{ asset('img/home/imagen-estudiantes.jpg') }}"
                                        id="picture" alt="">
                                @endisset
                                <div class="ml-3">
                                    <h1>
                                        <a class="mb-3 font-bold text-gray-500"
                                            href="{{ route('courses.show', $similar) }}">{{ Str::limit($similar->title, 40) }}</a>
                                    </h1>
                                    <div class="flex items-center mb-2">
                                        <img class="object-cover w-8 h-8 rounded-full shadow-lg"
                                            src="{{ $similar->teacher->profile_photo_url }}" alt="">
                                        <p class="ml-2 text-sm text-gray-700">{{ $similar->teacher->name }}</p>
                                    </div>

                                    <p class="text-sm"><i class="mr-2 text-yellow-400 fas fa-star"></i>{{ $similar->rating }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
        {{-- <div class="order-2 lg:col-span-2 lg:order-1"> --}}
            {{-- <section class="mb-12 card">
                <div class="card-body">
                    <h1 class="mb-2 text-2xl font-bold">Lo que aprenderás</h1>
                    <ul class="grid grid-cols-2 md:grid-cols-2 gap-x-6 gap-y-2">

                        @foreach ($course->goals as $goal)
                            <li class=""><i
                                    class="mr-3 text-gray-600 fas fa-check"></i>{{ $goal->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="mb-12">
                <h1 class="mb-2 text-3xl font-bold">Temario</h1>
                @foreach ($course->sections as $section)
                    <article class="mb-4 shadow"
                        @if ($loop->first) x-data="{open:true}"
                                @else
                                x-data="{open:false}" @endif>
                        <!--Alphine: El valor de open va ser lo contrario del valor de open a traves del ! es decir si es false
                                    se cambia a true y viceversa -->
                        <header class="px-4 py-2 bg-gray-200 border border-gray-200 cursor:pointer"
                            x-on:click="open=!open">
                            <h1 class="text-lg font-bold text-gray-600">{{ $section->name }}</h1>
                        </header>
                        <div class="px-4 py-2 bg-white " x-show="open">
                            <ul class="grid grid-cols-1 gap-2">
                                @foreach ($section->lessons as $lesson)
                                    <li class="text-base text-gray-700">
                                    <li class="mr-2 text-gray-600 fas fa-play-circle"></li>{{ $lesson->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endforeach
            </section>

            <section class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Requisitos</h1>
                <ul class="list-disc list-inside">
                    @foreach ($course->requirements as $requirement)
                        <li class="text-base text-gray-700">{{ $requirement->name }}</li>
                    @endforeach

                </ul>
            </section>

            <section>
                <h1 class="text-3xl font-bold text-gray-800">Descripción</h1>
                <div class="text-base text-gray-700">
                    {!! $course->description !!}
                </div>
            </section> --}}

            @livewire('escuela.courses-review', ['course' => $course])

        {{-- </div> --}}

    </div>
@endsection
