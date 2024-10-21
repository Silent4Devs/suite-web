@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}{{ config('app.cssVersion') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<form action="{{ route('admin.module_firmas.update', $firma_module->id) }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <h4 style="color:#057BE2;">Módulo asignado</h4>
            <hr>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="anima-focus">
                        <select id="modulos" name="modulo_id" disabled class="form-control">
                            @foreach ($modulos as $modulo)
                                <option value="{{ $modulo->id }}" {{ $modulo->id == $firma_module->modulo_id ? 'selected' : '' }}>
                                    {{ $modulo->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="modulos">Módulo</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="anima-focus">
                        <select id="submodulos" disabled name="submodulo_id" class="form-control">
                            <option selected disabled>Seleccione una opción...</option>
                            @foreach ($submodulos as $submodulo)
                                <option value="{{ $submodulo->id }}" data-modulo="{{ $submodulo->modulo_id }}" {{ $submodulo->id == $firma_module->submodulo_id ? 'selected' : '' }}>
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
            <h4 style="color:#057BE2;">Configuración Listas de Aprobación</h4>
            <hr>
            <div class="row g-0">
                <div class="col-12">
                    <p>Seleccione cuántos participantes de aprobación tendrá tu lista.</p>
                    <div class="anima-focus">
                        <select id="participantes" name="participantes[]" class="form-control" multiple="multiple">
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}" {{ in_array($empleado->id, $participantes) ? 'selected' : '' }}>
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

    <div class="text-right">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
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

        const modulosSelect = $('#modulos');
        const submodulosSelect = $('#submodulos');

        modulosSelect.on('change', function () {
            const selectedModuloId = $(this).val();
            submodulosSelect.find('option').each(function () {
                const submoduloOption = $(this);
                if (submoduloOption.data('modulo') == selectedModuloId) {
                    submoduloOption.show();
                } else {
                    submoduloOption.hide();
                }
            });

            // Si no hay submódulo preseleccionado, selecciona el primero disponible
            if (!submodulosSelect.find('option:selected').length) {
                submodulosSelect.find('option:visible').first().prop('selected', true);
            }
        });

        // Trigger change event to set initial state based on preselected modulo
        modulosSelect.trigger('change');
    });
</script>
@endsection
