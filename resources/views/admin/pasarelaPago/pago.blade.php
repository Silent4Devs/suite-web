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

    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        You will be charged ${{ number_format($plan->price, 2) }} for {{ $plan->name }} Plan
                    </div>

                    <div class="card-body">

                        <form id="payment-form" action="{{ route('admin.pasarela-pago.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="card-holder-name" class="form-control"
                                            value="" placeholder="Name on the card">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Card details</label>
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary" id="card-button"
                                        data-secret="{{ $intent->client_secret }}">Purchase</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="content-pasarela">
        <a href="{{ route('admin.pasarela-pago.pre-pago') }}" class="link pb-2">
            <i class="material-symbols-outlined">shopping_cart</i>
            Regresar al carrito
        </a>

        <div class="card card-body mt-5">
            <h5>Selecciona un método de pago</h5>
            <form id="payment-form" action="{{ route('admin.pasarela-pago.create') }}" method="POST">
                @csrf
                <input type="hidden" class="form-control" name="plan" id="plan" value="{{ json_encode($data) }}">

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="nav options-pago-periodo">
                            <button class="btn active" data-toggle="tab" data-target="#nav-visa">
                                <img src="{{ asset('img/pasarelaPago/visa.png') }}" alt="">
                            </button>
                            <button class="btn" data-toggle="tab" data-target="#nav-paypal">
                                <img src="{{ asset('img/pasarelaPago/paypal.svg') }}" alt="">
                            </button>
                            <button class="btn" data-toggle="tab" data-target="#nav-mercado">
                                <img src="{{ asset('img/pasarelaPago/mercado-pago.webp') }}" alt="">
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-visa">
                        <div class="row">
                            <div class="col-md-6">

                                <h5 class="mt-4" style="font-size: 18px;"> Numero de tarjeta </h5>

                                <div class="row mt-3">
                                    <div class="form-group col-12">
                                        <label for="nombrePago">Nombre</label>
                                        <input type="text" id="nombrePago" name="nombrePago" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="apellidoPaternoPago">Apellido Paterno*</label>
                                        <input type="text" id="apellidoPaternoPago" name="apellidoPaternoPago"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="apellidoMaternoPago">Apellido Materno*</label>
                                        <input type="text" id="apellidoMaternoPago" name="apellidoMaternoPago"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Detalle de Tarjeta</label>
                                            <div id="card-element"></div>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="codigoDescuento">Código de Descuento</label>
                                            <input type="text" class="form-control" name="codigoDescuento"
                                                id="codigoDescuento" placeholder="Código de Descuento" maxlength="255"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 d-flex align-items-center flex-column">
                                {{-- <div style="text-center">
                                    <img src="{{ asset('img/logo_monocromatico.png') }}" alt=""
                                        style="height: 150px; opacity: 0.9;">
                                </div> --}}
                                <div class="text-center">
                                    <p class="text-center h3"><strong>Total a pagar:</strong></p>
                                    <p class="text-center h3"><strong>$: {{ json_encode($totalPriceFormatted) }}</strong></p>
                                </div>
                                <p class="text-center mt-5">
                                    <small><i>Al año: $31,000.00 te ahorrarías $400.00</i></small>
                                </p>
                                <button type="submit" class="btn btn-comprar py-3 w-100" id="card-button"
                                    data-secret="{{ $intent->client_secret }}">Comprar ahora</button>
                                <p class="mt-4">
                                    <small>
                                        <i>
                                            Al hacer clic en "Realizar pedido", confirmo que he leído y acepto todos los
                                            <br>
                                            <a class="link" href="">términos y políticas.</a>
                                        </i>
                                    </small>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-paypal">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="card card-body">
                                    <h5 class="mt-4" style="font-size: 18px;"> Compras en Tabantaj </h5>
                                    <p>
                                        Cuando se haya completado la transacción, se hará el cargo a tu método de
                                        pago y
                                        recibirás
                                        un correo electrónico para confirmar que hemos recibido tu pedido de compra.
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center flex-column">
                                {{-- <div style="text-center">
                                    <img src="{{ asset('img/logo_monocromatico.png') }}" alt=""
                                        style="height: 150px; opacity: 0.9;">
                                </div> --}}
                                <div class="text-center">
                                    <p class="text-center h3"><strong>Total a pagar:</strong></p>
                                    <p class="text-center h3"><strong>$: {{ json_encode($totalPriceFormatted) }}</strong></p>
                                </div>
                                <p class="text-center mt-5">
                                    <small><i>Al año: $31,000.00 te ahorrarías $400.00</i></small>
                                </p>

                                <button type="submit" class="btn btn-comprar py-3 w-100" id="card-button"
                                    data-secret="{{ $intent->client_secret }}" style="background-color: #FFC439;">
                                    <img src="{{ asset('img/pasarelaPago/paypal.svg') }}" alt=""
                                        style="height: 35px;">
                                </button>

                                <p class="mt-4">
                                    <small>
                                        <i>
                                            Al hacer clic en "Realizar pedido", confirmo que he leído y acepto todos los
                                            <br>
                                            <a class="link" href="">términos y políticas.</a>
                                        </i>
                                    </small>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-mercado">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="card card-body">
                                    <h5 class="mt-4" style="font-size: 18px;"> Compras en Tabantaj </h5>
                                    <p>
                                        Cuando se haya completado la transacción, se hará el cargo a tu método de pago y
                                        recibirás
                                        un correo electrónico para confirmar que hemos recibido tu pedido de compra.
                                    </p>
                                </div>

                            </div>

                            <div class="col-md-6 d-flex align-items-center flex-column">
                                {{-- <div style="text-center">
                                    <img src="{{ asset('img/logo_monocromatico.png') }}" alt=""
                                        style="height: 150px; opacity: 0.9;">
                                </div> --}}
                                <div class="text-center">
                                    <p class="text-center h3"><strong>Total a pagar:</strong></p>
                                    <p class="text-center h3"><strong>$: {{ json_encode($totalPriceFormatted) }}</strong></p>
                                </div>
                                <p class="text-center mt-5">
                                    <small><i>Al año: $31,000.00 te ahorrarías $400.00</i></small>
                                </p>

                                <button type="submit" class="btn btn-comprar py-3 w-100" id="card-button"
                                    data-secret="{{ $intent->client_secret }}"
                                    style="background-color: #fff; border:1px solid #bababa;">
                                    <img src="{{ asset('img/pasarelaPago/mercado-pago.webp') }}" alt=""
                                        style="height: 35px;">
                                </button>

                                <p class="mt-4">
                                    <small>
                                        <i>
                                            Al hacer clic en "Realizar pedido", confirmo que he leído y acepto todos los
                                            <br>
                                            <a class="link" href="">términos y políticas.</a>
                                        </i>
                                    </small>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const name = document.getElementById('nombrePago')
        const apellidoPa = document.getElementById('apellidoPaternoPago')
        const apellidoMa = document.getElementById('apellidoMaternoPago')
        const descuento = document.getElementById('codigoDescuento');


        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            const nombreCompleto = name.value + ' ' + apellidoPa.value + ' ' + apellidoMa.value;
            cardBtn.disabled = true
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: nombreCompleto
                        }
                    }
                }
            )

            if (error) {
                cardBtn.disable = false
            } else {
                let token = document.createElement('input');
                token.setAttribute('type', 'hidden');
                token.setAttribute('name', 'token');
                token.setAttribute('value', setupIntent.payment_method);
                form.appendChild(token);

                if (descuento.value) {
                    let descuentoInput = document.createElement('input');
                    descuentoInput.setAttribute('type', 'hidden');
                    descuentoInput.setAttribute('name', 'codigo_descuento');
                    descuentoInput.setAttribute('value', descuento.value);
                    form.appendChild(descuentoInput);
                }

                form.submit();
            }
        })
    </script>
    <script>
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });

        document.getElementById('cvv').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 4);
        });

        document.getElementById('expirationDate').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 4);
            if (this.value.length > 2) {
                this.value = this.value.slice(0, 2) + '/' + this.value.slice(2);
            }
        });
    </script>
@endsection
