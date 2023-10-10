@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">

    <style>
        @media print {
            .print-none {
                display: none !important;
            }
        }
    </style>

    <div class="print-none">
        {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    </div>

    <div class="mt-4 row justify-content-center">
        <div class="card col-sm-12 col-md-10">
            <div class="card-body">

                <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
                    onclick="javascript:window.print()">
                    <i class="fas fa-print"></i>
                    Imprimir
                </button>


                @php
                    use App\Models\Organizacion;
                    $organizacion = Organizacion::getFirst();
                    $logotipo = $organizacion->logotipo;
                    $empresa = $organizacion->empresa;
                @endphp
                <div class="row mt-5 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                    <div class="col-2 pl-0" style="border-right: 2px solid #ccc">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-1" style="width:100px;">
                    </div>
                    <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                        <span style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
                        <br>
                        <span style="color:#345183; font-size:15px;"><strong>Determinación de alcance:
                                {{ $alcanceSgsi->nombre ?? 'sin registro' }}</strong></span>

                    </div>
                    <div class="col-3 p-2">
                        <span style="color:#345183;">Fecha:
                            {{ \Carbon\Carbon::parse($alcanceSgsi->created_at)->format('d-m-Y') }}
                        </span>
                    </div>
                </div>


                <div class="row mt-5 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">

                    <div class="col-6 pl-0" style="border-right: 2px solid #ccc">
                        <div class="row">
                            <div class="col-3">
                                <strong style="font-size:12px; color:#345183">Aprobó</strong>
                            </div>
                            <div class="col-9">
                                <p style="font-size:12px; color:#345183">
                                    {{ Str::limit($alcanceSgsi->empleado->name, 25, '...') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <strong style="font-size:12px; color:#345183">Puesto</strong>
                            </div>
                            <div class="col-9">
                                <p style="font-size:12px; color:#345183">
                                    {{ Str::limit($alcanceSgsi->empleado->puesto, 25, '...') }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <strong style="font-size:12px; color:#345183">Área</strong>
                            </div>
                            <div class="col-9">
                                <p style="font-size:12px; color:#345183">
                                    {{ $alcanceSgsi->responsables ? $alcanceSgsi->area->area : 'Sin definir' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <strong style="font-size:12px; color:#345183">Fecha de publicación</strong>
                            </div>
                            <div class="col-7">
                                <p style="font-size:12px; color:#345183">{{ $alcanceSgsi->fecha_publicacion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <strong style="font-size:12px; color:#345183"> Fecha de entrada en vigor</strong>
                            </div>
                            <div class="col-7">
                                <p style="font-size:12px; color:#345183">{{ $alcanceSgsi->fecha_entrada }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <strong style="font-size:12px; color:#345183"> Fecha de revisión</strong>
                            </div>
                            <div class="col-7">
                                <p style="font-size:12px; color:#345183">{{ $alcanceSgsi->fecha_revision }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold; ml-4">
                        Descripción</span>
                </div>

                <div class="px-2 mt-2">
                    {!! $alcanceSgsi->alcancesgsi !!}
                </div>

                <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold; ml-4">
                        Normas</span>
                </div>

                <ul>
                    @foreach ($alcanceSgsi->normas as $norma)
                        <li style="font-size:12px;">
                            {{ $norma->norma }}
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
