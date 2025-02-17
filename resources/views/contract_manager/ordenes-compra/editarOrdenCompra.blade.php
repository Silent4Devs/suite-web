@extends('layouts.admin')

@section('content')
{{-- @section('titulo', 'Actualizar Orden de Compra') --}}

<link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}">
<link rel="stylesheet" href="{{ asset('css/requisitions/jquery.signature.css') }}{{ config('app.cssVersion') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
<style>
    .pulse {
        animation: pulse-animation 2s infinite;
    }

    .pulse-0 {
        animation: pulse-animation-0 2s infinite;
    }

    @keyframes pulse-animation {
        0% {
            box-shadow: 0 0 0 0px {{ $contadorIntentos['contadorColor'] }};
        }

        100% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }
    }

    @keyframes pulse-animation-0 {
        0% {
            box-shadow: 0 0 0 0px #FF0000;
        }

        100% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }
    }
</style>

{{-- <div class="card card-body"> --}}
{{-- <h4>Tienes
        @if ($contadorEdit == 3 || $contadorEdit == 2)
            <span class="badge badge-pill badge-success">{{ $contadorEdit }}</span>
        @elseif ($contadorEdit == 1)
            <span class="badge badge-pill badge-warning">{{ $contadorEdit }}</span>
        @else
            <span class="badge badge-pill badge-danger">{{ $contadorEdit }}</span>
        @endif
        ediciones disponibles:
    </h4> --}}
{{-- </div> --}}
@if ($contadorEdit > 0)
    <div class="create-requisicion">
        <form method="POST"
            action="{{ route('contract_manager.orden-compra.updateOrdenCompra', ['id' => $requisicion->id]) }}">
            @csrf
            <div class="card card-body caja-blue">

                <div>
                    <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width:150px; ">
                </div>

                <div>
                    <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
                    <h5 style="font-size: 17px;">En esta sección podrás modificar y procesar las Ordenes de Compra.</h5>
                </div>
            </div>

            <div class="card pulse" style="width: 156px; height: 68px;">
                <div class="card-body d-flex flex-column align-items-center">
                    <p class="mb-0" style="font-size:12px; color:#4870B2;">Ediciones disponibles</p>
                    <div class="card" style="width: 43px; height: 23px; margin-top:7px;">
                        <div class="card-body d-flex justify-content-center align-items-center"
                            style="padding:0px; background-color:{{ $contadorIntentos['contadorColor'] }}; border-radius:16px;">
                            <p class="mb-0" style="font-size:12px; color:#FFFFFF;">
                                {{ $contadorIntentos['contadorEdit'] }}</p>
                        </div>
                    </div>
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
                            <div class="anima-focus">
                                <input id="fecha_solicitud" class="form-control" placeholder=""
                                    value="{{ date('d-m-Y', strtotime($requisicion->fecha)) }}" disabled>
                                <label for="fecha_solicitud">
                                    Fecha solicitud <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input id="sucursal" class="form-control" placeholder="" disabled
                                    value="{{ $requisicion->sucursal->descripcion }}">
                                <label for="sucursal">
                                    Razón Social <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input id="usuario" placeholder="" class="form-control" disabled
                                    value="{{ $requisicion->user }}">
                                <label for="usuario">
                                    Solicita <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input id="area_sol" class="form-control" disabled placeholder=""
                                    value="{{ $requisicion->area }}">
                                <label for="area_sol">
                                    Área que solicita <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 l6 ">
                            <div class="anima-focus">
                                <input id="referencia" class="form-control" placeholder=""
                                    value="{{ $requisicion->referencia }}" disabled>
                                <label for="referencia">
                                    Referencia (Título de la requisición) <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>

                        <div class="col s12 l6 ">
                            <div class="anima-focus">
                                <input id="comprador" class="form-control" disabled placeholder=""
                                    value="{{ $requisicion->comprador->user->name }}">
                                <label for="comprador">
                                    Comprador <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 ">
                            <div class="anima-focus">
                                <input class="form-control" disabled id="proyecto" placeholder=""
                                    value="{{ optional($requisicion->contrato)->no_proyecto }} / {{ optional($requisicion->contrato)->no_contrato }} - {{ optional($requisicion->contrato)->nombre_servicio }}">
                                <label for="proyecto">
                                    Proyecto <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                                    placeholder="" value="{{ $requisicion->fecha_entrega }}">
                                <label for="fecha_entrega">
                                    Fecha de entrega
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <select name="pago" id="pago" class="form-control" required placeholder="">
                                    <option value="" disabled selected>Seleccione una forma de pago</option>
                                    <option value="credito" {{ $requisicion->pago == 'credito' ? 'selected' : '' }}>
                                        Crédito
                                    </option>
                                    <option value="contado" {{ $requisicion->pago == 'contado' ? 'selected' : '' }}>
                                        Contado
                                    </option>
                                </select>
                                <label for="pago">
                                    Pago a <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" required name="dias_credito" id="dias_credito"
                                    class="form-control" placeholder="" value="{{ $requisicion->dias_credito }}">
                                <label for="dias_credito">
                                    Días de crédito proveedor*
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <select name="moneda" id="moneda" class="form-control" required placeholder="">
                                    <option value="" disabled selected>
                                        Seleccione un tipo de moneda
                                    </option>
                                    @foreach ($monedas as $moneda)
                                        <option value="{{ $moneda->nombre }}"
                                            {{ $moneda->nombre == $requisicion->moneda ? 'selected' : '' }}>
                                            {{ $moneda->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="moneda">
                                    Moneda: <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" name="cambio" id="cambio" class="form-control"
                                    placeholder="" value="{{ $requisicion->cambio }}">
                                <label for="cambio">
                                    Tipo de cambio: <font class="asterisco"></font>
                                </label>
                            </div>
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
                            <div class="anima-focus">
                                <select name="proveedor_id" id="proveedor_id" class="form-control" required
                                    placeholder="">
                                    @if ($requisicion->proveedoroc_id)
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}"
                                                {{ $requisicion->proveedoroc_id == $proveedor->id ? 'selected' : '' }}
                                                data-nombre="{{ $proveedor->nombre }}"
                                                data-rfc="{{ $proveedor->rfc }}"
                                                data-contacto="{{ $proveedor->contacto }}"
                                                data-direccion="{{ $proveedor->calle }}, {{ $proveedor->colonia }}, {{ $proveedor->ciudad }}"
                                                data-razon="{{ $proveedor->razon_social }}">

                                                {{ $proveedor->razon_social }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled> Seleccione un Proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}"
                                                data-nombre="{{ $proveedor->nombre }}"
                                                data-rfc="{{ $proveedor->rfc }}"
                                                data-contacto="{{ $proveedor->contacto }}"
                                                data-direccion="{{ $proveedor->calle }}, {{ $proveedor->colonia }}, {{ $proveedor->ciudad }}"
                                                data-razon="{{ $proveedor->razon_social }}">

                                                {{ $proveedor->razon_social }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="proveedor_id">
                                    Proveedor <font class="asterisco">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" id="proveedor-nombre" name="nombre"
                                    value="{{ $requisicion->proveedor_catalogo_oc ?? $requisicion->proveedorOC->nombre ?? '' }}" placeholder=""
                                    class="form-control">
                                <label for="proveedor-nombre">
                                    Nombre Comercial
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" id="proveedor-rfc" name="rfc"
                                    value="{{ $requisicion->proveedorOC->rfc ?? '' }}" placeholder=""
                                    class="form-control">
                                <label for="proveedor-rfc">
                                    RFC
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" id="proveedor-contacto"
                                    value="{{ $requisicion->proveedorOC->contacto ?? '' }}" name="contacto"
                                    placeholder="" class="form-control">
                                <label for="proveedor-contacto">
                                    Nombre del contacto
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l9 ">
                            <div class="anima-focus">
                                <input type="text" id="proveedor-direccion"
                                    value="{{ $requisicion->proveedorOC->direccion ?? $proveedor->direccion ?? '' }}" placeholder="" name="direccion"
                                    class="form-control">
                                <label for="proveedor-direccion">
                                    Dirección
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l6 ">
                            <div class="anima-focus">
                                <input type="text" id="envio" name="direccion_envio"
                                    value="{{ $requisicion->proveedorOC->envio ?? $requisicion->direccion_envio_proveedor ?? '' }}" placeholder=""
                                    class="form-control">
                                <label for="envio">
                                    Envío a
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" id="proveedor-razon"
                                    value="{{ $requisicion->proveedorOC->facturacion ?? $proveedor->facturacion ?? '' }}" placeholder="" name="facturacion"
                                    class="form-control">
                                <label for="proveedor-razon">
                                    Facturación a
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3 ">
                            <div class="anima-focus">
                                <input type="text" value="{{ $requisicion->proveedorOC->credito ?? $requisicion->credito_proveedor ?? '' }}"
                                    name="credito_proveedor" placeholder="" id="cred_prov" class="form-control">
                                <label for="cred_prov">
                                    Crédito disponible
                                </label>
                            </div>
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
                            <input type="number" id="id_prod_{{ $count }}"
                                name="id_prod{{ $count }}" class="form-control mod-id_prod"
                                value="{{ $producto->id ?? null }}" hidden>
                            <div class="row">
                                <div class="col s12 l4 ">
                                    <div class="anima-focus">
                                        <input type="text" id="cant_{{ $count }}" placeholder=""
                                            name="cantidad{{ $count }}" class="form-control mod-cantidad"
                                            value="{{ $producto->cantidad }}">
                                        <label for="cant_{{ $count }}">
                                            Cantidad <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 l8 ">
                                    <div class="anima-focus">
                                        <select class="form-control mod-producto" id="prod_{{ $count }}"
                                            placeholder="" name="producto{{ $count }}" required>
                                            <option value="{{ $producto->producto->id }}" selected>
                                                {{ $producto->producto->descripcion }}
                                            </option>
                                        </select>
                                        <label for="prod_{{ $count }}">
                                            Producto o servicio <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l12 ">
                                    <div class="anima-focus">
                                        <textarea class="mod-especificaciones form-control" id="espec_{{ $count }}" placeholder=""
                                            name="especificaciones{{ $count }}">{{ $producto->espesificaciones }}</textarea>
                                        <label for="espec_{{ $count }}">
                                            Especificaciones del producto o servicio <font class="asterisco">*
                                            </font>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l4 ">
                                    <div class="anima-focus">
                                        <select name="centro_costo{{ $count }}" id="cen_cos" placeholder=""
                                            class="form-control mod-centro_costo" id="" required>
                                            @if ($producto->centro_costo_id)
                                                <option selected value="{{ $producto->centro_costo->id }}">
                                                    {{ $producto->centro_costo->clave }}</option>
                                            @else
                                                <option value="" selected disabled>Seleccione una opción de
                                                    Centro de
                                                    Costos</option>
                                            @endif
                                            @foreach ($centro_costos as $costo)
                                                <option value="{{ $costo->id }}">
                                                    {{ $costo->clave }}: {{ $costo->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="cen_cos">
                                            Centro de costos <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 l4 ">
                                    <div class="anima-focus">
                                        <select required class="form-control mod-contrato"
                                            id="cont_{{ $count }}" placeholder=""
                                            name="contrato{{ $count }}">
                                            @isset($contrato)
                                                <option value="{{ $contrato->id }}">
                                                    {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                                    {{ $contrato->nombre_servicio }}
                                                </option>
                                            @endisset
                                            @foreach ($contratos as $contrato)
                                                <option value="{{ $contrato->id }}"
                                                    data-no="{{ $contrato->no_contrato }}"
                                                    data-servicio="{{ $contrato->nombre_servicio }}"
                                                    {{ $producto->contrato_id == $contrato->id ? 'selected' : '' }}>
                                                    {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                                    {{ $contrato->nombre_servicio }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="cont_{{ $count }}">
                                            Proyecto <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 l4 ">
                                    <div class="anima-focus">
                                        <input type="text" id="no_p_{{ $count }}" placeholder=""
                                            name="no_personas{{ $count }}"
                                            class="form-control mod-no_personas"
                                            value="{{ $producto->no_personas }}">
                                        <label for="no_p_{{ $count }}">
                                            No. de Personas
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l4 ">
                                    <div class="anima-focus">
                                        <input type="text" id="porc_inv_{{ $count }}"
                                            name="porcentaje_involucramiento{{ $count }}"
                                            class="form-control mod-porcentaje_involucramiento"
                                            value="{{ $producto->porcentaje_involucramiento }}" placeholder="">
                                        <label for="porc_inv_{{ $count }}">
                                            Porcentaje de involucramiento
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <h3 class="sub-titulo-form">Subtotales</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l3 ">
                                    <label for="">
                                        Sub total <font class="asterisco">*</font>
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="sub_total{{ $count }}"
                                            data-count="{{ $count }}" class="mod-sub_total form-control"
                                            required value="{{ $producto->sub_total }}">
                                    </div>
                                </div>
                                <div class="col s12 l3 ">
                                    <label for="">
                                        IVA <font class="asterisco">*</font>
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="iva{{ $count }}"
                                            data-count="{{ $count }}" class="mod-iva form-control" required
                                            value="{{ $producto->iva }}">
                                    </div>
                                </div>
                                <div class="col s12 l3 ">
                                    <label for="">
                                        IVA retenido
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="iva_retenido{{ $count }}"
                                            data-count="{{ $count }}" class="mod-iva_retenido form-control"
                                            value="{{ $producto->iva_retenido }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l3 ">
                                    <label for="">
                                        Descuento
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="descuento{{ $count }}"
                                            data-count="{{ $count }}" class="mod-descuento form-control"
                                            value="{{ $producto->descuento }}">
                                    </div>
                                </div>
                                <div class="col s12 l3 ">
                                    <label for="">
                                        Otro impuesto
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="otro_impuesto{{ $count }}"
                                            data-count="{{ $count }}" class="mod-otro_impuesto form-control"
                                            value="{{ $producto->otro_impuesto }}">
                                    </div>
                                </div>
                                <div class="col s12 l3 ">
                                    <label for="">
                                        ISR retenido
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input type="text" name="isr_retenido{{ $count }}"
                                            data-count="{{ $count }}" class="mod-isr_retenido form-control"
                                            value="{{ $producto->isr_retenido }}">
                                    </div>
                                </div>
                                <div class="col s12 l3 ">
                                    <label for="">
                                        Total <font class="asterisco">*</font>
                                    </label>
                                    <div class="caja-input-dinero">
                                        <input id="input-total-serv{{ $count }}" type="text"
                                            name="total{{ $count }}" data-count="{{ $count }}"
                                            class="mod-total form-control" required value="{{ $producto->total }}">
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
                <div class="btn btn-add-card" onclick="addCard('servicio')"><i class="fa-regular fa-square-plus"></i>
                    AGREGAR
                    SERVICIOS Y PRODUCTOS</div>
            </div>

            <div class="caja-totales flex" style="justify-content: flex-end">
                <div class="card card-content" style="width: 280px;">
                    <div class="row">
                        <div class="col s12 l12 ">
                            <label for="">
                                Sub total
                            </label>
                            <div class="caja-input-dinero">
                                <input type="text" id="sub_total_calculado" name="sub_total" class="form-control"
                                    required value="{{ $requisicion->sub_total }}"
                                    style="background: rgb(250, 249, 249);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12 ">
                            <label for="">
                                IVA
                            </label>
                            <div class="caja-input-dinero">
                                <input type="text" id="iva_calculado" name="iva" class="form-control"
                                    required value="{{ $requisicion->iva }}"
                                    style="background: rgb(250, 249, 249);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12 ">
                            <label for="">
                                IVA retenido
                            </label>
                            <div class="caja-input-dinero">
                                <input type="text" id="iva_retenido_calculado" name="iva_retenido"
                                    class="form-control" required value="{{ $requisicion->iva_retenido }}"
                                    style="background: rgb(250, 249, 249);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12 ">
                            <label for="">
                                ISR retenido
                            </label>
                            <div class="caja-input-dinero">
                                <input type="text" id="isr_retenido_calculado" name="isr_retenido"
                                    class="form-control" required value="{{ $requisicion->isr_retenido }}"
                                    style="background: rgb(250, 249, 249);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12 ">
                            <label for="">
                                Total
                            </label>
                            <div class="caja-input-dinero">
                                <input type="text" id="total_calculado" name="total" class="form-control"
                                    required value="{{ $requisicion->total }}"
                                    style="background: rgb(250, 249, 249);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex" style="justify-content: flex-end; margin-top:50px; gap:10px;">
                <a href="{{ route('contract_manager.orden-compra') }}" class="btn btn-outline-primary">Regresar</a>
                <button class="btn tb-btn-primary" onclick="mensaje()">Guardar</button>
            </div>
        </form>
    </div>

    @livewire('tabla-historico-ordenes-compra', ['idReq' => $requisicion->id])
    {{-- <div class="card card-body">
        <h4>Historial de Cambios:</h4>

        @if (!empty($resultadoOrdenesCompra))
            @foreach ($resultadoOrdenesCompra as $cambios)
                <h5 style="margin-bottom: 10px;">Versión: {{ $cambios['version'] }}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor Anterior</th>
                            <th>Valor Modificado</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($cambios['cambios']))
                            @foreach ($cambios['cambios'] as $cambio)
                                <tr>
                                    <td>{{ getDiccionaryRequisionOrder($cambio->campo) }}</td>
                                    <td>{{ $cambio->valor_anterior }}</td>
                                    <td>{{ $cambio->valor_nuevo }}</td>
                                    <td>{{ $cambio->empleado->name }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No hay cambios registrados para esta versión.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br> <!-- Espacio entre tablas -->
            @endforeach
        @else
            <h6>No hay cambios registrados</h6>
        @endif

    </div> --}}

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

            let total_serv = parseFloat(document.querySelector('.productos-info .mod-sub_total[data-count="' +
                count_serv + '"]').value === "" ? 0 : document.querySelector(
                '.productos-info .mod-sub_total[data-count="' + count_serv + '"]').value) + parseFloat(
                document.querySelector('.productos-info .mod-iva[data-count="' + count_serv + '"]')
                .value === "" ? 0 : document.querySelector('.productos-info .mod-iva[data-count="' +
                    count_serv + '"]').value) - Array.from(document.querySelectorAll(
                '.productos-info .caja-input-dinero input[data-count="' + count_serv +
                '"]:not(.mod-total, .mod-sub_total, .mod-iva)')).reduce((acumulador, elemento) =>
                acumulador + (elemento.value === "" ? 0 : parseFloat(elemento.value)), 0);


            $('#input-total-serv' + count_serv).val(
                parseFloat(total_serv).toFixed(4)
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
                text: "Estas seguro de agregar un nuevo producto, no podrás eliminar los campos!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Seguro!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (tipo_card === 'servicio') {
                        // Obtén el conteo actual de cards
                        let cards_count = document.querySelectorAll('.card-product').length + 1;

                        // Crea la nueva card
                        let nueva_card = document.createElement("div");
                        nueva_card.classList.add("card", "card-body", "card-product");
                        nueva_card.setAttribute("data-count", cards_count);
                        nueva_card.setAttribute('id', `product-serv-${cards_count}`);

                        // Construye el HTML dinámicamente
                        nueva_card.innerHTML = `
                            <div>
                                <input type="number" id="id_prod_${cards_count}" name="id_prod${cards_count}"
                                    class="form-control mod-id_prod" hidden>
                                <div class="row">
                                    <div class="col s12 l4">
                                        <div class="anima-focus">
                                            <input type="text" id="cant_${cards_count}"
                                                name="cantidad${cards_count}"
                                                class="form-control mod-cantidad">
                                            <label for="cant_${cards_count}">Cantidad <font class="asterisco">*</font></label>
                                        </div>
                                    </div>
                                    <div class="col s12 l8">
                                        <div class="anima-focus">
                                            <select class="form-control mod-producto" id="prod_${cards_count}"
                                                    name="producto${cards_count}" required>
                                                <option value="{{ $producto->producto->id }}" selected>
                                                    {{ $producto->producto->descripcion }}
                                                </option>
                                            </select>
                                            <label for="prod_${cards_count}">Producto o servicio <font class="asterisco">*</font></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l12 ">
                                        <div class="anima-focus">
                                            <textarea class="mod-especificaciones form-control" id="espec_${cards_count}" placeholder=""
                                                name="especificaciones${cards_count}"></textarea>
                                            <label for="espec_${cards_count}">
                                                Especificaciones del producto o servicio <font class="asterisco">*
                                                </font>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l4 ">
                                        <div class="anima-focus">
                                            <select name="centro_costo${cards_count}" id="cen_cos" placeholder=""
                                                class="form-control mod-centro_costo" id="" required>
                                                @if ($producto->centro_costo_id)
                                                    <option selected value="{{ $producto->centro_costo->id }}">
                                                        {{ $producto->centro_costo->clave }}</option>
                                                @else
                                                    <option value="" selected disabled>Seleccione una opción de
                                                        Centro de
                                                        Costos</option>
                                                @endif
                                                @foreach ($centro_costos as $costo)
                                                    <option value="{{ $costo->id }}">
                                                        {{ $costo->clave }}: {{ $costo->descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="cen_cos">
                                                Centro de costos <font class="asterisco">*</font>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col s12 l4 ">
                                        <div class="anima-focus">
                                            <select required class="form-control mod-contrato"
                                                id="cont_${cards_count}" placeholder=""
                                                name="contrato${cards_count}">
                                                @isset($contrato)
                                                    <option value="{{ $contrato->id }}">
                                                        {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                                        {{ $contrato->nombre_servicio }}
                                                    </option>
                                                @endisset
                                                @foreach ($contratos as $contrato)
                                                    <option value="{{ $contrato->id }}"
                                                        data-no="{{ $contrato->no_contrato }}"
                                                        data-servicio="{{ $contrato->nombre_servicio }}"
                                                        {{ $producto->contrato_id == $contrato->id ? 'selected' : '' }}>
                                                        {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                                        {{ $contrato->nombre_servicio }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="cont_${cards_count}">
                                                Proyecto <font class="asterisco">*</font>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col s12 l4 ">
                                        <div class="anima-focus">
                                            <input type="text" id="no_p_${cards_count}" placeholder=""
                                                name="no_personas${cards_count}"
                                                class="form-control mod-no_personas"
                                                value="">
                                            <label for="no_p_${cards_count}">
                                                No. de Personas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l4 ">
                                        <div class="anima-focus">
                                            <input type="text" id="porc_inv_${cards_count}"
                                                name="porcentaje_involucramiento${cards_count}"
                                                class="form-control mod-porcentaje_involucramiento"
                                                value="" placeholder="">
                                            <label for="porc_inv_${cards_count}">
                                                Porcentaje de involucramiento
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <h3 class="sub-titulo-form">Subtotales</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            Sub total <font class="asterisco">*</font>
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="sub_total${cards_count}"
                                                data-count="${cards_count}" class="mod-sub_total form-control"
                                                required value="">
                                        </div>
                                    </div>
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            IVA <font class="asterisco">*</font>
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="iva${cards_count}"
                                                data-count="${cards_count}" class="mod-iva form-control" required
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            IVA retenido
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="iva_retenido${cards_count}"
                                                data-count="${cards_count}" class="mod-iva_retenido form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            Descuento
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="descuento${cards_count}"
                                                data-count="${cards_count}" class="mod-descuento form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            Otro impuesto
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="otro_impuesto${cards_count}"
                                                data-count="${cards_count}" class="mod-otro_impuesto form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            ISR retenido
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input type="text" name="isr_retenido${cards_count}"
                                                data-count="${cards_count}" class="mod-isr_retenido form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col s12 l3 ">
                                        <label for="">
                                            Total <font class="asterisco">*</font>
                                        </label>
                                        <div class="caja-input-dinero">
                                            <input id="input-total-serv${cards_count}" type="text"
                                                name="total${cards_count}" data-count="${cards_count}"
                                                class="mod-total form-control" required value="">
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-bottom: 30px;">
                                <!-- Aquí agrega el resto de los campos necesarios, siguiendo la misma estructura -->
                            </div>
                        `;

                        // Agrega la nueva card al contenedor
                        document.querySelector('.caja-card-product').appendChild(nueva_card);

                        // Actualiza el contador global del formulario
                        document.querySelector('#input-count-prod').value = cards_count;

                        console.log(`Nueva card añadida con el contador: ${cards_count}`);
                    }
                }
            });
        }
    </script>
@else
    <div class="card pulse-0" style="width: 156px; height: 68px;">
        <div class="card-body d-flex flex-column align-items-center">
            <p class="mb-0" style="font-size:12px; color:#4870B2;">Ediciones disponibles</p>
            <div class="card" style="width: 43px; height: 23px; margin-top:7px;">
                <div class="card-body d-flex justify-content-center align-items-center"
                    style="padding:0px; background-color:#FF0000; border-radius:16px;">
                    <p class="mb-0" style="font-size:12px; color:#FFFFFF;">{{ $contadorEdit }}</p>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 350px;">
            <div class="card-body d-flex jsutify-content-center flex-column align-items-center" st>
                <div style="height: 200px;">
                    <img src="{{ asset('img/welcome-blue.svg') }}" style="height: 100%;width:100%;" alt="Apoyo">
                </div>

                <div class="d-flex justify-content-center align-items-center flex-column">
                    <h5 style="font-size: 22px; font-weight: bolder; color: #474c6c;">
                        Acceso Restringido
                    </h5>
                    <p>
                        Ha alcanzado el limite de ediciones para esta Orden de Compra.
                    </p>
                    <a href="{{ route('contract_manager.orden-compra') }}" class="btn tb-btn-secondary">Regresar</a>

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="card-error">
        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="Apoyo">
        </div>

        <div>
            <h3 style="font-size: 22px; font-weight: bolder; color: #474c6c;">
                Acceso Restringido
            </h3>
            <p>
                Ha alcanzado el limite de ediciones para esta Orden de Compra.
            </p>
            <a href="{{ route('contract_manager.orden-compra') }}" class="btn">Regresar</a>
        </div>
    </div> --}}
@endif

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

            let total_serv = parseFloat(document.querySelector('.productos-info .mod-sub_total[data-count="' +
                count_serv + '"]').value === "" ? 0 : document.querySelector(
                '.productos-info .mod-sub_total[data-count="' + count_serv + '"]').value) + parseFloat(
                document.querySelector('.productos-info .mod-iva[data-count="' + count_serv + '"]')
                .value === "" ? 0 : document.querySelector('.productos-info .mod-iva[data-count="' +
                    count_serv + '"]').value) - Array.from(document.querySelectorAll(
                '.productos-info .caja-input-dinero input[data-count="' + count_serv +
                '"]:not(.mod-total, .mod-sub_total, .mod-iva)')).reduce((acumulador, elemento) =>
                acumulador + (elemento.value === "" ? 0 : parseFloat(elemento.value)), 0);


            $('#input-total-serv' + count_serv).val(
                parseFloat(total_serv).toFixed(4)
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

@endsection
