<div>
    <article class="card" x-data="{open:false}">
        <div class="bg-gray-100 card-body">
            <header>
                <h1 x-on:click="open = !open" class="cursor-pointer">Descripción de la lección</h1>
            </header>
            <div x-show="open">
                <hr class="my-2">

                @if ($lesson->description)
                    <form wire:submit="update">
                        <textarea wire:model.live="description.name" class="w-full form-input"></textarea>

                        @error('description.name')
                            <span class="text-sm text-red-500">{{$message}}</span>
                        @enderror

                        <div class="flex justify-end">
                            <button wire:click="destroy" class="text-sm btn btn-danger" style="color:white; background-color:red"
                             class="inline-flex items-center px-4 py-2 mt-4 mb-4 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"
                            type="button">Eliminar</button>
                            <button style="background-color:#333" class="inline-flex items-center px-4 py-2 mt-4 mb-4 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"
                            type="submit">Actualizar</button>
                        </div>
                    </form>
                @else
                    <div>
                        <textarea wire:model.live="name" class="w-full form-input" placeholder="Agregue una descripción de la lección"></textarea>

                        @error('name')
                            <span class="text-sm text-red-500">{{$message}}</span>
                        @enderror

                        <div class="flex justify-end">
                            <button wire:click="store" style="background-color:#333"
                            class="inline-flex items-center px-4 py-2 mt-4 mb-4 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                             Agregar</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </article>
</div>
