<div class="card shadow-none" x-data="{ open: false }">
    <div class="card-body">
        <div x-show="open">
            <hr class="my-2">
        </div>
        @if ($lesson->resource)
            <div class="mt-4 pl-4 d-flex justify-content-start align-items-center"
                style="min-height: 99px; border: 1px dashed #BEBEBE; border-radius: 2px;">
                <p><i wire:click="download" class="mr-2 cursor-pointer fas fa-download"
                        title="Descargar"></i>{{ $lesson->resource->url }}</p>
                <p class="ml-2">
                    <i wire:click="destroy" class="cursor-pointer fa-regular fa-trash-can" style="font-size:10.5pt;"
                        title="Eliminar"></i>
                </p>
            </div>
        @else
            {{-- <form wire:submit="save"> --}}
            <div class="flex items-center">
                <input wire:model.live="file" type="file" class="flex-1 form-input">
                <button type="button" wire:click="save" style="background-color:#333;"
                    class="inline-flex items-center px-4 py-2 mt-4 mb-4 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">Guardar</button>
            </div>
            <div class="mt-1 font-bold text-blue-500" wire:loading wire:target="file">
                Cargando ...
            </div>
            @error('file')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
            {{-- </form> --}}
        @endif
    </div>
</div>
