<div class="card-body datatable-fix">
    <h5 class="p-0 m-0 text-muted">Solicitados: Documentos que envíe a aprobación</h5>
    <hr>

    <table id="tblAprobaciones" class="table">
        <thead>
            <tr>
                <th style="vertical-align: top">
                    Evaluado
                </th>
                <th style="vertical-align: top">
                    Evaluadores
                </th>
                <th style="vertical-align: top">
                    Participacion
                </th>
                <th style="vertical-align: top">
                    Evaluar
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluaciones as $evaluacion)
                <tr>
                    <td>
                        {{ $evaluacion->empleado_evaluado->name }}
                    </td>
                    <td>
                        {{ $evaluacion->evaluador->name }}
                    </td>
                    <td>

                    </td>
                    <td>
                        <a
                            href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->evaluador, 'evaluador' => $evaluacion->empleado_evaluado]) }}"><i
                                class="fas fa-arrow-right"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [];


            $("#tblEvaluaciones").DataTable({
                buttons: dtButtons,
            });

            $("#tblAprobaciones").DataTable({
                buttons: [],
            });
        });
    </script>
@endsection
