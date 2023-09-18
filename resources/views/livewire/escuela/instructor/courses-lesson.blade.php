<div class="px-4 py-3">
    @forelse ($section->lessons as $item)
        <div class="card shadow-none">
            <div class="card-header row" style="border: 1px solid #D8D8D8;">
                <div class="col-10 d-flex align-items-center" style="padding: 0px;">
                    <a wire:click="edit({{ $item }})" style="cursor: pointer; color:#3086AF;">
                        <i style="font-size:10pt; cursor: pointer;"
                            class="d-inline fas fa-play-circle abirCollapse mr-2" data-toggle="collapse"
                            data-target="#miCollapse{{ $item->id }}" aria-expanded="false"></i>
                    </a>
                    <h5 class="d-inline" style="color:#3086AF; margin:0px">
                        {{ $item->name }}
                    </h5>
                    <div class="d-inline">
                        <a wire:click="destroy({{ $item }})" style="cursor: pointer">
                            <i style="font-size:10px;" class="m-1 fa-regular fa-trash-can" title="Eliminar" style="color:#747474"></i>
                        </a>
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-end">
                    <a wire:click="edit({{ $item }})" style="cursor: pointer; color:#3086AF;">
                        <i style="font-size: 20px; cursor: pointer;"
                            class="d-inline bi bi-caret-down-fill abirCollapse mr-2" data-toggle="collapse"
                            data-target="#miCollapse{{ $item->id }}" aria-expanded="false"></i>
                    </a>
                </div>
            </div>
            <div class="card-body collapse hide row" style="border: 1px solid #D8D8D8;" id="miCollapse{{ $item->id }}"
                wire:ignore>
                <form wire:submit.prevent="update" class="px-3 py-2 col-12">
                    <div class="grid mt-2 mb-2 grid-col-1 md:grid-cols-6 md:gap-2">
                        <label for="edit-lesson-name-{{ $section->id }}">Nombre</label>
                        <div class="md:col-span-5">
                            <input wire:model="lesson.name" id="edit-lesson-name-{{ $section->id }}" type="text"
                                class=" w-full form-control @if ($errors->has('lesson.name')) invalid @endif">
                            @error('lesson.name')
                                <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                            @enderror
                        </div>
                    </div>
                    <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                        <label for="edit-lesson-platform-{{ $section->id }}">Plataforma</label>
                        <div class="md:col-span-5">
                            <select wire:model="lesson.platform_id" id="edit-lesson-platform-{{ $section->id }}"
                                type="text"
                                class="w-full form-control @if ($errors->has('lesson.platform')) invalid @endif">
                                @foreach ($platforms as $platform)
                                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                @endforeach
                            </select>
                            @error('lesson.platform')
                                <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                            @enderror
                        </div>
                    </div>
                    <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                        <label for="edit-lesson-url-{{ $section->id }}">URL</label>
                        <div class="md:col-span-5">
                            <input wire:model="lesson.url" id="edit-lesson-url-{{ $section->id }}" type="text"
                                class="form-control w-full @if ($errors->has('lesson.url')) invalid @endif">
                            @error('lesson.url')
                                <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{-- <button style="background-color:#333" type="submit"  >
                                  Actualizar
                                </button> --}}
                        <button type="submit" class="btn btn-outline-primary"
                            style="min-width:140px;">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center">
            Aun no hay lecciones en esta sección
        </div>
    @endforelse

    @include('livewire.escuela.instructor.add-new-lesson')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let abrirCollapseButtons = document.querySelectorAll('i.abirCollapse');
            abrirCollapseButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Encuentra el collapse asociado al botón actual
                    let targetId = this.getAttribute('data-target');
                    let collapse = document.querySelector(targetId);
                    if (collapse.classList.contains('hide')) {
                        collapse.classList.remove('hide');
                    } else {
                        collapse.classList.add('hide');
                    }
                });
            });
        });
    </script>
</div>

{{-- <div id="miCollapse{{$item->id}}"  class="collapse hide">
</div> --}}

{{-- <div class="card shadow-none">
                            <div class="card-header" style="color:blue; border: 1px solid #D8D8D8;">
                                <i style="font-size:10pt" class="d-inline text-black-500 fas fa-play-circle" @click="open = !open"></i>
                                <h5 class="d-inline">
                                    {{ $item->name }}
                                </h5>
                                <div class="d-inline">
                                    <a wire:click="edit({{ $item }})" style="cursor: pointer" >
                                        <i style="font-size:10pt" class="ml-1 text-blue-500 cursor-pointer fas fa-edit" title="Editar"></i>
                                    </a>
                                    <a wire:click="destroy({{ $item }})" style="cursor: pointer">
                                        <i style="font-size:10pt; color:red;" class="ml-2 fas fa-trash" title="Eliminar" ></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body" x-show="open" style="border: 1px solid #D8D8D8;">
                                <div class="px-3 py-2 ">
                                    <ul>
                                        <li><b>Plataforma:</b> {{ $item->platform->name }}</li>
                                        <li><b>Enlace:</b> <a href="{{ $item->url }}" class="text-gray-400 underline"
                                                target="_blank">{{ $item->url }}</a></li>
                                    </ul>
                                    <div class="mb-3">
                                        @livewire('escuela.instructor.lesson-resources', ['lesson' => $item], key('lesson-resource' . $item->id))
                                    </div>
                                </div>
                            </div>
                        </div> --}}

{{-- @if ($lesson->id == $item->id)
                <div class="card-body" style="border: 1px solid #D8D8D8;">
                    <form wire:submit.prevent="update" class="px-3 py-2">
                        <div class="grid mt-2 mb-2 grid-col-1 md:grid-cols-6 md:gap-2">
                            <label for="edit-lesson-name-{{ $section->id }}">Nombre</label>
                            <div class="md:col-span-5">
                                <input wire:model="lesson.name" id="edit-lesson-name-{{ $section->id }}" type="text"
                                    class=" w-full form-input @if ($errors->has('lesson.name')) invalid @endif">
                                @error('lesson.name')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                            <label for="edit-lesson-platform-{{ $section->id }}">Plataforma</label>
                            <div class="md:col-span-5">
                                <select wire:model="lesson.platform_id" id="edit-lesson-platform-{{ $section->id }}"
                                    type="text" class="w-full form-input @if ($errors->has('lesson.platform')) invalid @endif">
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('lesson.platform')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                            <label for="edit-lesson-url-{{ $section->id }}">URL</label>
                            <div class="md:col-span-5">
                                <input wire:model="lesson.url" id="edit-lesson-url-{{ $section->id }}" type="text"
                                    class="form-input w-full @if ($errors->has('lesson.url')) invalid @endif">
                                @error('lesson.url')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                        </div>
                        <div class="flex justify-end gap-2">
                            <button wire:click="cancel" type="button" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                                Cancelar
                            </button>
                            <button style="background-color:#333" type="submit"  >
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="card-body" x-show="open" style="border: 1px solid #D8D8D8;">
                    {{$item}}
                </div>
            @endif --}}
