<div class="card">
    <div class="card-body">
        <h4 style="color:#057BE2; title-table-rds">Módulo asignado</h4>
        <hr>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="anima-focus">
                    <input class="form-control" id="modulo" name="modulo" type="text" value="{{ $lista->modulo }}"
                        placeholder="" disabled>
                    <label for="modulo">Módulo</label>
                </div>
            </div>
            <div class="col-6">
                <div class="anima-focus">
                    <input class="form-control" id="submodulo" name="submodulo" type="text"
                        value="{{ $lista->submodulo }}" placeholder="" disabled>
                    <label for="modulo">Submódulo</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 style="color:#057BE2; title-table-rds">Configuración Listas de Aprobación</h4>
        <hr>
        <div class="row g-0">
            <div class="col-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                <p style="text-align:justify">Esta sección permite que las personas <br> seleccionadas puedan
                    autorizar el flujo en <br> cualquier
                    momento, sin requerir la aprobación <br> de los niveles seleccionados.
                </p>

                <div class="col-8">
                    <div class="anima-focus">
                        <select id="superaprobadores" name="superaprobadores[]" class="form-control" multiple="multiple"
                            placeholder="">
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}" data-avatar="{{ $empleado->avatar }}">
                                    {{ $empleado->name }}</option>
                            @endforeach
                        </select>
                        <label for="superaprobadores" style="color:#057BE2;">Super Aprobadores</label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <p>Seleccione cuantos niveles de aprobación tendra tu lista, para poder asignar por cada nivel
                    el
                    numero
                    de colaboradores que se requiera.</p>
                <br>
                <br>

                <div class="row mb-4">
                    <div class="anima-focus">
                        <select id="niveles" name="niveles" class="form-control" placholder="">
                            <option value={{ $lista->niveles }} selected>{{ $lista->niveles }}</option>
                            @for ($i = 1; $i < 6; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <label for="niveles" style="color:#057BE2;">Seleccione los niveles</label>
                    </div>
                </div>
                <div>
                    @error('nivel_null')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-row nivel{{ $i }}Div" style="display: none;">
                            <div class="mt-4 mb-1">
                                <i class="fas fa-circle" style="color: #007bff;"></i> Nivel {{ $i }}
                                <br>
                                &nbsp; &nbsp; Asigna a los colaboradores que deben aprobar para pasar al
                                siguiente
                                nivel.
                            </div>
                            <div class="anima-focus" style="width: 100rem;">
                                <select id="nivel{{ $i }}" name="nivel{{ $i }}[]"
                                    class="form-control" multiple="multiple">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}"
                                            data-avatar="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                            {{ in_array($empleado->id, $nivelData[$i - 1] ?? []) ? 'selected' : '' }}>
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="nivel{{ $i }}" style="color:#057BE2;">Colaboradores</label>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
