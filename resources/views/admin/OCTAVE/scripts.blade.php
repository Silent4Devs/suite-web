<style>
    .bajo {
        color: #fff !important;
        background-color: rgb(50, 205, 63) !important;
        /* position:relative; */
    }

    .bajo::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63) !important;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .medio {
        color: #000 !important;
        background-color: yellow !important;

    }

    .alto {
        color: #fff !important;
        background-color: rgb(255, 136, 0) !important;

    }

    .critico {
        color: #fff !important;
        background-color: red !important;
    }

    #selectValorCritico {

        color: #000 !important;
    }

    /* .muybajo{

        background-color:red !important;

        } */

</style>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let custodio = document.querySelector('#dueno_informacion');
            let area_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
            let puesto_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');

            document.getElementById('dueno_id_puesto').innerHTML = puesto_init;
            document.getElementById('dueno_id_area').innerHTML = area_init;
            custodio.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                console.log(area);
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('dueno_id_puesto').innerHTML = puesto;
                document.getElementById('dueno_id_area').innerHTML = area;
            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            let custodio = document.querySelector('#custodio_informacion');
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
    </script>

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

    <script>
        $(document).ready(function() {
            const custodios = @json($custodios);
            const duenos = @json($duenos);
            const amenazas = @json($amenazas);
            const vulnerabilidades = @json($vulnerabilidades);
            const activosoctave = @json($activosoctave);
            const matrizActivosOctave = @json($matrizOctave);
            let count = 0;
            if (matrizActivosOctave.matriz_activos) {
                matrizActivosOctave.matriz_activos.forEach((item, index) => {
                    let formulario = {
                        id: item.id,
                        activosAi: item.nombre_ai,
                        valorCriticoInformacion: item.valor_criticidad,
                        duenoActivo: item.id_dueno,
                        custodioActivo: item.id_custodio,
                        contenedorActivo: item.contenedor_activos,
                        escenarioRiesgo: item.escenario_riesgo,
                        amenazasInformacion: item.id_amenaza,
                        vulnerabilidadesInformacion: item.id_vulnerabilidad,
                        confidencialidadInformacion: item.confidencialidad,
                        disponibilidadInformacion: item.disponibilidad,
                        integridadInformacion: item.integridad,
                        evaluacionRiesgo: item.evaluacion_riesgo,
                    }
                    agregarFilaActivosInfo(index, formulario);
                });
                count = matrizActivosOctave.matriz_activos.length;
            }
            //   renderizarTablaResponsabilidades(count);

            function agregarFilaActivosInfo(contador, formulario) {
                const contenedorActivosInfo = document.getElementById('contenedor_informacion');
                let html =
                    `
                        <tr>
                            <td><input type="hidden" name="activosoctave[${contador}][id]" value="${formulario.id?formulario.id:0}"><input class="form-control" type="text"  name="activosoctave[${contador}][nombre_ai]" value="${formulario.activosAi}"></td>
                            <td class="col-4"><select id="selectValorCritico" class="form-control select2" name="activosoctave[${contador}][valor_criticidad]" value="${formulario.valorCriticoInformacion}"><option style="background-color:#fff !important; color:#000 !important;" value="">Seleccione una opción</option>
                            <option style="background-color:rgb(50, 205, 63)" ${formulario.valorCriticoInformacion == "1" ? "selected":''} value="1">Muy Bajo</option>
                            <option style="background-color:rgb(50, 205, 63)" ${formulario.valorCriticoInformacion == "2" ? "selected":''} value="2" >Bajo</option>
                            <option style="background-color:yellow;" ${formulario.valorCriticoInformacion == "3" ? "selected":''} value="3">Medio</option>
                            <option style="background-color:rgb(255, 136, 0);" ${formulario.valorCriticoInformacion == "4" ? "selected":''} value="4">Alto</option>
                            <option style="background-color:red;" ${formulario.valorCriticoInformacion == "5" ? "selected":''} value="5">Critico</option>
                            </select></td>
                            <td><select class="form-control" value="${formulario.duenoActivo}" name="activosoctave[${contador}][id_dueno]">`
                duenos.forEach(dueno => {
                    html +=
                        `<option data-puesto="${dueno.name}" data-contact="${formulario.id}" value="${dueno.id}" ${formulario.duenoActivo ==  dueno.id ? "selected":''} >${dueno.name}</option>`
                })
                html +=
                    `</select>
                                        </td >
                                        <td><select class="form-control" value="${formulario.custodioActivo}" name="activosoctave[${contador}][id_custodio]">`
                custodios.forEach(custodio => {
                    html +=
                        `<option data-puesto="${custodio.name}" data-contact="${formulario.id}" value="${custodio.id}" ${formulario.custodioActivo ==  custodio.id ? "selected":''} >${custodio.name}</option>`
                })
                html +=
                    `</select>
                            </td >
                            <td class="col-4"><select class="form-control" name="activosoctave[${contador}][contenedor_activos]" value="${formulario.contenedorActivo}"><option value="">Seleccione una opción</option>
                            <option  ${formulario.contenedorActivo == "Soluciones Cloud (Google Workspace-Azure)" ? "selected":''} value="Soluciones Cloud (Google Workspace-Azure)" >Soluciones Cloud (Google Workspace-Azure)</option>
                            <option  ${formulario.contenedorActivo == "Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)" ? "selected":''} value="Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)" >Soluciones Corporativas (Equipo de Cómputo-IPAD-Disco Externo-Gavetas)</option>
                            <option  ${formulario.contenedorActivo == "Base de Datos" ? "selected":''} value="Base de Datos">Base de Datos</option>
                            <option  ${formulario.contenedorActivo == "Servidores" ? "selected":''} value="Servidores">Servidores</option>
                            <option  ${formulario.contenedorActivo == "Aplicaciones Internas (Meltsan-Astro)" ? "selected":''} value="Aplicaciones Internas (Meltsan-Astro)">Aplicaciones Internas (Meltsan-Astro)</option>
                            <option  ${formulario.contenedorActivo == "Aplicaciones Externas (CRM)" ? "selected":''} value="Aplicaciones Externas (CRM)">Aplicaciones Externas (CRM)</option>
                            </select></td>
                            <td><textarea class="form-control" type="text"  name="activosoctave[${contador}][escenario_riesgo]">${formulario.escenarioRiesgo}</textarea></td>
                            <td><select class="form-control" value="${formulario.amenazasInformacion}" name="activosoctave[${contador}][id_amenaza]">`
                amenazas.forEach(amenaza => {
                    html +=
                        `<option value="${amenaza.id}" ${formulario.amenazasInformacion ==  amenaza.id ? "selected":''} >${amenaza.nombre}</option>`
                })
                html +=
                    `</select>
                                        </td>
                                        <td><select class="form-control" value="${formulario.vulnerabilidadesInformacion}" name="activosoctave[${contador}][id_vulnerabilidad]">`
                vulnerabilidades.forEach(vulnerabilidad => {
                    html +=
                        `<option value="${vulnerabilidad.id}" ${formulario.vulnerabilidadesInformacion ==  vulnerabilidad.id ? "selected":''} >${vulnerabilidad.nombre}</option>`
                })
                html += `</select>
                            </td>
                            <td><select class="form-control" select2 name="activosoctave[${contador}][confidencialidad]" value="${formulario.confidencialidadInformacion}" data-evaluacion-escenario="1" data-contador="${contador}">
                            <option  ${formulario.confidencialidadInformacion == "0" ? "selected":''} value="0" >0</option>
                            <option  ${formulario.confidencialidadInformacion == "1" ? "selected":''} value="1" >1</option>
                            <option  ${formulario.confidencialidadInformacion == "2" ? "selected":''} value="2">2</option>
                            <option  ${formulario.confidencialidadInformacion == "3" ? "selected":''} value="3">3</option>
                            <option  ${formulario.confidencialidadInformacion == "4" ? "selected":''} value="4">4</option>
                            <option  ${formulario.confidencialidadInformacion == "5" ? "selected":''} value="5">5</option>
                            </select>
                            </td>
                            <td><select class="form-control"  select2  name="activosoctave[${contador}][disponibilidad]" value="${formulario.disponibilidadInformacion}" data-evaluacion-escenario="1" data-contador="${contador}">
                            <option  ${formulario.disponibilidadInformacion == "0" ? "selected":''} value="0" >0</option>
                            <option  ${formulario.disponibilidadInformacion == "1" ? "selected":''} value="1" >1</option>
                            <option  ${formulario.disponibilidadInformacion == "2" ? "selected":''} value="2" >2</option>
                            <option  ${formulario.disponibilidadInformacion == "3" ? "selected":''} value="3">3</option>
                            <option  ${formulario.disponibilidadInformacion == "4" ? "selected":''} value="4">4</option>
                            <option  ${formulario.disponibilidadInformacion == "5" ? "selected":''} value="5">5</option>
                            </select>
                            </td>
                            <td><select class="form-control"  select2  name="activosoctave[${contador}][integridad]" value="${formulario.integridadInformacion}" data-evaluacion-escenario="1" data-contador="${contador}">
                            <option  ${formulario.integridadInformacion == "0" ? "selected":''} value="0" >0</option>
                            <option  ${formulario.integridadInformacion == "1" ? "selected":''} value="1" >1</option>
                            <option  ${formulario.integridadInformacion == "2" ? "selected":''} value="2" >2</option>
                            <option  ${formulario.integridadInformacion == "3" ? "selected":''} value="3">3</option>
                            <option  ${formulario.integridadInformacion == "4" ? "selected":''} value="4">4</option>
                            <option  ${formulario.integridadInformacion == "5" ? "selected":''} value="5">5</option>
                            </select>
                            </td>
                            <td><input class="form-control evaluacion_riesgo" type="text" name="activosoctave[${contador}][evaluacion_riesgo]" value="${formulario.evaluacionRiesgo}" readonly data-contador="${contador}"></td>
                            <td><button type="button" name="btn-remove-activos" id="" class="btn btn-danger remove btn-remove-activos" data-delete-back="${formulario.id?formulario.id:0}">Eliminar</button></td>
                        </tr>
                    `
                $("#contenedor_informacion").append(html);
                // contenedorActivosInfo.innerHTML += html;
                limpiarFormulario();


            }


            function limpiarFormulario() {
                const activosAi = document.getElementById('nombre_ai_informacion').value = null;
                const valorCriticoInformacion = document.getElementById('criticidad_informacion').value = null;
                const duenoActivo = document.getElementById('dueno_informacion').value = null;
                const duenoPuesto = document.getElementById('dueno_id_puesto').innerHTML = null;
                const duenoArea = document.getElementById('dueno_id_area').innerHTML = null;
                const custodioActivo = document.getElementById('custodio_informacion').value = null;
                const custodioPuestoActivo = document.getElementById('id_custodio_puesto').innerHTML = null;
                const custodioAreaActivo = document.getElementById('id_custodio_area').innerHTML = null;
                const contenedorActivo = document.getElementById('contenedor_activos_informacion').value = null;
                const escenarioRiesgo = document.getElementById('escenario_riesgo_informacion').value = null;
                const amenazasInformacion = document.getElementById('amenaza_informacion').value = null;
                const vulnerabilidadesInformacion = document.getElementById('vulnerabilidad_informacion').value =
                    null;
                const confidencialidadInformacion = document.getElementById('confidencialidad_informacion').value =
                    null;
                const disponibilidadInformacion = document.getElementById('disponibilidad_informacion').value =
                    null;
                const integridadInformacion = document.getElementById('integridad_informacion').value = null;
                const evaluacionRiesgo = document.getElementById('evaluacion_informacion').value = null;
                $('#criticidad_informacion').val('').trigger('change');
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
                const activosAi = document.getElementById('nombre_ai_informacion').value;
                const valorCriticoInformacion = document.getElementById('criticidad_informacion').value;
                const duenoActivo = document.getElementById('dueno_informacion').value;
                const custodioActivo = document.getElementById('custodio_informacion').value;
                const contenedorActivo = document.getElementById('contenedor_activos_informacion').value;
                const escenarioRiesgo = document.getElementById('escenario_riesgo_informacion').value;
                const amenazasInformacion = document.getElementById('amenaza_informacion').value;
                const vulnerabilidadesInformacion = document.getElementById('vulnerabilidad_informacion')
                    .value;
                const confidencialidadInformacion = document.getElementById('confidencialidad_informacion')
                    .value;
                const disponibilidadInformacion = document.getElementById('disponibilidad_informacion')
                    .value;
                const integridadInformacion = document.getElementById('integridad_informacion').value;
                const evaluacionRiesgo = document.getElementById('evaluacion_informacion').value;

                if (activosAi == "" || valorCriticoInformacion == "" || duenoActivo == "" ||
                    custodioActivo == "" || contenedorActivo == "" || escenarioRiesgo == "" ||
                    amenazasInformacion == "" || vulnerabilidadesInformacion == "" ||
                    confidencialidadInformacion == "" || disponibilidadInformacion == "" ||
                    integridadInformacion == "" || evaluacionRiesgo == "") {
                    if (activosAi == "") {
                        document.querySelector('.nombre_ai_error').innerText =
                            "Debes agregar nombre del AI";
                    }
                    if (valorCriticoInformacion == "") {
                        document.querySelector('.valor_critico_error').innerText =
                            "Debes agregar valor";
                    }
                    if (duenoActivo == "") {
                        document.querySelector('.dueno_error').innerText =
                            "Selecciona al dueño";
                    }
                    if (custodioActivo == "") {
                        document.querySelector('.custodio_error').innerText =
                            "Selecciona al custodio";
                    }
                    if (contenedorActivo == "") {
                        document.querySelector('.contenedor_activo_error').innerText =
                            "Selecciona un opción del contenedor ";
                    }
                    if (escenarioRiesgo == "") {
                        document.querySelector('.escenario_riesgo_error').innerText =
                            "Debes agregar un escenario de riesgo";
                    }
                    if (amenazasInformacion == "") {
                        document.querySelector('.amenaza_error').innerText =
                            "Debes seleccionar una amenaza";
                    }
                    if (vulnerabilidadesInformacion == "") {
                        document.querySelector('.vulnerabilidad_error').innerText =
                            "Debes seleccionar una vulnerabilidad";
                    }
                    if (confidencialidadInformacion == "") {
                        document.querySelector('.confidencialidad_error').innerText =
                            "Debes agregar confidencialidad";
                    }
                    if (disponibilidadInformacion == "") {
                        document.querySelector('.disponibilidad_error').innerText =
                            "Debes agregar disponibilidad";
                    }
                    if (integridadInformacion == "") {
                        document.querySelector('.integridad_error').innerText =
                            "Debes agregar integridad";
                    }
                    if (evaluacionRiesgo == "") {
                        document.querySelector('.evaluacion_riesgo_error').innerText =
                            "Debes agregar evaluación";
                    }

                } else {
                    let formulario = {
                        activosAi,
                        valorCriticoInformacion,
                        duenoActivo,
                        custodioActivo,
                        contenedorActivo,
                        escenarioRiesgo,
                        amenazasInformacion,
                        vulnerabilidadesInformacion,
                        confidencialidadInformacion,
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
                                url: "{{ route('admin.matriz-riesgo.octave.activo.delete') }}",
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
        Livewire.on('impactoObtenido', impacto => {
            document.querySelectorAll('.evaluacion_riesgo').forEach(el => {
                let contador = el.getAttribute('data-contador');
                let confidencialidad = document.querySelector(
                    `[name="activosoctave[${contador}][confidencialidad]"]`).value
                let disponibilidad = document.querySelector(
                    `[name="activosoctave[${contador}][disponibilidad]"]`).value
                let integridad = document.querySelector(
                    `[name="activosoctave[${contador}][integridad]"]`).value
                el.value = (Number(confidencialidad) + Number(disponibilidad) + Number(integridad)) *
                    impacto;
            });
        })
        document.getElementById('activos_info_table').addEventListener('change', (e) => {
            if (e.target.getAttribute('data-evaluacion-escenario') == 1) {
                let impacto = Number(document.getElementById("valorImpacto").value);
                let contador = e.target.getAttribute('data-contador');
                let confidencialidad = document.querySelector(
                    `[name="activosoctave[${contador}][confidencialidad]"]`).value
                let disponibilidad = document.querySelector(
                    `[name="activosoctave[${contador}][disponibilidad]"]`).value
                let integridad = document.querySelector(
                    `[name="activosoctave[${contador}][integridad]"]`).value
                let evaluacionRiesgo = document.querySelector(
                        `[name="activosoctave[${contador}][evaluacion_riesgo]"]`).value = (Number(
                        confidencialidad) + Number(disponibilidad) + Number(integridad)) *
                    impacto;
            }
        })
    </script>


    <script type=text/javascript>
        document.getElementById('nombre_ai_informacion').addEventListener('change',(e)=>{
            let dueno_nombre = e.target.options[e.target.selectedIndex].getAttribute('data-dueno');
            let dueno_puesto = e.target.options[e.target.selectedIndex].getAttribute('data-dueno-puesto');
            let dueno_area = e.target.options[e.target.selectedIndex].getAttribute('data-dueno-area');
            let dueno_informacion = document.getElementById('dueno_informacion');
            let dueno_id_puesto = document.getElementById('dueno_id_puesto');
            let dueno_id_area = document.getElementById('dueno_id_area');
            dueno_informacion.innerHTML = dueno_nombre;
            dueno_id_puesto.innerHTML = dueno_puesto;
            dueno_id_area.innerHTML = dueno_area;

            let custodio_nombre = e.target.options[e.target.selectedIndex].getAttribute('data-custodio');
            let custodio_puesto = e.target.options[e.target.selectedIndex].getAttribute('data-custodio-puesto');
            let custodio_area = e.target.options[e.target.selectedIndex].getAttribute('data-custodio-area');
            let custodio_informacion = document.getElementById('custodio_informacion');
            let id_custodio_puesto = document.getElementById('id_custodio_puesto');
            let id_custodio_area = document.getElementById('id_custodio_area');
            custodio_informacion.innerHTML = custodio_nombre;
            id_custodio_puesto.innerHTML = custodio_puesto;
            id_custodio_area.innerHTML = custodio_area;


        });

    </script>


@endsection
