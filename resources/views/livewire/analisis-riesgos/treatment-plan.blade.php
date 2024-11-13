<div class="mt-4 card card-body shadow-sm">
    <h4 style="margin: 0px;">Plan de tratamiento de riesgos</h4>
    <hr style="margin-top: 10px; margin-bottom: 20px;">
    <div class="datatable-fix">
        <table class="table w-100 datatable datatable-risk-analysis" id="datatable-risk-analysis">
            <thead class="">
                <tr>
                    <th>
                        Nombre del Análisis
                    </th>
                    <th>
                        Riesgo total
                    </th>
                    <th>
                        Riesgo Residual
                    </th>
                    <th>
                        Plan de trabajo
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!is_null($sheets) && count($sheets) > 0)
                    @foreach ($sheets as $sheet)
                        <tr>
                            <td>
                                {{ $riskName }}
                            </td>
                            <td>
                                {{ $sheet->initial_risk }}
                            </td>
                            <td>
                                {{ $sheet->residual_risk ? $sheet->residual_risk : 'Sin evaluar' }}
                            </td>
                            <td >
                                @if ($sheet->sheet->treatment_plan_id)
                                <a type="button" class="btn" href="{{ route('admin.planes-de-accion.show', $sheet->sheet->treatment_plan_id) }}">
                                    <span class="material-symbols-outlined">
                                        view_kanban
                                    </span>
                                </a>
                                @else
                                    <a type="button" class="btn" data-toggle="modal" data-target="#modalPlanAccion" wire:click="selectSheetId({{$sheet->sheet->id}})">
                                        <span class="material-symbols-outlined">
                                            view_kanban
                                        </span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            No hay datos registrados
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div wire:ignore.self class="modal fade" id="modalPlanAccion" tabindex="-1" role="dialog" aria-labelledby="modalPlanAccionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="titulo_general_funcion"
                        style="
                    margin-bottom: 0px !important;
                ">Registrar: Plan de Trabajo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí carga el contenido del formulario -->
                    <div class="mt-4">
                        <div class="">
                                <form wire:submit.prevent="saveTreatmentPlan">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <div class="form-group anima-focus">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}"
                                                        id="parent" aria-describedby="parent" name="parent" required wire:model.defer='parent'>
                                                    @if ($errors->has('parent'))
                                                        <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                                                    @endif
                                                    <label for="parent"> Nombre: <span class="text-danger">*</span></label>
                                                    <span class="text-danger parent_error error-ajax"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm" style="padding-left: inherit !important">
                                            <div class="form-group anima-focus">
                                                <input type="date" min="1945-01-01" class="form-control" id="inicio"
                                                    name="inicio" required required wire:model.defer='inicio'>
                                                <label for="inicio"> Fecha inicio <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group anima-focus">
                                                <input type="date" min="1945-01-01" class="form-control" id="fin"
                                                    name="fin" required required wire:model.defer='fin'>
                                                <label for="fin"> Fecha fin <span class="text-danger">*</span></label>
                                                <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="width: -webkit-fill-available;padding-left: 20px;padding-right: 20px;">
                                            <div class="form-group">
                                                <div class="form-group anima-focus">
                                                    <textarea class="form-control" id="objetivo" name="objetivo" required required wire:model.defer='objetivo'></textarea>
                                                    <label for="objetivo">Objetivo: <span class="text-danger">*</span></label>
                                                    <span class="text-danger norma_error error-ajax"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="text-right form-group col-12" style="margin-left:-5px;">
                                        <button class="btn btn-xs tb-btn-primary" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                            </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
