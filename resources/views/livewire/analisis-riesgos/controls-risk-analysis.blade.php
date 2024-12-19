<div class="card" style="width: 100%; margin:0px;">
    <div class="card-body">
        {{-- {{$sheetId}} --}}
        @if ($sheetId)
            <div class="datatable-fix">
                <table class="table w-100 datatable datatable-risk-analysis-controls"
                    id="datatable-risk-analysis-controls">
                    <thead class="">
                        <tr>
                            <th>Control</th>
                            <th>Declaración de aplicabilidad</th>
                            <th>Aplica</th>
                            <th>Justificación</th>
                            <th style="width:100px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($controlsSheet as $index => $controlSheet)
                            <tr>
                                <td>
                                    {{ $controlSheet['control'] }} {{ $controlSheet['control_name'] }} {{$index}}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="applicability"
                                            id="flexCheckDefault-{{ $index }}"
                                            {{ $controlSheet['applicability'] ? 'checked' : '' }}
                                            wire:model.defer="controlsSheet.{{ $index }}.applicability">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $controlSheet['control'] }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class='d-flex gap-1'>
                                        <div>No</div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="customSwitch1-{{ $index }}"
                                                wire:model.defer="controlsSheet.{{ $index }}.is_apply">
                                            <label class="custom-control-label"
                                                for="customSwitch1-{{ $index }}">Sí</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea style="min-height: 70px;" class="form-control" name="justify" id="justify"
                                            wire:model.defer="controlsSheet.{{ $index }}.justification">{{ $controlSheet['justification'] }}</textarea>
                                    </div>
                                </td>
                                <td>
                                    @if ($controlSheet['fileStatus'])
                                        <div class="mt-4 pl-4 d-flex justify-content-start align-items-center"
                                            style="">
                                            <p><i wire:click="download('{{ $controlSheet['file'] }}')"
                                                    class="mr-2 cursor-pointer fas fa-download" title="Descargar"></i>
                                            </p>
                                            <p class="ml-2">
                                                <i wire:click="deleteFile('{{ $index }}')"
                                                    class="cursor-pointer fa-regular fa-trash-can" style=""
                                                    title="Eliminar"></i>
                                            </p>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <input type="file" name="file-{{ $index }}"
                                                id="file-{{ $index }}" style="display: none;"
                                                wire:model.defer="controlsSheet.{{$index }}.file" />
                                            <label for="file-{{ $index }}">
                                                <span class="material-symbols-outlined">
                                                    attach_file
                                                </span>
                                                <span>{{$controlSheet['file'] ? $controlSheet['file']->getClientOriginalName() : ''}}</span>
                                            </label>
                                            @if($controlSheet['file'])
                                                <i wire:click="deleteFile('{{ $index }}')"
                                                class="cursor-pointer fa-regular fa-trash-can" style=""
                                                title="Eliminar"></i>
                                                @endif

                                        </div>
                                        <div class="mt-1 font-bold text-blue-500" wire:loading
                                            wire:target="controlsSheet.{{ $index }}.file">
                                            Cargando ...
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <button type="button" wire:click="saveTable" id="submitControls" class="btn tb-btn-primary">GUARDAR
            CONTROLES</button>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
    console.log("component load")
        // Livewire.hook('message.processed', (component) => {
    //     console.log(`Componente ${component.fingerprint.name} listo para escuchar eventos.`);
    // });
});
</script>
