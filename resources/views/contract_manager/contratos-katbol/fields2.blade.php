<div class="card-content px-36">
    <!-- property general info -->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small class="active">Fase*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="fase">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fase') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Estado*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="estado">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('estado') }}</label>
            </div>
        </div>

    </div>
    <!-- Termina información inicial-->
    <hr/>
    <!-- Segundo div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small>Número de SAP</small>
            <div class="display-flex ml-4">
                <input id="input_numsap" name="numero_sap" class="validate" type="number">
                <span for="input_numsap" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('number_sap') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Título/Nombre</small>
            <div class="display-flex ml-4">
                <textarea id="input_titulonom" name="titulo_nombre" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_titulonom" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('titulo_nombre') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Marco normativo</small>
            <div class="display-flex ml-4">
                <textarea id="input_marconormativo" name="marco_normativa" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_marconormativo" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('marco_normativa') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Síntesis ejecutiva</small>
            <div class="display-flex ml-4">
                <textarea id="input_sintesis" name="marco_normativa" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_marconormativo" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('marco_normativa') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Comentarios de desfasamiento</small>
            <div class="display-flex ml-4">
                <textarea id="input_desfa" name="comentarios_desfasamiento" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_desfa" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('comentarios_desfasamiento') }}</label>
            </div>
        </div>
    </div>
    <!-- Termina segundo div -->
    <hr>
    <!-- Segundo div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small>Fecha de firma del contrato</small>
            <div class="display-flex ml-4">
                <input id="input_firmcontrato" name="fecha_firma_contrato" class="validate datepicker">
                <span for="input_firmcontrato" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fecha_inicio') }}</label>
            </div>
        </div>

        <div class="input-field col s12 m4">
            <small>Fecha de liberación de garantías</small>
            <div class="display-flex ml-4">
                <input id="input_fechlib" name="fecha_liberacion_garantias" class="validate datepicker">
                <span for="input_fechlib" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fecha_liberacion_garantias') }}</label>
            </div>
        </div>

    </div>
    <!-- Termina segundo div -->
    <hr>
    <!-- Tercer div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small class="active">Ejecución 2</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="ejecucion_dos">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('ejecucion_dos') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Gerencia 2</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="gerencia_dos">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('gerencia_dos') }}</label>
            </div>
        </div>
    </div>
    <!-- Termina tercer div -->
    <hr>
    <!-- Cuarto div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small class="active">Presupuesto ejercido facturado</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="presupuesto_ejercido_facturado">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('presupuesto_ejercido_facturado') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Presupuesto ejercido en letra</small>
            <div class="display-flex ml-4">
                <textarea id="input_presupuestoletra" name="presupuesto_ejercido_letra" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_presupuestoletra" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('presupuesto_ejercido_letra') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Clasificación de partida</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="clasificacion_partida">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('clasificacion_partida') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Monto de la fianza</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="monto_fianza">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_fianza') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Monto de la fianza en letra</small>
            <div class="display-flex ml-4">
                <textarea id="input_fianzaletra" name="monto_fianza_letra" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_fianzaletra" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_fianza_letra') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Presupuesto ejercido en letra</small>
            <div class="display-flex ml-4">
                <textarea id="input_presupuestoletra" name="presupuesto_ejercido_letra" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_presupuestoletra" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('presupuesto_ejercido_letra') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Número de fianza</small>
            <div class="display-flex ml-4">
                <input id="input_nofianza" name="numero_fianza" class="validate" type="number">
                <span for="input_nofianza" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('numero_fianza') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Afianzadora</small>
            <div class="display-flex ml-4">
                <textarea id="input_afianzadora" name="afianzadora" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_afianzadora" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('afianzadora') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Fecha de expedición de la póliza</small>
            <div class="display-flex ml-4">
                <input id="input_fechexpedicion" name="fecha_expedicion_poliza" class="validate datepicker">
                <span for="input_fechinicio" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fecha_expedicion_poliza') }}</label>
            </div>
        </div>
    </div>
    <!-- Termina cuarto div -->
    <hr>
    <div class="row mb-3">
        <div class="col s12">
            <button class="btn btn-right blue" type="submit">Enviar</button>
            <a onClick="window.location.reload();" class="btn btn-default">Refrescar</a>
        </div>
    </div>
</div>
