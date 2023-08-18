@extends('layouts.admin')

@section('titulo', 'Contratos')

@section('content')
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/botones.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formularios/contratos.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/iconos.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/letra.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/ventana.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/titulos.css')}}"> --}}

  <style>
        /* .asterisco {
            color: red;
            margin-left: 5px;

        } */

        /*.select-wrapper input{

        direction:rtl;
        text-align:left;

        }*/

    </style>

{{-- {{ Breadcrumbs::render('contratos_edit', $contrato) }} --}}
        @include('admin.bitacora.formedit', ["show_contrato"=>false])



    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content blue-text" style="overflow-x:auto !important;">
                    <span class="card-title">Contrato</span>
                    <table class="refresco" id="tblContrato">
                        <thead style="overflow-x:auto !important;">
                            <tr>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">No. contrato</p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Vigencia</p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Fase</p>
                                </th>
                                <th>
                                @if($contrato->tipo_cambio == 'USD' )

                                    <p></p>
                                @else

                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">IVA&nbsp;@for ($i = 0; $i < 20; $i++)&nbsp;@endfor</p>

                                @endif

                                </th>
                                <th>
                                @if($contrato->tipo_cambio == 'USD' )

                                    <p></p>

                                @else
                                        <p class="grey-text" style="font-size:17px;font-weight:bold;">Subtotal&nbsp;@for ($i = 0; $i < 20; $i++)&nbsp;@endfor</p>

                                @endif
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Monto&nbsp;total&nbsp;@for ($i = 0; $i < 15; $i++)&nbsp;@endfor</p>
                                </th>
                                <th>
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Estado</p>
                                </th>
                                <th style="text-align: center">
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Habilitar ampliación</p>
                                </th>
                                <th style="text-align: center">
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Convenio Modificatorio</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contrato_importe_total = $contratos->monto_pago;
                            @endphp
                            @foreach ($contratos->ampliaciones as $ampliacion)
                                @php
                                    $contrato_importe_total += $ampliacion->importe;
                                @endphp
                            @endforeach
                            <tr class="black-text">
                                <td>{{ $contratos->no_contrato }}</td>
                                <td>
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $contratos->vigencia_contrato }}
                                </td>
                                <td>{{ $contratos->fase }}</td>
                                <td>
                                @if($contrato->tipo_cambio == 'USD' )
                                     <p></p>

                                @else
                                    $ {{ number_format(($contrato_importe_total / 1.16) * 0.16, 2) }}

                                @endif

                                </td>
                                <td>
                                @if($contrato->tipo_cambio == 'USD' )
                                     <p></p>
                                @else
                                    $ {{ number_format($contrato_importe_total / 1.16, 2) }}
                                @endif
                                </td>
                                <td>
                                    $ {{ number_format($contrato_importe_total, 2) }}
                                </td>
                                <td>
                                    @if($contrato->estatus == 'vigentes')
                                    Vigente
                                    @elseif($contrato->estatus == 'renovaciones')
                                    Renovación
                                    @else
                                    Cerrado
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    <form style="width:100%;" id="ampliacion_form"
                                        action="{{ route('contract_manager.contratos-katbol.ampliacion', ['id' => $contratos->id]) }}"
                                        method="POST">
                                        @method("PATCH")
                                        <p style="width:100%; text-align:center;">
                                            <label style="width:100% !important;">
                                                <input  type="checkbox" class="checkbox"
                                                    {{ $contratos->contrato_ampliado ? 'checked' : '' }} />
                                                <span></span>
                                            </label>
                                        </p>
                                    </form>
                                </td>
                                <td style="text-align: center">
                                    <form style="width:100%;" id="convenio_form"
                                        action="{{ route('contract_manager.contratos-katbol.convenios', ['id' => $contratos->id]) }}"
                                        method="POST">
                                        @method("PATCH")
                                        <p style="width:100%; text-align:center;">
                                            <label style="width:100% !important;">
                                                <input  type="checkbox" class="checkbox_convenios"
                                                    {{ $contratos->convenio_modificatorio ? 'checked' : '' }} />
                                                <span></span>
                                            </label>
                                        </p>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <ul class="collapsible popout">
        <li>
            <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Facturación</div>
            <div class="collapsible-body">

                    <div class="row">
                        <div class="col s12 m12">
                            <div class="card">
                                <div class="card-content">
                                    <table align="center">
                                        <thead>
                                        <tr>
                                            <th><p class="grey-text tablaparra" >No. pagos</p></th>
                                            <th><p class="grey-text tablaparra">Tipo</p></th>
                                            <th><p class="grey-text tablaparra">Nombre servicio</p></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="black-text">
                                                <td>
                                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                                        data-title="Número de contrato"
                                                        data-value="{{ $contratos->no_pagos }}" class="no_pagos"
                                                        data-name="no_pagos">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                                        data-title="Tipo de contrato"
                                                        data-value="{{ $contratos->tipo_contrato }}"
                                                        class="tipo_contrato" data-name="tipo_contrato">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" data-type="text" data-pk="{{ $contratos->id }}"
                                                        data-url="{{ route('contract_manager.contratos-katbol.contratopago', $contratos->id) }}"
                                                        data-title="Nombre de servicio"
                                                        data-value="{{ $contratos->nombre_servicio }}"
                                                        class="nombre_servicio" data-name="nombre_servicio">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">

                            @livewire('factura.factura-component', ['contrato_id' => $contratos->id,
                            'show_contrato'=>false, 'contrato_total'=>$contratos->monto_pago])
                        </div>
                    </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">multiline_chart</i>Niveles de servicio
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('niveles-servicio.niveles-component', ['contrato_id' => $contratos->id,
                                'show_contrato'=>false])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">event</i>Entregables mensuales
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('entregable-mensual.entregablecomponent', ['contrato_id' => $contratos->id,
                                'show_contrato'=>false])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">assignment_turned_in</i>Cierre proyecto
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('cierre-contratos.cierrecomponent', ['contrato_id' => $contratos->id,
                                'show_contrato'=>false])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li id="ampliacion_contrato_lista" style="display: {{ $contratos->contrato_ampliado ? 'block' : 'none' }}">
            <div class="collapsible-header"><i class="material-icons">add_task</i>Ampliación de contrato
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('ampliacion-contratos.ampliacion-component', [
                                'contrato_id' => $contratos->id,
                                'show_contrato'=>false,
                                'fecha_fin_contrato'=>$contratos->fecha_fin
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li id="convenio_contrato_lista" >
            <div class="collapsible-header" style="display: {{ $contratos->convenio_modificatorio ? 'block' : 'none' }}"><i class="fas fa-handshake"></i>Convenios Modificatorios
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' =>
                                $contratos->id,
                                'show_contrato'=>false])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">done_all</i> Cédula de cumplimiento
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' =>
                                $contratos->id,
                                'show_contrato'=>false])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="row">
        <div class="col s12 right-align" style="padding-right: 30px !important;">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn-redondeado btn btn-primary" >Salir sin llenar</a>
        </div>
    </div>

    <script>
        @section('x-editable')
            $(document).ready(function () {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            //categories table
            $(".no_pagos").editable({
            dataType: 'json',
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });
            $(".tipo_contrato").editable({
            dataType: 'json',
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });

            $(".nombre_servicio").editable({
            dataType: 'json',
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });

            $(".checkbox_convenios").click(function() {
            let convenio = 0;
            let url = $("#convenio_form").attr("action");
            if($(".checkbox_convenios").is(':checked')) {
            convenio = 1;
            $.ajax({
            type: "POST",
            url: url,
            data: {convenio},
            success: function (response) {
            if (response.success == 1) {
            $("#convenio_contrato_lista").show();
            }
            }
            });
            } else {
            convenio = 0;
            $.ajax({
            type: "POST",
            url: url,
            data: {convenio},
            success: function (response) {
            if (response.success == 0) {
            $("#convenio_contrato_lista").hide();
            }
            }
            });
            }
            });


            $(".checkbox").click(function() {
            let ampliado = 0;
            let url = $("#ampliacion_form").attr("action");
            if($(".checkbox").is(':checked')) {
            ampliado = 1;
            $.ajax({
            type: "POST",
            url: url,
            data: {ampliado},
            success: function (response) {
            if (response.success == 1) {
            $("#ampliacion_contrato_lista").show();
            }
            }
            });
            } else {
            ampliado = 0;
            $.ajax({
            type: "POST",
            url: url,
            data: {ampliado},
            success: function (response) {
            if (response.success == 0) {
            $("#ampliacion_contrato_lista").hide();
            }
            }
            });
            }
            });
            });

            function refreshTable() {
            $('.refresco').fadeOut();
            $('.refresco').load(url, function () {
            $('.refresco').fadeIn();
            });
            }

            $("#dolares_filtro").select2('destroy');


        @endsection

    </script>
@endsection
