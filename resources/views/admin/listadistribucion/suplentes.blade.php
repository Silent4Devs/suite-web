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
                <p style="text-align:justify">
                    @if ($lista->modelo == 'OrdenCompra')
                        En esta sección define un <br>
                        reponsable de aprobar las Ordenes de Compra para continuar <br>
                        con el flujo.
                    @elseif ($lista->modelo == 'KatbolRequsicion')
                        En esta sección define un segundo reponsable<br>
                        encargado de aprobar las Requisiciones para continuar <br>
                        con el flujo.
                    @endif
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
                        <label for="superaprobadores" style="color:#057BE2;">Responsable</label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <p>Selecciona de la lista los nombres de los colaboradores que podrán firmar en caso de que el
                    responsable no esté disponible.</p>
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
                        <label for="niveles" style="color:#057BE2;">Seleccione el número de colaboradores.</label>
                    </div>
                </div>
                <div>
                    @error('nivel_null')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @for ($i = 1; $i < 6; $i++)
                        <div class="form-row nivel{{ $i }}Div" style="display: none;">
                            <div class="mt-4 mb-1">
                                <i class="fas fa-circle" style="color: #007bff;"></i>
                                Sustituto
                                {{ $i }}
                                <br>
                                <div class="row">
                                    Asigna al colaborador que servira como suplente en caso de que el
                                    responsable no se encuentre disponible.
                                </div>
                                <div class="row">
                                    La primera posición que asigne será la responsable de firmar u rechazar la
                                    ordenen de compra la segunda y/o tercera posición del colaborador que asigne en el
                                    mismo
                                    campo sólo serán notificadas por correo en copia.
                                </div>
                            </div>
                            <div class="mt-4 col-12">
                                <div class="anima-focus">
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
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
