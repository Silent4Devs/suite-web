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
        <a href="" class="link">
            <i class="material-symbols-outlined">shopping_cart</i>
            Regresar al carrito
        </a>

        <div class="card card-body mt-5">
            <h4>Selecciona un método de pago</h4>

            <div class="row">
                <div class="col-md-6">

                    <div class="d-flex justify-content-center mt-5 options-pago-periodo">
                        <button class="btn active">
                            vis
                        </button>
                        <button class="btn">
                            pay
                        </button>
                        <button class="btn">
                            merca
                        </button>
                    </div>

                    <div class="">
                        <h5 class="mt-4"> Numero de tarjeta </h5>
                        <form action="">

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Apellido Paterno*</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Apellido Materno*</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Número de tarjeta*</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 form-group">
                                    <label for="">Fecha de expiración*</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="">CVC*</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group d-flex align-items-center gap-1">
                                    <input type="checkbox" name="" id="">
                                    <label for="">
                                        Guardar mi información de pago para facilitar el proceso de pago la próxima vez.
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-center mt-5 options-pago-periodo">
                        <button class="btn active">
                            Mensual
                        </button>
                    </div>
                    <h4 class="d-flex justify-content-between mt-4">
                        <span>8 Aplicaciones</span>
                        <span>$310.00 x 8</span>
                    </h4>
                    <hr>
                    <h5 class="d-flex justify-content-between">
                        <span>Todas las aplicaciones</span>
                        <span>$2480.00 mx</span>
                    </h5>
                    <hr>
                    <span>¿Tienes un código de descuento?</span>
                    <div class="d-flex align-items-center gap-1">
                        <input type="text" class="form-control">
                        <button class="btn btn-secondary">Enviar&nbsp;código</button>
                    </div>
                    <hr>
                    <h5 class="d-flex justify-content-between" style="color: #0034E3;">
                        <span>Total al mes +IVA:</span>
                        <span>$2620.00 mx</span>
                    </h5>

                    <p class="text-center">
                        <small><i>Al año: $31,000.00 te ahorrarías $400.00</i></small>
                    </p>

                    <button class="btn btn-success w-100">
                        Comprar ahora
                    </button>

                    <p>
                        <small>
                            <i>
                                Al hacer clic en "Realizar pedido", confirmo que he leído y acepto todos los
                                <a href="">términos y políticas.</a>
                            </i>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
