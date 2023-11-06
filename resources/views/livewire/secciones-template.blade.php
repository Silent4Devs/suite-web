<div>
    <div class="card card-body">
        <div class="form-row" style="">
            <div class="col-md-10 titulo-card-template" style="font:roboto;color:#306BA9; font-size:16px;">
                Define cuantas secciones tendrá tu cuestionario
            </div>
            <div class="col-m-1" style="font:roboto;color:#306BA9; font-size:14px; ">
                <div class="">Añadir Sección</div>
            </div>
            <div class="col-m-1 " style="">
                <select id="secciones" name="secciones" wire:model.lazy="secciones" class="form-control">
                    <option value=1 selected>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
            <div class="col-3">
                <button class="btn btn-link" wire:click="backSeccion">Regresar</button>
            </div>
            <div class="col-6" style="text-align: center">
                {{ $posicion_seccion }}/{{ $secciones }}
            </div>
            <div class="col-3">
                <button class="btn btn-link" wire:click="nextSeccion">Siguiente</button>
            </div>
        </div>
    </div>

    @if ($secciones >= 1 && $secciones <= 4 && $posicion_seccion == 1)
        <div class="card">
            <div class="card-header">
                <h3>Sección 1</h3>
            </div>
            <div class="linea-seccion col-md-12">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4" style="color:#FF0000; font-size:10px;">La evaluación debe tener un valor total
                        del
                        100% entre las secciones
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion1">
                        + Agregar Pregunta
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descripcion_s1" name="descripcion_s1" placeholder="Descripcion"
                                style="height: 150px"></textarea>
                            <label for="descripcion_s1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body mt-5">
                <div style="color:#306BA9; font-size:16px;">Formulario
                    <hr style="">
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="pregunta_1" name="pregunta_1" placeholder="Pregunta" style="height: 150px"></textarea>
                            <label for="pregunta_1">Pregunta</label>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($preguntas as $key => $p)
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta_{{ $key }}" name="pregunta_{{ $key }}"
                                    placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta_{{ $key }}">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($secciones >= 2 && $secciones <= 4 && $posicion_seccion == 2)
        <div>
            <div class="seccion col-m-2">
                <h3>Sección 2</h3>
            </div>
            <div class="linea-seccion col-md-12">
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4" style="color:#FF0000; font-size:10px;">La evaluación debe tener un valor total
                        del
                        100% entre las secciones
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion2">
                        + Agregar Pregunta
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descripcion_s1" name="descripcion_s1" placeholder="Descripcion"
                                style="height: 150px"></textarea>
                            <label for="descripcion_s1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body mt-5">
                <div style="color:#306BA9; font-size:16px;">Formulario
                    <hr style="">
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="pregunta_1" name="pregunta_1" placeholder="Pregunta" style="height: 150px"></textarea>
                            <label for="pregunta_1">Pregunta</label>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($preguntas as $key => $p)
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta_{{ $key }}" name="pregunta_{{ $key }}"
                                    placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta_{{ $key }}">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($secciones >= 3 && $secciones <= 4 && $posicion_seccion == 3)
        <div>
            <div class="seccion col-m-2">
                <h3>Sección 3</h3>
            </div>
            <div class="linea-seccion col-md-12">
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4" style="color:#FF0000; font-size:10px;">La evaluación debe tener un valor
                        total
                        del
                        100% entre las secciones
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion3">
                        + Agregar Pregunta
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descripcion_s1" name="descripcion_s1" placeholder="Descripcion"
                                style="height: 150px"></textarea>
                            <label for="descripcion_s1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body mt-5">
                <div style="color:#306BA9; font-size:16px;">Formulario
                    <hr style="">
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="pregunta_1" name="pregunta_1" placeholder="Pregunta" style="height: 150px"></textarea>
                            <label for="pregunta_1">Pregunta</label>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($preguntas as $key => $p)
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta_{{ $key }}" name="pregunta_{{ $key }}"
                                    placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta_{{ $key }}">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($secciones == 4 && $posicion_seccion == 4)
        <div>
            <div class="seccion col-m-2">
                <h3>Sección 4</h3>
            </div>
            <div class="linea-seccion col-md-12">
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4" style="color:#FF0000; font-size:10px;">La evaluación debe tener un valor
                        total
                        del
                        100% entre las secciones
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion4">
                        + Agregar Pregunta
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descripcion_s1" name="descripcion_s1" placeholder="Descripcion"
                                style="height: 150px"></textarea>
                            <label for="descripcion_s1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body mt-5">
                <div style="color:#306BA9; font-size:16px;">Formulario
                    <hr style="">
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="pregunta_1" name="pregunta_1" placeholder="Pregunta" style="height: 150px"></textarea>
                            <label for="pregunta_1">Pregunta</label>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($preguntas as $key => $p)
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta_{{ $key }}" name="pregunta_{{ $key }}"
                                    placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta_{{ $key }}">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@livewireScripts()
