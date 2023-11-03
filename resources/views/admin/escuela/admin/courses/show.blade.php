<x-app-layout>
    <section class="py-12 mb-12 bg-gray-700">
        <div class="container grid grid-cols-2 gap-6 lg:grid-cols-2 ">
            <figure>
                @isset($course->image->url)
                    <img class="object-cover object-center w-full h-64" src="{{ asset(Storage::url($course->image->url)) }}"
                        id="picture" alt="">
                @else
                    <img class="object-cover w-full h-36" src="{{ asset('img/home/imagen-estudiantes.jpg') }}" id="picture"
                        alt="">
                @endisset
            </figure>
            <div class="text-white">
                <h1 class="text-4xl">{{ $course->title }}</h1>
                <h2 class="mb-3 text-4xl">{{ $course->subtitle }}</h2>
                <p class="mb-2"><i class="mr-3 fas fa-chart-line"></i>Nivel:{{ $course->level->name }}</p>
                <p class="mb-2"><i class="mr-3 fas fa-tags"></i>Categoría: {{ $course->category->name }}</p>
                <p class="mb-2"><i class="mr-3 fas fa-users"></i>Matriculados: {{ $course->students_count }}
                </p>
                <p class="mb-2"><i class="mr-3 fas fa-star"></i>Calificación: {{ $course->raiting }}</p>
            </div>
        </div>
    </section>

    <!--META-->
    <!-- Gap 6 da separación entre columna y columna-->
    <div class="container grid grid-cols-1 gap-6 lg:grid-cols-3">


        <div class="order-2 lg:col-span-2 lg:order-1">
            <section class="mb-12 card">
                <div class="card-body">
                    <h1 class="mb-2 text-2xl font-bold">Lo que aprenderás</h1>
                    <ul class="grid grid-cols-2 md:grid-cols-2 gap-x-6 gap-y-2">

                        @forelse ($course->goals as $goal)
                            <li class="text-base text-gray-700"><i
                                    class="mr-3 text-gray-600 fas fa-check"></i>{{ $goal->name }}</li>
                        @empty
                            <li class="text-base text-gray-700">Este curso no tiene asignado ninguna meta</li>
                        @endforelse
                    </ul>
                </div>
            </section>

            <section class="mb-12">
                <h1 class="mb-2 text-3xl font-bold">Temario</h1>

                @forelse ($course->sections as $section )

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
                @empty

                    <article class="card">
                        <div class="card-body">
                            Este curso no tiene ninguna sección asignada
                        </div>
                    </article>
                @endforelse
            </section>

            <section class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Requisitos</h1>
                <ul class="list-disc list-inside">
                    @forelse ($course->requirements as $requirement)
                        <li class="text-base text-gray-700">{{ $requirement->name }}</li>
                    @empty
                        <li class="text-base text-gray-700">Este curso no tiene ningún requerimiento</li>
                    @endforelse

                </ul>
            </section>

            <section>
                <h1 class="text-3xl font-bold text-gray-800">Descripción</h1>
                <div class="text-base text-gray-700">
                    {!! $course->description !!}
                </div>
            </section>

            @livewire('courses-review', ['course' => $course])

        </div>

        <div class="order-1 lg:order-2">
            <section class="mb-4 card ">
                <div class="card-body">
                    <div class="flex items-center">
                        {{-- <!--Clase object-cover para que no se deforme la imagen--> --}}
                        <img class="object-cover w-12 h-12 rounded-full shadow-lg"
                            src="{{ $course->teacher->profile_photo_url }}" alt="{{ $course->teacher->name }}">
                        <div class="ml-4">
                            <h1 class="text-lg font-bold text-gray-500">Instructor{{ $course->teacher->name }}</h1>
                            <a class="text-sm font-bold text-blue-400"
                                href="">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                        </div>
                    </div>
                    <form action="{{ route('admin.courses.approved', $course) }}" class="mt-4" method="POST">
                        @csrf
                        <button type="submit" class="w-full btn danger ">Aprobar curso</button>
                    </form>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
