<div class="row mt-4 align-items-center">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

    <div class=" col-12">
        <table class="table w-100" id="tblParticipantes">
            <thead>
                <tr>
                    @if ($recurso->ya_finalizo)
                        <th style="text-align: center !important;">Asistencia</th>
                    @endif
                    <th scope="col" style="width:40%">Empleado</th>
                    <th scope="col" style="width:20%">Area</th>
                    <th scope="col" style="width:20%">Estatus</th>
                    <th scope="col" style="width:20%">Calificación</th>
                    <th scope="col" style="width:20%">Progreso</th>
                    <th scope="col" style="width:20%">Certificado</th>
                    <th scope="col" style="width:10%">Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalParticipante" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalParticipanteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalParticipanteLabel">Cargar Certificado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-group" action="{{ route('admin.recursos.calificar') }}" method="POST"
                        enctype="multipart/form-data" id="formularioModal">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="btnCancelarModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarModal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
