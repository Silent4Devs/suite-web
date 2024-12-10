@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')

    <style>
        div.recuadro-instruccion {
            width: 100%;
            background: #FFFBEE;
            border: 1px solid #FFA200;
            border-radius: 9px;
            opacity: 1;
            color: #FF8000;
            padding: 10px 20px;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Proyecto</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div class="card card-body mt-4">
        @php
            use App\Models\TimesheetHoras;
        @endphp
        @can('timesheet_administrador_proyectos_create')
            <div class="row">
                <div class="col-12">
                    <h4 class="title-card-time">Nuevo Proyecto</h4>
                </div>
            </div>
            <form id="timesheet-proyectos-form" method="POST" action="{{ route('admin.timesheet-proyectos-store') }}">
                @csrf

                <div class="row mb-4">
                    <div class="recuadro-instruccion">
                        <strong>!</strong> &nbsp; Debe Ingresar un Identificador antes de poder seleccionar el tipo.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8" style="padding-left: 0px !important; padding-right: 0px !important">
                        @livewire('identificador-proyectos-int-ext')
                    </div>
                    {{-- <div class="form-group col-md-2 anima-focus">
                        <input type="text" id="identificador_proyect" placeholder=""
                            title="Por favor, no incluyas comas en el nombre de la tarea." name="identificador"
                            pattern="[^\.,]*" class="form-control" maxlength="254" required>
                        {!! Form::label('identificador', 'ID*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('identificador'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador') }}
                            </div>
                        @endif
                        @error('identificador')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-4 anima-focus">
                        <input type="text" id="name_proyect" name="proyecto_name" class="form-control" maxlength="254"
                            required placeholder="">
                        <label for="name_proyect" class="asterisco">Nombre del proyecto*</label>
                        <span id="alertaGenerica" style="color: red; display: none;"></span>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-4 anima-focus">
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option selected value="">Seleccione cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="cliente_id" class="asterisco">Cliente*</label>
                    </div>

                    <div class="form-group col-md-4 anima-focus" style="position: relative; top: -1.5rem;"
                        id="caja_areas_seleccionadas_create">
                        <select class="select2-multiple form-control" multiple="multiple" id="areas_seleccionadas"
                            name="areas_seleccionadas[]">
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                        <label for="areas_seleccionadas" class="asterisco">Área(s) participante(s)*</label>
                        <div class="mt-1">
                            <input id="chkall" name="chkall" type="checkbox" value="todos"> Seleccionar Todas
                        </div>
                    </div>

                    <div class="form-group col-md-4 anima-focus">
                        <select class="form-control" name="sede_id" id="sede_id">
                            <option selected value="">Seleccione sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                        <label for="sede_id" class="asterisco">Sede</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 anima-focus">
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                        <label for="fecha_inicio" class="asterisco">Fecha de inicio</label>
                        @if ($errors->has('fecha_inicio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_inicio') }}
                            </div>
                        @endif
                        @error('fecha_inicio')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 anima-focus">
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                        <label for="fecha_fin" class="asterisco">Fecha de fin</label>
                        @if ($errors->has('fecha_fin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_fin') }}
                            </div>
                        @endif
                        @error('fecha_fin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 anima-focus">
                        <input type="text" pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                            name="horas_proyecto" maxlength="250" id="horas_proyecto" class="form-control">
                        <label for="horas_proyecto" class="asterisco">Horas Asignadas al proyecto</label>
                        @if ($errors->has('horas_proyecto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('horas_proyecto') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12 text-right">
                        <button id="submit-btn" class="btn btn-primary" type="button" onclick="mostrarCargando()">
                            Crear Proyecto
                        </button>

                        <!-- Indicador de carga (oculto por defecto) -->
                        <div id="loading-spinner" class="spinner-border text-primary" role="status" style="display: none;">
                            <span class="sr-only">Cargando...</span>
                        </div>
                    </div>
                </div>
            </form>
        @endcan
    </div>
@endsection

@section('scripts')
    <script>
        function mostrarCargando() {
            // Desactivar el botón y mostrar el spinner
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('loading-indicator').style.display = 'inline-block';

            // Simula una petición, puedes quitar esto si tienes una petición real
            setTimeout(function() {
                // Rehabilitar el botón y ocultar el spinner (cuando termina la carga)
                document.getElementById('submit-btn').disabled = false;
                document.getElementById('loading-indicator').style.display = 'none';
            }, 3000); // Cambia 3000 por la duración de tu carga (3 segundos en este ejemplo)
        }
    </script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                theme: 'bootstrap4',
                allowClear: true
            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get form and submit button
            const form = document.getElementById('timesheet-proyectos-form');
            const submitBtn = document.getElementById('submit-btn');

            // Add event listener to submit button
            submitBtn.addEventListener('click', function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Perform AJAX request
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Proyecto Creado',
                                text: data
                                    .message, // Assuming the response contains a 'message' key
                                allowOutsideClick: false // Prevent dismissing by clicking outside the dialog
                            }).then((result) => {
                                Swal.fire({
                                    icon: 'question',
                                    title: '¿Desea Crear un Contrato para este Proyecto?',
                                    text: 'Ir a vista de creación de Contratos',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí',
                                    cancelButtonText: 'No'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Show modal for additional inputs
                                        Swal.fire({
                                            title: 'Datos del Contrato',
                                            html:
                                                // '<input type="checkbox" id="contrato_privado" class="swal2-input"> Contrato Privado<br>' +
                                                '<label for="no_contrato">No.Contrato</label>' +
                                                '<input type="text" id="no_contrato" class="swal2-input" placeholder="No. contrato">' +
                                                '<label for="nombre_servicio">Nombre del Servicio.</label>' +
                                                '<textarea id="nombre_servicio" class="swal2-textarea" placeholder="Nombre del servicio"></textarea>',
                                            focusConfirm: false,
                                            preConfirm: () => {
                                                return {
                                                    // contrato_privado: document
                                                    //     .getElementById(
                                                    //         'contrato_privado'
                                                    //     ).checked,
                                                    no_contrato: document
                                                        .getElementById(
                                                            'no_contrato')
                                                        .value,
                                                    nombre_servicio: document
                                                        .getElementById(
                                                            'nombre_servicio'
                                                        ).value
                                                };
                                            }
                                        }).then((result) => {
                                            if (result.value) {
                                                // Redirect to the desired route with additional data
                                                const id_proyecto = data
                                                    .id_proyecto;
                                                const additionalData =
                                                    new FormData();
                                                // additionalData.append(
                                                //     'contrato_privado',
                                                //     result.value
                                                //     .contrato_privado);
                                                additionalData.append(
                                                    'no_contrato', result
                                                    .value.no_contrato);
                                                additionalData.append(
                                                    'nombre_servicio',
                                                    result.value
                                                    .nombre_servicio);
                                                additionalData.append(
                                                    'id_proyecto',
                                                    id_proyecto);
                                                additionalData.append('_token',
                                                    csrfToken);

                                                fetch("{{ route('admin.timesheet.creacionContratoProyecto') }}", {
                                                        method: 'POST',
                                                        body: additionalData,
                                                        headers: {
                                                            'X-CSRF-TOKEN': csrfToken
                                                        }
                                                    }).then(response => response
                                                        .json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Contrato Creado',
                                                                text: data
                                                                    .message
                                                            }).then(
                                                                () => {
                                                                    // Redirect to the edit route
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        "{{ route('admin.timesheet-proyectos-edit', 'id') }}"
                                                                        .replace(
                                                                            'id',
                                                                            id_proyecto
                                                                        );
                                                                });
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Error!',
                                                                text: data
                                                                    .message
                                                            }).then(
                                                                () => {
                                                                    // Redirect to the edit route
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        "{{ route('admin.timesheet-proyectos-edit', 'id') }}"
                                                                        .replace(
                                                                            'id',
                                                                            id_proyecto
                                                                        );
                                                                });
                                                        }
                                                    }).catch(error => {
                                                        console.error(
                                                            'Error:',
                                                            error);
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error!',
                                                            text: 'Se ha producido un error al intentar crear el contrato.'
                                                        }).then(
                                                            () => {
                                                                // Redirect to the edit route
                                                                window
                                                                    .location
                                                                    .href =
                                                                    "{{ route('admin.timesheet-proyectos-edit', 'id') }}"
                                                                    .replace(
                                                                        'id',
                                                                        id_proyecto
                                                                    );
                                                            });
                                                    });
                                            }
                                        });
                                    } else {
                                        // If the user cancels
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Cancelado',
                                            text: 'La acción ha sido cancelada.',
                                        }).then(() => {
                                            // Redirect to the edit route
                                            const id_proyecto = data
                                                .id_proyecto;
                                            window.location.href =
                                                "{{ route('admin.timesheet-proyectos-edit', 'id') }}"
                                                .replace('id', id_proyecto);
                                        });
                                    }
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data
                                    .message // Assuming the response contains a 'message' key
                            });
                        }
                    })
                    .catch(error => {
                        // Handle errors
                        console.error('Error:', error);
                        // Example: Show generic error message using SweetAlert2
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Se ha producido un error al intentar crear el proyecto.'
                        });
                    });
            });
        });
    </script>
@endsection
