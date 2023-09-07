
<div>

    <h4>Lecciones</h4>
    <hr class="mt-2">

    {{-- add new section --}}
    <div class="mt-2" x-data="{open: false}">
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-outline-primary" wire:click="store" type="button">
                AGREGAR NUEVA SECCIÓN <i class="fas fa-plus"></i>
                {{-- <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg> Agregar nueva sección --}}
            </button>
        </div>
        {{-- <article class="px-4 py-3 mb-3 rounded shadow bg-gray-50" x-show="open">
            <h1 class="mb-3 text-lg font-bold">Nueva sección</h1>
            <div class="flex flex-wrap gap-2 mb-3">
                <div class="flex-1">
                    <input wire:model="name" x-ref="nameInput" type="text" class="form-input w-full @if($errors->has('name')) invalid @endif" placeholder="Nombre de la sección">
                    @error('name')
                        <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <div>
                    <div class="flex gap-2">
                        <button class="btn" @click="open = false" wire:click="resetName">Cancelar</button>
                        <button class="btn btn-blue" wire:click="store">Guardar</button>
                    </div>
                </div>
            </div>
        </article> --}}
    </div>

    @forelse($course->sections as $item)
        <div class="card shadow-none" x-data="{open: {{ ($loop->first ? 'true' : 'false') }} }">
            @if ($section->id == $item->id)
                {{-- edit section --}}
                {{-- <p class="p-3">Presiona la tecla enter para guardar el cambio en la sección</p> --}}
                {{-- <header class="flex items-center justify-between px-4 py-3">
                    <form class="flex-1" wire:submit.prevent="update">
                        <input wire:model="section.name" type="text" class="form-control w-full @if($errors->has('section.name')) invalid @endif" placeholder="Escribir...">
                        @error('section.name')
                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                        @enderror
                    </form>
                </header> --}}
                <div class="card-header" style="background: #306BA9; color: #FFFFFF">
                    <div class="row ">
                        <div class="col-10">
                            <form class="flex-1" wire:submit.prevent="update">
                                <input wire:model="section.name" type="text" class="form-control w-full @if($errors->has('section.name')) invalid @endif" placeholder="Escribir...">
                                @error('section.name')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- show section --}}
                <div class="card-header" style="background: #306BA9; color: #FFFFFF">
                    <div class="row ">
                        <div class="col-10">
                            <h3>{{ $item->name }}</h3>
                        </div>
                        <div class="col-2">
                                <div wire:click="edit({{ $item }})" class="d-inline">
                                    <i style="font-size:10pt" class= "fas fa-edit"></i>
                                </div>
                                <div wire:click="destroy({{ $item }})" class="d-inline">
                                    <i style="font-size:10pt;" class="m-1 fa-regular fa-trash-can"></i>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @livewire('escuela.instructor.courses-lesson', ['section' => $item], key($item->id))
                </div>
            @endif
        </div>
    @empty
    <div class="text-center">
        Este curso aun no tiene lecciones.
    </div>
    @endforelse

    {{-- add new section --}}
    {{-- <div class="mt-4" x-data="{open: false}">
        <div class="mb-3 text-center">
            <button class="btn btn-green" type="button" @click="open = true; if (open) $nextTick(()=>{ $refs.nameInput.focus() });" x-show="!open">
                <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg> Agregar nueva sección
            </button>
        </div>
        <article class="px-4 py-3 mb-3 rounded shadow bg-gray-50" x-show="open">
            <h1 class="mb-3 text-lg font-bold">Nueva sección</h1>
            <div class="flex flex-wrap gap-2 mb-3">
                <div class="flex-1">
                    <input wire:model="name" x-ref="nameInput" type="text" class="form-input w-full @if($errors->has('name')) invalid @endif" placeholder="Nombre de la sección">
                    @error('name')
                        <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                    @enderror
                </div>
                <div>
                    <div class="flex gap-2">
                        <button class="btn" @click="open = false" wire:click="resetName">Cancelar</button>
                        <button class="btn btn-blue" wire:click="store">Guardar</button>
                    </div>
                </div>
            </div>
        </article>
    </div> --}}

</div>

