@extends('layouts.admin')

@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios/contratos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}"> --}}


    <style>
        .diseño-titulo {

            margin-top: 20px;
            margin-bottom: 30px;
            height: 30px;
            background: #345183;
            border-bottom-right-radius: 100px;
            border-top-right-radius: 100px;
            border-bottom-left-radius: 100px;
            border-top-left-radius: 100px;
        }

        .asterisco {
            color: red;
            margin-left: 5px;

        }

        .select-wrapper input {

            direction: rtl;
            text-align: left;

        }
    </style>

    <div class="row">
        <div class="col s12 m12">
            <div class="" style="margin-top:-20px; margin-left:10px; margin-right:10px;">
                <div class="">

                    <div class="col s12">
                        <div class="form-group diseño-titulo">
                            <p class="center-align" style="font-size:13pt; color:#ffffff;">&nbsp;&nbsp;INFORMACIÓN GENERAL DEL
                                CONTRATO
                            </p>
                        </div>
                    </div>



                    <!-- <div class="box box-primary">-->
                    {!! Form::model($contrato, [
                        'route' => ['contract_manager.contratos-katbol.update', $contrato->id],
                        'method' => 'patch',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    @include('admin.bitacora.formedit', ['show_contrato' => true])

                    {!! Form::close() !!}
                    <!-- </div>-->
                </div>
            </div>
        </div>
    </div>








    <style>
        #firma_aprobador canvas {
            border: 1px solid #bbb;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/lemonadejs/dist/lemonade.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@lemonadejs/signature/dist/index.min.js"></script>
    @if ($firmar)
        <div class="col-12">
            <div class="card card-body">
                <form action="{{ route('contract_manager.contratos-katbol.aprobacion-firma-contrato') }}" method="POST">
                    @csrf
                    <div class="d-flex gap-4 align-items-center flex-column">
                        <div>
                            <h5>Ingrese su firma para la aprobación del registro</h5>
                        </div>
                        <div id="firma_aprobador" class="" style="width: auto;"></div>
                        <input type="hidden" name="firma_base" value="" id="firma-input">
                        <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                        <div class="d-flex gap-5">
                            <div id="resetCanvas" class="btn btn-outline-secondary">Limpiar</div>
                            <button class="btn btn-primary">Guardar firma</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <script>
        // Get the element to render signature component inside
        const firma_aprobador = document.getElementById("firma_aprobador");
        const resetCanvas = document.getElementById("resetCanvas");
        resetCanvas.addEventListener("click", () => {
            // console.log(component.getImage());
            component.value = [];
            document.getElementById('firma-input').value = component.getImage();
        });
        document.querySelector('#firma_aprobador').onmouseup = function() {
            document.getElementById('firma-input').value = component.getImage();
        }
        // Call signature with the firma_aprobador element and the options object, saving its reference in a variable
        const component = Signature(firma_aprobador, {
            width: 700,
            height: 300,
            instructions: ""
        });
    </script>

    @if ($aprobacionFirmaContrato->count())
        <div class="col-12">
            <div class="card card-body">
                <h5 class="text-center">Aprobaciones firmadas</h5>
                <div class="d-flex flex-wrap gap-4 mt-4 justify-content-center"
                    style="width: 100%; max-width: 1000px; margin: auto;">
                    @foreach ($aprobacionFirmaContrato as $firma)
                        @if ($firma->firma)
                            <div class="text-center">
                                <img src="{{ $firma->firma_ruta }}" alt="firma" style="width: 400px;"> <br>
                                <span>{{ $firma->aprobador->name }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif








    <div class="col s12 m12">
        <div class="card card-body">
            <div class="table-responsive">
                <span class="card-title">Contrato</span>
                <table class="table" id="tblContrato">
                    <thead>
                        <tr>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">No. contrato</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Vigencia</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Fase</p>
                            </th>
                            <th>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">IVA</p>
                                @endif
                            </th>
                            <th>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Subtotal</p>
                                @endif
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Monto de pago total</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Estado</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Habilitar ampliación</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Convenios Modificatorios
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contrato_importe_total = $contratos->monto_pago;
                        @endphp
                        @foreach ($contratos->ampliaciones as $ampliacion)
                            @php
                                $contrato_importe_total += $ampliacion->importe;
                            @endphp
                        @endforeach
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $contratos->vigencia_contrato }}
                            </td>
                            <td>{{ $contratos->fase }}</td>
                            <td>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format(($contrato_importe_total / 1.16) * 0.16, 2) }}
                                @endif
                            </td>
                            <td>
                                @if ($contrato->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format($contrato_importe_total / 1.16, 2) }}
                                @endif
                            </td>
                            <td>$ {{ number_format($contrato_importe_total, 2) }}</td>
                            <td>{{ $contratos->estatus }}</td>
                            <td style="text-align: center">
                                <form id="ampliacion_form"
                                    action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                {{ $contratos->contrato_ampliado ? 'checked' : '' }} disabled />
                                            <span></span>
                                        </label>
                                    </p>
                                </form>
                            </td>
                            <td style="text-align: center">
                                <form id="ampliacion_form"
                                    action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                    method="POST">
                                    @method('PATCH')
                                    <p>
                                        <label>
                                            <input type="checkbox" class="checkbox"
                                                {{ $contratos->contrato_ampliado ? 'checked' : '' }} disabled />
                                            <span></span>
                                        </label>
                                    </p>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <div class="col s12 m12">
            <div class="card card-body">
                <h5 class="mb-0 d-inline-block">Facturación</h5>
                <hr class="hr-custom-title">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <p class="grey-text tablaparra">No. pagos</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Tipo</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Nombre servicio</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="black-text">
                                <td>{{ $contratos->no_pagos }}</td>
                                <td>{{ $contratos->tipo_contrato }}</td>
                                <td>{{ $contratos->nombre_servicio }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m12">
        <div class="card card-body">
            @livewire('factura.factura-component', ['contrato_id' => $contratos->id, 'show_contrato' => true, 'contrato_total' => $contratos->monto_pago])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Niveles de servicio</h5>
            <hr class="hr-custom-title">
            @livewire('niveles-servicio.niveles-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Entregables mensuales</h5>
            <hr class="hr-custom-title">
            @livewire('entregable-mensual.entregablecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => true])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cierre proyecto</h5>
            <hr class="hr-custom-title">
            @livewire('cierre-contratos.cierrecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => true])
        </div>
    </div>

    <div class="col s12 m12" id="ampliacion_contrato_lista"
        style="display: {{ $contratos->contrato_ampliado ? 'block' : 'none' }}">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Ampliación de contrato</h5>
            <hr class="hr-custom-title">
            @livewire('ampliacion-contratos.ampliacion-component', [
                'contrato_id' => $contratos->id,
                'show_contrato' => true,
                'fecha_fin_contrato' => $contratos->fecha_fin,
            ])
        </div>
    </div>

    <div class="col s12 m12" id="convenio_contrato_lista"
        style="display: {{ $contratos->convenio_modificatorio ? 'block' : 'none' }}">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Convenios Modificatorios</h5>
            <hr class="hr-custom-title">
            @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => true])
        </div>
    </div>

    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class='btn btn-success'>Salir</a>
        </div>
    </div>

    @if ($contrato->documento)
        <script type="text/javascript">
            $(document).ready(function() {
                $(".td_fianza").fadeIn(0);
            });
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(function() {
                $('.table-fianza').fadeOut(0);
            });
        </script>
    @endif
@endsection
