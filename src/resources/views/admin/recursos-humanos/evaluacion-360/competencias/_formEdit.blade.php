<div>
    <div class="container">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            COMPETENCIA
        </div>
        @include('admin.recursos-humanos.evaluacion-360.competencias._form')
        <div>
            <div class="pl-0 form-check form-switch">
                <label class="container-check">Asignar esta competencia a todos los
                    empleados de la organización
                    <input class="form-check-input"
                        {{ old('toda_la_empresa', $competencia->toda_la_empresa) ? 'checked' : '' }}
                        name="toda_la_empresa" type="checkbox" id="toda_la_empresa">
                    <span class="checkmark"></span>
                </label>
                {{-- <label class="form-check-label" for="toda_la_empresa"></label> --}}
            </div>
            <span id="niveles_cargando" class="d-none"><i class="fas fa-circle-notch fa-spin"></i>
                Cargando niveles</span>
            <div class="mt-2" id="nivel_esperado_contenedor">

            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            CONDUCTAS ESPERADAS
        </div>
        <div class="px-1 py-2 mb-3 rounded" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                    </p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Ahora define las conductas
                        esperadas de esta
                        competencia, iniciando por el nivel más básico.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="datatable-fix">
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
        </div>
    </div>
</div>
