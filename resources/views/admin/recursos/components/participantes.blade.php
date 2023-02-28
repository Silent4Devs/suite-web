<div class="my-3">
    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="selectGrupoDeParticipantes"><i class="fas fa-search iconos-crear"></i>Selecciona a los
                participantes por: </label>
            <select id="selectGrupoDeParticipantes" name="tipo_de_grupo" class="form-control">
                <option value="">-- Selecciona un opción --</option>
                <option value="all"
                    {{ $recurso->tipo_seleccion_participantes ? ($recurso->tipo_seleccion_participantes->tipo == 'all' ? 'selected' : '') : '' }}>
                    Toda
                    la
                    organización</option>
                <option value="area"
                    {{ $recurso->tipo_seleccion_participantes ? ($recurso->tipo_seleccion_participantes->tipo == 'area' ? 'selected' : '') : '' }}>
                    Área
                </option>
                <option value="grupo"
                    {{ $recurso->tipo_seleccion_participantes ? ($recurso->tipo_seleccion_participantes->tipo == 'grupo' ? 'selected' : '') : '' }}>
                    Grupo
                </option>
                <option value="individual"
                    {{ $recurso->tipo_seleccion_participantes ? ($recurso->tipo_seleccion_participantes->tipo == 'individual' ? 'selected' : '') : '' }}>
                    Individualmente
                </option>
                @if ($recurso->id)
                    <option value="almacenada">Selección almacenada en DB</option>
                @endif
            </select>
            <span class="text-danger errores tipo_de_grupo_error"></span>
            <div id="contenedorDesicion" class="mt-3"></div>
        </div>
        {{-- <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
            <input class="form-control" type="text" id="emailParticipante" placeholder="Correo del participante"
                readonly style="cursor: not-allowed" />
        </div> --}}
        {{-- <div class="col-12" style="text-align: end;">
            <button id="btnAgregarParticipante" class="btn btn-success">Añadir</button>
        </div> --}}
        <div class="col-12 mt-3">
            <div id="sinParticipantes" class="col-12 text-center">
                <span class="text-danger errores participantes_error"></span>
                <p><strong>Sin Participantes</strong></p>
                <img src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="sin participante" width="250">
            </div>
            <div class="row" id="contenedorParticipantesCargados"></div>
            <div class="row" id="contenedorParticipantes"></div>
        </div>
    </div>
</div>
<div class="text-right form-group col-12">
    <a href="{{ route('admin.recursos.index') }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger btnGuardarDraftRecurso" type="submit" id="btnGuardarDraftRecurso">
        Borrador
    </button>
</div>
@include('admin.recursos.components.js.participantes-scripts')
