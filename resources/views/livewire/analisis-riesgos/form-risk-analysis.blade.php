<div class="mt-4 card card-body shadow-sm">
    <style>
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile+label {
            max-width: 80%;
            /* font-size: 1.25rem; */
            /* font-weight: 700; */
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0.625rem 1.25rem;
        }

        .inputfile-3+label {
            color: #006DDB;
        }

        /* .inputfile-3:focus+label,
        .inputfile-3.has-focus+label,
        .inputfile-3+label:hover {
            color: #c39f77;
        } */
    </style>
    <h4 style="margin: 0px;">Formulario</h4>
    <hr style="margin-top: 20px;">

    <div style="display:flex; flex-direction:row; gap:17px; justify-content:space-between;">
        @if ($verifyPeriod)
            <button type="button" id="register"
                style=";width: 180px; height: 50px; background-color: #ECFBFF; border: 1px solid #9EB4C9; color:#006DDB;"
                class="btn" data-toggle="modal" data-target="#RegisterSheet">
                Registrar
            </button>
        @else
            <button wire:click="verifyStatus" type="button" id="register"
                style=";width: 180px; height: 50px; background-color: #ECFBFF; border: 1px solid #9EB4C9; color:#006DDB;"
                class="btn">
                Registrar
            </button>
        @endif
        {{-- <button type="button" style="width: 180px; height: 50px;" class="btn tb-btn-primary" data-toggle="modal"
            data-target="#formRiskAnalysis">
            <i class="material-symbols-outlined">
                text_snippet
            </i>
            Ver Formulario
        </button> --}}
        <button wire:click="$emit('finishPeriod')" type="button"
            style="width: 180px; height: 50px; background-color:#FA8E00; color:#FFFFFF;" class="btn">
            Finalizar
        </button>
    </div>
    <hr style="margin-top: 20px;">

    <div class="datatable-fix">
        <table class="table w-100 datatable datatable-risk-analysis" id="datatable-risk-analysis">
            <thead class="">
                <tr>
                    @foreach ($questionSettigns as $questionSettign)
                        <th>
                            {{ $questionSettign->question->title }}
                        </th>
                    @endforeach
                    @foreach ($formulasSettings as $formulaSettign)
                        <th>
                            {{ $formulaSettign->formula->title }}
                        </th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($verifyAnswers)
                    @foreach ($sheetTables as $sheetTable)
                        <tr>
                            @foreach ($sheetTable->sheet->answersTable as $answerTable)
                                @isset($answerTable->value)
                                    <td>
                                        {{ $answerTable->value }}
                                    </td>
                                @else
                                    <td>
                                        Sin datos registrados
                                    </td>
                                @endisset
                            @endforeach
                            <td>
                                <div class="btn-group dropstart">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="material-symbols-outlined">
                                            more_vert
                                        </i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if (!$sheetTable->sheet->initial_risk_confirm)
                                        <li><a class="dropdown-item" type="button" data-toggle="modal"
                                                data-target="#formRiskAnalysis"
                                                wire:click="chageStatusForm(1,{{ $sheetTable->sheet->id }})">
                                                <p class="m-0">Evaluar/editar formulario</p>
                                            </a></li>
                                        @endif
                                        @if ($sheetTable->sheet->initial_risk_confirm)
                                        <li><a class="dropdown-item" type="button" data-toggle="modal"
                                                data-target="#formRiskAnalysis"
                                                wire:click="chageStatusForm(2,{{ $sheetTable->sheet->id }})">
                                                <p class="m-0">Finalizar /editar formulario</p>
                                            </a></li>
                                        @endif
                                    </ul>
                                </div>
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

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="formRiskAnalysis" tabindex="-1"
        aria-labelledby="formRiskAnalysisModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <div class="modal-content" style="background:none; border:none; gap:28px;">
                    {{-- header --}}
                    <div class="card d-flex align-items-center"
                        style="width: 100%; margin:0px; padding-top:31px; padding-bottom:31px; background-color:{{ $sheetForm['bg'] }};">
                        @if ($sheetForm['status'] === 1)
                            <h3>Riesgo inicial</h3>
                            <p class="m-0">Evalúa tu riesgo inicial</p>
                        @else
                            <h3>Riesgo Residual</h3>
                            <p class="m-0">Evalúa tu riesgo residual</p>
                        @endif
                    </div>
                    {{-- Form --}}
                    <div class="card" style="width: 100%; margin:0px;">
                        <form id='Form' class="card-body" onsubmit="return false;">
                            {{-- {{ $sheetId }} --}}
                            @foreach ($sections as $section)
                                <div style="width:100%; column-gap: 20px;">
                                    <div class="encabezado">
                                        <div class="section d-flex justify-content-between" style="margin-top:15px;">
                                            {{ $section->title }}
                                        </div>
                                        <div class="section2"></div>
                                    </div>
                                    <div class="row">
                                        @foreach ($section->questions as $question)
                                            <div class="col-{{ $question->size }}">
                                                <div class="card">
                                                    <div class="card-body mb-0">
                                                        <label>
                                                            @if ($question->type != 10)
                                                                {{ $question->title }}
                                                                {{ $question->type }}
                                                                <span
                                                                    style="color:#FF0000">{{ $question->obligatory ? '*' : null }}</span>
                                                            @endif
                                                        </label>

                                                        @include('admin.analisis-riesgos.tbFormMaker', [
                                                            'question' => $question,
                                                            'answersForm' => $answersForm,
                                                            'scales' => $scales,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-end gap-3">
                                {{-- <button type="button" class="btn tb-btn-secondary" data-dismiss="modal"
                                    onclick="limpiarFormulario()">CANCELAR</button> --}}
                                <button type="submit" id="submitButton" class="btn tb-btn-primary">GUARDAR FORMULARIO</button>
                            </div>
                        </form>
                    </div>
                    {{-- result --}}
                    <div class="card d-flex flex-row " style="width: 100%;">
                        @if ($sheetForm['status'] === 2)
                            <div class="d-flex flex-column align-items-center justify-content-center"
                                style="height: 190px; width:50%; background-color:{{ $sheetForm['bg'] }}; border-radius: 16px 0px 0px 16px;">
                                <h6>Nivel de riesgo residual</h6>
                                <h2>{{ $risks['initial'] }}% / {{ $risks['residual'] }}%</h2>
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-center"
                                style="height: 190px; width:100%; border-radius: 0px 16px 16px 0px;">
                                <h6>Probabilidad / Impacto</h6>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center"
                                style="height: 190px; width:50%; background-color:{{ $sheetForm['bg'] }}; border-radius: 16px 0px 0px 16px;">
                                <h6>Nivel de riesgo inicial</h6>
                                <h2>{{ $risks['initial'] }}%</h2>
                                <div style="width: auto; padding:5px; background: {{$risks['approveInitial'] ? '#78BB50':'#FF9898'}}; border-radius: 11px;">
                                    @if($risks['approveInitial'])
                                    <h6 style="color:#FFFFFF" class="mb-0">Aceptable</h6>
                                    @else
                                    <h6 style="color:#FFFFFF" class="mb-0">
                                        No aceptable
                                    </h6>
                                    @endif
                                </div>
                                {{-- @dump($risks['approveInitial'] ) --}}
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-center"
                                style="height: 190px; width:100%; border-radius: 0px 16px 16px 0px;">
                                <h6>Probabilidad / Impacto</h6>
                            </div>
                        @endif
                    </div>
                    {{-- controls --}}
                    @if ($sheetId)
                        <livewire:analisis-riesgos.controls-risk-analysis :riskAnalysisId="$riskAnalysisId" />

                        {{-- <livewire:analisis-riesgos.controls-risk-analysis :sheetId="$sheetId" /> --}}
                    @endif

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn tb-btn-secondary" data-dismiss="modal"
                            onclick="limpiarFormulario()">CANCELAR</button>
                        <button wire:click="riskConfirmMessage"  class="btn tb-btn-primary">CONFIRMAR RIESGO {{$sheetForm['status'] === 2 ? 'RESIDUAL':'INICIAL'}}</button>
                    </div>

                    {{-- <div class="card" style="width: 100%; margin:0px;">
                        <div class="card-body">
                            @if ($sheetId)
                                <div class="datatable-fix">
                                    <table class="table w-100 datatable datatable-risk-analysis-controls"
                                        id="datatable-risk-analysis-controls">
                                        <thead class="">
                                            <tr>
                                                <th>Control</th>
                                                <th>Declaración de aplicabilidad</th>
                                                <th>Aplica</th>
                                                <th>Justificación</th>
                                                <th style="width:100px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($controlsSheet as $index => $controlSheet)
                                                <tr>
                                                    <td>
                                                        {{ $controlSheet->control }} {{ $controlSheet->control_name }}
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="applicability"
                                                                id="flexCheckDefault-{{ $index }}"
                                                                {{ $controlSheet->applicability ? 'checked' : '' }}
                                                                wire:model.defer="controlsSheet.{{ $index }}.applicability">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $controlSheet->control }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class='d-flex gap-1'>
                                                            <div>No</div>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customSwitch1-{{ $index }}"
                                                                    wire:model.defer="controlsSheet.{{ $index }}.is_apply">
                                                                <label class="custom-control-label"
                                                                    for="customSwitch1-{{ $index }}">Sí</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea style="min-height: 70px;" class="form-control" name="justify" id="justify"
                                                                wire:model.defer="controlsSheet.{{ $index }}.justification">{{ $controlSheet->justification }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($controlSheet->file)
                                                        <div class="mt-4 pl-4 d-flex justify-content-start align-items-center"
                                                            style="">
                                                            <p><i wire:click="download"
                                                                    class="mr-2 cursor-pointer fas fa-download"
                                                                    title="Descargar"></i></p>
                                                            <p class="ml-2">
                                                                <i wire:click="destroy"
                                                                    class="cursor-pointer fa-regular fa-trash-can"
                                                                    style="" title="Eliminar"></i>
                                                            </p>
                                                        </div>
                                                        @else
                                                        <div>
                                                            <input type="file" name="file-3-{{$index}}" id="file-3-{{$index}}"
                                                                class="inputfile inputfile-3" wire:model.defer="controlsSheet.{{ $index }}.file" />
                                                            <label for="file-3-{{$index}}">
                                                                <span class="material-symbols-outlined">
                                                                    attach_file
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="mt-1 font-bold text-blue-500" wire:loading wire:target="controlsSheet.{{ $index }}.file">
                                                            Cargando ...
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <button type="button" wire:click="saveTable" id="submitControls"
                                class="btn tb-btn-primary">GUARDAR CONTROLES</button>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

    {{-- Modal Registro --}}
    <div wire:ignore class="modal fade" id="RegisterSheet" tabindex="-1" aria-labelledby="RegisterSheetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background:none; border:none; gap:28px;">
                <div class="card" style="width: 100%; margin:0px;">
                    <div class="card-body">
                        <h5 style="display: flex; justify-content:center;">Desea retomar algún riesgo del periodo
                            anterior</h5>
                        <span class="material-symbols-outlined"
                            style="display: flex; justify-content:center; font-size:60px;">
                            breaking_news
                        </span>
                        <p style="display: flex; justify-content:center;">Esta acción te permite cargar Análisis de
                            periodos anteriores</p>
                        <p style="display: flex; justify-content:center;">En caso de AGREGAR deberá enlistar los riegos
                            registrados en el periodo anterior</p>
                        <p style="display: flex; justify-content:center;">En caso de NO ACEPTAR se creará un registro
                            sin retomar los valores utilizados anteriormente</p>
                        <hr style="margin-top: 10px;">
                        <div>
                            table
                        </div>
                        <div style="display:flex; justify-content:flex-end; flex-direction:row; gap:17px;">
                            <button style="width: 163px; height: auto; color:#006DDB;"
                                class="btn btn-simple-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button wire:click="createPeriod" style="width: 163px; height: auto;"
                                class="btn tb-btn-secondary">
                                No Aceptar
                            </button>
                            <button style="width: 163px; height: auto;" class="btn tb-btn-primary">
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- send form --}}
    <script>
        // function submitForm() {
        //     e.preventDefault();
        //     const form = document.getElementById('Form');
        //     const formData = new FormData(form);

        //     const data = {};
        //     formData.forEach((value, key) => {
        //         data[key] = value;
        //     });

        //     Livewire.emit('formData', data);
        // };
        document.getElementById('submitButton').addEventListener('click', function(e) {
            const form = document.getElementById('Form');
            const formData = new FormData(form);

            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            if (form.checkValidity()) {
                Livewire.emit('formData', data);
            }
        });
    </script>

    <script>
        function handleApplicability(checkbox, index) {
            // Get the checked state of the checkbox
            const isChecked = checkbox.checked;

            // Manually emit the event to Livewire
            // Livewire.emit('changeApplicability', index, isChecked);
        }
    </script>

    {{-- clear form --}}
    <script>
        function limpiarFormulario() {
            const form = document.getElementById('Form');
            form.reset(); // Esto restablece los valores del formulario a los valores por defecto (vaciar si no hay valor predeterminado)
        }
    </script>

    {{-- table sheets --}}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                console.log('liwe');
                setTimeout(() => {
                    tablaLivewire('datatable-risk-analysis');
                }, 200);

            });

            Livewire.on('scriptTabla2', () => {
                setTimeout(() => {
                    tablaLivewire('datatable-risk-analysis-controls');
                }, 200);
            });
        });
    </script>

    {{-- alerts --}}
    @yield('js')

    {{-- alert finish period sheet --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("finishPeriod", id => {
                Swal.fire({
                    html: `
                    <h3 class="mb-0" style="color:#575757; font-size:22px;"><strong>Esta acción finaliza el periodo de Análisis</strong></h3>
                    <span class="material-symbols-outlined" style="font-size:60px;">analytics</span>
                    <h6 style="color:#575757;"><strong>¿Estás seguro que deseas realizar esta accion?</strong></h6>
                    <h6>Esta acción será permanente y no podrá deshacerse</h6>
                    `,
                    showCancelButton: true,
                    customClass: {
                        title: 'custom-title',
                        confirmButton: 'btn tb-btn-primary',
                        cancelButton: 'custom-cancel-button'
                    },
                    confirmButtonText: "Finalizar Análisis",
                    cancelButtonText: "Regresar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('template-top-analisis-riesgos', 'destroy', id);
                        Swal.fire({
                            title: "Finalizado",
                            text: "El periodo de analisis finalizo con éxito",
                            icon: "success"
                        });
                    }
                });
            })
        });
    </script>

    {{-- alert response form sheet --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("responseForm", (edit) => {
                let title = "";
                let action = "";
                if (!edit) {
                    title = "Guardado";
                    action = "guardo";
                } else {
                    title = "Editado";
                    action = "edito";
                }
                Swal.fire({
                    title: title,
                    text: `Se ${action} exitosamente el formulario`,
                    icon: "success"
                });
            })
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("responseTableControls", () => {
                // let title = "";
                // let action = "";
                // if (!edit) {
                //     title = "Guardado";
                //     action = "guardo";
                // } else {
                //     title = "Editado";
                //     action = "edito";
                // }
                Swal.fire({
                    title: 'Guardado y/o Editado',
                    text: `Se guardo y/o edito exitosamente los controles`,
                    icon: "success"
                });
            })
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Livewire.on("riskConfirmMessage", () => {
            Swal.fire({
                html: `
                <h3 class="mb-0" style="color:#575757; font-size:22px;"><strong>Confirmar riesgo </strong></h3>
                <h6 style="color:#575757;"><strong>¿Estás seguro que deseas realizar esta accion?</strong></h6>
                <h6>Esta acción será permanente y no podrá deshacerse</h6>
                `,
                showCancelButton: true,
                customClass: {
                    title: 'custom-title',
                    confirmButton: 'btn tb-btn-primary',
                    cancelButton: 'custom-cancel-button'
                },
                confirmButtonText: "Confirmar Riesgo",
                cancelButtonText: "Regresar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('riskConfirm');
                    Swal.fire({
                        title: "Confirmado",
                        text: "El riesgo se confirmo con éxito",
                        icon: "success"
                    });
                }
            });
        })
    });
</script>

    {{-- <script>
        document.addEventListener('deleteMessage', event => {
            Swal.fire({
                title: "Eliminar este elemento",
                text: "¿Estás seguro de querer eliminar este registro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    // @this.call('delete');
                    Swal.fire({
                    title: "Eliminado",
                    text: "El registro se eliminó exitosamente",
                    icon: "success"
                    });
                }
            });
        });
    </script> --}}

</div>
