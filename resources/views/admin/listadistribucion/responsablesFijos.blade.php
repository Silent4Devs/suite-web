<style>
    .form-row[class*="nivel"] {
        display: block !important;
    }
</style>

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

            <input name="niveles" id="niveles" type="hidden" value="{{ $lista->niveles }}">

            <div class="col-12">
                <br>
                <br>

                <div>
                    @for ($i = 1; $i <= $lista->niveles; $i++)

                        @php
                            $comprador = \App\Models\Empleado::select('id', 'name', 'foto')
                                ->where('id', $participantes_seleccionados['nivel' . $i][0]['empleado_id'])
                                ->first();
                        @endphp

                        <div class="form-row nivel{{ $i }}Div">
                            <div class="mt-4 mb-1">
                                <i class="fas fa-circle" style="color: #007bff;"></i> Nivel {{ $i }}
                                <br>
                                &nbsp; &nbsp; Asigna a los colaboradores que deben aprobar para pasar al
                                siguiente
                                nivel.
                            </div>
                            <div class="row">
                                <div class="mt-4 col-3">
                                    <h6>Comprador:</h6>
                                    {{ $comprador->name }}
                                </div>
                                <div class="mt-4 col-9">
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
                                        <label for="nivel{{ $i }}"
                                            style="color:#057BE2;">Colaboradores</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
