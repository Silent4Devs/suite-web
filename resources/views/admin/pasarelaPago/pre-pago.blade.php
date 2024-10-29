@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/global/TbColorsGlobal.css') }}">
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
            {{-- <div class="col-md-6 d-flex">
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
            </div> --}}
            <div class="col-md-6 d-flex">
                <div class="card card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4>Todas las aplicaciones Web</h4>
                        <div class="">
                            <label for=""><strong>Todos</strong></label>
                            <input type="checkbox" id="input-all-apps-pasarela">
                        </div>
                    </div>
                    <div class="box-apps-pre-pago my-4">
                        @foreach ($unsubscribed_plans as $unsubscribed_plan)
                            <div class="card-app-pre-pago">
                                <div class="d-flex gap-1 align-items-center">
                                    <i
                                        class="material-symbols-outlined icon-background color-{{ $unsubscribed_plan['img'] }}">
                                        {{ $unsubscribed_plan['img'] }}</i>
                                    <span>{{ $unsubscribed_plan['name'] }}</span>
                                </div>
                                <input type="checkbox" name="plan_ids[]" value="{{ $unsubscribed_plan['stripe_plan'] }}"
                                    class="checkbox-submit input-check-app-pasarela"
                                    data-plan-name="{{ $unsubscribed_plan['name'] }}"
                                    data-plan-price="{{ $unsubscribed_plan['price'] }}"
                                    data-plan-id="{{ $unsubscribed_plan['stripe_plan'] }}"
                                    data-plan-product="{{ $unsubscribed_plan['product'] }}">
                            </div>
                        @endforeach
                    </div>
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
                            <hr>
                            <div id="total-aplications">

                            </div>
                            <hr>
                            <div class="d-flex justify-content-between"
                                style="color: #17B265; font-weight: bolder; font-size: 18px;">
                                <span>Total al mes +IVA:</span>
                                <span id="total-price">$ 0.00</span>
                            </div>
                            <div class="mt-3">
                                <small>Al año: <strong>$3,110.00</strong> te ahorriasas <strong>$400.00</strong></small>
                            </div>
                            <form id="payment-form" action="{{ route('admin.pasarela-pago.pago') }}" method="POST">
                                @csrf
                                <div class="mt-5">
                                    <input type="hidden" name="arrayData" id="arrayData">
                                    <button id="buy-now-button" class="btn-comprar w-100 py-3 text-white" disabled
                                        type="submit">Comprar ahora</button>
                                </div>
                            </form>
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
                            <div class="d-flex justify-content-between"
                                style="color: #236485; font-weight: bolder; font-size: 18px;">
                                <span>Total al mes +IVA:</span>
                                <span>$2480.00</span>
                            </div>
                            <div class="mt-3">
                                <small>Al año: <strong>$3,110.00</strong> te ahorriasas <strong>$400.00</strong></small>
                            </div>
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

                @include('admin.pasarelaPago.components.metodos-pago')
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        const selectedPlans = [];
        document.addEventListener('DOMContentLoaded', function() {
            const allCheckbox = document.getElementById('input-all-apps-pasarela');
            const checkboxes = document.querySelectorAll('.input-check-app-pasarela');
            const totalPriceLabel = document.getElementById('total-price');
            const aplicationSelect = document.getElementById('total-aplications');
            const buyNowButton = document.getElementById('buy-now-button');

            allCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = allCheckbox.checked;
                });
                updateTotalPrice();
                updateSelectedPlans();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotalPrice();
                    updateSelectedPlans();
                });
            });

            function updateTotalPrice() {
                let totalPrice = 0;
                let anyChecked = false;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        totalPrice += parseFloat(checkbox.getAttribute('data-plan-price'));
                        anyChecked = true;
                    }
                });

                totalPriceLabel.textContent = '$ ' + totalPrice.toFixed(2);

                buyNowButton.disabled = !anyChecked;
            }

            function updateSelectedPlans() {
                selectedPlans.length = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedPlans.push({
                            name: checkbox.getAttribute('data-plan-name'),
                            product: checkbox.getAttribute('data-plan-product'),
                            price: parseFloat(checkbox.getAttribute('data-plan-price')),
                            id: checkbox.value
                        });
                    }
                });
                updatePlans(selectedPlans);
            }

            function updatePlans(plans) {
                aplicationSelect.innerHTML = '';

                if (plans.length === 0) {
                    return;
                }
                const uniquePlans = new Set();

                plans.forEach(aplicacion => {
                    const key = `${aplicacion.name}-${aplicacion.price}`;
                    if (!uniquePlans.has(key)) {
                        uniquePlans.add(key);

                        const div = document.createElement('div');
                        div.className = 'd-flex justify-content-between';

                        const span = document.createElement('span');
                        span.textContent = `${aplicacion.name}`;

                        const strong = document.createElement('strong');
                        strong.textContent = `$ ${aplicacion.price}`;
                        div.appendChild(span);
                        div.appendChild(strong);
                        aplicationSelect.appendChild(div);
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const arrayDataField = document.getElementById('arrayData');
                arrayDataField.value = JSON.stringify(selectedPlans);
                form.submit();
            });
        });
    </script>
@endsection
