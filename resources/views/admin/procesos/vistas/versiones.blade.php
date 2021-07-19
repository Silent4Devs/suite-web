

<div class="mt-5 card">
    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2 text-center text-white"><strong>Historial del aprobación del documento:
                {{ $documento->nombre }}</strong></h3>
    </div>

    <div class="container">
        <h5 class="mb-4 text-center" style="font-weight: bold">ESTATUS ACTUAL DEL DOCUMENTO
            @if ($documento->estatus == '1')
                <span class="badge badge-primary">EN ELABORACIÓN</span>
            @elseif($documento->estatus == '2')
                <span class="badge badge-success">EN REVISIÓN</span>
            @elseif($documento->estatus == '3')
                <span class="badge badge-success">PUBLICADO</span>
            @elseif($documento->estatus == '4')
                <span class="badge badge-danger">RECHAZADO</span>
            @endif
        </h5>
        <div class="main-timeline">

            @foreach ($revisiones as $revision)
                @php
                    $foto = 'man.png';
                    if ($revision->empleado->foto) {
                        $foto = $revision->empleado->foto;
                    } else {
                        if ($revision->empleado->genero == 'M') {
                            $foto = 'woman.png';
                        } elseif ($revision->empleado->genero == 'H') {
                            $foto = 'man.png';
                        } else {
                            $foto = 'user.png';
                        }
                    }
                @endphp
                <!-- start experience section-->
                <div class="timeline">
                    <div class="icon"></div>
                    <div class="date-content">
                        <div class="date-outer"
                            style="background-image: url('{{ asset('storage/empleados/imagenes') . '/' . $foto }}');clip-path: circle(50% at 50% 50%);background-position:center;background-size: cover;">

                            <span class="date" style="position: relative">
                                {{ $revision->foto }}

                                {{-- <span class="month">2 Years</span>
                                <span class="year">2013</span> --}}
                            </span>
                        </div>
                    </div>
                    <div class="timeline-content">
                        <h5 class="title">{{ $revision->empleado->name }}</h5>

                        @switch($revision->estatus)
                            @case(1)
                                <span class="badge badge-primary">SIN RESPUESTA</span>
                            @break
                            @case(2)
                                <span class="badge badge-success">APROBADO</span>
                            @break
                            @case(3)
                                <span class="badge badge-danger">RECHAZADO</span>
                            @break
                            @case(4)
                                <span class="badge badge-danger">RECHAZADO EN EL NIVEL ANTERIOR</span>
                            @break
                            @default
                                <span class="badge badge-primary">SIN RESPUESTA</span>
                        @endswitch
                        @php
                            $locale = 'es_MX';
                            $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
                        @endphp
                        <span class="badge badge-primary">{{ $nf->format($revision->no_revision) }} REVISIÓN</span>
                        <p class="description">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chat-dots" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                <path
                                    d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                            </svg> Comentarios
                            <span> {!! $revision->comentarios !!}</span>
                        </p>
                        <span>{{ $revision->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <!-- end experience section-->

            @endforeach

        </div>
    </div>
</div>
