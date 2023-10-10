    <div style="margin-top:80px !important;" >

        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <label for="nombre"> <i class="fas fa-camera-retro iconos-crear"></i>Nombre Escenario</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre_escenario" value="{{ old('indicador', '') }}">
                    <small class="text-danger errores escenario_error"></small>
            </div>

            <div class="col-sm-12 col-lg-12 col-md-12 mt-4">
                <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                    id="descripcion_escenario" >{{ old('descripcion', '') }}</textarea>
                    <small class="text-danger errores descripcion_error"></small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-md-4 col-sm-12">
                <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label><br>
                <select class="form-control select2 {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
                    name="confidencialidad" id="confidencialidad_escenario">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <small class="text-danger errores confidencialidad_error"></small>
            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="disponibilidad"><i class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label><br>
                <select class="form-control select2 {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
                    name="disponibilidad" id="disponibilidad_escenario">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <small class="text-danger errores disponibilidad_error"></small>
            </div>


            <div class="form-group col-md-4 col-sm-12">
                <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label><br>
                <select class="form-control select2 {{ $errors->has('integridad') ? 'is-invalid' : '' }}" name="integridad"
                    id="integridad_escenario">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <small class="text-danger errores integridad_error"></small>
            </div>
        </div>


        <div class="form-group col-md-12 col-sm-12">
            <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Controles</label><br>
            <select
                class="form-control js-example-basic-multiple select2  {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                name="controles_id[]" id="select2-multiple-input-sm" multiple="multiple">
                <option value disabled>
                    Selecciona una opción</option>
                @foreach ($controles as $control)
                    <option value="{{ $control->id }}">
                        {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                    </option>
                @endforeach
            </select>
            <small class="text-danger errores controles_error"></small>
        </div>


        <div class="row col-12">
            <div class="mb-3 col-12 mt-4 " style="text-align: end">
                <button type="button" name="btn-suscribir-escenario" id="btn-suscribir-escenario"
                    class="btn btn-success">Agregar</button>
            </div>
        </div>

        <div class="row col-12">
            <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                <table class="table w-100" id="escenarios_table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Confidencialidad</th>
                            <th>Integridad</th>
                            <th>Disponibilidad</th>
                            <th>Controles</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenedor_escenarios">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


