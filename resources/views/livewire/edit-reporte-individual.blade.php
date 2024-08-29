<div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    @if ($cuentas != null)
        <div class="container-fluid mb-4">
            <div class="row">
                @foreach ($cuentas as $cuenta)
                    <div class="col-3 mt-4">
                        <div class="card card-body justify-content-center"
                            style="background-color: #b9f3fd; min-height:100px;">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h6>{{ $cuenta->nombre }}</h6>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <h3 class="d-inline mr-2">{{ $cuenta->count }}
                                    </h3>
                                    <i class="fa-solid fa-file-circle-check iconos-crear d-inline"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($this->reporte != null)
        <div class="col-12 mt-4 " style="text-align: end">
            <button type="button" wire:click.prevent="modal('crear')" class="btn btn-outline-primary">Documentar
                Hallazgo</button>
        </div>

        <div class="row">
            <br>
        </div>

        <div class="card card-body">
            <div class="row">
                <div class="form-group col-sm-4 col-md-4 col-lg-3">
                    <button wire:click="movePreviousReport" class="btn btn-link">
                        < Reporte Anterior</button>
                </div>
                <div class="form-group col-sm-4 col-md-4 col-lg-6" style="text-align: center">
                    {{ $this->findPosition($this->reporte->id) }}/{{ $reportes_audit->count() }}
                </div>
                <div class="form-group col-sm-4 col-md-4 col-lg-3" style="text-align: end">
                    <button wire:click="moveNextReport" class="btn btn-link">Reporte Siguiente ></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Hallazgos</h5>

                                <input id="auditoria_internas_id" name="auditoria_internas_id" type="hidden"
                                    value=" {{ $id_auditoria }}" wire:model.defer="auditoria_internas_id">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ml-4 mr-4">

                                @if ($view == 'create')
                                    <div class="row">
                                        <div class="form-group mt-3 mb-3 col-sm-12">
                                            <div class="anima-focus">
                                                <select name="c_id" id="c_id"
                                                    class="form-control select {{ $errors->has('c_id') ? 'is-invalid' : '' }}"
                                                    wire:model.defer="c_id" required>
                                                    <option value="">Seleccione una Claúsula</option>
                                                    @foreach ($clausulas as $claus)
                                                        <option value="{{ $claus->id }}">
                                                            {{ $claus->nombre_clausulas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label select-label">Cláusulas</label>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($view == 'edit')
                                    <div class="row">
                                        <div class="form-group mt-3 mb-3 col-sm-12">
                                            <div class="anima-focus">
                                                <select name="c_edit_id" id="c_edit_id"
                                                    class="form-control select {{ $errors->has('c_edit_id') ? 'is-invalid' : '' }}"
                                                    wire:model.defer="c_edit_id" required>
                                                    @foreach ($clausulas as $claus)
                                                        <option value="{{ $claus->id }}">
                                                            {{ $claus->nombre_clausulas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label select-label">Cláusulas</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-12">
                                        <div class="anima-focus">
                                            <input type="text"
                                                class="form-control {{ $errors->has('incumplimiento_requisito') ? 'is-invalid' : '' }}"
                                                name="incumplimiento_requisito" id="incumplimiento_requisito"
                                                wire:model.defer="incumplimiento_requisito" required placeholder="" />
                                            <label class="required" for="incumplimiento_requisito">
                                                Requisito</label>
                                        </div>
                                        @if ($errors->has('incumplimiento_requisito'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('incumplimiento_requisito') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-12">
                                        <div class="anima-focus">
                                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                                                id="descripcion" wire:model.defer="descripcion" required placeholder=""></textarea>
                                            <label class="required" for="descripcion">
                                                Descripción</label>
                                        </div>
                                        @if ($errors->has('descripcion'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('descripcion') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h5>Subtema</h5>

                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-4">
                                        <div class="anima-focus">
                                            <input type="number" min="1" max="100000"
                                                class="form-control {{ $errors->has('no_tipo') ? 'is-invalid' : '' }}"
                                                name="no_tipo" id="no_tipo" wire:model.defer="no_tipo"
                                                placeholder=""></input>
                                            <label class="required" for="no_tipo">
                                                No.</label>
                                        </div>
                                        @if ($errors->has('no_tipo'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('no_tipo') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-3 mb-3 col-sm-8">
                                        <div class="anima-focus">
                                            <input type="text"
                                                class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                                                name="titulo" id="titulo" wire:model.defer="titulo"
                                                placeholder="" />
                                            <label class="required" for="titulo">
                                                Título</label>
                                        </div>
                                        @if ($errors->has('titulo'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('titulo') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-12 col-md-12 col-lg-12">
                                        <div class="anima-focus">
                                            <select name="clasificacion_id" id="clasificacion_id"
                                                class="form-control select {{ $errors->has('clasificacion_id') ? 'is-invalid' : '' }}"
                                                wire:model.defer="clasificacion_id">
                                                <option value="">Seleccione una Clasificación</option>
                                                @foreach ($clasificaciones as $clasif)
                                                    <option value="{{ $clasif->id }}">
                                                        {{ $clasif->nombre_clasificaciones }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="required" for="clasificacion_id">Clasificación del
                                                Hallazgo</label>
                                        </div>
                                        @if ($errors->has('clasificacion_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('clasificacion_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-12">
                                        <div class="anima-focus">
                                            <select
                                                class="form-control {{ $errors->has('proceso') ? 'is-invalid' : '' }}"
                                                name="proceso_id" id="proceso_id" wire:model.defer="proceso">
                                                <option value="">Seleccione un proceso</option>
                                                @foreach ($procesos as $proceso)
                                                    <option value="{{ $proceso->id }}">
                                                        {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label for="proceso_id">Proceso</label>
                                        </div>
                                        @if ($errors->has('proceso'))
                                            <div class="text-danger">
                                                {{ $errors->first('proceso') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-3 mb-3 col-sm-6 col-md-12 col-lg-12">
                                        <div class="anima-focus">
                                            <input type="text" class="form-control"
                                                value="{{ $this->reporte->empleado->area->area }}" disabled
                                                placeholder="">
                                            <label for="area">Área</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn tb-btn-primary"
                                    wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="form-group col-md-12 row mt-4">
                <h5>Hallazgos</h5>&nbsp;&nbsp;
                <h5 style="color: orange"> {{ $this->reporte->empleado->name }}</h5>
                <hr style="width: 98%; margin:auto;">
            </div>

            <div class="row">
                <div class="datatable-rds w-100">
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Cláusula</th>
                                <th>Subtema</th>
                                <th></th>
                                {{-- <th scope="col-6">Requisito</th>
                            <th scope="col-6">Descripción</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->clausula->nombre_clausulas }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <label for="no_tipo">
                                                    No.</label><br>
                                                <input type="number" class="form-control"
                                                    value="{{ $data->no_tipo }}" disabled>
                                            </div>
                                            <div class="form-group col-sm-9">
                                                <label for="titulo">
                                                    Título</label><br>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->titulo }}" disabled>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align:right">
                                        <div class="dropdown">
                                            <div class="btn" type="button" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </div>
                                            <div class="btn" onclick="viewAudit({{ $data->id }})">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    wire:click.prevent="modal('editar', {{ $data->id }})">
                                                    <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                                <a class="dropdown-item"
                                                    wire:click.prevent="modal('borrar', {{ $data->id }})">
                                                    <i class="fa-solid fa-trash"
                                                        wire:click.prevent="$emit('eliminarParteInteresada',{{ $data->id }})"></i>&nbsp;Eliminar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="d-none tr-sec-menu tr-second{{ $data->id }}">
                                    <td style="min-width:100px;">{{ $data->incumplimiento_requisito }}</td>
                                    <td style="min-width:100px;">{{ $data->descripcion }}</td>
                                    <td style="min-width:100px;">
                                        {{ $data->procesos ? $data->procesos->nombre : 'n/a' }}
                                    </td>
                                </tr>
                                <tr class="d-none tr-sec-menu tr-second{{ $data->id }}">
                                    <td style="min-width:100px;">{{ $data->areas ? $data->areas->area : 'n/a' }}</td>
                                    <td colspan="2">
                                        {{ $data->clasificacion->nombre_clasificaciones ?? $data->clasificacion_hallazgo }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col s12">
                    <div class="form-group col-sm-12 right " style="margin: 0; text-align: end">
                        <div><span>Mostrar</span>
                            <select class="select_pagination" wire:model="pagination">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>registros</span>
                        </div>
                    </div>
                </div>
                <div>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>

        @if ($this->reporte->estado == 'enviado' || $this->reporte->estado == null)
            <div class="card card-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="anima-focus">
                            <textarea class="form-control {{ $errors->has('comentarios') ? 'is-invalid' : '' }}" name="comentarios"
                                id="comentarios" wire:model.defer="comentarios"></textarea>
                            <label class="required" for="comentarios">
                                Comentarios</label>
                        </div>
                        @if ($errors->has('comentarios'))
                            <div class="invalid-feedback">
                                {{ $errors->first('comentarios') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @elseif ($this->reporte->estado == 'aprobado' || $this->reporte->estado == 'rechazado')
            <div class="card card-body">
                <div class="row col-md-12"></div>
                <div>
                    <h5>Comentarios:</h5>
                </div>
                <div>
                    <p>{{ $this->reporte->comentarios }}</p>
                </div>
            </div>
        @endif

        <div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if ($this->reporte->estado != 'aprobado')
                            <div class="row" style="justify-content: center; display: flex;">
                                <h3>Firma de Auditor Lider</h3>
                            </div>
                            <div class="row" style="justify-content: center; display: flex;">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="row" style="justify-content: center; display: flex;">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        @else
                            <div class="row" style="justify-content: center; display: flex;">
                                <h3>Firma de Auditor Lider</h3>
                            </div>
                            <div class="row">
                                <span style="height: 36px;"></span>
                            </div>
                            <div class="row" style="justify-content: center; display: flex;">
                                <img width="450" height="250" style="border: 1px solid black;"
                                    src="{{ asset('storage/auditorias-internas/auditoria/' . $this->reporte->id_auditoria . '/reporte/' . $this->reporte->id . '/' . $this->reporte->lider->name . $this->reporte->firma_lider) }}">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row" style="justify-content: center; display: flex;">
                            <h3>Firma de Auditor Interno</h3>
                        </div>
                        <div class="row">
                            <span style="height: 36px;"></span>
                        </div>
                        @if (isset($this->reporte->firma_empleado))
                            <div class="row" style="justify-content: center; display: flex;">
                                <img width="450" height="250" style="border: 1px solid black;"
                                    alt="No se ha Firmado el reporte"
                                    src="{{ asset('storage/auditorias-internas/auditoria/' . $this->reporte->id_auditoria . '/reporte/' . $this->reporte->id . '/' . $this->reporte->empleado->name . $this->reporte->firma_empleado) }}">
                            </div>
                        @else
                            <div class="row" style="justify-content: center; display: flex;">
                                <img width="450" height="250" style="border: 1px solid black;"
                                    alt="No se ha Firmado el reporte" src="{{ asset('img/firma.png') }}">
                            </div>
                        @endif
                    </div>
                </div>
                @if ($this->reporte->estado != 'aprobado')
                    <div class="row" style="justify-content: center; display: flex; margin-top: 10px;">
                        <button id="save" type="submit" class="btn btn-outline-primary"
                            data-reporte="{{ $this->reporte->id }}">Confirmar Acuerdo</button>
                    </div>
                    <div class="row" style="justify-content: center; display: flex;">
                        <div class="row" style="justify-content: center; display: flex;">
                            <button type="submit" id="rechazo-link" class="btn btn-link"
                                data-reporte="{{ $this->reporte->id }}">Rechazar</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    @endif
</div>
