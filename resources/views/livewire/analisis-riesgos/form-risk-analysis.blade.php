<div class="mt-4 card card-body shadow-sm">
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
    <div>
        <table class="table table-bordered w-100 datatable datatable-risk-analysis" id="datatable-risk-analysis">
            <thead class="thead-dark">
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
                </tr>
            </thead>
            <tbody>
                @if ($verifyAnswers)
                    @foreach ($sheetTables as $sheetTable )
                    <tr>
                        @foreach ( $sheetTable->sheet->answersTable as $answerTable )
                            @isset($sheetTable->sheet->answersTable->value)
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
                            <div>
                                <div class="d-flex align-items-start options">
                                    <div class="caja-options card card-body" style="border-radius: 0px !important; position: absolute;">
                                        <a type="button" data-toggle="modal" data-target="#formRiskAnalysis">
                                            <p class="m-0">Evaluar/editar formulario</p>
                                        </a>
                                        <a type="button" data-toggle="modal" data-target="#formRiskAnalysis">
                                            <p class="m-0">Finalizar /editar formulario</p>
                                        </a>


                                    </div>
                                    <button class="btn pt-0">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                </div>
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
    <div wire:ignore class="modal fade" id="formRiskAnalysis" tabindex="-1"
        aria-labelledby="formRiskAnalysisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background:none; border:none; gap:28px;">
                <div class="card" style="width: 100%; margin:0px;">
                    <form id='Form' class="card-body" onsubmit="return false;">
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
                                                            <span
                                                                style="color:#FF0000">{{ $question->obligatory ? '*' : null }}</span>
                                                        @endif
                                                    </label>
                                                    @include('admin.analisis-riesgos.tbFormMaker', [
                                                        'question' => $question,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submitButton">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="card" style="width: 100%; margin:0px;">
                    <div class="card-body">
                        hola 2
                    </div>
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
                            <button style="width: 163px; height: auto; color:#006DDB;" class="btn btn-simple-secondary"
                                data-dismiss="modal">
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

    <script>
        function submitForm() {
            e.preventDefault();
            const form = document.getElementById('Form');
            const formData = new FormData(form);

            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            Livewire.emit('formData', data);
        };
        document.getElementById('submitButton').addEventListener('click', function(e) {
            // e.preventefault();
            // Obtén el formulario
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
        $(function() {
            let dtButtons = [];

            let dtOverrideGlobals = {
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-risk-analysis').DataTable(dtOverrideGlobals);
        });
    </script>

    @yield('js')
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
</div>
