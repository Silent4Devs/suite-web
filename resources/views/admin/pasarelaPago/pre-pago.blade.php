@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.components.menu')

    <div class="content-pasarela">
        @include('admin.pasarelaPago.components.btn-regresar')

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-body">
                    <h3 style="color: #3086AF;">Servicio de implementación</h3>
                    <p class="mt-4">
                        ¿Quieres libertad total para acceder a tu software en cualquier momento y lugar? Con nuestro
                        innovador [Nombre del Software], obtienes la flexibilidad de elegir cómo y dónde gestionar tus
                        datos.
                    </p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" style="font-size:17px;" for="inlineRadio1">Instalación
                            local</label>
                    </div>

                    <p class="mt-4">
                        Instálalo en tu servidor local para un control total sobre tu información y un acceso rápido sin
                        depender de la conexión a internet. <br>

                        <strong>Limite de almacenamiento en la nube 1T</strong>
                    </p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" style="font-size:17px;" for="inlineRadio1">En la nube</label>
                    </div>

                    <p class="mt-4">
                        ¿O prefieres la conveniencia de la nube? No hay problema. Con solo unos clics, tu software
                        estará
                        listo para funcionar en un entorno virtual, garantizando la disponibilidad y la seguridad de tus
                        datos en cualquier situación. <br>

                        <strong>Limite de almacenamiento en la nube 1T</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="nav options-pago-periodo" style="border: none;">
                    <button class="btn active" data-toggle="tab" data-target="#nav-mes">
                        Mes
                    </button>
                    <button class="btn" data-toggle="tab" data-target="#nav-año">
                        Año
                    </button>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-mes">
                        <div class="card card-body">
                            <div class="d-flex justify-content-between">
                                <span>Todas las aplicaciones</span>
                                <strong>$6600.00 MX</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>8 Aplicaciones</span>
                                <strong>$310.00 x 8</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Total al mes +IVA:</span>
                                <strong>$2480.00</strong>
                            </div>
                            <span>Al año: <strong>$3,110.00</strong> te ahorriasas <strong>$400.00</strong></span>
                            <div class="mt-5">
                                <a href="{{ route('admin.pasarela-pago.pago') }}"
                                    class="btn btn-comprar w-100 py-3 text-white">
                                    Comprar ahora
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-año">
                        <div class="card card-body">
                            <div class="d-flex justify-content-between">
                                <span>Todas las aplicaciones</span>
                                <strong>$6600.00 MX</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>8 Aplicaciones</span>
                                <strong>$310.00 x 8</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Total al mes +IVA:</span>
                                <strong>$2480.00</strong>
                            </div>
                            <span>Al año: <strong>$3,110.00</strong> te ahorriasas <strong>$400.00</strong></span>
                            <div class="mt-5">
                                <a href="{{ route('admin.pasarela-pago.pago') }}"
                                    class="btn btn-comprar w-100 py-3 text-white" style="background-color: #3086AF;">
                                    Comprar ahora
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <p>
                    Medios de pago
                </p>
                <div class="card card-body">
                    <div class="p-4" style="background-color: #FFFFDA;">
                        Tu seguridad es nuestra prioridad. Con nuestra plataforma de pagos online, puedes estar
                        tranquilo
                        sabiendo que tus transacciones están protegidas en cada paso del camino.
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-5">
            <h4>Todas las aplicaciones Web</h4>
            <div class="">
                <label for="">Todos</label>
                <input type="checkbox">
            </div>
        </div>
        <div class="box-apps-pre-pago my-4">
            @foreach ($plans as $plan)
                <div class="card-app-pre-pago">
                    <div class="d-flex gap-1 align-items-center">
                        <i class="material-symbols-outlined icon-background" style="background-color: #9CEBFF;">school</i>
                        <span>{{ $plan->name }}</span>
                    </div>
                    <input type="checkbox" name="plan_ids[]" value="{{ $plan->id }}" class="checkbox-submit">
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
@endsection
