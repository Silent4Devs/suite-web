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
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_1" name="color_estatus_1"
                            class="color-input form-control" value="#34B990" title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_1" name="estatus_1" class="form-control"
                                placeholder="Estatus" required>
                            <label for="estatus_1">Estatus</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_1" name="valor_estatus_1" class="form-control"
                                placeholder="Valor" required>
                            <label for="valor_estatus_1">Valor</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="descripcion_parametros_1" name="descripcion_parametros_1"
                                class="form-control" placeholder="Descripción" required>
                            <label for="descripcion_parametros_1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_2" name="color_estatus_2"
                            class="color-input form-control" value="#73A7D5" title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_2" name="estatus_2" class="form-control"
                                placeholder="Estatus" required>
                            <label for="estatus_2">Estatus</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_2" name="valor_estatus_2" class="form-control"
                                placeholder="Valor" required>
                            <label for="valor_estatus_2">Valor</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="descripcion_parametros_2" name="descripcion_parametros_2"
                                class="form-control" placeholder="Descripción" required>
                            <label for="descripcion_parametros_2">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_3" name="color_estatus_3"
                            class="color-input form-control" value="#F59595" title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_3" name="estatus_3" class="form-control"
                                placeholder="Estatus">
                            <label for="estatus_3">Estatus</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_3" name="valor_estatus_3" class="form-control"
                                placeholder="Valor">
                            <label for="valor_estatus_3">Valor</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="descripcion_parametros_3" name="descripcion_parametros_3"
                                class="form-control" placeholder="Descripción" required>
                            <label for="descripcion_parametros_3">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_4" name="color_estatus_4"
                            class="color-input form-control" value="#EEEEEE" title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_4" name="estatus_4" class="form-control"
                                placeholder="Estatus">
                            <label for="estatus_4">Estatus</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_4" name="valor_estatus_4" class="form-control"
                                placeholder="Valor">
                            <label for="valor_estatus_4">Valor</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="descripcion_parametros_4" name="descripcion_parametros_4"
                                class="form-control" placeholder="Descripción" required>
                            <label for="descripcion_parametros_4">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body">
            <div class="form-row">
                <div class="col-md-9 titulo-card-template"
                    style="font-family: roboto; color: #306BA9; font-size: 16px;">
                    Define cuantas secciones tendrá tu cuestionario
                </div>
                <div class="col-md-2" style="font:roboto;color:#306BA9; font-size:14px; text-align:right;">
                    <p>Añadir Sección</p>
                </div>
                {{-- Establece cuantas secciones habra --}}
                <div class="col-md-1">
                    <select id="secciones" name="secciones" wire:model.lazy="secciones" class="form-control">
                        <option value=1 selected>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Dice en que seccion esta  y nos deja desplazarnos entre ellas --}}
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

        {{-- Cual es la seccion visible --}}
        @if ($secciones >= 1 && $secciones <= 4 && $posicion_seccion == 1)
            <div class="row no-gutters">
                <div class="col-2">
                    <div class="encabezado">
                        <h3 style="margin-left:10px;" class="mb-0">Sección 1</h3>
                    </div>
                </div>
                <div class="col-10">
                    <div
                        style="background: #306BA9 0% 0%; height:14px; margin-top:16.2px; border-top-right-radius:14px;">
                    </div>
                </div>
            </div>
            <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                <div class="card-body">
                    {{-- El porcentaje de evaluación solo esta activo si es mas de 1 seccion --}}
                    @if ($secciones > 1 && $secciones <= 4)
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99" step="0.01"
                                    name="porcentaje_seccion_{{ $posicion_seccion }}"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            {{-- <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div> --}}
                        </div>
                    @endif
                    <div class="row" style="justify-content: right;">
                        <div class="col-2">
                            <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion1">
                                Añadir Pregunta
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
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

            {{-- Libreria para realizar el drag and drop establece el espacio donde se podran mover --}}
            <div id="sortable-container">
                {{-- Sortable item establece que es lo que se va a mover --}}
                <div class="card card-body sortable-item">
                    <div class="d-flex justify-content-end align-items-end">
                        {{-- Drag Handle establece el area desde donde se podra mover o "arrastrar" el item --}}
                        <div class="drag-handle">
                            <div class="flex-column">
                                <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pregunta1" name="pregunta1" placeholder="Pregunta" style="height: 76px;"></textarea>
                                <label for="pregunta1">Pregunta</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Arreglo de preguntas, al presionar el boton de añadir se agregan mas a la seccion --}}
                @foreach ($preguntas_s1 as $key => $p)
                    <div class="card card-body sortable-item">
                        <div class="d-flex justify-content-end align-items-end">
                            <div class="drag-handle">
                                <div class="flex-column">
                                    <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                    <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta1_{{ $key }}" name="pregunta1_{{ $key }}"
                                        placeholder="Pregunta" style="height: 76px;"></textarea>
                                    <label for="pregunta1_{{ $key }}">Pregunta</label>
                                </div>
                            </div>
                        </div>
                        {{-- Cada pregunta agregada cuenta con boton de eliminacion, el key indica cual posicion tiene
                            en el arreglo y la elimina  --}}
                        <div style="text-align: end;">
                            <button class="btn trash-button"
                                wire:click.prevent="removePreguntaSeccion1({{ $key }})">
                                <i class="fa-regular fa-trash-can" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                    title="Eliminar"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($secciones >= 2 && $secciones <= 4 && $posicion_seccion == 2)
            <div class="row no-gutters">
                <div class="col-2">
                    <div class="encabezado">
                        <h3 style="margin-left:10px;" class="mb-0">Sección 2</h3>
                    </div>
                </div>
                <div class="col-10">
                    <div
                        style="background: #306BA9 0% 0%; height:14px; margin-top:16.2px; border-top-right-radius:14px;">
                    </div>
                </div>
            </div>
            <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            Porcentaje de evaluación:
                            <input type="number" min="0.01" max="99.99" step="0.01"
                                name="porcentaje_seccion_{{ $posicion_seccion }}"
                                id="porcentaje_seccion_{{ $posicion_seccion }}">
                        </div>
                        <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe tener un
                            valor
                            total
                            del
                            100% entre las secciones
                        </div>
                    </div>
                    <div class="row" style="justify-content: right;">
                        <div class="col-2">
                            <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion2">
                                Añadir Pregunta
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
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

                <div id="sortable-container">

                    <div class="card card-body sortable-item">
                        <div class="d-flex justify-content-end align-items-end">
                            <div class="drag-handle">
                                <div class="flex-column">
                                    <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                    <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="pregunta2" name="pregunta2" placeholder="Pregunta" style="height: 76px;"></textarea>
                                    <label for="pregunta2">Pregunta</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($preguntas_s2 as $key => $p)
                        <div class="card card-body sortable-item">
                            <div class="d-flex justify-content-end align-items-end">
                                <div class="drag-handle">
                                    <div class="flex-column">
                                        <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                        <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="pregunta2_{{ $key }}" name="pregunta2_{{ $key }}"
                                            placeholder="Pregunta" style="height: 76px;"></textarea>
                                        <label for="pregunta2_{{ $key }}">Pregunta</label>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: end;">
                                <button class="btn trash-button"
                                    wire:click.prevent="removePreguntaSeccion2({{ $key }})">
                                    <i class="fa-regular fa-trash-can" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                        title="Eliminar"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif ($secciones >= 3 && $secciones <= 4 && $posicion_seccion == 3)
                <div class="row no-gutters">
                    <div class="col-2">
                        <div class="encabezado">
                            <h3 style="margin-left:10px;" class="mb-0">Sección 3</h3>
                        </div>
                    </div>
                    <div class="col-10">
                        <div
                            style="background: #306BA9 0% 0%; height:14px; margin-top:16.2px; border-top-right-radius:14px;">
                        </div>
                    </div>
                </div>
                <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Porcentaje de evaluación:
                                <input type="number" min="0.01" max="99.99" step="0.01"
                                    name="porcentaje_seccion_{{ $posicion_seccion }}"
                                    id="porcentaje_seccion_{{ $posicion_seccion }}">
                            </div>
                            <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe
                                tener un
                                valor
                                total
                                del
                                100% entre las secciones
                            </div>
                        </div>
                        <div class="row" style="justify-content: right;">
                            <div class="col-2">
                                <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion3">
                                    Añadir Pregunta
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
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
                    <div id="sortable-container">

                        <div class="card card-body sortable-item">
                            <div class="d-flex justify-content-end align-items-end">
                                <div class="drag-handle">
                                    <div class="flex-column">
                                        <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                        <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="pregunta3" name="pregunta3" placeholder="Pregunta" style="height: 76px;"></textarea>
                                        <label for="pregunta3">Pregunta</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($preguntas_s3 as $key => $p)
                            <div class="card card-body sortable-item">
                                <div class="d-flex justify-content-end align-items-end">
                                    <div class="drag-handle">
                                        <div class="flex-column">
                                            <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                            <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="pregunta3_{{ $key }}" name="pregunta3_{{ $key }}"
                                                placeholder="Pregunta" style="height: 76px;"></textarea>
                                            <label for="pregunta3_{{ $key }}">Pregunta</label>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: end;">
                                    <button class="btn trash-button"
                                        wire:click.prevent="removePreguntaSeccion3({{ $key }})">
                                        <i class="fa-regular fa-trash-can"
                                            style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif ($secciones == 4 && $posicion_seccion == 4)
                    <div class="row no-gutters">
                        <div class="col-2">
                            <div class="encabezado">
                                <h3 style="margin-left:10px;" class="mb-0">Sección 4</h3>
                            </div>
                        </div>
                        <div class="col-10">
                            <div
                                style="background: #306BA9 0% 0%; height:14px; margin-top:16.2px; border-top-right-radius:14px;">
                            </div>
                        </div>
                    </div>
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    Porcentaje de evaluación:
                                    <input type="number" min="0.01" max="99.99" step="0.01"
                                        name="porcentaje_seccion_{{ $posicion_seccion }}"
                                        id="porcentaje_seccion_{{ $posicion_seccion }}">
                                </div>
                                <div class="col-md-6" style="color:#FF0000; font-size:10px;">La evaluación debe
                                    tener un
                                    valor
                                    total
                                    del
                                    100% entre las secciones
                                </div>
                            </div>
                            <div class="row" style="justify-content: right;">
                                <div class="col-2">
                                    <button class="btn btn-link" wire:click.prevent="addPreguntaSeccion4">
                                        Añadir Pregunta
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
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
                        <div id="sortable-container">

                            <div class="card card-body sortable-item">
                                <div class="d-flex justify-content-end align-items-end">
                                    <div class="drag-handle">
                                        <div class="flex-column">
                                            <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                            <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="pregunta4" name="pregunta4" placeholder="Pregunta" style="height: 76px;"></textarea>
                                            <label for="pregunta4">Pregunta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach ($preguntas_s4 as $key => $p)
                                <div class="card card-body sortable-item">
                                    <div class="d-flex justify-content-end align-items-end">
                                        <div class="drag-handle">
                                            <div class="flex-column">
                                                <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                                <i class="fa-solid fa-ellipsis-vertical fa-2x"></i>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="pregunta4_{{ $key }}" name="pregunta4_{{ $key }}"
                                                    placeholder="Pregunta" style="height: 76px;"></textarea>
                                                <label for="pregunta4_{{ $key }}">Pregunta</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: end;">
                                        <button class="btn trash-button"
                                            wire:click.prevent="removePreguntaSeccion4({{ $key }})">
                                            <i class="fa-regular fa-trash-can"
                                                style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
        @endif

        @if ($secciones == $posicion_seccion)
            <div class="row">
                @if ($secciones > 1 && $secciones <= 4)
                    <div class="col-3">
                        <button type="submit" class="btn btn-link" wire:click="backSeccion">Sección
                            Anterior</button>
                    </div>
                @else
                    <div class="col-3"></div>
                @endif
                <div class="col-5">
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-primary btn-block">Cancelar</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary btn-block" type="submit">Generar Template</button>
                </div>
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
