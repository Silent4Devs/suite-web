<div>
    <div class="container">
        @include('admin.recursos-humanos.evaluacion-360.competencias._form')
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 300px">
            <h4 class="text-center text-muted" style="border-bottom: 2px solid #345183;">Niveles</h4>
        </div>
    </div>
    <div class="container">
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 tblNiveles">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            Nivel
                        </th>
                        <th style="vertical-align: top">
                            Conducta Esperada
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="d-flex justify-content-center">
                <div style="width: 300px">
                    <h4 class="text-center text-muted" style="border-bottom: 2px solid #345183;">Asignación</h4>
                </div>
            </div>
            <div>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                        {{ old('toda_la_empresa', $competencia->toda_la_empresa) ? 'checked' : '' }} name="toda_la_empresa"
                        type="checkbox" id="toda_la_empresa">
                    <label class="form-check-label" for="toda_la_empresa">¿Desea asignar a toda la empresa?</label>
                </div>
                <span id="niveles_cargando" class="d-none"><i class="fas fa-circle-notch fa-spin"></i>
                    Cargando niveles</span>
                <div class="mt-2" id="nivel_esperado_contenedor">

                </div>
            </div>
        </div>
    </div>
</div>
