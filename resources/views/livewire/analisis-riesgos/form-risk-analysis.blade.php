<div class="mt-4 card card-body shadow-sm">
    <h4 style="margin: 0px;">Formulario</h4>
    <hr style="margin-top: 20px;">

    <div style="display:flex; flex-direction:row; gap:17px;">
        <button id="register" style=";width: 180px; height: 50px; background-color: #ECFBFF; border: 1px solid #9EB4C9; color:#006DDB;" class="btn ">
            Registrar
        </button>
        <button type="button" style="width: 180px; height: 50px;" class="btn tb-btn-primary" data-toggle="modal" data-target="#formRiskAnalysis">
            <i class="material-symbols-outlined">
                text_snippet
            </i>
            Ver Formulario
        </button>

    </div>
    <hr style="margin-top: 20px;">
    <div>
        {{-- <div class="card-body datatable-fix"> --}}
            <table class="table table-bordered w-100 datatable datatable-risk-analysis"
            id="datatable-risk-analysis">
                <thead class="thead-dark">
                    <tr>
                        @foreach ( $settignsTable as $settign )
                            <th>
                                {{$settign->title}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        {{-- </div> --}}
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="formRiskAnalysis" tabindex="-1"
        aria-labelledby="formRiskAnalysisModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" >
                <div class="modal-content" style="background:none; border:none; gap:28px;" >
                    <div class="card" style="width: 100%; margin:0px;">
                        <div class="card-body">
                            @foreach ($sections as $section )
                            <div style="width:100%; column-gap: 20px;">
                                <div class="encabezado">
                                    <div class="section d-flex justify-content-between" style="margin-top:15px;">
                                         {{$section->title}}
                                    </div>
                                    <div class="section2"></div>
                                </div>
                                <div class="row">
                                    @foreach ($section->questions as $question )
                                        <div>
                                            {{$question->title}}
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div className="row"> --}}
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="card" style="width: 100%; margin:0px;">
                        <div class="card-body">
                            hola 2
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
