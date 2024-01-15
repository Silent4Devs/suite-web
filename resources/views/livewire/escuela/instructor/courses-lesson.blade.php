<div class="px-4 py-3">

    @forelse ($section->lessons as $item)

        <div class="card shadow-none " x-data="{ isOpen: false }" id="card{{$item->id}}" style="border: 1px solid #D8D8D8; border-radius:16px;">
            <div class="card-header " style="border: none;">
                <div class="row">
                    <div class="col-11 d-flex align-items-baseline" style="padding: 0px;">
                        <button @click="isOpen = !isOpen" wire:click="edit({{ $item }})" style="cursor: pointer; color:#3086AF; border: none; background:none;" id="link{{$item->id}}" class="mr-1">
                            <i style="font-size:14px; cursor: pointer;"
                                class="d-inline fas fa-play-circle openCollapse" id="toggleButton{{$item->id}}" ></i>
                        </button>
                        <h5 class="d-inline" style="color:#3086AF;">
                            {{ $item->name }}
                        </h5>
                        <div class="d-inline">
                            <a wire:click="destroy({{ $item }})" style="cursor: pointer">
                                <i style="font-size:16px;" class="ml-2 fa-regular fa-trash-can" title="Eliminar" style="color:#747474"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <button @click="isOpen = !isOpen" wire:click="edit({{ $item }})"
                            style="cursor: pointer; color:#3086AF; border: none; background:none;"
                            id="2link{{ $item->id }}">
                            <i style="font-size: 20px; cursor: pointer;" class="d-inline bi bi-caret-down-fill openCollapse"
                                id="toggle2Button{{ $item->id }}"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body collapsible-content" x-show="isOpen" style="border-top: 1px solid #D8D8D8;"
                id="collapse{{ $item->id }}" wire:ignore>
                <div wire:loading>
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div wire:loading.remove>
                    <form wire:submit.prevent="update" class="px-3 py-2 ">
                        <div class="row">
                            <div class="form-group col-8 anima-focus">
                                <input wire:model.defer="lesson.name" id="edit-lesson-name-{{ $section->id }}"
                                    type="text" placeholder=""
                                    class=" form-control @if ($errors->has('lesson.name')) invalid @endif">
                                @error('lesson.name')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                                <label for="edit-lesson-name-{{ $section->id }}">Nombre*</label>

                            </div>
                            <div class="form-group col-4 anima-focus">
                                <select wire:model.defer="lesson.platform_id"
                                    id="edit-lesson-platform-{{ $section->id }}" type="text"
                                    class="w-full form-control @if ($errors->has('lesson.platform')) invalid @endif">
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('lesson.platform')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                                <label for="edit-lesson-platform-{{ $section->id }}">Plataforma*</label>

                            </div>
                            <div class="form-group col-12 anima-focus">
                                <input wire:model.defer="lesson.url" id="edit-lesson-url-{{ $section->id }}"
                                    type="text" placeholder=""
                                    class="form-control w-full @if ($errors->has('lesson.url')) invalid @endif">
                                @error('lesson.url')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                                <label for="edit-lesson-url-{{ $section->id }}">URL*</label>

                            </div>
                        </div>
                        <div class="mt-3">
                            @livewire('escuela.instructor.lesson-resources', ['lesson' => $item], key('lesson-resource' . $item->id))
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-outline-primary"
                                style="min-width:140px;">Actualizar</button>
                        </div>
                    </form>
                </div>
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
            const bladeElements = document.querySelectorAll('.test');
            console.log(bladeElements);
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('openCollapse')) {
                    let targetId = event.target.getAttribute('data-id');
                    let collapse = document.querySelector(targetId);
                    console.log("collapse", targetId);
                    collapse.classList.toggle('collapse');

                }
            });
        });
    </script>
</div>



