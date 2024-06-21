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
        <a href="{{ route('admin.pasarela-pago.inicio') }}" class="link">
            <i class="material-symbols-outlined">shopping_cart</i>
            Regresar al carrito
        </a>

        <div class="card card-body mt-5">
            <h4>Selecciona un método de pago</h4>
            <form id="payment-form" action="{{ route('admin.pasarela-pago.create') }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}"> --}}
                <div class="row">
                    <div class="col-md-6">

                        <div class="d-flex justify-content-center mt-5 options-pago-periodo">
                            <button class="btn active">
                                <img src="{{ asset('img/pasarelaPago/visa.png') }}" alt="">
                            </button>
                            <button class="btn">
                                <img src="{{ asset('img/pasarelaPago/paypal.svg') }}" alt="">
                            </button>
                            <button class="btn">
                                <img src="{{ asset('img/pasarelaPago/mercado-pago.webp') }}" alt="">
                            </button>
                        </div>

                        <div class="">
                            <h5 class="mt-4"> Numero de tarjeta </h5>


                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Nombre</label>
                                    <input type="text" id="nombrePago" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Apellido Paterno*</label>
                                    <input type="text" id="apellidoPaternoPago" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Apellido Materno*</label>
                                    <input type="text" id="apellidoMaternoPago" class="form-control">
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
                            <div class="row">
                                <div class="col-12 form-group d-flex align-items-center gap-1">
                                    <label>
                                        <input type="checkbox" name="" id="">
                                        Guardar mi información de pago para facilitar el proceso de pago la próxima vez.
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 d-flex align-items-center flex-column justify-content-end">
                        <p class="text-center mt-5">
                            <small><i>Al año: $31,000.00 te ahorrarías $400.00</i></small>
                        </p>

                        <button type="submit" class="btn btn-comprar py-3 w-100" id="card-button"
                            data-secret="{{ $intent->client_secret }}">Comprar ahora</button>

                        <p class="mt-4">
                            <small>
                                <i>
                                    Al hacer clic en "Realizar pedido", confirmo que he leído y acepto todos los <br>
                                    <a class="link" href="">términos y políticas.</a>
                                </i>
                            </small>
                        </p>
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
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
@endsection
