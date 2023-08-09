<div>
    <div class="px-4 py-3">
        @forelse ($section->lessons as $item)
            <article class="mb-1 bg-white rounded shadow" x-data="{ open: false }">
                @if ($lesson->id == $item->id)
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
                        <div class="flex justify-end gap-2">
                            <button wire:click="cancel" type="button" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                                Cancelar
                            </button>
                            <x-jet-danger-button style="background-color:#333" type="submit"  >
                              Actualizar
                            </x-jet-danger-button>
                        </div>
                    </form>
                @else
                    <header>
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2 text-left rounded focus:ring-2 focus:ring-gray-300 focus:outline-none">
                            <div>
                                <i style="font-size:10pt" class="text-black-500 fas fa-play-circle"></i>
                                {{ $item->name }}
                            </div>
                            <svg class="inline h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </header>
                    <div class="px-3 py-2 border-t border-gray-100" x-show="open">
                        <ul>
                            <li><b>Plataforma:</b> {{ $item->platform->name }}</li>
                            <li><b>Enlace:</b> <a href="{{ $item->url }}" class="text-gray-400 underline"
                                    target="_blank">{{ $item->url }}</a></li>
                        </ul>
                        <div class="px-6 pt-3 text-right bg-gray-100">
                            <a wire:click="edit({{ $item }})" style="cursor: pointer">
                                <i style="font-size:10pt" class="ml-1 text-blue-500 cursor-pointer fas fa-edit" title="Editar"></i>
                            </a>
                            <a wire:click="destroy({{ $item }})" style="cursor: pointer">
                                <i style="font-size:10pt; color:red;" class="ml-2 fas fa-trash" title="Eliminar" ></i>
                            </a>
                            {{-- <button wire:click="destroy({{ $item }})" class="btn btn-red"
                                type="button">Eliminar</button> --}}
                        </div>

                        <div class="mb-3">
                            @livewire('instructor.lesson-description', ['lesson' => $item], key('lesson-description' . $item->id))
                        </div>
                        <div class="mb-3">
                            @livewire('instructor.lesson-resources', ['lesson' => $item], key('lesson-resource' . $item->id))
                        </div>
                    </div>
                @endif

            </article>
        @empty
            <div class="text-center">
                Aun no hay lecciones en esta sección
            </div>
        @endforelse

        {{-- add new lesson --}}
        <div class="mt-4" x-data="{ open: false }">
            <div class="mb-3 ">
                <button class="btn" type="button"
                    @click="open = true; if (open) $nextTick(()=>{ $refs.lessonName.focus() });" x-show="!open">
                    <i class="fas fa-plus"></i> Agregar nueva lección
                </button>
            </div>
            <article class="px-4 py-3 mb-3 bg-white rounded shadow" x-show="open">
                <h1 class="mb-3 text-lg font-bold">Nueva lección</h1>
                <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                    <label for="name-{{ $section->id }}">Nombre</label>
                    <div class="md:col-span-5">
                        <input wire:model="name" id="name-{{ $section->id }}" x-ref="lessonName" type="text"
                            class="w-full form-input @if ($errors->has('name')) invalid @endif">
                        @error('name')
                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                        @enderror
                    </div>
                </div>
                <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                    <label for="platform-{{ $section->id }}">Plataforma</label>
                    <div class="md:col-span-5">
                        <select wire:model="platform_id" id="platform-{{ $section->id }}" type="text"
                            class=" w-full form-input @if ($errors->has('platform_id')) invalid @endif">
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                        @error('platform_id')
                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                        @enderror
                    </div>
                </div>
                <div class="grid items-center mb-2 grid-col-1 md:grid-cols-6 md:gap-3">
                    <label for="url-{{ $section->id }}">URL</label>
                    <div class="md:col-span-5">
                        <input wire:model="url" id="url-{{ $section->id }}" type="text"
                            class=" w-full form-input @if ($errors->has('url')) invalid @endif">
                        @error('url')
                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <x-jet-danger-button wire:click="cancel" @click="open = false" type="button" style="background-color:white"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                    Cancelar</x-jet-danger-button>
                    <x-jet-button wire:click="store" style="background-color:#333">Crear</x-jet-button>
                </div>
            </article>
        </div>
    </div>

</div>
