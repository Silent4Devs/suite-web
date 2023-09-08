<div class="row" style="margin: 0;">

</div>
<div style=" overflow: hidden; overflow-y:auto; max-height: 250px !important;">

    <table class="table" style="margin-top: 30px; margin-left: 20px; margin-right: 20px;">
        <thead>
            <tr>
                <th style="vertical-align:top; max-width: 50px;">
                    <p class="grey-text letra-ngt">No de revisión</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Estatus</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Cumple</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Fecha de realización</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Asignado</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Hallazgos/Comentarios</p>
                </th>
                <th style="vertical-align:top">
                    <p class="grey-text letra-ngt">Opciones</p>
                </th>
            </tr>
        </thead>
        <tbody style="">
            @php
                $contador = 0;
            @endphp
            @forelse($consultaRevisiones as $revision)
                @php
                    $contador++;
                @endphp
                <tr>
                    <td>
                        {{ $contador }}
                    </td>

                    <td>
                        {{ $revision->estatus }}
                    </td>
                    <td>
                        @if ($revision->cumple)
                            <i class="material-icons green-text">check</i>
                        @else
                            <i class="material-icons red-text">close</i>
                        @endif
                    </td>

                    <td>
                        {{ $revision->created_at }}
                    </td>

                    <td>
                        @if ($revision->asignado)
                            {{ $revision->asignado->name }}
                        @else
                            sin asignar
                        @endif
                    </td>

                    <td>
                        {{ $revision->observaciones }}
                    </td>
                    <td>
                        <button wire:click="revisionDelete({{ $revision->id }})" class="btn red">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Esta factura no tiene revisiones</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="input-field col s12 m4">
        <small>
            <p class="grey-text" style="font-size:17px;font-weight:bold;">
                No. revisión
            </p>
        </small>
        <div class="form-control" style="margin-top: 15px">{{ $no_revision }}</div>
        <input type="hidden" value="{{ $no_revision }}" name="no_revision" id="no_revision">
    </div>

    <div class="col s12 m4" wire:ignore>
        <div class="input-field col s12">
            <small>
                <p class="grey-text" style="font-size:17px;font-weight:bold;">
                    Estatus<font class="asterisco">*
                    </font>
                </p>
            </small>
            <select name="estatus" id="estatus" class="form-control" wire:model.defer="estatus"
                style="opacity:1 !important;">
                <option value="" disabled selected>Elige una opción</option>
                <option value="recibido">Recibido</option>
                <option value="progreso">Progreso</option>
                <option value="pagada">Pagada</option>
            </select>
        </div>
        @error('estatus')
            <span class="red-text" style="margin-left: 9px">{{ $message }}</span>
        @enderror
    </div>

    <div class="col s12 m4" wire:ignore>
        <div class="input-field col s12">
            <small>
                <p class="grey-text" style="font-size:17px;font-weight:bold;">
                    Asignado<font class="asterisco">*
                    </font>
                </p>
            </small>
            <select name="asignado_id" id="asignado_id" class="form-control" wire:model.defer="asignado_id"
                style="opacity:1 !important;">
                <option value="" disabled selected>Elige una opción</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div wire:ignore class="input-field col s12 m4">
        <small>
            <p class="grey-text" style="font-size:17px;font-weight:bold; margin-top:15px">
                Cumple<font class="asterisco">
                    *</font>
            </p>
        </small>
        <br>
        <div class="switch">
            <label>
                No
                <input type="checkbox" id="cumple" name="cumple" wire:model.defer="cumple">

                <span class="lever"></span>
                Si
            </label>
        </div>
    </div>
    <!-- Revisiones -->

</div>
<div class="row">
    <div class="input-field col s12 m12">
        <small>
            <p class="grey-text" style="font-size:17px;font-weight:bold;">
                Hallazgos / Comentarios</p>
        </small>
        <textarea class="form-control" type="text" name="hallazgos_comentarios" wire:model.defer="hallazgos_comentarios"
            class="text_area"></textarea>

        @error('hallazgos_comentarios')
            <span class="red-text">{{ $message }}</span>
        @enderror
    </div>
</div>
