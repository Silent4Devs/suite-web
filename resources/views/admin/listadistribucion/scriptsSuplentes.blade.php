<script>
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
                    maximumSelectionLength: 3,
                    language: {
                        maximumSelected: function(maximumSelect) {
                            return 'Solo puede seleccionarse un maximo de 1 sustituto y 2 colaboradores en copia por nivel.';
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
                maximumSelectionLength: 3,
                language: {
                    maximumSelected: function(maximumSelect) {
                        return 'Solo puede seleccionarse un maximo de 1 sustituto y 2 colaboradores en copia por nivel.';
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
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function(maximumSelect) {
                return 'Solo puede seleccionarse un maximo de 1 sustituto y 2 colaboradores en copia por nivel.';
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
                maximumSelectionLength: 3,
                language: {
                    maximumSelected: function(maximumSelect) {
                        return 'Solo puede seleccionarse un maximo de 1 sustituto y 2 colaboradores en copia por nivel.';
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
        var avatarHtml = `<img src="${avatar}" class="img_empleado" style="margin-left: 20px;" />`;
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
