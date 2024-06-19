@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.menu')

    <div class="content-pasarela">
        <a href="" class="link">Regresar</a>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-body mt-5">
                    <h3 style="color: #3086AF;">Servicio de implementación</h3>
                    <p class="mt-3">
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

                    <p class="mt-3">
                        Instálalo en tu servidor local para un control total sobre tu información y un acceso rápido sin
                        depender de la conexión a internet.
                        <strong>Limite de almacenamiento en la nube 1T</strong>
                    </p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" style="font-size:17px;" for="inlineRadio1">En la nube</label>
                    </div>

                    <p class="mt-3">
                        ¿O prefieres la conveniencia de la nube? No hay problema. Con solo unos clics, tu software estará
                        listo para funcionar en un entorno virtual, garantizando la disponibilidad y la seguridad de tus
                        datos en cualquier situación. <br>

                        <strong>Limite de almacenamiento en la nube 1T</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-center mt-5 options-pago-periodo" style="border: none;">
                    <button class="btn active">
                        Mes
                    </button>
                    <button class="btn">
                        Año
                    </button>
                </div>
                <div class="card card-body">
                    <div class="d-flex justify-content-between">
                        <span>Todas las aplicaciones</span>
                        <span>$6600.00 MX</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>8 Aplicaciones</span>
                        <span>$310.00 x 8</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Total al mes +IVA:</span>
                        <span>$2480.00</span>
                    </div>
                    <span>Al año: $3,110.00 te ahorriasas $400.00</span>
                    <div class="mt-5">
                        <a href="{{ route('admin.pasarela-pago.pago') }}" class="btn btn-comprar w-100 py-3 text-white">
                            Comprar ahora
                        </a>
                    </div>
                </div>

                <p>
                    Medios de pago
                </p>
                <div class="card card-body">
                    <div class="p-4" style="background-color: #FFFFDA;">
                        Tu seguridad es nuestra prioridad. Con nuestra plataforma de pagos online, puedes estar tranquilo
                        sabiendo que tus transacciones están protegidas en cada paso del camino.
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-5">
            <h3>Todas las aplicaciones Web</h3>
            <div class="">
                <label for="">Todos</label>
                <input type="checkbox">
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 all-aplicaciones-pre">
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background" style="background-color: #9CEBFF;">school</i>
                    <strong>Capacitación</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background" style="background-color: #F1F1F1;">language</i>
                    <strong>Gestión Normativa</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background"
                        style="background-color: #FCB4BC;">quick_reference</i>
                    <strong>Planes de trabajo</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background"
                        style="background-color: #E0C5FF;">folder_managed</i>
                    <strong>Gestor Documental</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background"
                        style="background-color: #9CEBFF;">install_desktop</i>
                    <strong>Gestión de Talento</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background"
                        style="background-color: #F1F1F1;">quick_reference</i>
                    <strong>Gestión Contractual</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background" style="background-color: #FCB4BC;">gpp_maybe</i>
                    <strong>Gestión de Riesgos</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
            <div class="card card-body flex-direction-row flex-wrap justify-content-between">
                <div class="d-flex gap-1 align-items-center">
                    <i class="material-symbols-outlined icon-background" style="background-color: #E0C5FF;">groups</i>
                    <strong>Visitantes</strong>
                </div>
                <input type="checkbox" name="" id="">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
