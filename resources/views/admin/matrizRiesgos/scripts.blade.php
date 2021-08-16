@section('scripts')
    <script type=text/javascript>
        $('#id_responsable').change(function() {
            var elaboroID = $(this).val();
            if (elaboroID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getEmployeeData') }}?id=" + elaboroID,
                    success: function(res) {
                        if (res) {
                            $("#id_puesto").empty();
                            $("#id_puesto").attr("value", res.puesto);
                            $("#id_area").empty();
                            $("#id_area").attr("value", res.area);
                        } else {
                            $("#id_puesto").empty();
                            $("#id_area").empty();
                        }
                    }
                });
            } else {
                $("#id_puesto").empty();
                $("#id_area").empty();
            }
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
@endsection
