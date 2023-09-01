<div class="card-content px-36">
    <!-- property general info -->
    <div class="row mb-4">
        <div class="heading-small"><h3 class="title-section">Gestión de contratos</h3></div>
        <div class="input-field col s12 m4">
            <small class="active">Clasificación de contrato*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="clasificacion_contrato">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('Type') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Número de expediente*</small>
            <div class="display-flex ml-4">
                <input id="input_ne" name="numero_expediente" class="validate" type="number" data-length="10" required>
                <span for="input_ne" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('numero_expediente') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Número de contrato</small>
            <div class="display-flex ml-4">
                <input id="input_con" name="numero_contrato" class="validate" type="number" data-length="10">
                <span for="input_con" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('numero_contrato') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Objeto*</small>
            <div class="display-flex ml-4">
                <textarea id="input_obj" name="objeto" class="validate materialize-textarea" type="text"
                          required></textarea>
                <span for="input_obj" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('objeto') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Tipo de compra*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="tipo_contrato">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('tipo_contrato') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Alcance*</small>
            <div class="display-flex ml-4">
                <textarea id="input_alc" name="alcance" class="validate materialize-textarea" type="text"
                          required></textarea>
                <span for="input_obj" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('alcance') }}</label>
            </div>
        </div>

    </div>
    <!-- Termina información inicial-->
    <hr/>
    <!-- Segundo div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small>Fecha inicio*</small>
            <div class="display-flex ml-4">
                <input id="input_fechinicio" name="fecha_inicio" class="validate datepicker" type="date"
                       data-length="10" required>
                <span for="input_fechinicio" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fecha_inicio') }}</label>
            </div>
        </div>

        <div class="input-field col s12 m4">
            <small>Fecha finalización*</small>
            <div class="display-flex ml-4">
                <input id="input_fechfinal" name="fecha_final" class="validate datepicker" required>
                <span for="input_fechfinal" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('fecha_final') }}</label>
            </div>
        </div>

    </div>
    <!-- Termina segundo div -->
    <hr>
    <!-- Tercer div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small class="active">Administrador del contrato</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="administrador_contrato">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('administrador-contrato') }}</label>
            </div>
        </div>

        <div class="input-field col s12 m4">
            <small class="active">Puesto</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="puesto">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('puesto') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Líder del servicio</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="lider_servicio">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('tipo_contrato') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small>Descripción del servicio</small>
            <div class="display-flex ml-4">
                <textarea id="input_descserv" name="descripcion_servicio" class="validate materialize-textarea"
                          type="text"></textarea>
                <span for="input_obj" class="helper-text" data-error="¡Incorrecto!" data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('descripcion_servicio') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Nombre del proveedor*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="nombre_proveedor" required>
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('nombre_proveedor') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Responsable por el proveedor*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="responsable_proveedor" required>
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('responsable_proveedor') }}</label>
            </div>
        </div>
    </div>
    <!-- Termina tercer div -->
    <hr>
    <!-- Cuarto div-->
    <div class="row mb-4">
        <div class="input-field col s12 m4">
            <small class="active">Monto total con IVA*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="monto_total">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_total') }}</label>
            </div>
        </div>

        <div class="input-field col s12 m4">
            <small>Monto con IVA en letra*</small>
            <div class="display-flex ml-4">
                <textarea id="input_montoiva" name="monto_iva_letra" class="validate materialize-textarea" type="text"
                          required></textarea>
                <span for="input_montoiva" class="helper-text" data-error="¡Incorrecto!"
                      data-success="¡Correcto!"></span>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_iva_letra') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Monto sin IVA*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="monto_sin_iva">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_sin_iva') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Monto IVA %*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="monto_iva_porcentaje">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('monto_iva_porcentaje') }}</label>
            </div>
        </div>
        <div class="input-field col s12 m4">
            <small class="active">Partida presupuestal*</small>
            <div class="display-flex ml-4">
                <select class="validate" required="" aria-required="true" name="partida_presupuestal">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <div class="display-flex ml-4">
                <label class="red-text">{{ $errors->first('partida_presupuestal') }}</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col s12">
            <button class="btn btn-right blue" type="submit">Enviar</button>
            <a onClick="window.location.reload();" class="btn btn-default">Refrescar</a>
        </div>
    </div>
</div>
