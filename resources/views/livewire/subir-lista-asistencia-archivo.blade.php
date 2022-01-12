<div>
    @if ($mostrarLista)
        <a href="{{ $recurso->ruta_lista_asistencia }}" target="_blank">
            <img src="{{ asset('img/lista-de-asistentes.png') }}" alt="Lista de Asistencia">
            <span>{{ $recurso->lista_asistencia }}</span>
        </a>
        <p style="cursor: pointer" wire:click="remove"><i class="fas fa-trash mr-2"></i>Remover</p>
        <p wire:loading wire:target="remove"><i class="fas fa-circle-notch fa-spin"></i> Eliminando</p>
    @else
        <label for="listaA" style="cursor: pointer"><img src="{{ asset('img/lista-de-asistentes.png') }}"
                alt="Lista de Asistencia">
            <span id="textoLista" wire:ignore>Seleccionar lista de asistencia</span>
        </label>
        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <!-- File Input -->
            <input type="file" wire:model="lista" id="listaA" class="d-none">
            @error('lista') <span class="error">{{ $message }}</span> @enderror
            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
        <p wire:loading wire:target="save"><i class="fas fa-circle-notch fa-spin"></i> Guardando</p>
        <button type="submit" wire:click="save" class="btn btn-success" wire:loading.attr="disabled">Guardar</button>
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
