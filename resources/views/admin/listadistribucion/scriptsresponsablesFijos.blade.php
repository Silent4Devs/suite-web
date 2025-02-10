<script>
    var participantesSeleccionados = {!! json_encode($participantes_seleccionados) !!};

    function populateSelects() {
        Object.keys(participantesSeleccionados).forEach(function(nivel) {
            var nivelSelect = $('#' + nivel);

            participantesSeleccionados[nivel].forEach(function(item) {
                // Ignorar el participante con numero_orden igual a 1
                if (item.numero_orden !== 1 && nivelSelect.length && item.empleado_id) {
                    var foundOption = nivelSelect.find('option[value="' + item.empleado_id + '"]');

                    // Check if the option exists and select it if it does
                    if (foundOption.length) {
                        foundOption.attr('selected', 'selected');
                    } else {
                        var option = new Option(item.empleado_id, item.empleado_id);
                        $(option).html(item
                            .empleado_id); // Cambia esto según tus requisitos de visualización

                        nivelSelect.append(option);
                    }
                }
            });
        });
    }

    $(document).ready(function() {
        populateSelects();

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

        $('#niveles').change(function() {
            var selectedNivel = $(this).val();
            $('.form-row').hide(); // Hide all select boxes initially
            for (var i = 1; i <= selectedNivel; i++) {
                $('.nivel' + i + 'Div')
                    .show(); // Show the selected nivel and preceding nivel's select boxes
                $('.nivel' + i + 'Div select').select2({
                    maximumSelectionLength: 5, // Max selection
                    language: {
                        maximumSelected: function(maximumSelect) {
                            return 'Solo pueden seleccionarse un máximo de 5 aprobadores por nivel.';
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
                maximumSelectionLength: 5, // Max selection
                language: {
                    maximumSelected: function(maximumSelect) {
                        return 'Solo pueden seleccionarse un máximo de 5 aprobadores por nivel.';
                    }
                },
            }); // Initialize select2 for the preselected select(s)
        }

        // Apply select2 to each nivel select
        for (let i = 1; i <= {{ $lista->niveles }}; i++) {
            $('#nivel' + i).select2({
                templateResult: formatAvatar,
                templateSelection: formatAvatar,
                maximumSelectionLength: 5, // Max selection
                language: {
                    maximumSelected: function(maximumSelect) {
                        return 'Solo pueden seleccionarse un máximo de 5 aprobadores por nivel.';
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

    var niveles = @json($lista->niveles);
    var selectedOptions = {}; // Object to store selected options for each nivel in order

    for (var i = 1; i <= niveles; i++) {
        selectedOptions['nivel' + i] = [];

        (function(nivel) {
            $('#nivel' + nivel).on('select2:select', function(e) {
                var selectedOptionId = e.params.data.id;

                if (!selectedOptions['nivel' + nivel].includes(selectedOptionId)) {
                    selectedOptions['nivel' + nivel].push(selectedOptionId);
                }

                $('#nivel' + nivel).find('option').sort(function(a, b) {
                    return selectedOptions['nivel' + nivel].indexOf(a.value) - selectedOptions[
                        'nivel' + nivel].indexOf(b.value);
                }).appendTo('#nivel' + nivel);
            });

            $('#nivel' + nivel).on('select2:unselect', function(e) {
                var unselectedOptionId = e.params.data.id;
                var index = selectedOptions['nivel' + nivel].indexOf(unselectedOptionId);
                if (index !== -1) {
                    selectedOptions['nivel' + nivel].splice(index, 0);
                }
            });
        })(i);
    }
</script>
