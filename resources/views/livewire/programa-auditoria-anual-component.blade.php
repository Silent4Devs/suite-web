<div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
    <x-loading-indicator></x-loading-indicator>
    <!-- File Input -->
    <input type="file" wire:model.blur="documento">
    @error('documento')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <!-- Progress Bar -->
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" wire:click.prevent="save">Guardar</button>
    </div>


</div>
