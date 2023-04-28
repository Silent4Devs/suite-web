@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let responsable = document.querySelector('#id_responsable');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('id_area').innerHTML = recortarTexto(area_init);
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_puesto').innerHTML = recortarTexto(puesto);
                document.getElementById('id_area').innerHTML = recortarTexto(area);
            })

            function recortarTexto(texto, length = 30) {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }

            document.getElementById('confidencialidad').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad').checked;
                let disponibilidad = document.getElementById('disponibilidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));


            })
            document.getElementById('integridad').addEventListener('change', (e) => {
                let disponibilidad = document.getElementById('disponibilidad').checked;
                let confidencialidad = document.getElementById('confidencialidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })
            document.getElementById('disponibilidad').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad').checked;
                let confidencialidad = document.getElementById('confidencialidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })

            document.getElementById('confidencialidad_cid').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad_cid').checked;
                let disponibilidad = document.getElementById('disponibilidad_cid').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacionRes');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo_residual');
                // let impacto = Number(document.getElementById('impacto_residual').value);
                // let probabilidad =Number(document.getElementById('probabilidad_residual').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })
            document.getElementById('integridad_cid').addEventListener('change', (e) => {
                let disponibilidad = document.getElementById('disponibilidad_cid').checked;
                let confidencialidad = document.getElementById('confidencialidad_cid').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacionRes');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo_residual');
                // let impacto = Number(document.getElementById('impacto_residual').value);
                // let probabilidad =Number(document.getElementById('probabilidad_residual').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })
            document.getElementById('disponibilidad_cid').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad_cid').checked;
                let confidencialidad = document.getElementById('confidencialidad_cid').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacionRes');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo_residual');
                // let impacto = Number(document.getElementById('impacto_residual').value);
                // let probabilidad =Number(document.getElementById('probabilidad_residual').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let custodio = document.querySelector('#custodio');
            let area_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
            let puesto_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');

            document.getElementById('id_custodio_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('id_custodio_area').innerHTML = recortarTexto(area_init);
            custodio.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_custodio_puesto').innerHTML = recortarTexto(puesto);
                document.getElementById('id_custodio_area').innerHTML = recortarTexto(area);
            })
        });

        function recortarTexto(texto, length = 30) {
            let trimmedString = texto?.length > length ?
                texto.substring(0, length - 3) + "..." :
                texto;
            return trimmedString;
        }

    </script>

    <script>
        $(document).ready(function() {
            $(".js-example-basic-multiple").select2(
                'theme': 'bootstrap4',
                allowClear: true,
                minimumResultsForSearch: -1,
            );
        });
    </script>

    <script type=text/javascript>
        $('#probabilidad').change(function() {
            var impactoID = document.getElementById("impacto").value;
            // var ponderacion = document.getElementById("resultadoponderacion").value;
            let probabilidadID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            document.getElementById("nivelriesgo").value = result;
            switch (true) {
                case result == 0:
                    $('#nivelriesgo_pre').text('Bajo');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-success');
                    break;
                case result >= 9 && result <= 18:
                    $('#nivelriesgo_pre').text('Medio');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case result >= 27 && result <= 36:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case result >= 54 && result <= 81:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                default:
                    alert("Rango no encontrado, ¡Intentalo de nuevo!");
                    break;
            }

        });

        $('#impacto').change(function() {
            var probabilidadID = document.getElementById("probabilidad").value;
            var ponderacion = document.getElementById("resultadoponderacion").value;
            let impactoID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            document.getElementById("nivelriesgo").value = result;
            switch (true) {
                case result == 0:
                    $('#nivelriesgo_pre').text('Bajo');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-succes');
                    break;
                case result >= 9 && result <= 18:
                    $('#nivelriesgo_pre').text('Medio');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case result >= 27 && result <= 36:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case result >= 54 && result <= 81:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                default:
                    alert("Rango no encontrado, ¡Intentalo de nuevo!");
                    break;
            }
        });
    </script>

    <script type=text/javascript>
        $('#probabilidad_residual').change(function() {
            var impactoID_residual = document.getElementById("impacto_residual").value;
            // var ponderacionRes = document.getElementById("resultadoponderacionRes").value;
            let probabilidadID_residual = $(this).val();
            //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
            let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
            document.getElementById("nivelriesgo_residual").value = result1;
            switch (true) {
                case result1 == 0:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-success');
                    break;
                case result1 >= 9 && result1 <= 18:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case result1 >= 27 && result1 <= 36:
                    $('#nivelriesgo_residual_pre').text('Moderado');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case result1 >= 54 && result1 <= 81:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                default:
                    alert("Rango no encontrado, ¡Intentalo de nuevo!");
                    break;
            }
        });

        $('#impacto_residual').change(function() {
            var probabilidadID_residual = document.getElementById("probabilidad_residual").value;
            let impactoID_residual = $(this).val();
            var ponderacionRes = document.getElementById("resultadoponderacionRes").value;
            let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
            //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
            document.getElementById("nivelriesgo_residual").value = result1;
            switch (true) {
                case result1 == 0 :
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-success');
                    break;
                case result1 >= 9 && result1 <= 18:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case result1 >= 27 && result1 <= 36:
                    $('#nivelriesgo_residual_pre').text('Moderado');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case result1 >= 54 && result1 <= 81:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                default:
                    alert("Rango no encontrado, ¡Intentalo de nuevo!");
                    break;
            }
        });
    </script>




    <script type="text/javascript">
        Livewire.on('planStore', () => {
            $('#planAccionModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Plan de Acción creado con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>

    <script type="text/javascript">
        $("#ejemplo").click(function() {
            var val = $(this).val();
            if (val == 0) {
                $("#ver1").css("display", "none");
                $("#modulo_planaccion").css("display", "block");
            } else {
                $("#ver1").css("display", "block");
                $("#modulo_planaccion").css("display", "none");

            }
        });
    </script>

    <script>
        var numero1 = document.getElementById("numero1").value;
        var numero2 = document.getElementById("numero2").value;

        var suma = numero1 + numero2;

        document.writeln(suma);
    </script>
@endsection
