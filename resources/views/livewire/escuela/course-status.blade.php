<div class="d-flex" style="gap: 20px;">
    <div style="width: 100%;">
        <div>
            {{-- <h5 class="col-12 titulo_general_funcion">Mis Cursos</h5> --}}
            <!--Para que me traiga correctamente el video hay que agregar -->
            <div>
                {!! $current->iframe ? $current->iframe : 'Sin registro' !!}
            </div>

            <h4 class="mt-3">{{$current->name}}</h4>

            <div class="flex justify-between mt-4">
                <div class="flex items-center mt-4 cursor-pointer" wire:click="completed">
                    @if ($current->completed)
                        <i class="text-2xl text-blue-600 fas fa-toggle-on"></i>
                    @else
                        <i class="text-2xl text-gray-600 fas fa-toggle-off"></i>
                    @endif

                    <p class="ml-2 text-sm">Marcar esta lección como terminada</p>
                </div>
                @if ($current->resource)
                    <div class="flex text-gray-600 cursor-pointer item-center" wire:click="download">
                        <i class="text-lg fas fa-download"></i>
                        <p class="ml-2 text-sm">Descargar Recurso</p>
                    </div>
                @endif
            </div>
            <div class="mt-2 card">
                <div class="flex font-bold text-white-500 card-body">
                    @if ($this->previous)
                        <a wire:click="changeLesson({{ $this->previous }})" class="cursor-pointer mr-3">
                            Tema anterior
                        </a>
                    @else
                    <a class="cursor-pointer mr-3">
                        Tema anterior
                    </a>
                    @endif
                        <a wire:click="changeLesson({{ $this->next }})" class="ml-auto cursor-pointer">
                            Siguiente tema
                        </a>
                </div>
            </div>
            {{-- <div class="card card-body d-flex justify-space-between">
            </div> --}}


        </div>
    </div>

    <div class="card card-body" style="width: 320px;">
        <h4>{{ $course->title }}</h6>
        <div class="flex items-center">
            <figure>
                <img class="object-cover w-12 h-12 mr-4 rounded-full" src="{{ $course->teacher->profile_photo_url }}">
            </figure>
            <div>
                <p>{{ $course->teacher->name }}</p>
                {{-- <a class="text-sm text-blue-500" href="">{{ '@' . Str::slug($course->teacher->name, '') }}</a> --}}
                <p class="text-primary">{{$course->category->name}}</p>
            </div>
        </div>

        <p class="mt-2 text-sm text-gray-600 ">{{ $this->advance . '%' }} completado</p>
        <div class="relative pt-1">
            <div class="flex h-2 mb-4 overflow-hidden text-xs bg-gray-200 rounded">
                <div style="width:{{ $this->advance . '%' }}"
                    class="flex flex-col justify-center text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                </div>
            </div>
        </div>

        <ul>
            @foreach ($course->sections as $section)
                <li class="mb-4 text-gray-600">
                    <a class="inline mb-2 text-base font-bold">{{ $section->name }}</a>
                    <ul>
                        @foreach ($section->lessons as $lesson)
                            <li>
                                <div>
                                    @if ($lesson->completed)
                                        @if ($current->id == $lesson->id)
                                            <span
                                                class="inline-block w-4 h-4 mt-1 mr-2 border-2 border-yellow-300 rounded-full">
                                                <a class="cursor:pointer"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @else
                                            <span class="inline-block w-4 h-4 mt-1 mr-2 bg-yellow-300 rounded-full">
                                                <a class="cursor:pointer"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @endif
                                    @else
                                        @if ($current->id == $lesson->id)
                                            <span
                                                class="inline-block w-4 h-4 mt-1 mr-2 border-2 border-gray-500 rounded-full">
                                                <a class="cursor:pointer"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @else
                                            <span class="inline-block w-4 h-4 mt-1 mr-2 bg-gray-500 rounded-full">
                                                <a class="cursor:pointer"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </li>
                        @endforeach

                        @foreach ($section->evaluations as $evaluation)
                            @if ($evaluation->questions->count() > 0)
                                @php
                                    $completed = in_array($evaluation->id, $evaluationsUser);
                                @endphp
                                <li class="flex">
                                    <div>
                                        <span
                                            class="inline-block w-4 h-4 mt-1 mr-2 rounded-full border-2 {{ $completed ? 'bg-green-500  border-green-500' : 'border-gray-500' }}"></span>
                                        <a class="cursor:pointer"
                                            href="{{ route('admin.curso.evaluacion', ['course' => $course->id, 'evaluation' => $evaluation->id]) }}"
                                            wire:click="changeLesson({{ $lesson }})">{{ $evaluation->name }}
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Evaluación</span>
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
