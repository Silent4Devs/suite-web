@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Orden de Compra')

{{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

<link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}">


<div class="create-requisicion">
    <form method="POST" action="{{ route('contract_manager.orden-compra.update', ['id' => $requisicion->id]) }}">
        @csrf
        <div class="card card-body caja-blue">

            <div>
                <img src="{{ asset('img/welcome-blue.svg') }}" alt=""
                    style="width:150px; position: relative; top: 50px; right: 410px;">
            </div>

            <div style="position: relative; top:-5rem; left: 50px;">
                <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
                <h5 style="font-size: 17px;">En esta sección podrás generar y procesar las Ordenes de Compra.</h5>
            </div>
        </div>

        <div class="requisicion-info">
            <div class="card card-body">
                <div class="row">
                    {{-- <div class="col s12 l12">
                            <h3 class="titulo-form">Orden de Compra</h3>
                            <hr style="margin: 20px 0px;">
                            <h2>Folio Requisición: 00-00{{ $requisicion->id}}</h2>
                            <br>
                        </div> --}}
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Fecha solicitud <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" value="{{ date('d-m-Y', strtotime($requisicion->fecha)) }}"
                            disabled>
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Razón Social <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" disabled value="{{ $requisicion->sucursal->descripcion }}">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Solicita <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" disabled value="{{ $requisicion->user }}">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Área que solicita <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" disabled value="{{ $requisicion->area }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 l6 ">
                        <label for="" class="txt-tamaño">
                            Referencia (Título de la requisición) <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" value="{{ $requisicion->referencia }}" disabled>
                    </div>

                    <div class="col s12 l6 ">
                        <label for="" class="txt-tamaño">
                            Comprador <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" disabled value="{{ $requisicion->comprador->user->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 ">
                        <label for="" class="txt-tamaño">
                            Proyecto <font class="asterisco">*</font>
                        </label>
                        <input class="browser-default" disabled
                            value="{{ $requisicion->contrato->no_proyecto }} / {{ $requisicion->contrato->no_contrato }} - {{ $requisicion->contrato->nombre_servicio }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Fecha de entrega
                        </label>
                        <input type="date" name="fecha_entrega" class="browser-default"
                            value="{{ $requisicion->fecha_entrega }}">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Pago a <font class="asterisco">*</font>
                        </label>
                        <select name="pago" id="" class="browser-default" required>
                            <option value=""></option>
                            <option value="credito" {{ $requisicion->pago == 'credito' ? 'selected' : '' }}>Crédito
                            </option>
                            <option value="contado" {{ $requisicion->pago == 'contado' ? 'selected' : '' }}>Contado
                            </option>
                        </select>
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Días de crédito proveedor
                        </label>
                        <input type="text" required   name="dias_credito"
                            class="browser-default" value="{{ $requisicion->dias_credito }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Moneda: <font class="asterisco">*</font>
                        </label>
                        <select name="moneda"  class="browser-default" required>
                            <option disabled selected></option>
                            @foreach ($monedas as $moneda)
                                <option value="{{ $moneda->nombre }}"
                                    {{ $moneda->nombre == $requisicion->moneda ? 'selected' : '' }}>
                                    {{ $moneda->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Tipo de cambio: <font class="asterisco"></font>
                        </label>
                        <input type="text"  name="cambio" class="browser-default"
                            value="{{ $requisicion->cambio }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="proveedores-info">
            <div class="card card-body">
                <div class="row">
                    <div class="col s12">
                        <h3 class="sub-titulo-form">Proveedor</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Proveedor <font class="asterisco">*</font>
                        </label>
                        <select name="proveedor_id" id="proveedor_id" class="browser-default" required>
                            @if ($requisicion->proveedor_id)
                                <option value="{{ $requisicion->proveedor_id }}" selected
                                    data-nombre="{{ $requisicion->proveedor->nombre }}"
                                    data-rfc="{{ $requisicion->proveedor->rfc }}"
                                    data-contacto="{{ $requisicion->proveedor->contacto }}"
                                    data-direccion="{{ $requisicion->proveedor->calle }}, {{ $requisicion->proveedor->colonia }}, {{ $requisicion->proveedor->ciudad }}"
                                    data-razon="{{ $requisicion->proveedor->razon_social }}">

                                    {{ $requisicion->proveedor->razon_social }}
                                </option>
                            @else
                                <option value="" selected disabled></option>
                            @endif
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" data-nombre="{{ $proveedor->nombre }}"
                                    data-rfc="{{ $proveedor->rfc }}" data-contacto="{{ $proveedor->contacto }}"
                                    data-direccion="{{ $proveedor->calle }}, {{ $proveedor->colonia }}, {{ $proveedor->ciudad }}"
                                    data-razon="{{ $proveedor->razon_social }}">

                                    {{ $proveedor->razon_social }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Nombre Comercial
                        </label>
                        <input type="text" id="proveedor-nombre" name="nombre" value="" readonly
                            class="browser-default">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            RFC
                        </label>
                        <input type="text" id="proveedor-rfc" name="rfc" value="" readonly
                            class="browser-default">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Nombre del contacto
                        </label>
                        <input type="text" id="proveedor-contacto" value="" name="contacto" readonly
                            class="browser-default">
                    </div>
                    <div class="col s12 l9 ">
                        <label for="" class="txt-tamaño">
                            Dirección
                        </label>
                        <input type="text" id="proveedor-direccion" value="{{ $proveedor->direccion }}"
                            name="direccion" class="browser-default">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l6 ">
                        <label for="" class="txt-tamaño">
                            Envío a
                        </label>
                        <input type="text" name="direccion_envio" value="{{ $proveedor->envio }}"
                            placeholder="Dirección" class="browser-default">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Facturación a
                        </label>
                        <input type="text" id="proveedor-razon" value="{{ $proveedor->facturacion }}"
                            name="facturacion" class="browser-default">
                    </div>
                    <div class="col s12 l3 ">
                        <label for="" class="txt-tamaño">
                            Crédito disponible
                        </label>
                        <input type="text"
                            value="{{ $proveedor->credito }}" name="credito_proveedor" class="browser-default">
                    </div>
                </div>
            </div>
        </div>

        <div class="productos-info caja-card-product">
            @php
                $count = 0;
            @endphp
            @foreach ($requisicion->productos_requisiciones as $producto)
                @php
                    $count = $count + 1;
                @endphp
                <div class="card card-body card-product">
                    <div>
                        <div class="row">
                            <div class="col s12">
                                <h3 class="sub-titulo-form">Producto o servicio</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4 ">
                                <label for="" class="txt-tamaño">
                                    Cantidad <font class="asterisco">*</font>
                                </label>
                                <input type="text" name="cantidad{{ $count }}"
                                    class="browser-default mod-cantidad" value="{{ $producto->cantidad }}">
                            </div>
                            <div class="col s12 l8 ">
                                <label for="" class="txt-tamaño">
                                    Producto o servicio <font class="asterisco">*</font>
                                </label>
                                <select class="browser-default mod-producto" name="producto{{ $count }}"
                                    required>
                                    <option value="{{ $producto->producto->id }}" selected>
                                        {{ $producto->producto->descripcion }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l12 ">
                                <label for="" class="txt-tamaño">
                                    Especificaciones del producto o servicio <font class="asterisco">*</font>
                                </label>
                                <textarea class="mod-especificaciones browser-default" name="especificaciones{{ $count }}">{{ $producto->espesificaciones }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4 ">
                                <label for="" class="txt-tamaño">
                                    Centro de costos <font class="asterisco">*</font>
                                </label>
                                <select name="centro_costo{{ $count }}"
                                    class="browser-default mod-centro_costo" id="" required>
                                    @if ($producto->centro_costo_id)
                                        <option selected value="{{ $producto->centro_costo->id }}">
                                            {{ $producto->centro_costo->clave }}</option>
                                    @else
                                        <option value="" selected disabled></option>
                                    @endif
                                    @foreach ($centro_costos as $costo)
                                        <option value="{{ $costo->id }}">
                                            {{ $costo->clave }}: {{ $costo->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col s12 l4 ">
                                <label for="" class="txt-tamaño">
                                    Proyecto <font class="asterisco">*</font>
                                </label>
                                <select required class="browser-default mod-contrato"
                                    name="contrato{{ $count }}">
                                    @isset($contrato)
                                        <option value="{{ $contrato->id }}">
                                            {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                            {{ $contrato->nombre_servicio }}
                                        @endisset
                                        @foreach ($contratos as $contrato)
                                    <option value="{{ $contrato->id }}" data-no="{{ $contrato->no_contrato }}"
                                        data-servicio="{{ $contrato->nombre_servicio }}"
                                        {{ $producto->contrato_id == $contrato->id ? 'selected' : '' }}>
                                        {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                        {{ $contrato->nombre_servicio }}
            @endforeach
            </select>
        </div>
        <div class="col s12 l4 ">
            <label for="" class="txt-tamaño">
                No. de Personas
            </label>
            <input type="text" name="no_personas{{ $count }}"
                class="browser-default mod-no_personas" value="{{ $producto->no_personas }}">
        </div>
</div>
<div class="row">
    <div class="col s12 l4 ">
        <label for="" class="txt-tamaño">
            Porcentaje de involucramiento
        </label>
        <input type="text" name="porcentaje_involucramiento{{ $count }}"
            class="browser-default mod-porcentaje_involucramiento"
            value="{{ $producto->porcentaje_involucramiento }}">
    </div>
</div>

<div class="row">
    <div class="col s12">
        <h3 class="sub-titulo-form">Subtotales</h3>
    </div>
</div>
<div class="row">
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            Sub total <font class="asterisco">*</font>
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="sub_total{{ $count }}" data-count="{{ $count }}"
                 class="mod-sub_total browser-default" required
                value="{{ $producto->sub_total }}">
        </div>
    </div>
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            IVA <font class="asterisco">*</font>
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="iva{{ $count }}" data-count="{{ $count }}"
                class="mod-iva browser-default" required value="{{ $producto->iva }}">
        </div>
    </div>
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            IVA retenido
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="iva_retenido{{ $count }}" data-count="{{ $count }}"
               class="mod-iva_retenido browser-default"
                value="{{ $producto->iva_retenido }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            Descuento
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="descuento{{ $count }}" data-count="{{ $count }}"
                class="mod-descuento browser-default"
                value="{{ $producto->descuento }}">
        </div>
    </div>
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            Otro impuesto
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="otro_impuesto{{ $count }}" data-count="{{ $count }}"
                class="mod-otro_impuesto browser-default"
                value="{{ $producto->otro_impuesto }}">
        </div>
    </div>
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            ISR retenido
        </label>
        <div class="caja-input-dinero">
            <input type="text" name="isr_retenido{{ $count }}" data-count="{{ $count }}"
                class="mod-isr_retenido browser-default"
                value="{{ $producto->isr_retenido }}">
        </div>
    </div>
    <div class="col s12 l3 ">
        <label for="" class="txt-tamaño">
            Total <font class="asterisco">*</font>
        </label>
        <div class="caja-input-dinero">
            <input id="input-total-serv{{ $count }}" type="text" name="total{{ $count }}"
                data-count="{{ $count }}" class="mod-total browser-default"
                required value="{{ $producto->total }}" readonly>
        </div>
    </div>
</div>
<hr style="margin-bottom: 30px;">
</div>
</div>
@endforeach
</div>
<input id="input-count-prod" type="hidden" name="count_productos" value="{{ $count }}">
<div>
    <div class="btn btn-add-card" onclick="addCard('servicio')"><i class="fa-regular fa-square-plus"></i> AGREGAR
        SERVICIOS Y PRODUCTOS</div>
</div>

<div class="caja-totales flex" style="justify-content: flex-end">
    <div class="card card-content" style="width: 280px;">
        <div class="row">
            <div class="col s12 l12 ">
                <label for="" class="txt-tamaño">
                    Sub total
                </label>
                <div class="caja-input-dinero">
                    <input type="text" id="sub_total_calculado" name="sub_total"
                        class="browser-default" required value="{{ $requisicion->sub_total }}"
                        style="background: rgb(250, 249, 249);" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12 ">
                <label for="" class="txt-tamaño">
                    IVA
                </label>
                <div class="caja-input-dinero">
                    <input type="text" id="iva_calculado" name="iva"
                        class="browser-default" required value="{{ $requisicion->iva }}"
                        style="background: rgb(250, 249, 249);" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12 ">
                <label for="" class="txt-tamaño">
                    IVA retenido
                </label>
                <div class="caja-input-dinero">
                    <input type="text" id="iva_retenido_calculado" name="iva_retenido"
                        class="browser-default" required value="{{ $requisicion->iva_retenido }}"
                        style="background: rgb(250, 249, 249);" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12 ">
                <label for="" class="txt-tamaño">
                    ISR retenido
                </label>
                <div class="caja-input-dinero">
                    <input type="text" id="isr_retenido_calculado" name="isr_retenido"
                        class="browser-default" required value="{{ $requisicion->isr_retenido }}"
                        style="background: rgb(250, 249, 249);" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12 ">
                <label for="" class="txt-tamaño">
                    Total
                </label>
                <div class="caja-input-dinero">
                    <input type="text" id="total_calculado" name="total"
                        class="browser-default" required value="{{ $requisicion->total }}"
                        style="background: rgb(250, 249, 249);" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex" style="justify-content: flex-end; margin-top:50px; gap:10px;">
    <a href="{{ route('contract_manager.orden-compra') }}" class="btn"
        style="background: #959595 !important">Regresar</a>
    <button class="btn btn-primary" onclick="mensaje()">Guardar</button>
</div>
</form>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function mensaje() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Registro guardado con éxito.',
            showConfirmButton: false,
            timer: 1500
        })
    }
</script>
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $('select').select2('destroy');

        let option = $('#proveedor_id option:selected');
        $('#proveedor-nombre').val(option.attr('data-nombre'));
        $('#proveedor-rfc').val(option.attr('data-rfc'));
        $('#proveedor-contacto').val(option.attr('data-contacto'));
        // $('#proveedor-direccion').val(option.attr('data-direccion'));
        // $('#proveedor-razon').val(option.attr('data-razon'));
    });

    document.getElementById('proveedor_id').addEventListener("change", function dataProveedor() {
        let option = $('#proveedor_id option:selected');
        $('#proveedor-nombre').val(option.attr('data-nombre'));
        $('#proveedor-rfc').val(option.attr('data-rfc'));
        $('#proveedor-contacto').val(option.attr('data-contacto'));
        // $('#proveedor-direccion').val(option.attr('data-direccion'));
        // $('#proveedor-razon').val(option.attr('data-razon'));
    });

    $('.productos-info').on('keyup', function(e) {
        if (e.target.parentNode.classList.contains('caja-input-dinero')) {
            let count_serv = e.target.name.split('')[e.target.name.length - 1];

            $('#input-total-serv' + count_serv).val(
                parseFloat(document.querySelector('.productos-info .mod-sub_total[data-count="' +
                    count_serv + '"]').value === "" ? 0 : document.querySelector(
                    '.productos-info .mod-sub_total[data-count="' + count_serv + '"]').value) + parseFloat(
                    document.querySelector('.productos-info .mod-iva[data-count="' + count_serv + '"]')
                    .value === "" ? 0 : document.querySelector('.productos-info .mod-iva[data-count="' +
                        count_serv + '"]').value) - Array.from(document.querySelectorAll(
                    '.productos-info .caja-input-dinero input[data-count="' + count_serv +
                    '"]:not(.mod-total, .mod-sub_total, .mod-iva)')).reduce((acumulador, elemento) =>
                    acumulador + (elemento.value === "" ? 0 : parseFloat(elemento.value)), 0)
            );

            $('#sub_total_calculado').val(Array.from(document.querySelectorAll('.mod-sub_total')).reduce((
                acumulador, elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(
                elemento.value)), 0));
            $('#iva_calculado').val(Array.from(document.querySelectorAll('.mod-iva')).reduce((acumulador,
                    elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(elemento.value)),
                0));
            $('#iva_retenido_calculado').val(Array.from(document.querySelectorAll('.mod-iva_retenido')).reduce((
                acumulador, elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(
                elemento.value)), 0));
            $('#descuento_calculado').val(Array.from(document.querySelectorAll('.mod-descuento')).reduce((
                acumulador, elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(
                elemento.value)), 0));
            $('#otro_impuesto_calculado').val(Array.from(document.querySelectorAll('.mod-otro_impuesto'))
                .reduce((acumulador, elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(
                    elemento.value)), 0));
            $('#isr_retenido_calculado').val(Array.from(document.querySelectorAll('.mod-isr_retenido')).reduce((
                acumulador, elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(
                elemento.value)), 0));
            $('#total_calculado').val(Array.from(document.querySelectorAll('.mod-total')).reduce((acumulador,
                    elemento) => acumulador + (elemento.value === "" ? 0 : parseFloat(elemento.value)),
                0));
        }
    });
</script>

<script>
    function addCard(tipo_card) {

        Swal.fire({
            title: 'Agregar Producto?',
            text: "Estas seguro de agregar un  nuevo producto, no podras eliminar los campos!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Seguro!'
        }).then((result) => {
            if (result.isConfirmed) {

                if (tipo_card === 'servicio') {
                    let card = document.querySelector('.card-product');
                    let nueva_card = document.createElement("div");
                    nueva_card.classList.add("card");
                    nueva_card.classList.add("card-body");
                    nueva_card.classList.add("card-product");
                    let cards_count = document.querySelectorAll('.card-product').length + 1;
                    nueva_card.setAttribute("data-count", cards_count);
                    let id_nueva_card = 'product-serv-' + cards_count;
                    nueva_card.setAttribute('id', id_nueva_card);

                    let caja_cards = document.querySelector('.caja-card-product');
                    caja_cards.appendChild(nueva_card);
                    document.querySelector('.card-product:last-child').innerHTML += card.innerHTML;

                    document.querySelector('#' + id_nueva_card + ' .mod-cantidad').setAttribute('name',
                        'cantidad' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-producto').setAttribute('name',
                        'producto' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-especificaciones').setAttribute('name',
                        'especificaciones' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-centro_costo').setAttribute('name',
                        'centro_costo' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-contrato').setAttribute('name',
                        'contrato' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-no_personas').setAttribute('name',
                        'no_personas' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-porcentaje_involucramiento')
                        .setAttribute('name', 'porcentaje_involucramiento' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-sub_total').setAttribute('name',
                        'sub_total' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-descuento').setAttribute('name',
                        'descuento' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-iva').setAttribute('name', 'iva' +
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-otro_impuesto').setAttribute('name',
                        'otro_impuesto' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-iva_retenido').setAttribute('name',
                        'iva_retenido' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-isr_retenido').setAttribute('name',
                        'isr_retenido' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-total').setAttribute('name', 'total' +
                        cards_count);

                    document.querySelector('#' + id_nueva_card + ' .mod-cantidad').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-producto').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-especificaciones').setAttribute(
                        'data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-centro_costo').setAttribute(
                        'data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-contrato').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-no_personas').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-porcentaje_involucramiento')
                        .setAttribute('data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-sub_total').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-descuento').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-iva').setAttribute('data-count',
                        cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-otro_impuesto').setAttribute(
                        'data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-iva_retenido').setAttribute(
                        'data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-isr_retenido').setAttribute(
                        'data-count', cards_count);
                    document.querySelector('#' + id_nueva_card + ' .mod-total').setAttribute('data-count',
                        cards_count);

                    document.querySelector('#' + id_nueva_card + ' .mod-total').setAttribute('id',
                        'input-total-serv' + cards_count);

                    $('#' + id_nueva_card + ' input').val('');
                    $('#' + id_nueva_card + ' select').innerHTML +=
                        '<option value="" selected disabled></option>';
                    $('#' + id_nueva_card + ' textarea').innerText = '';

                    document.querySelector('#input-count-prod').value = cards_count;
                }
                Swal.fire(
                    'Agregado!',
                    'Producto agregado.',
                    'success'
                )
            }
        })
    }
</script>
@endsection
