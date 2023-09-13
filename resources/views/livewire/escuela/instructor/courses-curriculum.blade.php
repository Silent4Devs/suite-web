
<div>

    <h4>Lecciones</h4>
    <hr class="mt-2">

    {{-- add new section --}}
    <div class="mt-2" x-data="{open: false}">
        <div class="d-flex justify-content-end" style="margin: 30px 0px;">
            <button class="btn advance" wire:click="store" type="button">
                AGREGAR NUEVA SECCIÓN <i class="fas fa-plus"></i>

            </button>
        </div>
    </div>
    @forelse($course->sections as $item)
        <div class="card shadow-none" x-data="{open: {{ ($loop->first ? 'true' : 'false') }} }">
            @if ($section->id == $item->id)
                <div class="card-header" style="background: #306BA9; color: #FFFFFF;">
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
                <div class="card-header" style="background: #306BA9; color: #FFFFFF; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="row ">
                        <div class="col-10 d-flex justify-content-start align-items-center">
                            <h3 class="mb-0">{{ $item->name }}</h3>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-center">
                                <div wire:click="edit({{ $item }})" class="d-inline">
                                    <i style="font-size:10pt" class= "fas fa-edit mr-3"></i>
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

</div>

