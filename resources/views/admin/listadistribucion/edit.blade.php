@extends('layouts.admin')
<style>
    .imgdoc {
        width: 150px;
        height: 150px;
        position: relative;
        top: 5px;
        left: 15px;
        /* UI Properties */
        background: transparent url('img/icono_onboarding.png') 0% 0% no-repeat padding-box;
        opacity: 1;
    }

    #btn_cancelar {
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        opacity: 1;
    }

    .anima-focus label {
        margin-top: -7px !important;

    }
</style>
@section('css')
<link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}" @endsection
    @section('content')
    @include('admin.listadistribucion.estilos')

    <div class="card instrucciones">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('politicas.png') }}" class="imgdoc"  alt="">
                </div>
                <div class="col-10" style="position: relative; top: 3rem;">
                    <h5>Crea tu propio grupo de distribución de correo</h6>
                        <p>En esta sección puedes generar las listas de distribucion de correos, agruparlas ydarles el nivel
                            de prioridad para ser administradas conforme a su nivel asignado</p>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.lista-distribucion.update', [$lista->id]) }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 style="color:#057BE2; title-table-rds">Módulo asignado</h4>
                <hr>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="anima-focus">
                            <input class="form-control" id="modulo" name="modulo" type="text"
                                value="{{ $lista->modulo }}" placeholder="" disabled>
                            <label  for="modulo">Módulo</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus">
                            <input class="form-control" id="submodulo" name="submodulo" type="text"
                                value="{{ $lista->submodulo }}" placeholder="" disabled>
                            <label  for="modulo">Submódulo</label>
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
                    <div class="col-5">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p style="text-align:justify">Esta sección permite que las personas <br> seleccionadas puedan autorizar el flujo en <br> cualquier
                            momento, sin requerir la aprobación <br> de los niveles seleccionados.
                        </p>

                        <div class="col-8">
                            <div class="anima-focus">
                                <select id="superaprobadores"  name="superaprobadores[]" class="form-control"
                                    multiple="multiple" placeholder="">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                            {{ $empleado->name }}</option>
                                    @endforeach
                                </select>
                                <label for="superaprobadores" style="color:#057BE2;">Super Aprobadores</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Seleccione cuantos niveles de aprobación tendra tu lista, para poder asignar por cada nivel el
                            numero
                            de colaboradores que se requiera.</p>
                            <br>
                            <br>

                        <div class="row mb-4">
                            <div class="anima-focus">
                                <select id="niveles" name="niveles" class="form-control" placholder="">
                                    <option value={{ $lista->niveles }} selected>{{ $lista->niveles }}</option>
                                    @for ($i = 1; $i < 6; $i++)
                                        <option value={{ $i }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="niveles" style="color:#057BE2;">Seleccione los niveles</label>
                            </div>
                        </div>
                        <div>
                            @for ($i = 1; $i < 6; $i++)
                                <div class="form-row nivel{{ $i }}Div" style="display: none;">
                                    <div class="mt-4 mb-1">
                                        <i class="fas fa-circle" style="color: #007bff;"></i>  Nivel {{ $i }} <br>
                                       &nbsp; &nbsp; Asigna a los colaboradores que deben aprobar para pasar al siguiente nivel.
                                    </div>
                                    <div class="anima-focus" style="width: 100rem;">
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
                                        <label for="nivel{{ $i }}" style="color:#057BE2;">Colaboradores</label>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  style="position: relative; left: 65rem;">
            <a href="{{ route('admin.lista-distribucion.index') }}" type="button" class="btn btn-primary" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
            <button type="submit" class="btn btn-primary" style="width: 8rem;">Crear</button>
        </div>
    </form>
@endsection
    @section('scripts') <script>
        var superaprobadoresSeleccionados = {!! json_encode($superaprobadores_seleccionados) !!};

        $(document).ready(function() {
            var superaprobadoresSelect = $('#superaprobadores');

            var options = $('option', superaprobadoresSelect);

            // Sort the options based on the numero_orden property
            options.detach().sort(function(a, b) {
                var aOrder = superaprobadoresSeleccionados.find(item => item.empleado_id === $(a).val())
                    ?.numero_orden || 0;
                var bOrder = superaprobadoresSeleccionados.find(item => item.empleado_id === $(b).val())
                    ?.numero_orden || 0;
                return aOrder - bOrder;
            });

            // Append the sorted options back to the select element
            superaprobadoresSelect.append(options);

            // Set the 'selected' attribute for options that match the superaprobadores_seleccionados data
            options.each(function() {
                var empleadoId = $(this).val();
                var isSelected = superaprobadoresSeleccionados.some(function(item) {
                    return item.empleado_id == empleadoId;
                });

                if (isSelected) {
                    $(this).attr('selected', 'selected');
                }
            });
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
                    $('.nivel' + i + 'Div select').select2({
                        maximumSelectionLength: 5,
                        language: {
                            maximumSelected: function(maximumSelect) {
                                return 'Solo pueden seleccionarse un maximo de 5 aprobadores por nivel.';
                                // Customize the message according to your preference
                            }
                        },
                    }); // Initialize select2 for the chosen select(s)
                }
            });

            var initialNivel = $('#niveles').val();
            $('.form-row').hide(); // Hide all select boxes initially
            for (var i = 1; i <= initialNivel; i++) {
                $('.nivel' + i + 'Div').show(); // Show the preselected nivel and preceding nivel's select boxes
                $('.nivel' + i + 'Div select').select2({
                    maximumSelectionLength: 5,
                    language: {
                        maximumSelected: function(maximumSelect) {
                            return 'Solo pueden seleccionarse un maximo de 5 aprobadores por nivel.';
                            // Customize the message according to your preference
                        }
                    },
                }); // Initialize select2 for the preselected select(s)
            }
        });
    </script>

    <script>
        var selectedOptions = []; // Array to store selected options in order

        $('#superaprobadores').select2({
            templateResult: formatAvatar, // Format avatar in options
            templateSelection: formatAvatar, // Format avatar in selected options
            maximumSelectionLength: 5,
            language: {
                maximumSelected: function(maximumSelect) {
                    return 'Solo pueden seleccionarse un maximo de 5 superaprobadores.';
                    // Customize the message according to your preference
                }
            },
            formatSelectionTooBig: function(maximum) {
                return '';
                // Customize the message according to your preference
            },
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
                    maximumSelectionLength: 5,
                    language: {
                        maximumSelected: function(maximumSelect) {
                            return 'Solo pueden seleccionarse un maximo de 5 aprobadores por nivel.';
                            // Customize the message according to your preference
                        }
                    },
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

            // if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
            //     Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
            //         'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
            //     $('#nivel1').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
            //     selectedOptions.shift();
            // }

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

            // if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
            //     Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
            //         'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
            //     $('#nivel2').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
            //     selectedOptions.shift();
            // }

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

            // if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
            //     Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
            //         'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
            //     $('#nivel3').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
            //     selectedOptions.shift();
            // }

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

            // if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
            //     Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
            //         'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
            //     $('#nivel4').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
            //     selectedOptions.shift();
            // }

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

            // if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
            //     Swal.fire('Solo se permiten seleccionar un maximo de 5 aprobadores por nivel',
            //         'Se reemplazara uno de los aprobadores ya seleccionados', 'info');
            //     $('#nivel5').find(`option[value="${selectedOptions[0]}"]`).prop('selected', false);
            //     selectedOptions.shift();
            // }

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
