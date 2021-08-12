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
            $("#nivelriesgo").attr("value", Number(probabilidadID) * Number(impactoID));
        });

        $('#impacto').change(function() {
            var probabilidadID = document.getElementById("probabilidad").value;
            let impactoID = $(this).val();
            $("#nivelriesgo").attr("value", Number(probabilidadID) * Number(impactoID));

        });
    </script>

    <script type=text/javascript>
        $('#probabilidad_residual').change(function() {
            var impactoID_residual = document.getElementById("impacto_residual").value;
            let probabilidadID_residual = $(this).val();
            $("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
        });

        $('#impacto_residual').change(function() {
            var probabilidadID_residual = document.getElementById("probabilidad_residual").value;
            let impactoID_residual = $(this).val();
            $("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));

        });
    </script>
@endsection
