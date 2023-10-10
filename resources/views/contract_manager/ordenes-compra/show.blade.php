@extends('layouts.admin')
@section('content')
@section('titulo', 'Ver Orden de Compra')

@include('layouts.datatables_css')
<link rel="stylesheet" href="{{asset('css/requisiciones.css')}}">
<style>
    .col{
        overflow-wrap: break-word;
    }
    @media print{
        .card.card-item{
            background-color: #fff !important;
            box-shadow: none !important;
            margin: 0 !important;
        }

        .proveedores-doc,
        .proveedores-doc:nth-child(2n+1){
            background-color: #fff !important;
        }


    }
</style>
<div class="create-requisicion">
    <div class="card card-content caja-blue">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt=""  style="width:150px; position: relative; top: 150px; right: 430px;">
        </div>

        <div style="position: relative; top:-5rem; left:80px;">
            <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido</h3>
            <h5 style="font-size: 17px; margin-top:10px;">En esta sección puedes ver tu orden de compra</h5>
            <p style=" margin-top:10px;">
                Aquí podrás crear, revisar y procesar solicitudes de compra de manera rápida y sencilla, <br> optimizando el flujo de trabajo y asegurando un seguimiento transparente de todas las transacciones.
            </p><br>
            <form method="POST" action="{{ route('contract_manager.orden-compra.pdf', ['id' => $requisicion->id]) }}">
            @csrf
            <button style="background-color: white; border-color: #fff; border-radius: 5px; padding:10px 24px; font-size:16px">
                <i class="fas fa-print"></i>&nbsp;&nbsp;Imprimir Orden de Compra
            </button>
           </form>
        </div>
</div>
<div id="impresion">
    <div id="paso-firma" class="tab-content">
            <div class="card card-item doc-requisicion">
                <div class="flex header-doc">
                    <div class="flex-item item-doc-img">
                        @if ($requisicion->sucursal->mylogo)
                        <td><img src="{{ url('razon_social/'.$requisicion->sucursal->mylogo) }}"  style="width:100%; max-width:150px;"></td>
                        @else
                        <td><img src="{{ asset('sinLogo.png') }}" style="width:100%; max-width:150px;"></td>
                        @endif
                    </div>
                    <div class="flex-item">
                         {{$requisicion->sucursal->empresa }} <br>
                         {{$requisicion->sucursal->rfc }} <br>
                         {{$requisicion->sucursal->direccion }} <br>
                    </div>
                    <div class="flex-item item-header-doc-info" style="">
                        <h4 style="font-size: 18px; color:#49598A;">ORDEN DE COMPRA</h4>
                        <p>Folio: 00-00{{ $requisicion->id}} </p>
                        <p>Fecha de solicitud: {{ date('d-m-Y', strtotime($requisicion->fecha))  }}</p>
                    </div>
                </div>
                <div class="flex doc-blue">
                    <div class="flex-item">
                        <strong>Referencia:</strong><br>
                        {{$requisicion->referencia }}
                        <br><br>
                        <strong>Proyecto:</strong><br>
                        {{$requisicion->contrato->no_contrato }} - {{$requisicion->contrato->nombre_servicio }} - {{$requisicion->contrato->proveedor->nombre_comercial }}
                    </div>
                    <div class="flex-item">
                        <strong>Área que solicita:</strong><br>
                        {{$requisicion->area }}
                        <br><br>
                        <strong>Comprador:</strong><br>
                        @isset($requisicion->comprador->user->name)
                        {{$requisicion->comprador->user->name}}
                        @endisset
                    </div>
                    <div class="flex-item">
                        <strong>Solicita:</strong><br>
                        {{$requisicion->user }}
                        <br><br>
                    </div>
                </div>
                @foreach ($requisicion->productos_requisiciones as $producto )
                <div class="flex">
                    <div class="flex-item">
                        <strong> Producto o servicio:</strong>
                    </div>
                </div>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong> Cantidad:</strong><br><br>
                            {{ $producto->cantidad }}
                        </div>
                        <div class="col s12 l4">
                            <strong> Producto o servicio:</strong><br><br>
                           {{ $producto->producto->descripcion }}
                        </div>
                        <div class="col s12 l4">
                            <strong> Especificaciones del producto o servicio: </strong><br><br>
                           {{ $producto->espesificaciones }}
                        </div>
                        <div class="col s12 l4">
                            <strong> SubTotal:</strong><br><br>
                            {{ $producto->sub_total }}
                        </div>
                        <div class="col s12 l4">
                            <strong> Descuento:</strong><br><br>
                           {{ $producto->descuento }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong> Otro Impuesto: </strong><br><br>
                           {{ $producto->otro_impuesto }}
                        </div>
                        <div class="col s12 l4">
                            <strong> IVA: </strong><br><br>
                           {{ $producto->iva }}
                        </div>
                        <div class="col s12 l4">
                            <strong> IVA retenido: </strong><br><br>
                           {{ $producto->iva_retenido }}
                        </div>
                        <div class="col s12 l4">
                            <strong> ISR retenido: </strong><br><br>
                           {{ $producto->isr_retenido }}
                        </div>
                        <div class="col s12 l4">
                            <strong> Total: </strong><br><br>
                           {{ $producto->total }}
                        </div>
                    </div>
                @endforeach
                @foreach ($requisicion->provedores_requisiciones as $provedores )
                    <div class="proveedores-doc" style="background-color: #EEEEEE;">
                        <div class="flex header-proveedor-doc">
                            <div class="flex-item">
                                <strong>Proveedor</strong>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-item">
                                <small> -Provea contexto detallado de su necesidad de adquisición, es importante mencionar si es que la solicitud está ligada a algún proyecto en particular. <br> -En caso de que no se brinde detalle suficiente que sustente la compra, esto no procedera </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4">
                                <strong>Proveedor:</strong><br><br>
                                {{$provedores->proveedor}}
                            </div>
                            <div class="col s12  l4">
                                <strong>Detalle del producto:</strong><br><br>
                                {{$provedores->detalles}}
                            </div>
                            <div class="col s12 l4">
                                <strong>Comentarios:</strong><br><br>
                                {{ $provedores->comentarios }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4">
                                <strong>Nombre del contacto:</strong><br><br>
                                {{$provedores->contacto}}
                            </div>
                            <div class="col s12 l4">
                                <strong>Fecha Inicio:</strong><br><br>
                                {{ date('d-m-Y', strtotime($provedores->fecha_inicio)) }}
                            </div>
                            <div class="col s12 l4">
                                <strong>Teléfono:</strong><br><br>
                                {{$provedores->cel}}
                            </div>
                            <div class="col s12 l4">
                                <br><br>
                                <strong>Correo Electrónico:</strong><br><br>
                                {{$provedores->contacto_correo}}
                            </div>
                            <div class="col s12 l4">
                                <br><br>
                                <strong>Fecha Fin:</strong><br><br>
                                {{ date('d-m-Y', strtotime($provedores->fecha_fin)) }}
                            </div>
                            <div class="col s12 l4">
                                <br><br>
                                <strong>URL:</strong><br><br>
                                {{$provedores->url}}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="proveedores-doc" style="background-color: #EEEEEE;">
                    <div class="flex header-proveedor-doc">
                        <div class="flex-item">
                            <strong>Total General</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong>Subtotal:</strong><br><br>
                            {{$requisicion->sub_total}}
                        </div>
                        <div class="col s12  l4">
                            <strong>IVA:</strong><br><br>
                            {{$requisicion->iva}}
                        </div>
                        <div class="col s12 l4">
                            <strong>IVA retenido:</strong><br><br>
                            {{ $requisicion->iva_retenido }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong>ISR retenido:</strong><br><br>
                            {{$requisicion->isr_retenido}}
                        </div>
                        <div class="col s12 l4">
                            <strong>Total:</strong><br><br>
                            {{ $requisicion->total }}
                        </div>
                    </div>
                </div>


                <div class="caja-firmas-doc">
                    <div class="flex" style="margin-top: 70px;">
                        <div class="flex-item">
                            @if ($requisicion->firma_solicitante_orden)
                                 <img src="{{$requisicion->firma_solicitante_orden}}" class="img-firma">
                                 <p>{{$requisicion->user}}</p>
                                 <p>{{ $requisicion->fecha_firma_solicitante_orden }}</p>
                            @else
                                <div style="height: 137px;"></div>
                            @endif
                            <hr>
                            <p>
                            <small>FECHA, FIRMA Y NOMBRE DEL SOLICITANTE </small>
                            </p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-item">
                            @if ($requisicion->firma_finanzas_orden)
                                <img src="{{$requisicion->firma_finanzas_orden}}" class="img-firma">
                                <p>Lourdes del Pilar Abadía Velasco </p>
                                <p>{{ $requisicion->fecha_firma_finanzas_orden }}</p>
                            @else
                                <div style="height: 137px;"></div>
                            @endif
                            <hr>
                            <p>
                            <small>FECHA, FIRMA Y NOMBRE DE FINANZAS</small>
                            </p>
                        </div>
                        <div class="flex-item">
                            @if ($requisicion->firma_comprador_orden)
                                <img src="{{$requisicion->firma_comprador_orden}}" class="img-firma">
                                <p>{{$requisicion->comprador->user->name}} </p>
                                <p>{{ $requisicion->fecha_firma_comprador_orden }}</p>
                            @else
                                <div style="height: 137px;"></div>
                             @endif
                            <hr>
                            <p>
                            <small> FECHA, FIRMA Y NOMBRE  DE COMPRADORES</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex print-none" >
                    <div class="flex-item">
                        <small ><i style="color: #2395AA;">-NOTA : En caso de ser capacitación se necesita el visto bueno de Gestión de talento.</i></small>
                        <button class="btn btn info"  style="position: relative;   left:40%;"><a  href="{{route('contract_manager.orden-compra')}}" style="color: #EEEEEE">Regresar</a></button>
                    </div>
                </div>
            </div>
    </div>
</div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    @section('scripts')
    <script>
        Livewire.on('render_firma', (id_tab) => {
            var signaturePad = $('#firma_content').signature({syncField: '#firma', syncFormat: 'PNG'});

            $('#clear').click(function(e) {
                e.preventDefault();
                signaturePad.signature('clear');
                $("#firma").val('');
            });
        });
    </script>
    <script>
           $('select').select2('destroy');
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {

            });

            function printArea(){
                let area = $('#select_solicitante option:selected').attr("data-area");
                document.querySelector('#area_print').value = area;

            }
            function addCard(tipo_card){
                if(tipo_card === 'servicio'){
                    let card = document.querySelector('.card-product');
                    let nueva_card = document.createElement("div");
                    nueva_card.classList.add("card");
                    nueva_card.classList.add("card-content");
                    nueva_card.classList.add("card-product");
                    let cards_count = document.querySelectorAll('.card-product').length + 1;
                    nueva_card.setAttribute("data-count", cards_count);
                    let id_nueva_card = 'product-serv-' + cards_count;
                    nueva_card.setAttribute('id', id_nueva_card);

                    let caja_cards = document.querySelector('.caja-card-product');
                    caja_cards.appendChild(nueva_card);
                    document.querySelector('.card-product:last-child').innerHTML += card.innerHTML;

                    document.querySelector('#' + id_nueva_card + ' .model-cantidad').setAttribute('name', 'cantidad_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .model-producto').setAttribute('name', 'producto_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .model-especificaciones').setAttribute('name', 'especificaciones_' + cards_count);
                }

                if(tipo_card === 'proveedor'){
                    let card = document.querySelector('.card-proveedor');
                    let nueva_card = document.createElement("div");
                    nueva_card.classList.add("card");
                    nueva_card.classList.add("card-content");
                    nueva_card.classList.add("card-proveedor");
                    let cards_count = document.querySelectorAll('.card-proveedor').length + 1;
                    nueva_card.setAttribute("data-count", cards_count);
                    let id_nueva_card = 'proveedor-card-' + cards_count;
                    nueva_card.setAttribute('id', id_nueva_card);

                    let caja_cards = document.querySelector('.caja-card-proveedor');
                    caja_cards.appendChild(nueva_card);
                    document.querySelector('.card-proveedor:last-child').innerHTML += card.innerHTML;

                    let modal_forms = document.querySelectorAll('#' + id_nueva_card + ' .modal-form');

                    // modal_forms.forEach(item => {
                    //     let new_name = item.name.replace((cards_count - 1), (cards_count));
                    //     item.setAttribute('name', new_name);
                    // });
                    document.querySelector('#' + id_nueva_card + ' .modal-proveedor').setAttribute('name', 'proveedor_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-detalles').setAttribute('name', 'detalles_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-tipo').setAttribute('name', 'tipo_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-tipo-2').setAttribute('name', 'tipo_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-comentario').setAttribute('name', 'comentarios_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-nombre').setAttribute('name', 'contacto_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-telefono').setAttribute('name', 'contacto_telefono_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-correo').setAttribute('name', 'contacto_correo_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-url').setAttribute('name', 'contacto_url_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-start').setAttribute('name', 'contacto_fecha_inicio_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-end').setAttribute('name', 'contacto_fecha_fin_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .modal-cotizacion').setAttribute('name', 'cotizacion_' + cards_count);

                }
            }

        </script>

    @endsection
</div>

@endsection
