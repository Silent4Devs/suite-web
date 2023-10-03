@extends('layouts.admin')

@section('content')
@section('titulo', 'Firmar Requisicion')
<link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}">

    <div class="card card-content caja-blue">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width:150px; position: relative; top: 100px; right: 430px;">
        </div>

        <div style="position: relative; top:-5rem; left: 80px;">
            <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
            <h5 style="font-size: 17px; margin-top:10px;">En esta sección puedes generar tu firma electrónica</h5>
            <p style="margin-top:10px;">
                Aquí podrás firmar, revisar y procesar solicitudes de compra de manera rápida y sencilla, <br> optimizando el
                flujo de trabajo y asegurando un seguimiento transparente de todas las transacciones.
            </p>
        </div>
    </div>
<div id="paso-firma" class="tab-content">
    <div class="card card-item doc-requisicion">
        <div class="flex header-doc">
            <div class="flex-item item-doc-img">
                @if ($requisicion->sucursal->mylogo)
                    <img src="{{ url('razon_social/'.$requisicion->sucursal->mylogo) }}" style="width:100%; max-width:150px;">
                @else
                    <img src="{{ asset('sinLogo.png') }}" style="width:100%; max-width:150px;">
                @endif
            </div>
            <div class="flex-item info-med-doc-header">
                {{ $requisicion->sucursal->empresa }} <br>
                {{ $requisicion->sucursal->rfc }} <br>
                {{ $requisicion->sucursal->direccion }} <br>
            </div>
            <div class="flex-item item-header-doc-info" style="">
                <h4 style="font-size: 18px; color:#49598A;">REQUISICIÓN DE ADQUISICIONES</h4>
                <p>Folio: 00-00{{ $requisicion->id }}</p>
                <p>Fecha de solicitud: {{ date('d-m-Y', strtotime($requisicion->fecha)) }} </p>
            </div>
        </div>
        <div class="flex doc-blue">
            <div class="flex-item">
                <strong>Referencia:</strong><br>
                {{ $requisicion->referencia }}<br><br>
                <strong>Proyecto:</strong><br>
                {{ $requisicion->contrato->no_proyecto }} / {{ $requisicion->contrato->no_contrato }} - {{ $requisicion->contrato->nombre_servicio }}
            </div>
            <div class="flex-item">
                <strong>Área que solicita:</strong><br>
                {{ $requisicion->area }}<br><br>
                <strong>Comprador:</strong><br>
                @isset($comprador->user->name)
                    {{ $comprador->user->name }}
                @endisset
            </div>
            <div class="flex-item">
                <strong>Solicita:</strong><br>
                {{ $requisicion->user }}<br><br>
            </div>
        </div>
        <div class="flex">
            <div class="flex-item">
                <strong> Producto o servicio:</strong>
            </div>
        </div>
        @foreach ($requisicion->productos_requisiciones as $producto)
            <div class="row">
                <div class="col s12 l4">
                    <strong> Cantidad:</strong><br><br>
                    <p>
                        {{ $producto->cantidad }}
                    </p>
                </div>
                <div class="col s12 l4">
                    <strong> Producto o servicio:</strong><br><br>
                    <p>
                        @isset($producto->producto->descripcion)
                            {{ $producto->producto->descripcion }}
                        @endisset
                    </p>
                </div>
                <div class="col s12 l4">
                    <strong> Especificaciones del producto o servicio:</strong><br><br>
                    <p>
                        {{ $producto->espesificaciones }}
                    </p>
                </div>
            </div>
            <hr>
        @endforeach
        <hr style="width: 80%; margin:auto;">
        @foreach ($requisicion->provedores_requisiciones as $proveedor)
            <div class="proveedores-doc" style="">
                <div class="flex header-proveedor-doc">
                    <div class="flex-item">
                        <strong>Proveedor: </strong> {{ $proveedor->proveedor }}
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-item">
                        <small> -Provea contexto detallado de su necesidad de Adquisición, es importante mencionar si es
                            que la solicitud está ligada a algún proyecto en particular. -En caso de que no se brinde
                            detalle suficiente que sustente la compra, es no procedera.s </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4">
                        <strong>Proveedor:</strong><br><br>
                        {{ $proveedor->proveedor }}
                    </div>
                    <div class="col s12  l4">
                        <strong>Detalle del producto:</strong><br><br>
                        {{ $proveedor->detalles }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Comentarios:</strong><br><br>
                        {{ $proveedor->comentarios }}
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4">
                        <strong>Nombre del contacto:</strong><br><br>
                        {{ $proveedor->contacto }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Fecha Inicio:</strong><br><br>
                        {{ date('d-m-Y', strtotime($proveedor->fecha_inicio)) }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Teléfono:</strong><br><br>
                        {{ $proveedor->cel }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>Correo Electrónico:</strong><br><br>
                        {{ $proveedor->contacto_correo }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>Fecha Fin:</strong><br><br>
                        {{ date('d-m-Y', strtotime($proveedor->fecha_fin)) }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>URL:</strong><br><br>
                        {{ $proveedor->url }}
                    </div>
                </div>
            </div>
        @endforeach

        @if ($requisicion->proveedor_catalogo  != null)
        @foreach ($proveedores_catalogo as $prov)
        <div class="proveedores-doc" style="">
            <div class="flex header-proveedor-doc">
                <div class="flex-item">
                    <strong>Proveedor: </strong> @isset($prov->nombre)
                    {{ $prov->nombre }}
                    @endisset
                </div>
            </div>
            <div class="flex">
                <div class="flex-item">
                    <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                        mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                        caso de que no se brinde detalle suficiente que sustente la compra, esto no
                        procedera </small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4">
                    <strong>Razon social:</strong><br><br>
                    {{$prov->razon_social}}
                </div>
                <div class="col s12 l4">
                    <strong>RFC:</strong><br><br>
                    {{$prov->rfc}}
                </div>
                <div class="col s12 l4">
                    <strong>Contacto:</strong><br><br>
                    {{$prov->contacto}}
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4">
                    <strong>Fecha Inicio:</strong><br><br>
                    {{ date('d-m-Y', strtotime($prov->fecha_inicio)) }}
                </div>
                <div class="col s12 l2">
                    <strong>Fecha Fin:</strong><br><br>
                    {{ date('d-m-Y', strtotime($prov->fecha_fin)) }}
                </div>
            </div>
        </div>
        @endforeach
        @endif

        @if ($proveedor_indistinto)
        <div class="proveedores-doc" style="">
            <div class="flex header-proveedor-doc">
                <div class="flex-item">
                    <strong>Proveedor: </strong>  Indistinto
                </div>
            </div>
            <div class="flex">
                <div class="flex-item">
                    <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                        mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                        caso de que no se brinde detalle suficiente que sustente la compra, esto no
                        procedera </small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4">
                    <strong>Fecha Inicio:</strong><br><br>
                    {{ date('d-m-Y', strtotime($proveedor_indistinto->fecha_inicio)) }}
                </div>
                <div class="col s12 l4">
                    <strong>Fecha Fin:</strong><br><br>
                    {{  date('d-m-Y', strtotime($proveedor_indistinto->fecha_fin))}}
                </div>

            </div>
        </div>
        @endif
        <div class="caja-firmas-doc">
            <div class="flex" style="margin-top: 70px;">
                <div class="flex-item">
                    @if ($requisicion->firma_solicitante)
                        <img src="{{ $requisicion->firma_solicitante }}" class="img-firma">
                        <p>{{ $requisicion->user }}</p>
                        <p>{{ $requisicion->fecha_firma_solicitante_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small>FECHA, FIRMA Y NOMBRE DEL SOLICITANTE </small>
                    </p>
                </div>
                <div class="flex-item">
                    @if ($requisicion->firma_jefe)
                        <img src="{{ $requisicion->firma_jefe }}" class="img-firma">
                        <p>@isset($supervisor)
                            {{$supervisor}}
                        @endisset</p>
                        <p>{{ $requisicion->fecha_firma_jefe_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small>FECHA, FIRMA Y NOMBRE DEL JEFE INMEDIATO</small>
                    </p>
                </div>
            </div>
            <div class="flex">
                <div class="flex-item">
                    @if ($requisicion->firma_finanzas)
                        <img src="{{ $requisicion->firma_finanzas }}" class="img-firma">
                        <p>Lourdes del Pilar Abadía Velasco </p>
                        <p>{{ $requisicion->fecha_firma_finanzas_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small> FECHA, FIRMA Y NOMBRE DE FINANZAS</small>
                    </p>
                </div>
                <div class="flex-item">
                    @if ($requisicion->firma_compras)
                        <img src="{{ $requisicion->firma_compras }}" class="img-firma">
                        <p>{{ $requisicion->comprador->user->name }} </p>
                        <p>{{ $requisicion->fecha_firma_comprador_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small> FECHA, FIRMA Y NOMBRE DE COMPRADORES</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="flex-item">
                <small><i style="color: #2395AA;">-NOTA : En caso de ser capacitación se necesita el visto bueno de
                        Gestión de talento.</i></small>
            </div>
        </div>
    </div>
    @if ( is_null($requisicion->firma_solicitante) || is_null($requisicion->firma_jefe) || is_null($requisicion->firma_finanzas)  || is_null($requisicion->firma_compras))
    <div class="card card-content" style="margin-bottom: 30px">
        <form method="POST" id="myForm" action="{{ route('contract_manager.requisiciones.firmar-update', ['tipo_firma' => $tipo_firma, 'id' => $requisicion->id]) }}">
            @csrf
            <div class="">
                <h5><strong>Firma*</strong></h5>
                <p>
                    Indispensable firmar la requisición antes de guardar y enviarla a aprobación de lo contrario podrá
                    ser rechazada por alguno de los colaboradores
                </p>
            </div>
            <div class="flex caja-firmar" wire:ignore>
                <div class="flex-item" style="display:flex; justify-content: center; flex-direction: column; align-items:center;">
                    <div id="firma_content" class="caja-space-firma">
                        <input type="hidden" name="firma" id="firma">
                    </div>
                    <div>
                        <div class="btn" style="color: white; background:  gray !important; transform: translateY(-40px) scale(0.8);" id="clear">Limpiar</div>
                    </div>
                </div>
            </div>
            <div class="flex" style="justify-content: end; gap:10px;">
                {{--  <div class="btn btn-secundario" style="background: #959595 !important"><i class="fa-solid fa-chevron-left icon-prior"></i> Regresar </div>  --}}
            </div>
        </form>
        <form method="POST" action="{{ route('contract_manager.requisiciones.rechazada', ['id' => $requisicion->id]) }}">
            @csrf
            <div class="flex" style="position: relative; top: -1rem;  justify-content: space-between;">
                <button class="btn btn-primary" style="background: #454545 !important;">RECHAZAR REQUISICIÓN</button>
                <div onclick="validar();" style="" class="btn btn-primary">Firmar</div>
            </div>
        </form>
    </div>
    @endif
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function validar(params) {
        var x = $("#firma").val();
        if (x) {
            document.getElementById("myForm").submit();
        }else{
            Swal.fire(
             'Aun no ha firmado',
             'Porfavor Intentelo nuevamente',
             'error');
        }
    }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.signature.min.js') }}"></script>
@endsection
@section('scripts')
<script>
    $('select').select2('destroy');
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        var signaturePad = $('#firma_content').signature({
            syncField: '#firma',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.signature('clear');
            $("#firma").val('');
        });
    });
</script>
@endsection
