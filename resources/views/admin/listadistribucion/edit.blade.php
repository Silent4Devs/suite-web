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

    <form method="POST" action="{{ route('admin.lista-distribucion.update', [$lista->id]) }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>Módulo Asignado</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating">
                            <input class="form-control" id="modulo" name="modulo" type="text"
                                value="{{ $lista->modulo }}" disabled>
                            <label for="modulo">Modulo</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input class="form-control" id="modulo" name="submodulo" type="text"
                                value="{{ $lista->submodulo }}" disabled>
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
                <div class="row g-0">
                    <div class="col-5">
                        <p>Esta sección permite que las personas seleccionadas puedan autorizar el flujo en cualquier
                            momento,
                            sin requerir la aprobación de los niveles seleccionados
                        </p>

                        <div class="row">
                            <label for="superaprobadores">Super Aprobadores</label>
                            <select id="superaprobadores" name="superaprobadores[]" class="form-control"
                                multiple="multiple">
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                        {{ $empleado->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-7">
                        <p>Seleccione cuantos niveles de aprobación tendra tu lista, para poder asignar por cada nivel el
                            numero
                            de colaboradores que se requiera.</p>

                        <div class="row">
                            <label for="niveles">Seleccione los niveles</label>
                            <select id="niveles" name="niveles" class="form-control">
                                <option value={{ $lista->niveles }} selected>{{ $lista->niveles }}</option>
                                @for ($i = 1; $i < 6; $i++)
                                    <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- @for ($i = 1; $i < 6; $i++)
                            <div class="form-row nivel{{ $i }}Div" style="display: none;">
                                <label for="nivel{{ $i }}">Nivel {{ $i }}</label>
                                <select id="nivel{{ $i }}" name="nivel{{ $i }}[]"
                                    class="form-control" multiple="multiple">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor --}}
                        @for ($i = 1; $i < 6; $i++)
                            <div class="form-row nivel{{ $i }}Div" style="display: none;">
                                <label for="nivel{{ $i }}">Nivel {{ $i }}</label>
                                <select id="nivel{{ $i }}" name="nivel{{ $i }}[]"
                                    class="form-control" multiple="multiple">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}"
                                            data-avatar="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                            {{ in_array($empleado->id, $nivelData[$i - 1] ?? []) ? 'selected' : '' }}>
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                        {{-- <div class="form-row niveles-container" id="nivel2-container">
                            <label for="nivel2">Nivel 2</label>
                            <select id="nivel2" name="nivel2[]" class="form-control" multiple="multiple">
                                <optgroup label="Nivel 2">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-row niveles-container" id="nivel3-container">
                            <label for="nivel3">Nivel 3</label>
                            <select id="nivel3" name="nivel3[]" class="form-control" multiple="multiple">
                                <optgroup label="Nivel 3">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-row niveles-container" id="nivel4-container">
                            <label for="nivel4">Nivel 4</label>
                            <select id="nivel4" name="nivel4[]" class="form-control" multiple="multiple">
                                <optgroup label="Nivel 4">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-row niveles-container" id="nivel5-container">
                            <label for="nivel5">Nivel 5</label>
                            <select id="nivel5" name="nivel5[]" class="form-control" multiple="multiple">
                                <optgroup label="Nivel 5">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <button type="submit">Guardar</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        var superaprobadoresSeleccionados = {!! json_encode($superaprobadores_seleccionados) !!};

        // Loop through each superaprobador
        superaprobadoresSeleccionados.forEach(function(superaprobador) {
            var empleadoId = superaprobador.empleado_id;
            var numeroOrden = superaprobador.numero_orden;

            // Find the corresponding option based on empleadoId
            var option = $('#superaprobadores option[value="' + empleadoId + '"]');

            // If the option exists, append it to the #superaprobadores select based on numero_orden
            if (option.length > 0) {
                option.detach();
                var options = $('#superaprobadores option');
                if (options.length === 0) {
                    $('#superaprobadores').append(option);
                } else {
                    options.each(function(index, element) {
                        var currentNumeroOrden = superaprobadoresSeleccionados.find(sa => sa.empleado_id ==
                            $(element).val()).numero_orden;
                        if (numeroOrden < currentNumeroOrden) {
                            option.insertBefore(element);
                            return false; // Break the loop
                        } else if (index === options.length - 1) {
                            $('#superaprobadores').append(option);
                        }
                    });
                }
            }
        });
    </script>

    <script>
        var participantesSeleccionados = {!! json_encode($participantes_seleccionados) !!};

        function populateSelects() {
            Object.keys(participantesSeleccionados).forEach(function(nivel) {
                var nivelSelect = $('#' + nivel);

                participantesSeleccionados[nivel].forEach(function(item) {
                    if (nivelSelect.length && item.empleado_id) {
                        var foundOption = nivelSelect.find('option[value="' + item.empleado_id + '"]');

                        // Check if the option exists and select it if it does
                        if (foundOption.length) {
                            foundOption.attr('selected', 'selected');
                        } else {
                            var option = new Option(item.empleado_id, item.empleado_id);
                            $(option).html(item
                                .empleado_id); // Change this according to your display requirements

                            nivelSelect.append(option);
                        }
                    }
                });
            });
        }

        $(document).ready(function() {
            populateSelects();
        });
    </script>

    <script>
        var participantesSeleccionados = {!! json_encode($participantes_seleccionados) !!};

        $(document).ready(function() {
            // Loop through each level (nivel1, nivel2, etc.)
            $.each(participantesSeleccionados, function(key, value) {
                var selectElement = $('#' + key);
                var options = $('option', selectElement);

                // Sort the options based on the numero_orden property
                options.detach().sort(function(a, b) {
                    var aOrder = value.find(item => item.empleado_id == $(a).val())?.numero_orden ||
                        0;
                    var bOrder = value.find(item => item.empleado_id == $(b).val())?.numero_orden ||
                        0;
                    return aOrder - bOrder;
                });

                // Append the sorted options back to the select element
                selectElement.append(options);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#niveles').change(function() {
                var selectedNivel = $(this).val();
                $('.form-row').hide(); // Hide all select boxes initially
                for (var i = 1; i <= selectedNivel; i++) {
                    $('.nivel' + i + 'Div')
                        .show(); // Show the selected nivel and preceding nivel's select boxes
                    $('.nivel' + i + 'Div select').select2(); // Initialize select2 for the chosen select(s)
                }
            });

            var initialNivel = $('#niveles').val();
            $('.form-row').hide(); // Hide all select boxes initially
            for (var i = 1; i <= initialNivel; i++) {
                $('.nivel' + i + 'Div').show(); // Show the preselected nivel and preceding nivel's select boxes
                $('.nivel' + i + 'Div select').select2(); // Initialize select2 for the preselected select(s)
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#superaprobadores').select2({
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

        $('#superaprobadores').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                $('#superaprobadores').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#superaprobadores').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#superaprobadores');
        });

        $('#superaprobadores').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            for (let i = 1; i < 6; i++) {
                $('#nivel' + i).select2({
                    templateResult: formatAvatar,
                    templateSelection: formatAvatar,
                    escapeMarkup: function(m) {
                        return m;
                    }
                });
            }
        });

        function formatAvatar(option) {
            if (!option.id) {
                return option.text;
            }

            var avatar = $(option.element).data('avatar');
            var avatarHtml = `<img src="${avatar}" class="img_empleado" />`;
            var avatarText = option.text;

            var formattedResult = $('<span>' + avatarHtml + ' ' + avatarText + '</span>');
            return formattedResult;
        }
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order


        $('#nivel1').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
                    'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
                $('#nivel1').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#nivel1').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#nivel1');
        });

        $('#nivel1').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#nivel2').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
                    'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
                $('#nivel2').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#nivel2').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#nivel2');
        });

        $('#nivel2').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#nivel3').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
                    'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
                $('#nivel3').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#nivel3').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#nivel3');
        });

        $('#nivel3').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#nivel4').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
                    'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
                $('#nivel4').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#nivel4').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#nivel4');
        });

        $('#nivel4').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order
        $('#nivel5').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
                Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
                    'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
                $('#nivel5').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
                selectedOptions.shift();
            }

            if (!selectedOptions.includes(selectedOptionId)) {
                selectedOptions.push(selectedOptionId);
            }

            $('#nivel5').find('option').sort(function(a, b) {
                return selectedOptions.indexOf(a.value) - selectedOptions.indexOf(b.value);
            }).appendTo('#nivel5');
        });

        $('#nivel5').on('select2:unselect', function(e) {
            var unselectedOptionId = e.params.data.id;
            var index = selectedOptions.indexOf(unselectedOptionId);
            if (index !== -1) {
                selectedOptions.splice(index, 1);
            }
        });
    </script>
@endsection
