<div class="card" x-data="{open: false}">
    <div class="card-body">
        <header>
            <h1 x-on:click="open = !open" class="cursor-pointer">Recursos de la lección</h1>
        </header>

        <div x-show="open">
            <hr class="my-2">
        </div>
            @if ($lesson->resource)
                <div class="flex items-center justify-between">
                    <p><i wire:click="download" class="mr-2 text-blue-500 cursor-pointer fas fa-download"></i>{{$lesson->resource->url}}</p>
                    <i wire:click="destroy" class="cursor-pointer fas fa-trash" style="color:red; font-size:10.5pt;"></i>
                </div>
            @else
            <form wire:submit.prevent="save">
                <div class="flex items-center">
                    <input wire:model="file" type="file" class="flex-1 form-input">
                    <button type="submit" style="background-color:#333;"
                    class="inline-flex items-center px-4 py-2 mt-4 mb-4 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"
                    >Guardar</button>
                </div>
                <div class="mt-1 font-bold text-blue-500" wire:loading wire:target="file">
                    Cargando ...
                </div>
                @error('file')
                    <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
            </form>
        @endif
    </div>
</div>
