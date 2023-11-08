<div>
    <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">
        <div class="card card-body mt-5">
            <div style="color:#306BA9; font-size:16px;">Datos Generales</div>
            <hr style="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3 ">
                        <input type="text" class="form-control" placeholder="Nombre del Template" id="nombre_template"
                            name="nombre_template" required>
                        <label for="nombre_template">Nombre del Template</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 ">
                        <select id="norma" name="norma" class="form-control " required>
                            @foreach ($normas as $norma)
                                <option value="{{ $norma->id }}">{{ $norma->norma }}</option>
                            @endforeach
                        </select>
                        <label for="norma">Norma</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" style="height: 100px"></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body mt-5">
            <div class="col-m-12" style="color:#306BA9; font-size:16px;">
                Define el valor de los parámetros con los que se evaluará tu cuestionario
            </div>
            <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
                Estatus: Define el nombre de tu parámetro
            </div>
            <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
                Valor: Agrega el valor de tu parámetro con los que se evaluará tu cuestionario
            </div>
            <br>
            <div class="row">
                <div class="col-3">
                    <div class="form-row">
                        <div class="col-8">
                            <div class="form-floating mb-3 ">
                                <input type="text" id="estatus_1" name="estatus_1" class="form-control"
                                    placeholder="Estatus" required>
                                <label for="estatus_1">Estatus</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3 ">
                                <input type="number" id="valor_estatus_1" name="valor_estatus_1" class="form-control"
                                    placeholder="Valor" required>
                                <label for="valor_estatus_1">Valor</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 color-picker">
                            <input type="color" id="color_estatus_1" name="color_estatus_1"
                                class="color-input form-control" value="#563d7c" title="Seleccione un color">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-row">
                        <div class="col-8">
                            <div class="form-floating mb-3 ">
                                <input type="text" id="estatus_2" name="estatus_2" class="form-control"
                                    placeholder="Estatus" required>
                                <label for="estatus_2">Estatus</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3 ">
                                <input type="number" id="valor_estatus_2" name="valor_estatus_2" class="form-control"
                                    placeholder="Valor" required>
                                <label for="valor_estatus_2">Valor</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 color-picker">
                            <input type="color" id="color_estatus_2" name="color_estatus_2"
                                class="color-input form-control" value="#563d7c" title="Seleccione un color">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-row">
                        <div class="col-8">
                            <div class="form-floating mb-3 ">
                                <input type="text" id="estatus_3" name="estatus_3" class="form-control"
                                    placeholder="Estatus">
                                <label for="estatus_3">Estatus</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3 ">
                                <input type="number" id="valor_estatus_3" name="valor_estatus_3"
                                    class="form-control" placeholder="Valor">
                                <label for="valor_estatus_3">Valor</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 color-picker">
                            <input type="color" id="color_estatus_3" name="color_estatus_3"
                                class="color-input form-control" value="#563d7c" title="Seleccione un color">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-row">
                        <div class="col-8">
                            <div class="form-floating mb-3 ">
                                <input type="text" id="estatus_4" name="estatus_4" class="form-control"
                                    placeholder="Estatus">
                                <label for="estatus_4">Estatus</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3 ">
                                <input type="number" id="valor_estatus_4" name="valor_estatus_4"
                                    class="form-control" placeholder="Valor">
                                <label for="valor_estatus_4">Valor</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 color-picker">
                            <input type="color" id="color_estatus_4" name="color_estatus_4"
                                class="color-input form-control" value="#563d7c" title="Seleccione un color">
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        @if ($secciones > 1 && $secciones <= 4)
            <div class="card card-body">
                <div class="row">
                    <div class="col-3">
                        <button type="submit" class="btn btn-link" wire:click="backSeccion">Regresar</button>
                    </div>
                    <div class="col-6" style="text-align: center">
                        {{ $posicion_seccion }}/{{ $secciones }}
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-link" wire:click="nextSeccion">Siguiente</button>
                    </div>
                </div>
            </div>
        @endif

        @if ($secciones >= 1 && $secciones <= 4 && $posicion_seccion == 1)
            <div class="card">
                <div class="card-header">
                    <h3>Sección 1</h3>
                </div>
                <div class="card-body">
                    @if ($secciones > 1 && $secciones <= 4)
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div>
                        </div>
                    @endif
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
            </div>
            <div class="card card-body mt-5">
                <div style="color:#306BA9; font-size:16px;">Formulario
                    <hr style="">
                </div>
            </div>

            <div id="sortable-container">

                <div class="card card-body sortable-item">
                    <div class="drag-handle">Drag me</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta1" name="pregunta1" placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta1">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($preguntas_s1 as $key => $p)
                    <div class="card card-body sortable-item">
                        <div class="drag-handle">Drag me</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta1_{{ $key }}" name="pregunta1_{{ $key }}"
                                        placeholder="Pregunta" style="height: 150px"></textarea>
                                    <label for="pregunta1_{{ $key }}">Pregunta</label>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 col-12" style="text-align: end;">
                            <button class="btn trash-button"
                                wire:click.prevent="removePreguntaSeccion1({{ $key }})">
                                <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                    title="Eliminar"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($secciones >= 2 && $secciones <= 4 && $posicion_seccion == 2)
            <div>
                <div class="seccion col-m-2">
                    <h3>Sección 2</h3>
                </div>
                <div class="card card-body">
                    @if ($secciones > 1 && $secciones <= 4)
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion2">
                            + Agregar Pregunta
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descripcion_s2" name="descripcion_s2" placeholder="Descripcion"
                                    style="height: 150px"></textarea>
                                <label for="descripcion_s2">Descripción</label>
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
                                <textarea class="form-control" id="pregunta2" name="pregunta2" placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta2">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($preguntas_s2 as $key => $p)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta2_{{ $key }}" name="pregunta2_{{ $key }}"
                                        placeholder="Pregunta" style="height: 150px"></textarea>
                                    <label for="pregunta2_{{ $key }}">Pregunta</label>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 col-12" style="text-align: end;">
                            <button class="btn trash-button"
                                wire:click.prevent="removePreguntaSeccion2({{ $key }})">
                                <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                    title="Eliminar"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($secciones >= 3 && $secciones <= 4 && $posicion_seccion == 3)
            <div>
                <div class="seccion col-m-2">
                    <h3>Sección 3</h3>
                </div>
                <div class="card card-body">
                    @if ($secciones > 1 && $secciones <= 4)
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion3">
                            + Agregar Pregunta
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descripcion_s3" name="descripcion_s3" placeholder="Descripcion"
                                    style="height: 150px"></textarea>
                                <label for="descripcion_s3">Descripción</label>
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
                                <textarea class="form-control" id="pregunta3" name="pregunta3" placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta3">Pregunta</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 col-12" style="text-align: end;">
                        <button class="btn trash-button"
                            wire:click.prevent="removePreguntaSeccion3({{ $key }})">
                            <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                title="Eliminar"></i>
                        </button>
                    </div>
                </div>

                @foreach ($preguntas_s3 as $key => $p)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta3_{{ $key }}" name="pregunta3_{{ $key }}"
                                        placeholder="Pregunta" style="height: 150px"></textarea>
                                    <label for="pregunta3_{{ $key }}">Pregunta</label>
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
                <div class="card card-body">
                    @if ($secciones > 1 && $secciones <= 4)
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion4">
                            + Agregar Pregunta
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descripcion_s4" name="descripcion_s4" placeholder="Descripcion"
                                    style="height: 150px"></textarea>
                                <label for="descripcion_s4">Descripción</label>
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
                                <textarea class="form-control" id="pregunta4" name="pregunta4" placeholder="Pregunta" style="height: 150px"></textarea>
                                <label for="pregunta4">Pregunta</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 col-12" style="text-align: end;">
                        <button class="btn trash-button"
                            wire:click.prevent="removePreguntaSeccion4({{ $key }})">
                            <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                title="Eliminar"></i>
                        </button>
                    </div>
                </div>

                @foreach ($preguntas_s4 as $key => $p)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta4_{{ $key }}" name="pregunta4_{{ $key }}"
                                        placeholder="Pregunta" style="height: 150px"></textarea>
                                    <label for="pregunta4_{{ $key }}">Pregunta</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($secciones == $posicion_seccion)
            <div class="row">
                <button class="btn-default">Cancelar</button>
                <button type="submit">Generar Template</button>
            </div>
        @else
            <div class="row">
                <div class="col-3">
                    <button type="submit" class="btn btn-link" wire:click="backSeccion">Sección Anterior</button>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-link" wire:click="nextSeccion">Siguiente Sección</button>
                </div>
            </div>
        @endif



    </form>
</div>

@livewireScripts()
