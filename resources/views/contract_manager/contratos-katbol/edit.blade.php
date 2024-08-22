@extends('layouts.admin')


@section('content')
    {{ Breadcrumbs::render('contratos-katbol_formulario') }}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        hr.hr-custom-title {
            width: 100%;
            margin: 8px 0;
            border-top: 3px solid #1E94A8;
        }
    </style>

    @if (session('mensajeError'))
        <div class="alert alert-danger">
            {{ session('mensajeError') }}
        </div>
    @endif
    {{-- {{ Breadcrumbs::render('contratos_edit', $contrato) }} --}}
    @include('admin.bitacora.formedit', ['show_contrato' => false])

    @livewire('edit-tabla-contratos', ['id_contrato' => $contratos->id])

    <div>
        <div class="col s12 m12">
            <div class="card card-body">
                <h5 class="mb-0 d-inline-block">Facturación</h5>
                <hr class="hr-custom-title">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <p class="grey-text tablaparra">No. pagos</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Tipo</p>
                                </th>
                                <th>
                                    <p class="grey-text tablaparra">Nombre servicio</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="black-text">
                                <td>{{ $contratos->no_pagos }}</td>
                                <td>{{ $contratos->tipo_contrato }}</td>
                                <td>{{ $contratos->nombre_servicio }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m12">
        <div class="card card-body">
            @livewire('factura.factura-component', ['contrato_id' => $contratos->id, 'show_contrato' => false, 'contrato_total' => $contratos->monto_pago])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Niveles de servicio</h5>
            <hr class="hr-custom-title">
            @livewire('niveles-servicio.niveles-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Entregables mensuales</h5>
            <hr class="hr-custom-title">
            @livewire('entregable-mensual.entregablecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cierre proyecto</h5>
            <hr class="hr-custom-title">
            @livewire('cierre-contratos.cierrecomponent', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12" id="ampliacion_contrato_lista">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Ampliación de contrato</h5>
            <hr class="hr-custom-title">
            @livewire('ampliacion-contratos.ampliacion-component', [
                'contrato_id' => $contratos->id,
                'show_contrato' => false,
                'fecha_fin_contrato' => $contratos->fecha_fin,
            ])
        </div>
    </div>

    <div class="col s12 m12" id="convenio_contrato_lista">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Convenios Modificatorios</h5>
            <hr class="hr-custom-title">
            @livewire('convenios-modificatorios-contratos.convenio-modificatorio-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>

    <div class="col s12 m12">
        <div class="card card-body">
            <h5 class="mb-0 d-inline-block">Cédula de cumplimiento</h5>
            <hr class="hr-custom-title">
            @livewire('cedula-cumplimiento.cedula-cumplimiento-component', ['contrato_id' => $contratos->id, 'show_contrato' => false])
        </div>
    </div>


    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn-success">Salir
                sin llenar</a>
        </div>
    </div>
@endsection
@section('x-editable')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //categories table
            $(".no_pagos").editable({
                dataType: 'json',
                success: function(response, newValue) {
                    console.log('Actualizado, response')
                }
            });
            $(".tipo_contrato").editable({
                dataType: 'json',
                success: function(response, newValue) {
                    console.log('Actualizado, response')
                }
            });

            $(".nombre_servicio").editable({
                dataType: 'json',
                success: function(response, newValue) {
                    console.log('Actualizado, response')
                }
            });

        });

        function refreshTable() {
            $('.refresco').fadeOut();
            $('.refresco').load(url, function() {
                $('.refresco').fadeIn();
            });
        }

        $("#dolares_filtro").select2('destroy');
    </script>
@endsection
