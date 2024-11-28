<div>
    {{-- <x-loading-indicator /> --}}
    <style>
        .fantasma {
            opacity: 0;
        }

        .sortable-chosen>.card-header {
            background-color: #15b6b9 !important;
        }

        .test {
            display: block !important;
        }
    </style>

    <h4>Lecciones</h4>
    <hr class="mt-2">
    {{-- @dump($course->order_section) --}}
    {{-- add new section --}}
    <div class="mt-2">
        <div class="d-flex justify-content-end" style="margin: 30px 0px;">
            <button class="btn btn-outline-primary advance" wire:click="store" type="button">
                AGREGAR NUEVA SECCIÓN <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div id="lista-secciones">
        @forelse($course->sections as $item)
            {{--  <div class="card shadow-none" x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">  --}}
            <div class="card shadow-none" id="seccion-{{ $item['id'] }}" data-id="seccion-{{ $item['id'] }}">
                @if ($section->id === $item['id'])
                    <div class="card-header" style="background: var(--color-tbj); color: #FFFFFF;">
                        <div class="row ">
                            <div class="col-10">
                                <form class="flex-1" wire:submit="update">
                                    <input wire:model="name" type="text"
                                        class="form-control w-full @if ($errors->has('section.name')) invalid @endif"
                                        placeholder="Escribir...">
                                    @error('section.name')
                                        <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- show section --}}
                    <div class="card-header"
                        style="background: var(--color-tbj); color: #FFFFFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
                        id="secction-show-{{ $item['id'] }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h3 class="mb-0">{{ $item->name }}</h3>
                            </div>
                            <div>
                                <i class="material-symbols-outlined drag-handle" style="cursor: move;">
                                    apps
                                </i>
                            </div>
                            <div class="">
                                <div wire:click="edit({{ $item }})" class="d-inline">
                                    <i style="font-size:10pt" class= "fas fa-edit mr-3"></i>
                                </div>
                                <div wire:click="destroy({{ $item }})" class="d-inline">
                                    <i style="font-size:10pt;" class="m-1 fa-regular fa-trash-can"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="secction-body-{{ $item['id'] }}">
                        @livewire('escuela.instructor.courses-lesson', ['section' => $item], key($item['id']))
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center">
                Este curso aun no tiene lecciones.
            </div>
        @endforelse
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    const lista = document.getElementById('lista-secciones');
    Sortable.create(lista, {
        animation: 150,
        choseClass: "seleccionado",
        handle: '.drag-handle',
        dragClass: "fantasma",

        ondEnd: () => {
            console.log();
        },
        group: "lista",
        store: {
            set: (sortable) => {
                let orden = sortable.toArray();
                @this.set('order', orden.join(','));
            },
            get: (sortable) => {
                if (@json($course->order_section)) {
                    return @json($course->order_section).split(',');
                }
            }
        },
    });
</script>
