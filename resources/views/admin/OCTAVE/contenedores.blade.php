

<div style="margin-top:80px !important;">

    <div class="row mt-3">
        <div class="col-sm-9 col-lg-9 col-md-9">
            <label for="nombre"> <i class="fas fa-box-open iconos-crear"></i>Nombre Contenedor</label>
            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                id="nombre_escenario" value="{{ old('indicador', '') }}">
                <small class="text-danger errores contenedor_error"></small>
        </div>

        <div class="col-sm-3 col-lg-3 col-md-3">
            <label for="nombre"><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo</label>
            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                id="nombre_escenario" value="{{ old('indicador', '') }}">
                <small class="text-danger errores riesgo_error"></small>
        </div>

    </div>



    <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
        <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción</label>
        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
            id="descripcion_escenario" >{{ old('descripcion', '') }}</textarea>
            <small class="text-danger errores descripcion_error"></small>
    </div>


    <div class="row  mt-3">
        <div class="form-group col-md-8 col-sm-8">
            <label for="confidencialidad"><i class="fas fa-camera-retro iconos-crear"></i>Escenario</label><br>
            <select class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
                name="confidencialidad" id="confidencialidad_escenario">
              <option>Seleccione una opción</option>
            </select>
            <small class="text-danger errores escenario_error"></small>
        </div>


    </div>

    <div class="row col-12">
        <div class="mb-3 col-12 mt-4 " style="text-align: end">
            <button type="button" name="btn-suscribir-contenedor" id="btn-suscribir-contenedor"
                class="btn btn-success">Agregar</button>
        </div>
    </div>

    <div class="row col-12">
        <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
            <table class="table w-100" id="contenedores_table" style="width:100%">
                <thead>
                    <tr>
                        <th>Contenedor</th>
                        <th>Riesgo</th>
                        <th>Descripción</th>
                        <th>Escenario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="contenedor_decontenedores">

                </tbody>
            </table>
        </div>
    </div>

</div>
