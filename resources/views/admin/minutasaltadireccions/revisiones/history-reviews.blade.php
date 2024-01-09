@extends('layouts.admin')
@section('content')
    <style>
        body {
            background-color: #f7f7f7;

        }

        .main-timeline {
            position: relative
        }

        .main-timeline:before {
            content: "";
            display: block;
            width: 2px;
            height: 100%;
            background: #c6c6c6;
            margin: 0 auto;
            position: absolute;
            top: 0;
            left: 0;
            right: 0
        }

        .main-timeline .timeline {
            margin-bottom: 40px;
            position: relative
        }

        .main-timeline .timeline:after {
            content: "";
            display: block;
            clear: both
        }

        .main-timeline .icon {
            width: 18px;
            height: 18px;
            line-height: 18px;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0
        }

        .main-timeline .icon:before,
        .main-timeline .icon:after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.33s ease-out 0s
        }

        .main-timeline .icon:before {
            background: #fff;
            border: 2px solid #232323;
            left: -3px
        }

        .main-timeline .icon:after {
            border: 2px solid #c6c6c6;
            left: 3px
        }

        .main-timeline .timeline:hover .icon:before {
            left: 3px
        }

        .main-timeline .timeline:hover .icon:after {
            left: -3px
        }

        .main-timeline .date-content {
            width: 50%;
            float: left;
            margin-top: 22px;
            position: relative
        }

        .main-timeline .date-content:before {
            content: "";
            width: 36.5%;
            height: 2px;
            background: #c6c6c6;
            margin: auto 0;
            position: absolute;
            top: 0;
            right: 10px;
            bottom: 0
        }

        .main-timeline .date-outer {
            width: 125px;
            height: 125px;
            font-size: 16px;
            text-align: center;
            margin: auto;
            z-index: 1
        }

        /* .main-timeline .date-outer:before, */
        .main-timeline .date-outer:after {
            content: "";
            width: 125px;
            height: 125px;
            margin: 0 auto;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            transition: all 0.33s ease-out 0s
        }

        .main-timeline .date-outer:before {
            background: #fff;
            border: 2px solid #232323;
            left: -6px
        }

        .main-timeline .date-outer:after {
            border: 2px solid #c6c6c6;
            left: 6px
        }

        .main-timeline .timeline:hover .date-outer:before {
            left: 6px
        }

        .main-timeline .timeline:hover .date-outer:after {
            left: -6px
        }

        .main-timeline .date {
            width: 100%;
            margin: auto;
            position: absolute;
            top: 27%;
            left: 0
        }

        .main-timeline .month {
            font-size: 18px;
            font-weight: 700
        }

        .main-timeline .year {
            display: block;
            font-size: 30px;
            font-weight: 700;
            color: #232323;
            line-height: 36px
        }

        .main-timeline .timeline-content {
            width: 50%;
            padding: 20px 0 20px 50px;
            float: right
        }

        .main-timeline .title {
            font-size: 19px;
            font-weight: 700;
            line-height: 24px;
            margin: 0 0 15px 0
        }

        .main-timeline .description {
            margin-bottom: 0
        }

        .main-timeline .timeline:nth-child(2n) .date-content {
            float: right
        }

        .main-timeline .timeline:nth-child(2n) .date-content:before {
            left: 10px
        }

        .main-timeline .timeline:nth-child(2n) .timeline-content {
            padding: 20px 50px 20px 0;
            text-align: right
        }

        @media only screen and (max-width: 991px) {
            .main-timeline .date-content {
                margin-top: 35px
            }

            .main-timeline .date-content:before {
                width: 22.5%
            }

            .main-timeline .timeline-content {
                padding: 10px 0 10px 30px
            }

            .main-timeline .title {
                font-size: 17px
            }

            .main-timeline .timeline:nth-child(2n) .timeline-content {
                padding: 10px 30px 10px 0
            }
        }

        @media only screen and (max-width: 767px) {
            .main-timeline:before {
                margin: 0;
                left: 7px
            }

            .main-timeline .timeline {
                margin-bottom: 20px
            }

            .main-timeline .timeline:last-child {
                margin-bottom: 0
            }

            .main-timeline .icon {
                margin: auto 0
            }

            .main-timeline .date-content {
                width: 95%;
                float: right;
                margin-top: 0
            }

            .main-timeline .date-content:before {
                display: none
            }

            .main-timeline .date-outer {
                width: 110px;
                height: 110px
            }

            .main-timeline .date-outer:before,
            .main-timeline .date-outer:after {
                width: 110px;
                height: 110px
            }

            .main-timeline .date {
                top: 30%
            }

            .main-timeline .year {
                font-size: 24px
            }

            .main-timeline .timeline-content,
            .main-timeline .timeline:nth-child(2n) .timeline-content {
                width: 95%;
                text-align: center;
                padding: 10px 0
            }

            .main-timeline .title {
                margin-bottom: 10px
            }

            .date img.imagen-history {
                margin-top: -20px;
                width: 29%;
                z-index: -3;
                clip-path: circle(50% at 50% 50%);
                margin-left: -7px;
            }
        }
    </style>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Historial de aprobación de la Minuta:
                    {{ $minuta->nombre }}</strong></h3>
        </div>
        <div class="container">
            <h5 class="mb-4 text-center" style="font-weight: bold">ESTATUS ACTUAL DE LA MINUTA
                @if ($minuta->estatus == '1')
                    <span class="badge badge-primary">EN ELABORACIÓN</span>
                @elseif($minuta->estatus == '2')
                    <span class="badge badge-success">EN REVISIÓN</span>
                @elseif($minuta->estatus == '3')
                    <span class="badge badge-success">PUBLICADO</span>
                @elseif($minuta->estatus == '4')
                    <span class="badge badge-danger">RECHAZADO</span>
                @endif
            </h5>
            <div class="main-timeline">

                @foreach ($revisiones as $revision)
                    <!-- start experience section-->
                    <div class="timeline">
                        <div class="icon"></div>
                        <div class="date-content">
                            <div class="date-outer"
                                style="background-image: url('{{ asset('storage/empleados/imagenes') . '/' }} . {{ $revision->empleado->avatar ?? '' }}');clip-path: circle(50% at 50% 50%);background-position:center;background-size: cover;">
                                <span class="date" style="position: relative">
                                    {{ $revision->foto ?? '' }}
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <h5 class="title">{{ $revision->empleado->name ?? '' }}</h5>

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

                                @case(5)
                                    <span class="badge badge-danger">RECHAZADO POR EDICIÓN DE LA MINUTA</span>
                                @break

                                @default
                                    <span class="badge badge-primary">SIN RESPUESTA</span>
                            @endswitch
                            @php
                                $locale = 'es_MX';
                                $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
                            @endphp
                            <span class="badge badge-primary">{{ $nf->format($revision->no_revision) }} REVISIÓN</span>
                            <span
                                class="badge badge-dark">{{ $revision->version == 0 ? 'Sin' : $nf->format($revision->version) }}
                                versión</span>
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
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minutasaltadireccions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
