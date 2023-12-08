@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}">
@endsection
@section('content')
    @include('admin.listadistribucion.estilos')
    <div class="card card-body instrucciones">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-10">
                <h5>Crea tu propio grupo de distribución de correo</h6>
                    <p>En esta sección puedes generar las listas de distribucion de correos, agruparlas ydarles el nivel
                        de prioridad para ser administradas conforme a su nivel asignado</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Módulo Asignado</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-floating">
                        <input class="form-control" id="modulo" type="text" value="{{ $lista->modulo }}" readonly>
                        <label for="modulo">Modulo</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input class="form-control" id="modulo" type="text" value="{{ $lista->submodulo }}" readonly>
                        <label for="modulo">Submodulo</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Configuración Listas de Aprobación</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <p>Esta sección permite que las personas seleccionadas puedan autorizar el flujo en cualquier momento,
                        sin requerir la aprobación de los niveles seleccionados
                    </p>
                    <select id="avatarSelect" multiple="multiple">
                        <option value="1" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 1</option>
                        <option value="2" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 2</option>
                        <option value="3" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 3</option>
                        <option value="4" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 4</option>
                        <option value="5" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 5</option>
                        <option value="6" data-avatar="UID_353_Víctor Hugo Rodríguez Albarrán.png">User 6</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input class="form-control" id="modulo" type="text" value="{{ $lista->submodulo }}" readonly>
                        <label for="modulo">Submodulo</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#avatarSelect').select2({
            templateResult: formatAvatar, // Format avatar in options
            templateSelection: formatAvatar, // Format avatar in selected options
            escapeMarkup: function(m) {
                return m;
            }
        });

        function formatAvatar(option) {
            if (!option.id) {
                return option.text;
            }

            var avatar = $(option.element).data('avatar');
            var avatarHtml = `<img src="{{ asset('storage/empleados/imagenes') }}/${avatar}" class="img_empleado" />`;
            var avatarText = option.text;

            var formattedResult = $('<span>' + avatarHtml + ' ' + avatarText + '</span>');
            return formattedResult;
        }

        $('#avatarSelect').on('select2:select', function(e) {
            var selectedData = $('#avatarSelect').select2('data'); // Get current selected data

            if (selectedOptions.length >= 5) {
                // Remove the last option from selectedData (exceeds limit)
                $('#avatarSelect').val(selectedOptions).trigger('change');
                return;
            }

            var selectedOptionId = e.params.data.id;
            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }
        });

        $('#avatarSelect').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>
@endsection
