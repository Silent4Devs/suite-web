<div class="d-flex" style="gap: 20px;">
    <style>
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

        .circulo {
            width: 60px;
            height: 60px;
        }

        .circulo img {
            width: 60px;
            /* Ajusta la imagen al tamaño del div circular */
            height: 60px;
            border-radius: 50%;
        }
    </style>

    <x-loading-indicator />

    <div style="width: 100%; ">
        <div style="position: sticky; top:80px;">
            {{-- <h5 class="col-12 titulo_general_funcion">Mis Cursos</h5> --}}
            <!--Para que me traiga correctamente el video hay que agregar -->
            <div class="video-curso-box">
                @if ($current && $current->iframe)
                    <div class="box-iframe-video-courses d-none">
                        {!! $current->iframe !!}
                    </div>
                    <div id="player3" class="w-100"></div>
                    {{-- <lite-youtube videoid="guJLfqTFfIw"></lite-youtube> --}}
                @else
                    <p>Sin registro</p>
                @endif
            </div>

            <div class="row" style="margin-top: 36px;">
                <div class="col-md-6">
                    @if ($current)
                        <h4>{{ $current->name }}</h4>
                    @else
                        <p>No current data available</p>
                    @endif
                </div>
                {{-- <div class="col-md-6">
                    <div class="cursor-pointer d-flex justify-content-end align-items-center" wire:click="completed"
                        style="cursor: pointer;">
                        @if ($current->completed)
                            <h4 class="mr-2 text-primary">Lección terminada</h4>
                            <i class="d-inline fas fa-toggle-on"
                                style="font-size: 30px; color: #006DDB; cursor: pointer;"></i>
                        @else
                            <h4 class="mr-2">Marcar esta lección como terminada</h4>
                            <i class="text-2xl text-gray-600 fas fa-toggle-off"
                                style="font-size: 30px; cursor: pointer;"></i>
                        @endif
                    </div>
                </div> --}}
            </div>

            <div class="mt-2 card pb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            @if ($this->previous)
                                <a wire:click="changeLesson({{ $this->previous }}, 'previous')" class=" text-primary"
                                    style="cursor: pointer;" onclick="refreshPage('boton')">
                                    < Tema anterior </a>
                                    @else
                                        <a href="#" id="test" class="text-muted">
                                            < Tema anterior</a>
                            @endif
                            <div wire:target="changeLesson({{ $this->previous }})">
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            @if ($this->next)
                                <a wire:click="changeLesson({{ $this->next }})" class="text-primary"
                                    style="cursor: pointer;" onclick="refreshPage()">
                                    Siguiente tema >
                                </a>
                            @else
                                <a href="#" id="test" class="text-muted"> Siguiente tema > </a>
                            @endif
                            <div wire:target="changeLesson({{ $this->next }})">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                @if (isset($current->resource))
                    <div class="flex text-gray-600 cursor-pointer item-center" wire:click="download"
                        style="cursor: pointer;">
                        <i class="text-lg fas fa-download d-inline"></i>
                        <p class="ml-2 text-sm d-inline">Descargar Recurso</p>
                    </div>
                @endif
            </div>


        </div>
    </div>

    <div class="card card-body" style="width: 320px;">
        <h4>{{ $course->title }}</h4>
        <div class="d-flex align-items-start" wire:ignore>
            <div class="img-person" style="min-width: 40px; min-height: 40px;">
                <img src="{{ isset($course->instructor->empleado->avatar_ruta) ? $course->instructor->empleado->avatar_ruta : '' }}"
                    alt="{{ $course->instructor->name ?? 'Sin asignar' }}">
                {{-- {{ $course->instructor->name ?? 'Sin asignar'  }} --}}
            </div>
            <div>
                {{-- {{ $course->instructor->name }} --}}
                <p class="ml-2">{{ $course->instructor->name ?? 'Sin asignar' }} </p>
                <p class="ml-2" style="color: #E3A008;">{{ strtoupper($course->category->name) }}</p>

            </div>
        </div>
        @if ($cursoCompletado === 100)
            <div class="">
                <a href="{{ route('admin.inicioUsuario.mis-cursos') }}"
                    style="color: #006DDB !important; text-decoration: underline !important;">Certificados</a>
            </div>
        @endif

        <div class="caja-info-card-mc">
            <p class="mt-2 text-primary">{{ $this->advance . '%' }} completado</p>
            <div class="curso-progreso-barra">
                <div class="indicador-progreso-barra" style="width: {{ $this->advance . '%' }};"></div>
            </div>
        </div>
        <div class="relative pt-1">
            <div class="flex h-2 mb-4 overflow-hidden text-xs bg-gray-200 rounded">
                <div style="width:{{ $this->advance . '%' }}"
                    class="flex flex-col justify-center text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                </div>
            </div>
        </div>

        <ul id="secciones-curso" style="list-style: none; cursor: pointer;">
            @foreach ($course->sections_order as $section)
                <li class="seccion-li-orden" id="seccion-{{ $section->id }}">
                    <i style="font-size:10pt; cursor: pointer;" class="d-inline text-black-500 fas fa-play-circle">
                    </i>
                    <a class="inline mb-2 text-base font-bold">{{ $section->name }}</a>

                    <ul style="list-style: none;">
                        @foreach ($section->lessons as $lesson)
                            <li>
                                <div>
                                    @if ($lesson->completed)
                                        @if ($current->id == $lesson->id)
                                            <span style="color:green;">
                                                <a class="cursor:pointer;"
                                                    wire:click="changeLesson({{ $lesson }})"
                                                    onclick="refreshPage()">{{ $lesson->name }}</a>
                                            </span>
                                        @else
                                            <span style="color:rgb(0, 179, 0);">
                                                <a class="cursor:pointer;"
                                                    wire:click="changeLesson({{ $lesson }})"
                                                    onclick="refreshPage()">{{ $lesson->name }}</a>
                                            </span>
                                        @endif
                                    @else
                                        @if ($current->id == $lesson->id)
                                            <span class="text-primary">
                                                <a class="cursor:pointer;"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @else
                                            <span class="">
                                                <a class="cursor:pointer;"
                                                    wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </li>
                        @endforeach

                        @foreach ($section->evaluations as $evaluation)
                            @php
                                $totalLectionSection = $section->lessons->count();
                                $completedLectionSection = $section->lessons;
                                $completedLessonsCount = $section->lessons
                                    ->filter(function ($lesson) {
                                        return $lesson->completed;
                                    })
                                    ->count();
                            @endphp
                            @if ($totalLectionSection != $completedLessonsCount)
                                <li style="list-style-type: disc;">
                                    <div>
                                        <span class="inline-block rounded-full border-2 border-gray-500"></span>
                                        <a class="cursor:pointer;" wire:click="alertSection()">{{ $evaluation->name }}
                                        </a>
                                    </div>
                                </li>
                            @else
                                @if ($evaluation->questions->count() > 0)
                                    @php
                                        $completed = in_array($evaluation->id, $evaluationsUser);
                                    @endphp
                                    <li style="list-style-type: disc;">
                                        <div>
                                            <span
                                                class="inline-block rounded-full border-2 {{ $completed ? 'bg-green-500  border-green-500' : 'border-gray-500' }}"></span>
                                            <a class="cursor:pointer;"
                                                href="{{ route('admin.curso.evaluacion', ['course' => $course->id, 'evaluation' => $evaluation->id]) }}"
                                                wire:click="changeLesson({{ $lesson }})">{{ $evaluation->name }}
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    @section('scripts')
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            var player;
            var complet;

            function refreshPage($type) {
                if ($type === "boton") {
                    setTimeout(function() {
                        initializeYouTubePlayer();
                    }, 1000); // Puedes ajustar el tiempo de espera si es necesario
                } else {
                    setTimeout(function() {
                        initializeYouTubePlayer();
                    }, 1500);
                }
            }
            document.addEventListener('livewire:update', function() {
                console.log('Componente Livewire actualizado');
                initializeYouTubePlayer();
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Aquí carga la API de YouTube IFrame
                var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            });



            function getYouTubeVideoId() {
                var assignIdIframe = document.querySelector(".box-iframe-video-courses iframe");
                assignIdIframe.id = 'videoYoutube';
                var iframe = document.getElementById('videoYoutube');
                var url = iframe.src;
                var videoId = url.split('/embed/')[1].split('?')[0];
                return videoId;
            }
            var videoId = getYouTubeVideoId();

            //esto siempre se tiene que ejecutar por la api de youtube
            function onYouTubeIframeAPIReady() {
                initializeYouTubePlayer();
            }

            function initializeYouTubePlayer() {
                var videoId = getYouTubeVideoId(); // Obtener el ID del video desde el iframe
                player = new YT.Player('player3', {
                    height: '460',
                    width: '940',
                    videoId: videoId, // Usar el ID del video obtenido
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                // Código a ejecutar cuando el reproductor está listo
                console.log('Reproductor listo');
                // player.playVideo();
            }

            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING) {
                    // El video ha comenzado a reproducirse
                    startTrackingProgress();
                } else if (event.data == YT.PlayerState.ENDED) {
                    console.log('El video ha terminado');
                    if (!@json($current->completed)) {
                        complet = true;
                        @this.completed();
                    }
                }
            }
            // Función para rastrear el progreso del video
            function startTrackingProgress() {
                setInterval(function() {
                    var currentTime = player.getCurrentTime();
                    var duration = player.getDuration();
                    var progress = (currentTime / duration) * 100;

                    console.log('Progreso del video: ' + progress + '%');

                    // Aquí puedes actualizar la UI o realizar otras acciones basadas en el progreso
                }, 1000); // Actualiza cada segundo
            }
            document.addEventListener('render', event => {
                setTimeout(function() {
                    initializeYouTubePlayer();
                }, 500);
            });
        </script>
    @endsection
</div>
