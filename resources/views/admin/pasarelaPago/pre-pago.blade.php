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
                    <h4>Servicio de implementación</h4>
                    <p>
                        ¿Quieres libertad total para acceder a tu software en cualquier momento y lugar? Con nuestro
                        innovador [Nombre del Software], obtienes la flexibilidad de elegir cómo y dónde gestionar tus
                        datos.
                    </p>

                    <label for="">
                        <input type="checkbox" name="" id="">
                        Instalación local
                    </label>

                    <label for="">
                        <input type="checkbox" name="" id="">
                        En la nube
                    </label>

                    <p>
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
                    <div>
                        <button class="btn btn-comprar">
                            Comprar ahora
                        </button>
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

    </div>
@endsection
@section('scripts')
@endsection
