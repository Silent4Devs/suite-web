<div>
    @if ($mostrarLista)
        <a href="{{ $recurso->ruta_lista_asistencia }}" target="_blank">
            <img src="{{ asset('img/lista-de-asistentes.png') }}" alt="Lista de Asistencia" width="30"
                style="width:30px;">
            <span>{{ $recurso->lista_asistencia }}</span>
        </a>
        <p style="cursor: pointer" wire:click="remove"><i class="fas fa-trash mr-2"></i>Remover</p>
        <p wire:loading wire:target="remove"><i class="fas fa-circle-notch fa-spin"></i> Eliminando</p>
    @else
        <table class="w-100">
            <tbody>
                <tr>
                    <td class="d-flex align-items-start justify-content-center">
                        <div>
                            <label class="m-0" for="listaA" style="cursor: pointer"><img
                                    src="{{ asset('img/lista-de-asistentes.png') }}" alt="Lista de Asistencia"
                                    width="30" style="width:30px;">
                                <span id="textoLista" wire:ignore>Subir lista de asistencia</span>
                            </label>
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <input type="file" wire:model.live="lista" id="listaA" class="d-none">
                                @error('lista') <small class="error text-danger">{{ $message }}</small> @enderror
                                <!-- Progress Bar -->
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                            <p wire:loading wire:target="save"><i class="fas fa-circle-notch fa-spin"></i> Guardando</p>
                        </div>
                        <button style="background: #345183;color: white;margin-left: 10px;" type="submit"
                            wire:click="save" class="btn btn-sm" wire:loading.attr="disabled"><i
                                class="fas fa-save mr-2"></i>Guardar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        document.getElementById('listaA').addEventListener('change', function(e) {
            const file = this.files[0];
            document.getElementById('textoLista').innerHTML = file.name;
        })

        window.livewire.on('listaGuardada', function(e) {
            toastr.success('Lista de asistencia cargada');
        })
        window.livewire.on('listaEliminada', function(e) {
            console.log(e);
            if (e.estatus == 200) {
                @this.set('lista', null);
                toastr.success(e.mensaje);
            }

            if (e.estatus == 500) {
                toastr.error(e.mensaje);
            }
        })
    })
</script>
