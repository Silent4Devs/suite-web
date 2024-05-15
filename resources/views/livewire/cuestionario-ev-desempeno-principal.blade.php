<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @include('admin.recursos-humanos.evaluaciones-desempeno.components.status-cards')

    <div wire:ignore>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @if ($evaluacionDesempeno->activar_objetivos && $acceso_objetivos)
                <li class="nav-item" role="presentation">
                    <div class="tab-objetivos tab-option" id="objetive-tab" data-toggle="tab" data-target="#objetive"
                        type="button" role="tab" aria-controls="objetive" aria-selected="true">
                        <div class="d-flex align-items-center" style="height: 200px; color: #f8f9fa;"><i
                                class="icon-tab fa-solid fa-bullseye" style="font-size: 28px; margin-right:5px;"></i>
                            <h5 class="m-0">EVALUA TUS OBJETIVOS</h5>
                        </div>
                    </div>
                </li>
            @endif
            @if ($evaluacionDesempeno->activar_competencias && $acceso_competencias)
                <li class="nav-item" role="presentation">
                    <div class="tab-competencia tab-option" id="competencies-tab" data-toggle="tab"
                        data-target="#competencies" type="button" role="tab" aria-controls="competencies"
                        aria-selected="{{ $acceso_objetivos ? 'false' : 'true' }}">
                        <div class="d-flex align-items-center" style="height: 200px; color: #f8f9fa;"><i
                                class="icon-tab material-symbols-outlined" style="font-size: 32px;">star </i>
                            <h5 class="m-0">EVALUA TUS COMPETENCIAS</h5>
                        </div>
                    </div>
                </li>
            @endif
        </ul>

        <div class="tab-content" id="myTabContent">
            @if ($evaluacionDesempeno->activar_objetivos && $acceso_objetivos)
                <div class="tab-pane fade{{ $acceso_objetivos ? ' show active' : '' }}" id="objetive" role="tabpanel"
                    aria-labelledby="objetive-tab">
                    <div class="card">
                        <div class="card-body">
                            @livewire('cuestionario-evaluacion-desempeno-objetivos', ['id_evaluacion' => $evaluacionDesempeno->id, 'id_evaluado' => $evaluado, 'id_periodo' => $periodo])
                        </div>
                    </div>
                </div>
            @endif
            @if ($evaluacionDesempeno->activar_competencias && $acceso_competencias)
                <div class="tab-pane fade{{ !$acceso_objetivos ? ' show active' : '' }}" id="competencies"
                    role="tabpanel" aria-labelledby="competencies-tab">
                    @livewire('cuestionario-evaluacion-desempeno-competencias', ['id_evaluacion' => $evaluacionDesempeno->id, 'id_evaluado' => $evaluado, 'id_periodo' => $periodo])
                </div>
            @endif
        </div>

    </div>

    <h1>Data from Child 1: {{ $dataFromChild1 }}</h1>

    <!-- Output received data from Child2 -->
    <h1>Data from Child 2: {{ $dataFromChild2 }}</h1>

    <div class="card">
        <div class="card-body">
            @if (
                $evaluacionDesempeno->activar_competencias &&
                    $acceso_competencias &&
                    $evaluacionDesempeno->activar_objetivos &&
                    $acceso_objetivos)
                @if ($autoevaluacion && $dataFromChild1 == 100 && $dataFromChild2 == 100)
                    <div class="d-flex justify-content-center">
                        <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h3>Firma del Evaluador</h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="clear" class="btn btn-link">Limpiar Firma</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                            style="border: 1px solid black;"></canvas>
                    </div>
                @elseif (!$autoevaluacion && $dataFromChild1 == 100 && $dataFromChild2 == 100)
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif(
                $evaluacionDesempeno->activar_competencias &&
                    $acceso_competencias &&
                    !$evaluacionDesempeno->activar_objetivos &&
                    !$acceso_objetivos)
                @if ($autoevaluacion && $dataFromChild2 == 100)
                    <div class="d-flex justify-content-center">
                        <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h3>Firma del Evaluador</h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="clear" class="btn btn-link">Limpiar Firma</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                            style="border: 1px solid black;"></canvas>
                    </div>
                @elseif (!$autoevaluacion && $dataFromChild2 == 100)
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif(
                !$evaluacionDesempeno->activar_competencias &&
                    !$acceso_competencias &&
                    $evaluacionDesempeno->activar_objetivos &&
                    $acceso_objetivos)
                @if ($autoevaluacion && $dataFromChild1 == 100)
                    <div class="d-flex justify-content-center">
                        <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h3>Firma del Evaluador</h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="clear" class="btn btn-link">Limpiar Firma</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                            style="border: 1px solid black;"></canvas>
                    </div>
                @elseif (!$autoevaluacion && $dataFromChild1 == 100)
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <h6>Por favor firma en el siguiente recuadro para confirmar tu evaluación.</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h3>Firma del Evaluador</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button id="clear" class="btn btn-link">Limpiar Firma</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                                    style="border: 1px solid black;"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
