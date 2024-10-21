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

    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn-primary">Salir
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
