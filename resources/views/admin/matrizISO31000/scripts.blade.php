@section('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let responsable = document.querySelector('#id_responsable');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('id_puesto').innerHTML = puesto_init;
            document.getElementById('id_area').innerHTML = area_init;
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_puesto').innerHTML = puesto;
                document.getElementById('id_area').innerHTML = area;
            })
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let custodio = document.querySelector('#custodio');
            let area_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
            let puesto_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');

            document.getElementById('id_custodio_puesto').innerHTML = puesto_init;
            document.getElementById('id_custodio_area').innerHTML = area_init;
            custodio.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_custodio_puesto').innerHTML = puesto;
                document.getElementById('id_custodio_area').innerHTML = area;
            })
        });
    </script> --}}

    <script type=text/javascript>
        $('#probabilidad').change(function() {
            var impactoID = document.getElementById("impacto").value;
            let probabilidadID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            $("#nivelriesgo").attr("value", result);
            switch (result) {
                case 0:
                    $('#nivelriesgo_pre').text('Bajo');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-success');
                    break;
                case 9:
                    $('#nivelriesgo_pre').text('Medio');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case 18:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case 27:
                    $('#nivelriesgo_pre').text('Muy alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case 36:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case 54:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                case 81:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                default:
                    alert("try again");
                    break;
            }

        });

        $('#impacto').change(function() {
            var probabilidadID = document.getElementById("probabilidad").value;
            let impactoID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            $("#nivelriesgo").attr("value", result);
            switch (result) {
                case 0:
                    $('#nivelriesgo_pre').text('Bajo');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-success');
                    break;
                case 9:
                    $('#nivelriesgo_pre').text('Media');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case 18:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case 27:
                    $('#nivelriesgo_pre').text('Muy alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case 36:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case 54:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                case 81:
                    $('#nivelriesgo_pre').text('Muy Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                default:
                    alert("try again");
                    break;
            }
        });
    </script>

    <script type=text/javascript>
        $('#probabilidad_residual').change(function() {
            var impactoID_residual = document.getElementById("impacto_residual").value;
            let probabilidadID_residual = $(this).val();
            //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
            let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
            $("#nivelriesgo_residual").attr("value", result1);
            switch (result1) {
                case 0:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-success');
                    break;
                case 9:
                    $('#nivelriesgo_residual_pre').text('Medio');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case 18:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case 27:
                    $('#nivelriesgo_residual_pre').text('Muy alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case 36:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case 54:
                    $('#nivelriesgo_residual_pre').text('Muy Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                case 81:
                    $('#nivelriesgo_residual_pre').text('Muy Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                default:
                    alert("try again");
                    break;
            }
        });

        $('#impacto_residual').change(function() {
            var probabilidadID_residual = document.getElementById("probabilidad_residual").value;
            let impactoID_residual = $(this).val();
            let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
            //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
            $("#nivelriesgo_residual").attr("value", result1);
            switch (result1) {
                case 0:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-success');
                    break;
                case 9:
                    $('#nivelriesgo_residual_pre').text('Medio');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case 18:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case 27:
                    $('#nivelriesgo_residual_pre').text('Muy alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case 36:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case 54:
                    $('#nivelriesgo_residual_pre').text('Muy Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                case 81:
                    $('#nivelriesgo_residual_pre').text('Muy Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').addClass('text-danger');
                    break;
                default:
                    alert("try again");
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

    {{-- <script>
        var numero1 = document.getElementById("numero1").value;
        var numero2 = document.getElementById("numero2").value;

        var suma = numero1 + numero2;

        document.writeln(suma);
    </script> --}}

    <script>
        $(document).ready(function() {
            const activosmatriz31000 = @json($activosmatriz31000);
            const amenazas = @json($amenazas);
            const vulnerabilidades = @json($vulnerabilidades);
            let count = 0;
            console.log(activosmatriz31000.activos_informacion);
            if (activosmatriz31000.activos_informacion != undefined) {
                if (activosmatriz31000.activos_informacion.length > 0) {
                    console.log(activosmatriz31000);
                    activosmatriz31000.activos_informacion.forEach((item, index) => {
                        let formulario = {
                            id: item.id,
                            activosAsociados: item.activos_asociados,
                            contenedorActivoOpcion: item.contenedor_activos,
                            amenazasInformacion: item.id_amenaza,
                            vulnerabilidadesInformacion: item.id_vulnerabilidad,
                            confidencialidadActivo: item.confidencialidad,
                            escenarioRiesgo: item.escenario_riesgo,
                            disponibilidadInformacion: item.disponibilidad,
                            integridadInformacion: item.integridad,
                            evaluacionRiesgo: item.evaluación_riesgo,
                        }
                        agregarFilaActivosInfo(index, formulario);
                    });
                    count = activosmatriz31000.activos_informacion.length;
                }
            }

            function agregarFilaActivosInfo(contador, formulario) {
                console.log(formulario)
                const contenedorActivosInfo = document.getElementById('contenedor_informacion');
                let html =
                    `
          <tr>
            <td><input type="hidden" name="activosmatriz31000[${contador}][id]" value="${formulario.id?formulario.id:0}"><input class="form-control" type="text"  name="activosmatriz31000[${contador}][activos_asociados]" value="${formulario.activosAsociados}"></td>
            <td class="col-4"><select class="form-control" name="activosmatriz31000[${contador}][contenedor_activos]" value="${formulario.contenedorActivoOpcion}"><option value="">Seleccione una opción</option>
            <option  ${formulario.contenedorActivoOpcion == "1" ? "selected":''} value="1" >Soluciones Cloud (Google Workspace-Azure)</option>
            <option  ${formulario.contenedorActivoOpcion == "2" ? "selected":''} value="2" >Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)</option>
            <option  ${formulario.contenedorActivoOpcion == "3" ? "selected":''} value="3">Base de Datos</option>
            <option  ${formulario.contenedorActivoOpcion == "4" ? "selected":''} value="4">Servidores</option>
            <option  ${formulario.contenedorActivoOpcion == "5" ? "selected":''} value="5">Aplicaciones Internas (Meltsan-Astro)</option>
            <option  ${formulario.contenedorActivoOpcion == "6" ? "selected":''} value="6">Aplicaciones Externas (CRM)</option>
            </select></td>
            <td><select class="form-control" value="${formulario.amenazasInformacion}" name="activosmatriz31000[${contador}][id_amenaza]">`
                amenazas.forEach(amenaza => {
                    html +=
                        `<option value="${amenaza.id}" ${formulario.amenazasInformacion ==  amenaza.id ? "selected":''} >${amenaza.nombre}</option>`
                })
                html +=
                    `</select>
            </td>
            <td><select class="form-control" value="${formulario.vulnerabilidadesInformacion}" name="activosmatriz31000[${contador}][id_vulnerabilidad]">`
                vulnerabilidades.forEach(vulnerabilidad => {
                    html +=
                        `<option value="${vulnerabilidad.id}" ${formulario.vulnerabilidadesInformacion ==  vulnerabilidad.id ? "selected":''} >${vulnerabilidad.nombre}</option>`
                })
                html += `</select>
            </td>
            <td><textarea class="form-control" type="text"  name="activosmatriz31000[${contador}][escenario_riesgo]">${formulario.escenarioRiesgo}</textarea></td>
            <td><select class="form-control" select2 name="activosmatriz31000[${contador}][confidencialidad]" value="${formulario.confidencialidadInformacion}" data-evaluacion-escenario="1" data-contador="${contador}">
            <option  ${formulario.confidencialidadActivo == "0" ? "selected":''} value="0" >0</option>
            <option  ${formulario.confidencialidadActivo == "1" ? "selected":''} value="1" >1</option>
            <option  ${formulario.confidencialidadActivo == "2" ? "selected":''} value="2">2</option>
            <option  ${formulario.confidencialidadActivo == "3" ? "selected":''} value="3">3</option>
            <option  ${formulario.confidencialidadActivo == "4" ? "selected":''} value="4">4</option>
            <option  ${formulario.confidencialidadActivo == "5" ? "selected":''} value="5">5</option>
            </select>
            </td>
            <td><select class="form-control"  select2  name="activosmatriz31000[${contador}][disponibilidad]" data-evaluacion-escenario="1" data-contador="${contador}"><option  ${formulario.disponibilidadInformacion == "0" ? "selected":''} value="0" >0</option>
            <option  ${formulario.disponibilidadInformacion == "1" ? "selected":''} value="1" >1</option>
            <option  ${formulario.disponibilidadInformacion == "2" ? "selected":''} value="2" >2</option>
            <option  ${formulario.disponibilidadInformacion == "3" ? "selected":''} value="3">3</option>
            <option  ${formulario.disponibilidadInformacion == "4" ? "selected":''} value="4">4</option>
            <option  ${formulario.disponibilidadInformacion == "5" ? "selected":''} value="5">5</option>
            </select>
            </td>
            <td><select class="form-control"  select2  name="activosmatriz31000[${contador}][integridad]" data-evaluacion-escenario="1" data-contador="${contador}"><option  ${formulario.integridadInformacion == "0" ? "selected":''} value="0" >0</option>
            <option  ${formulario.integridadInformacion == "1" ? "selected":''} value="1" >1</option>
            <option  ${formulario.integridadInformacion == "2" ? "selected":''} value="2" >2</option>
            <option  ${formulario.integridadInformacion == "3" ? "selected":''} value="3">3</option>
            <option  ${formulario.integridadInformacion == "4" ? "selected":''} value="4">4</option>
            <option  ${formulario.integridadInformacion == "5" ? "selected":''} value="5">5</option>
            </select>
            </td>
            <td><input class="form-control evaluacion_riesgo" type="text" name="activosmatriz31000[${contador}][evaluacion_riesgo]" data-contador="${contador}" value="${formulario.evaluacionRiesgo}"></td>
            <td><button type="button" name="btn-remove-activos" id="" class="btn btn-danger remove btn-remove-activos" data-delete-back="${formulario.id?formulario.id:0}">Eliminar</button></td>
         </tr>
          `
                contenedorActivosInfo.innerHTML += html;
                limpiarFormulario();


            }


            function limpiarFormulario() {
                const activosAsociados = document.getElementById('activos_asociados_informacion').value = null;
                const ccontenedorActivoOpcion = document.getElementById('contenedor_activo_informacion').value =
                    null;
                const amenazasInformacion = document.getElementById('amenaza_informacion').value = null;
                const vulnerabilidadesInformacion = document.getElementById('vulnerabilidad_informacion').value =
                    null;
                const confidencialidadActivo = document.getElementById('confidencialidad_informacion').value = null;
                const escenarioRiesgo = document.getElementById('escenario_riesgo_informacion').value = null;
                const disponibilidadInformacion = document.getElementById('disponibilidad_informacion').value =
                    null;
                const integridadInformacion = document.getElementById('integridad_informacion').value = null;
                const evaluacionRiesgo = document.getElementById('evaluación_riesgo_informacion').value = null;
                $('#confidencialidad_informacion').val('0').trigger('change');
                $('#disponibilidad_informacion').val('0').trigger('change');
                $('#integridad_informacion').val('0').trigger('change');
            }

            function limpiarErrores() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }


            $(document).on("click", "#btn-suscribir-activos_info", function() {
                limpiarErrores()
                const activosAsociados = document.getElementById('activos_asociados_informacion').value;
                const contenedorActivoOpcion = document.getElementById('contenedor_activo_informacion')
                    .value;
                const amenazasInformacion = document.getElementById('amenaza_informacion').value;
                const vulnerabilidadesInformacion = document.getElementById('vulnerabilidad_informacion')
                    .value;
                const confidencialidadActivo = document.getElementById('confidencialidad_informacion')
                    .value;
                const escenarioRiesgo = document.getElementById('escenario_riesgo_informacion').value;
                const disponibilidadInformacion = document.getElementById('disponibilidad_informacion')
                    .value;
                const integridadInformacion = document.getElementById('integridad_informacion').value;
                const evaluacionRiesgo = document.getElementById('evaluación_riesgo_informacion').value;

                if (activosAsociados == "" || contenedorActivoOpcion == "" || amenazasInformacion == "" ||
                    vulnerabilidadesInformacion == "" || confidencialidadActivo == "" || escenarioRiesgo ==
                    "" ||
                    disponibilidadInformacion == "" || integridadInformacion == "" || evaluacionRiesgo == ""
                ) {
                    if (activosAsociados == "") {
                        document.querySelector('.activos_asociados_error').innerText =
                            "Debes agregar un activo asociado ";
                    }
                    if (contenedorActivoOpcion == "") {
                        document.querySelector('.contenedor_activo_error').innerText =
                            "Debes seleccionar una opción";
                    }
                    if (amenazasInformacion == "") {
                        document.querySelector('.amenaza_error').innerText =
                            "Debes seleccionar una amenaza";
                    }
                    if (vulnerabilidadesInformacion == "") {
                        document.querySelector('.vulnerabilidad_error').innerText =
                            "Selecciona una vulnerabilidad";
                    }
                    if (confidencialidadActivo == "") {
                        document.querySelector('.confidencialidad_error').innerText =
                            "Selecciona confidencialidad ";
                    }
                    if (escenarioRiesgo == "") {
                        document.querySelector('.escenario_riesgo_error').innerText =
                            "Debes agregar un escenario de riesgo";
                    }
                    if (disponibilidadInformacion == "") {
                        document.querySelector('.disponibilidad_error').innerText =
                            "Debes seleccionar disponibilidad";
                    }
                    if (integridadInformacion == "") {
                        document.querySelector('.integridad_error').innerText =
                            "Debes seleccionar integridad";
                    }
                    if (evaluacionRiesgo == "") {
                        document.querySelector('.evaluacion_riesgo_error').innerText =
                            "Debes agregar evaluación";
                    }

                } else {
                    let formulario = {
                        activosAsociados,
                        contenedorActivoOpcion,
                        amenazasInformacion,
                        vulnerabilidadesInformacion,
                        confidencialidadActivo,
                        escenarioRiesgo,
                        disponibilidadInformacion,
                        integridadInformacion,
                        evaluacionRiesgo,
                    }


                    agregarFilaActivosInfo(count, formulario);
                    count++;
                }

            });


            $(document).on("click", ".btn-remove-activos", function() {
                let fila = this;
                if (this.getAttribute('data-delete-back') > 0) {
                    Swal.fire({
                        title: '¿Quieres eliminar esta fila?',
                        text: "¡No puedes revertir esto!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Conservar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                url: "{{ route('admin.matriz-seguridad.ISO31000.activo.delete') }}",
                                data: {
                                    id: this.getAttribute('data-delete-back')
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    toastr.success('Se ha eliminado el activo');
                                    $(fila).closest("tr").remove();
                                    count--;
                                }
                            });
                        }
                    })
                } else {
                    $(this).closest("tr").remove();
                    count--;
                }
            });


        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#selectValorCritico', function(event) {
            let optionSelected = $('#selectValorCritico option:selected').val();
            // console.log(optionSelected);
            $('#selectValorCritico').removeClass('bajo');
            $('#selectValorCritico').removeClass('medio');
            $('#selectValorCritico').removeClass('alto');
            $('#selectValorCritico').removeClass('critico');
            $('#selectValorCritico').addClass(optionSelected);

        });
        Livewire.on('impactoObtenido31', impacto => {
            console.log(impacto);
            document.querySelectorAll('.evaluacion_riesgo').forEach(el => {
                let contador = el.getAttribute('data-contador');
                let confidencialidad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][confidencialidad]"]`).value
                let disponibilidad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][disponibilidad]"]`).value
                let integridad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][integridad]"]`).value
                el.value = (Number(confidencialidad) + Number(disponibilidad) + Number(integridad)) *
                    impacto;
            });
        })
        document.getElementById('activos_info_table').addEventListener('change', (e) => {
            if (e.target.getAttribute('data-evaluacion-escenario') == 1) {
                let impacto = Number(document.getElementById("valor").value);
                let contador = e.target.getAttribute('data-contador');
                let confidencialidad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][confidencialidad]"]`).value
                let disponibilidad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][disponibilidad]"]`).value
                let integridad = document.querySelector(
                    `[name="activosmatriz31000[${contador}][integridad]"]`).value
                let evaluacionRiesgo = document.querySelector(
                        `[name="activosmatriz31000[${contador}][evaluacion_riesgo]"]`).value = (Number(
                        confidencialidad) + Number(disponibilidad) + Number(integridad)) *
                    impacto;
            }
        })
    </script>
@endsection
