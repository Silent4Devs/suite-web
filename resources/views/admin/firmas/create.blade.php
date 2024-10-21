@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}{{ config('app.cssVersion') }}">
    <!-- CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

    <!-- JavaScript de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <style>
        /* Aquí puedes añadir estilos personalizados si es necesario */
    </style>
@endsection

@section('content')
    <form action="{{ route('admin.module_firmas.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 style="color:#057BE2; title-table-rds">Módulo asignado</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="anima-focus">
                            <select id="modulos" name="modulos" class="form-control">
                                @foreach ($modulos as $modulo)
                                    <option value="{{ $modulo->id }}">
                                        {{ $modulo->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="modulos">Módulo</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus">
                            <select id="submodulos" name="submodulos" class="form-control">
                                <option selected disabled>Seleccione una opción...</option>
                                @foreach ($submodulos as $submodulo)
                                    <option value="{{ $submodulo->id }}" data-modulo="{{ $submodulo->modulo_id }}" style="display: none;">
                                        {{ $submodulo->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="submodulos">Submódulo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 style="color:#057BE2; title-table-rds">Configuración Listas de Aprobación</h4>
                <hr>
                <div class="row g-0">
                    <div class="col-12">
                        <p>Seleccione cuántos participantes de aprobación tendrá tu lista.</p>
                        <div class="anima-focus">
                            <select id="participantes" name="participantes[]" class="form-control" multiple="multiple">
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="participantes">Participantes (máximo 5)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right" style="position: relative; top:-1rem;">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#participantes').select2({
                placeholder: 'Selecciona participantes',
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ' '],
                templateResult: formatEmpleado,
                templateSelection: formatEmpleadoSelection,
                maximumSelectionLength: 5  // Limita a un máximo de 5 selecciones
            });

            function formatEmpleado(empleado) {
                if (!empleado.id) {
                    return empleado.text;
                }
                var avatar = $(empleado.element).data('avatar');
                var $avatar = $('<img class="avatar" src="' + avatar + '">');
                var $nombre = $('<span>' + empleado.text + '</span>');
                var $container = $('<span>').append($avatar).append($nombre);
                return $container;
            }

            function formatEmpleadoSelection(empleado) {
                return empleado.text;
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const modulosSelect = document.getElementById('modulos');
            const submodulosSelect = document.getElementById('submodulos');

            modulosSelect.addEventListener('change', function () {
                const selectedModuloId = this.value;

                // Reset submodulos select to the default option
                submodulosSelect.selectedIndex = 0;

                Array.from(submodulosSelect.options).forEach(option => {
                    if (option.getAttribute('data-modulo') == selectedModuloId) {
                        // Verifica si el submódulo ya está seleccionado
                        const submoduloSeleccionado = $('#submodulos').find(':selected').data('modulo');
                        if (submoduloSeleccionado != selectedModuloId) {
                            option.style.display = 'block';
                        }
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Ensure the default option is visible
                submodulosSelect.options[0].style.display = 'block';
            });

            // Trigger change event to set initial state
            modulosSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
