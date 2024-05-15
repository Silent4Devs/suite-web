<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @include('admin.recursos-humanos.evaluaciones-desempeno.components.status-cards')

    <div>
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
</div>
