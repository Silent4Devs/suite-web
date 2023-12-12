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
                            <label for="superaprobadores">SuperAprobadores</label>
                            <select id="superaprobadores" name="superaprobadores" class="form-control" multiple="multiple">
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

                        @for ($i = 1; $i < 6; $i++)
                            <div class="form-row nivel{{ $i }}Div" style="display: none;">
                                <label for="nivel{{ $i }}">Nivel {{ $i }}</label>
                                <select id="nivel{{ $i }}" name="nivel{{ $i }}" class="form-control"
                                    multiple="multiple">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
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
        var selectedOptions = []; // Array to store selected options in order

        $('#nivel1').select2({
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

        $('#nivel1').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
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

        $('#nivel2').select2({
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

        $('#nivel2').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
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

        $('#nivel3').select2({
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

        $('#nivel3').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
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

        $('#nivel4').select2({
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

        $('#nivel4').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
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

        $('#nivel5').select2({
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

        $('#nivel5').on('select2:select', function(e) {
            var selectedOptionId = e.params.data.id;

            if (selectedOptions.length >= 5 && !selectedOptions.includes(selectedOptionId)) {
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
