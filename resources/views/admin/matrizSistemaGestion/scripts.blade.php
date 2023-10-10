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
        });

        function recortarTexto(texto, length = 30) {
            let trimmedString = texto?.length > length ?
                texto.substring(0, length - 3) + "..." :
                texto;
            return trimmedString;
        }

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
        $('.sumaFactores').change(function() {
            var riesgo = document.getElementById("nivelriesgo").value;
            var estrategia = document.getElementById("estrategia_negocio").value;
            var calidad = document.getElementById("calidad_servicio").value;
            var cliente = document.getElementById("cliente").value;
            var disponibilidad2000 = document.getElementById("disponibilidad_2000").value;
            var niveles = document.getElementById("niveles_servicio").value;
            var continuidad = document.getElementById("continuidad_BCP").value;
            var confidencialidad = document.getElementById("confidencialidad_270000").value;
            var integridad = document.getElementById("integridad_27000").value;
            var disponibilidad27000 = document.getElementById("disponibilidad_27000").value;
            let result = Number(estrategia) + Number(calidad) + Number(cliente) + Number(disponibilidad2000) +
                Number(niveles) + Number(continuidad) + Number(confidencialidad) + Number(integridad) + Number(
                    disponibilidad27000);
           console.log(result);
            $("#resultado_ponderacion").attr("value", Math.round(result * 10)/10);

            let RiesgoTotal = Number(riesgo) + Number(result);
            $("#riesgo_total").attr("value", Math.round(RiesgoTotal * 10)/10);
            switch (true) {
                case RiesgoTotal >= 0 && RiesgoTotal <= 45:
                    $('#nivelriesgo_pre').text('Bajo');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-success');
                    break;
                case RiesgoTotal >= 46 && RiesgoTotal <= 90:
                    $('#nivelriesgo_pre').text('Medio');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-yellow');
                    break;
                case RiesgoTotal >= 91 && RiesgoTotal <= 135:
                    $('#nivelriesgo_pre').text('Alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-orange");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-orange');
                    break;
                case RiesgoTotal >= 136 && RiesgoTotal <= 185:
                    $('#nivelriesgo_pre').text('Muy alto');
                    $('#nivelriesgo_pre').removeClass("text-dark");
                    $('#nivelriesgo_pre').removeClass("text-yellow");
                    $('#nivelriesgo_pre').removeClass("text-success");
                    $('#nivelriesgo_pre').removeClass("text-danger");
                    $('#nivelriesgo_pre').addClass('text-danger');
                    break;
                default:
                    alert("Rango no encontrado, ¡Intentalo de nuevo!");
                    break;
            }
        });

        $('#tipo_riesgo').change(function(e) {
            let tipoRiesgo = this.value;
            let nivelRiesgo = document.getElementById("nivelriesgo");
            let nivelRiesgoPre = document.getElementById("nivelriesgo_pre");
            let probabilidad = document.getElementById("probabilidad");
            let riesgo = document.getElementById("impacto");

            let HTMLProbabilidad = "";
            let HTMLRiesgo = "";

            let nivelRiesgoRes = document.getElementById("nivelriesgo_residual");
            let nivelRiesgoPreRes = document.getElementById("nivelriesgo_residual_pre");
            let probabilidadRes = document.getElementById("probabilidad_residual");
            let riesgoRes = document.getElementById("impacto_residual");

            let HTMLProbabilidadRes = "";
            let HTMLRiesgoRes = "";

            if (Number(tipoRiesgo) == 0) {
                HTMLProbabilidad = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="9">ALTA (9)</option>
            <option value="6">MEDIA (6)</option>
            <option value="3">BAJA (3)</option>
            <option value="0">NULA (0)</option>
           `
                HTMLRiesgo = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="9">MUY ALTO (9)</option>
            <option value="6">ALTO (6)</option>
            <option value="3">MEDIO (3)</option>
            <option value="0">BAJO (0)</option>
           `
                HTMLProbabilidadRes = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="9">ALTA (9)</option>
            <option value="6">MEDIA (6)</option>
            <option value="3">BAJA (3)</option>
            <option value="0">NULA (0)</option>
           `
                HTMLRiesgoRes = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="9">MUY ALTO (9)</option>
            <option value="6">ALTO (6)</option>
            <option value="3">MEDIO (3)</option>
            <option value="0">BAJO (0)</option>
           `
            } else {
                HTMLProbabilidad = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="0">ALTA (0)</option>
            <option value="3">MEDIA (3)</option>
            <option value="6">BAJA (6)</option>
            <option value="9">NULA (9)</option>
           `
                HTMLRiesgo = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="0">MUY ALTO (0)</option>
            <option value="3">ALTO (3)</option>
            <option value="6">MEDIO (6)</option>
            <option value="9">BAJO (9)</option>
           `
                HTMLProbabilidadRes = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="0">ALTA (0)</option>
            <option value="3">MEDIA (3)</option>
            <option value="6">BAJA (6)</option>
            <option value="9">NULA (9)</option>
           `
                HTMLRiesgoRes = `
            <option value="" disabled="" selected="">Selecciona una opción</option>
            <option value="0">MUY ALTO (0)</option>
            <option value="3">ALTO (3)</option>
            <option value="6">MEDIO (6)</option>
            <option value="9">BAJO (9)</option>
           `
            }
            $("#nivelriesgo").attr("value", 0);
            $("#riesgo_total").attr("value", 0);
            $("#riesgo_residual").attr("value", 0);
            nivelRiesgoPre.innerHTML = null;
            probabilidad.innerHTML = HTMLProbabilidad;
            riesgo.innerHTML = HTMLRiesgo;

            $("#nivelriesgo_residual").attr("value", 0);
            nivelRiesgoPreRes.innerHTML = null;
            probabilidadRes.innerHTML = HTMLProbabilidadRes;
            riesgoRes.innerHTML = HTMLRiesgoRes;

        });
        $('.sumaFactoresResiduales').change(function() {
            var riesgo = document.getElementById("nivelriesgo_residual").value;
            var estrategia = document.getElementById("estrategia_negocioRes").value;
            var calidad = document.getElementById("calidad_servicioRes").value;
            var cliente = document.getElementById("clienteRes").value;
            var disponibilidad2000 = document.getElementById("disponibilidad_2000Res").value;
            var niveles = document.getElementById("niveles_servicioRes").value;
            var continuidad = document.getElementById("continuidad_BCPRes").value;
            var confidencialidad = document.getElementById("confidencialidad_270000Res").value;
            var integridad = document.getElementById("integridad_27000Res").value;
            var disponibilidad27000 = document.getElementById("disponibilidad_27000Res").value;
            let result = Number(estrategia) + Number(calidad) + Number(cliente) + Number(disponibilidad2000) +
                Number(niveles) + Number(continuidad) + Number(confidencialidad) + Number(integridad) + Number(
                    disponibilidad27000);
            $("#resultado_ponderacionRes").attr("value", Math.round(result* 10)/10);
            let RiesgoTotal = Number(riesgo) + Number(result);
            $("#riesgo_residual").attr("value",  Math.round(RiesgoTotal * 10)/10);
            switch (true) {
                case RiesgoTotal >= 0 && RiesgoTotal <= 45:
                    $('#nivelriesgo_residual_pre').text('Bajo');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-success');
                    break;
                case RiesgoTotal >= 46 && RiesgoTotal <= 90:
                    $('#nivelriesgo_residual_pre').text('Medio');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-yellow');
                    break;
                case RiesgoTotal >= 91 && RiesgoTotal <= 135:
                    $('#nivelriesgo_residual_pre').text('Alto');
                    $('#nivelriesgo_residual_pre').removeClass("text-dark");
                    $('#nivelriesgo_residual_pre').removeClass("text-orange");
                    $('#nivelriesgo_residual_pre').removeClass("text-success");
                    $('#nivelriesgo_residual_pre').removeClass("text-danger");
                    $('#nivelriesgo_residual_pre').addClass('text-orange');
                    break;
                case RiesgoTotal >= 136 && RiesgoTotal <= 185:
                    $('#nivelriesgo_residual_pre').text('Muy alto');
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

    <script type=text/javascript>
        $('#probabilidad').change(function() {
            var impactoID = document.getElementById("impacto").value;
            let probabilidadID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            $("#nivelriesgo").attr("value", result);


        });

        $('#impacto').change(function() {
            var probabilidadID = document.getElementById("probabilidad").value;
            let impactoID = $(this).val();
            let result = Number(probabilidadID) * Number(impactoID);
            $("#nivelriesgo").attr("value", result);

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
        $(document).ready(function() {
            let tipoTratamiento = @json($matrizRiesgo->tipo_tratamiento);
            if (tipoTratamiento == 0) {
                $("#ver1").css("display", "none");
                $("#modulo_planaccion").css("display", "block");
            } else {
                $("#ver1").css("display", "block");
                $("#modulo_planaccion").css("display", "none");

            }
        });
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('cerrar-modal', (event) => {
                $('#amenazaSelect').modal('hide');
                $('.modal-backdrop').hide();
                if (event.editar) {
                    toastr.success('Editado con éxito');
                } else {
                    toastr.success('Creado con éxito');
                }

            })
            Livewire.on('cerrar-VulnerabilidadModal', (event) => {
                $('#vulnerabilidadSelect').modal('hide');
                $('.modal-backdrop').hide();
                if (event.editar) {
                    toastr.success('Editado con éxito');
                } else {
                    toastr.success('Creado con éxito');
                }

            })
        })
    </script>
@endsection
