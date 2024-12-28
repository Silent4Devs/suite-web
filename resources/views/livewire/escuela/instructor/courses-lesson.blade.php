<div class="px-4 py-3">

    <div x-data="{ openElementId: null }">
        @forelse ($section->lessons as $keyItem => $item)
            <div class="card shadow-none" id="card{{ $item->id }}"
                style="border: 1px solid #D8D8D8; border-radius:16px;">
                <div class="card-header" style="border: none;">
                    <div class="row">
                        <div class="col-11 d-flex align-items-baseline" style="padding: 0px;">
                            <button
                                @click="openElementId === {{ $item->id }} ? openElementId = null : openElementId = {{ $item->id }}"
                                wire:click="edit({{ $item }})"
                                style="cursor: pointer; border: none; background:none;" id="link{{ $item->id }}"
                                class="mr-1 color-tbj">
                                <i style="font-size:14px; cursor: pointer;"
                                    class="d-inline fas fa-play-circle openCollapse"
                                    id="toggleButton{{ $item->id }}"></i>
                            </button>
                            <h5 class="d-inline" class="color-tbj">
                                {{ $item->name }}
                            </h5>
                            <div class="d-inline">
                                <a wire:click="destroy({{ $item }})" style="cursor: pointer">
                                    <i style="font-size:16px;" class="ml-2 fa-regular fa-trash-can" title="Eliminar"
                                        style="color:#747474"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <button
                                @click="openElementId === {{ $item->id }} ? openElementId = null : openElementId = {{ $item->id }}"
                                wire:click="edit({{ $item }})"
                                style="cursor: pointer; border: none; background:none;" id="2link{{ $item->id }}"
                                class="color-tbj">
                                <i style="font-size: 20px; cursor: pointer;"
                                    class="d-inline bi bi-caret-down-fill openCollapse"
                                    id="toggle2Button{{ $item->id }}"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body collapsible-content" x-show="openElementId === {{ $item->id }}"
                    style="border-top: 1px solid #D8D8D8;" id="collapse{{ $item->id }}" wire:ignore.self>
                    <div wire:loading>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div wire:loading.remove wire:loading.remove.class="test">
                        <div class="row">
                            <div class="form-group col-8 anima-focus">
                                <input wire:model="formName"
                                    id="edit-lesson-name-{{ $section->id }}-{{ $item->id }}" type="text"
                                    placeholder="" maxlength="250" class="form-control">
                                @error('formName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="edit-lesson-name-{{ $section->id }}-{{ $item->id }}">Nombre*</label>
                            </div>
                            <div class="form-group col-4 anima-focus">
                                <select wire:model="formPlatformId" wire:change="updateTypeArray({{ $keyItem }})"
                                    id="edit-lesson-platform-{{ $section->id }}-{{ $item->id }}"
                                    class="form-control w-full">
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('formPlatformId')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                                <label for="edit-lesson-platform-{{ $section->id }}">Plataforma*</label>
                            </div>
                            @if ($arrayTypeLesson[$keyItem] !== 'Documento')
                                <div class="form-group col-12 anima-focus">
                                    @if ($arrayTypeLesson[$keyItem] === 'Texto')
                                        <textarea wire:model="formText" id="edit-lesson-url-{{ $section->id }}-{{ $item->id }}" placeholder=""
                                            class="form-control w-full"></textarea>
                                        @error('formText')
                                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                        @enderror
                                        <label for="edit-lesson-url-{{ $section->id }}">Texto*</label>
                                    @else
                                        <input wire:model="formUrl"
                                            id="edit-lesson-url-{{ $section->id }}-{{ $item->id }}"
                                            type="text" placeholder="" class="form-control w-full">
                                        @error('formUrl')
                                            <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                        @enderror
                                        <label for="edit-lesson-url-{{ $section->id }}">URL*</label>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if (in_array($arrayTypeLesson[$keyItem], ['Youtube', 'Vimeo', 'Documento']))
                            <div class="mt-3">
                                @livewire('escuela.instructor.lesson-resources', ['lesson' => $item], key('lesson-resource-' . $item->id))
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mt-4">
                            <button wire:click="update" class="btn btn-outline-primary"
                                style="min-width:140px;">Actualizar</button>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center">
                Aun no hay lecciones en esta sección
            </div>
        @endforelse
    </div>


    @include('livewire.escuela.instructor.add-new-lesson')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('reinitializeCkeditor', () => {
                setTimeout(() => {
                    // const editorElement = document.querySelector('#description1');
                    // console.log(editorElement);
                    ClassicEditor.create(document.querySelector('#description2 textarea'), {
                            toolbar: [
                                'heading', 'bold', 'italic', 'strikethrough', 'underline',
                                'code',
                                'subscript', 'superscript', 'link', 'bulletedList',
                                'numberedList',
                                'indent', 'outdent', 'blockQuote', 'insertTable',
                                'mediaEmbed',
                                'undo', 'redo', 'alignment', 'fontSize', 'fontColor',
                                'fontBackgroundColor',
                                'highlight', 'horizontalLine', 'pageBreak',
                                'specialCharacters'
                            ],
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    }
                                ]
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });

                }, 500);
            });
        });
    </script>

</div>
