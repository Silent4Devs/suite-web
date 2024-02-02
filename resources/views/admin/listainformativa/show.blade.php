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
<link rel="stylesheet" href="{{ asset('css/listainformativa.css') }}" @endsection
    @section('content')
    @include('admin.listainformativa.estilos')

    <div class="card instrucciones">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('politicas.png') }}" class="imgdoc"  alt="">
                </div>
                <div class="col-10" style="position: relative; top: 3rem;">
                    <h5>Crea tu propio grupo de distribución de correo</h6>
                        <p>En esta sección puedes generar las listas informativas de correos, 
                            en las cuales se informaran a los colaboradores 
                            sobre los procesos en estos submodulos.</p>
                </div>
            </div>
        </div>
    </div>

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
        <div class="card" style="height: 680px;">
            <div class="card-body">
                <h4 style="color:#057BE2; title-table-rds">Configuración Listas de Aprobación</h4>
                <hr>
                <div class="row g-0">
                    <div class="col-12">
                        <div>
                            @error('nivel_null')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                                <div class="form-row nivel1Div"">
                                    <div class="mt-4 mb-1">
                                        <i class="fas fa-circle" style="color: #007bff;"></i> Informados <br>
                                       &nbsp; &nbsp; Asigna a los colaboradores que seran informados de los procesos en el modulo.
                                    </div>
                                    <div class="anima-focus" style="width: 100rem;">
                                        <select id="nivel1" name="nivel1[]"
                                            class="form-control" multiple="multiple">
                                            @foreach ($empleados as $empleado)
                                                <option value="{{ $empleado->id }}"
                                                    data-avatar="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                                    {{ in_array($empleado->id, $nivelData1 ?? []) ? 'selected' : '' }}>
                                                    {{ $empleado->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="nivel1" style="color:#057BE2;">Colaboradores</label>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div  style="position: relative; text-align:end;">
                <a href="{{ route('admin.lista-informativa.index') }}" type="button" class="btn btn-primary" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
    @section('scripts') <script>
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
                var selectElement = $('#nivel1');
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
            for (let i = 1; i < 11; i++) {
                $('#nivel' + i).select2({
                    templateResult: formatAvatar,
                    templateSelection: formatAvatar,
                    maximumSelectionLength: 10,
                    language: {
                        maximumSelected: function(maximumSelect) {
                            return 'Solo pueden seleccionarse un maximo de 10 informadores por modulo.';
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
@endsection
