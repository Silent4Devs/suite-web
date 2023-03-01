<script>
    if (document.querySelector('#id_responsable') != null) {

        let responsable = document.querySelector('#id_responsable');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
        document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
        document.getElementById('id_area').innerHTML = recortarTexto(area_init);

        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = e.target.options[e.target.selectedIndex].getAttribute('data-area');
            let puesto = e.target.options[e.target.selectedIndex].getAttribute('data-puesto');
            console.log(e.target.options[e.target.selectedIndex]);
            document.getElementById('id_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('id_area').innerHTML = recortarTexto(area)
        })
    }

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
        var confidencialidadMatrizRiesgos = document.getElementById("confidencialidad").value;
        var integridadMatrizRiesgos = document.getElementById("integridad").value;
        var disponibilidadMatrizRiesgos = document.getElementById("disponibilidad").value;
        let result = Number(confidencialidadMatrizRiesgos) + Number(integridadMatrizRiesgos) + Number(
            disponibilidadMatrizRiesgos);

        $("#resultadoponderacion").attr("value", Math.round(result * 10) / 10);

        let RiesgoTotal = Number(riesgo) + Number(result);
        $("#riesgo_total").attr("value", Math.round(RiesgoTotal * 10) / 10);
        switch (true) {
            case RiesgoTotal <= 68:
                $('#nivelriesgo_total').text('Bajo');
                $('#nivelriesgo_total').removeClass("text-dark");
                $('#nivelriesgo_total').removeClass("text-orange");
                $('#nivelriesgo_total').removeClass("text-yellow");
                $('#nivelriesgo_total').removeClass("text-danger");
                $('#nivelriesgo_total').addClass('text-success');
                break;
            case RiesgoTotal <= 113:
                $('#nivelriesgo_total').text('Medio');
                $('#nivelriesgo_total').removeClass("text-dark");
                $('#nivelriesgo_total').removeClass("text-orange");
                $('#nivelriesgo_total').removeClass("text-yellow");
                $('#nivelriesgo_total').removeClass("text-danger");
                $('#nivelriesgo_total').addClass('text-yellow');
                break;
            case RiesgoTotal <= 157:
                $('#nivelriesgo_total').text('Alto');
                $('#nivelriesgo_total').removeClass("text-dark");
                $('#nivelriesgo_total').removeClass("text-orange");
                $('#nivelriesgo_total').removeClass("text-success");
                $('#nivelriesgo_total').removeClass("text-danger");
                $('#nivelriesgo_total').addClass('text-orange');
                break;
            case RiesgoTotal <= 200:
                $('#nivelriesgo_total').text('Muy Alto');
                $('#nivelriesgo_total').removeClass("text-dark");
                $('#nivelriesgo_total').removeClass("text-orange");
                $('#nivelriesgo_total').removeClass("text-success");
                $('#nivelriesgo_total').removeClass("text-danger");
                $('#nivelriesgo_total').addClass('text-danger');
                break;
            default:
                alert("Rango no encontrado, ¡Intentalo de nuevo!");
                break;
        }
    });

    $('.sumaFactoresResiduales').change(function() {
        console.log('hola');
        var riesgoCid = document.getElementById("nivelriesgo_residual").value;
        var confidencialidadCid = document.getElementById("confidencialidad_cid").value;
        var integridadCid = document.getElementById("integridad_cid").value;
        var disponibilidadCid = document.getElementById("disponibilidad_cid").value;
        let resultCid = Number(confidencialidadCid) + Number(integridadCid) + Number(
            disponibilidadCid);
        $("#resultadoponderacionRes").attr("value", Math.round(resultCid * 10) / 10);

        let RiesgoTotalCid = Number(riesgoCid) + Number(resultCid);
        $("#riesgo_total_residual").attr("value", Math.round(RiesgoTotalCid * 10) / 10);
        switch (true) {
            case RiesgoTotalCid <= 68:
                $('#nivel_riesgo_total_residual').text('Bajo');
                $('#nivel_riesgo_total_residual').removeClass("text-dark");
                $('#nivel_riesgo_total_residual').removeClass("text-orange");
                $('#nivel_riesgo_total_residual').removeClass("text-yellow");
                $('#nivel_riesgo_total_residual').removeClass("text-danger");
                $('#nivel_riesgo_total_residual').addClass('text-success');
                break;
            case RiesgoTotalCid <= 113:
                $('#nivel_riesgo_total_residual').text('Medio');
                $('#nivel_riesgo_total_residual').removeClass("text-dark");
                $('#nivel_riesgo_total_residual').removeClass("text-orange");
                $('#nivel_riesgo_total_residual').removeClass("text-success");
                $('#nivel_riesgo_total_residual').removeClass("text-danger");
                $('#nivel_riesgo_total_residual').addClass('text-yellow');
                break;
            case RiesgoTotalCid <= 157:
                $('#nivel_riesgo_total_residual').text('Alto');
                $('#nivel_riesgo_total_residual').removeClass("text-dark");
                $('#nivel_riesgo_total_residual').removeClass("text-orange");
                $('#nivel_riesgo_total_residual').removeClass("text-success");
                $('#nivel_riesgo_total_residual').removeClass("text-danger");
                $('#nivel_riesgo_total_residual').addClass('text-orange');
                break;
            case RiesgoTotalCid <= 200:
                $('#nivel_riesgo_total_residual').text('Muy alto');
                $('#nivel_riesgo_total_residual').removeClass("text-dark");
                $('#nivel_riesgo_total_residual').removeClass("text-yellow");
                $('#nivel_riesgo_total_residual').removeClass("text-success");
                $('#nivel_riesgo_total_residual').removeClass("text-danger");
                $('#nivel_riesgo_total_residual').addClass('text-danger');
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

{{-- <script type="text/javascript">

    $(document).ready(function() {
        let tipoTratamiento = @json($matrizRiesgo->tipo_tratamiento);
        if (tipoTratamiento == 0) {
            $("#ver1").css("display", "none");
            $("#modulo_planaccion").css("display", "block");

        } else {
            $("#ver1").css("display", "block");
            $("#modulo_planaccion").css("display", "none");

        }
    })


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


</script> --}}

<script>
    var numero1 = document.getElementById("numero1").value;
    var numero2 = document.getElementById("numero2").value;

    var suma = numero1 + numero2;

    document.writeln(suma);
</script>
