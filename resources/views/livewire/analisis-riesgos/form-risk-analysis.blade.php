<div class="mt-4 card card-body shadow-sm">
    <h4 style="margin: 0px;">Formulario</h4>
    <hr style="margin-top: 20px;">

    <div style="display:flex; flex-direction:row; gap:17px;">
        <button id="register"
            style=";width: 180px; height: 50px; background-color: #ECFBFF; border: 1px solid #9EB4C9; color:#006DDB;"
            class="btn ">
            Registrar
        </button>
        <button type="button" style="width: 180px; height: 50px;" class="btn tb-btn-primary" data-toggle="modal"
            data-target="#formRiskAnalysis">
            <i class="material-symbols-outlined">
                text_snippet
            </i>
            Ver Formulario
        </button>

    </div>
    <hr style="margin-top: 20px;">
    <div>
        <table class="table table-bordered w-100 datatable datatable-risk-analysis" id="datatable-risk-analysis">
            <thead class="thead-dark">
                <tr>
                    @foreach ($settignsTable as $settign)
                        <th>
                            {{ $settign->title }}
                        </th>
                    @endforeach
                </tr>
            </thead>
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
</div>
