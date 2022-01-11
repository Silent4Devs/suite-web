<div class="row mt-4 align-items-center">
    <div class="datatable-fix col-12">
        <table class="table w-100" id="tblParticipantes">
            <thead>
                <tr>
                    <th scope="col" style="width:50%">Empleado</th>
                    <th scope="col" style="width:20%">Area</th>
                    <th scope="col" style="width:20%">Estatus</th>
                    <th scope="col" style="width:20%">Calificación</th>
                    <th scope="col" style="width:20%">Certificado</th>
                    <th scope="col" style="width:10%">Opciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($recurso->empleados as $empleado)
                    <tr>
                        <td style="width:50%">
                            <img src="{{ $empleado->avatar_ruta }}" class="img-empleado-tabla" />
                            {{ $empleado->name }}
                        </td>
                        <td style="width:20%">{{ $empleado->area->area }}</td>
                        @if ($empleado->pivot->es_aceptada == null)
                            <td style="width:20%"><i class="text-muted far fa-question-circle mr-2"></i> Pendiente</td>
                        @elseif($empleado->pivot->es_aceptada == true)
                            <td style="width:20%"><i class="text-success far fa-check-circle mr-2"></i> Aceptada</td>
                        @elseif($empleado->pivot->es_aceptada == false)
                            <td style="width:20%"><i class="text-danger far fa-times-circle mr-2"></i> Rechazada</td>
                        @endif
                        @if (\Carbon\Carbon::now()->isAfter(\Carbon\Carbon::parse($recurso->fecha_fin)))
                            <td style="width:10%">
                                <i class="fas fa-graduation-cap btnModal" style="cursor: pointer;" data-toggle="modal"
                                    data-target="#modalParticipante" data-empleado="{{ json_encode($empleado) }}"></i>
                            </td>
                        @endif
                    </tr>
                @endforeach --}}
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
