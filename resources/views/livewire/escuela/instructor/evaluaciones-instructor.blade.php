<div>
    <x-loading-indicator wire:loading />

    <h1 class="text-2xl font-bold">Evaluaciones</h1>

    <div class="m-4 mx-auto max-w-7xl sm:px-6 lg:px-8" >
        <div>
            <div class="mx-auto">
                <div>
                    <div>
                        <form action="" method="post">
                            @csrf

                            {{-- <span class="text-gray-700">Vincular a </span>
                            <div x-data="{ open: @entangle('showlessons') }">
                                <ul
                                    class="items-center w-full mt-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"> --}}
                            {{-- <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="name_linkedTo" {{ $linkedTo == 1 ? 'checked' : '' }}
                                                type="radio" wire:model.defer="linkedTo" value="1"
                                                name="list_linkedTo" x-on:click="open=false"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                            <label for="name_linkedTo"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">A
                                                este curso</label>
                                        </div>
                                    </li> --}}
                            {{-- <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="name_linkedTo_id" type="radio" value="2"
                                                {{ $linkedTo == 2 ? 'checked' : '' }} name="list_linkedTo"
                                                x-on:click="open=true" wire:model.defer="linkedTo"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                            <label for="name_linkedTo_id"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">A
                                                una lección de este curso</label>
                                        </div>
                                    </li>
                                </ul>
                                @error('linkedTo')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror --}}

                            <label wire:ignore x-show="open" class="block">
                                <p class="mt-4 text-gray-700">Sección a evaluar</p>
                                {{-- @error('section.is_active')
                                        <span
                                            class="content-end float-right text-xs text-red-700">{{ $message }}</span>
                                    @enderror --}}
                                <select wire:model.defer="section_id" id="section_id" name="section[is_active]"
                                    value="{{ old('section.is_active') }}" class="block w-full mt-2 mb-2 form-input">
                                    <option value="" selected disabled>Seleccionar una o más secciones
                                    </option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>

                            </label>
                            @error('section_id')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>


                    <label class="block mt-4">
                        <span class="text-gray-700">Nombre</span>
                        @error('section.name')
                            <span class="content-end float-right text-xs text-red-700">{{ $message }}</span>
                        @enderror
                        <input class="block w-full mt-2 mb-2 form-input" type="text" value="" id="title"
                            wire:model.defer="name">
                        @error('name')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </label>
                    <label class="block mt-4 mb-4" wire:ignore>

                        {!! Form::label('description', 'Descripción:', ['class' => 'mb-4']) !!}
                        {!! Form::textarea('description', null, [
                            'class' => 'form-input block w-full mt-4 mb-2 description' . ($errors->has('description') ? ' border-red-600' : ''),
                        ]) !!}
                        @error('description')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </label>
                    {{-- <label class="block mt-4">
                                    <span class="text-gray-700">¿Está activo?</span>
                                    @error('is_active')
                                        <span class="content-end float-right text-xs text-red-700">{{ $message }}</span>
                                    @enderror --}}
                    {{-- <select name="section[is_active]" value="{{ old('section.is_active') }}"
                                    class="block w-full mt-1 bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select> --}}
                    {{-- <ul
                                    class="items-center w-full mt-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="name_is_active" checked type="radio" value="1"
                                                name="list_is_active" x-on:click="open=false"
                                                wire:model.defer="is_active"<
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="name_is_active"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                        </div>
                                    </li>
                                    <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="name_is_active_id" type="radio" value="0"
                                                name="list_is_active" x-on:click="open=true"
                                                wire:model.defer="is_active"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="name_is_active_id"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                        </div>
                                    </li>
                                </ul>
                            </label> --}}

                    <div class="flex items-center justify-end mt-4">
                        {{-- <a href="{{route('listSection')}}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">Back</a> --}}
                        @if (!$editar)
                            <x-jet-button type="submit" class="mb-3 ml-4" wire:click.prevent="save">
                                {{ __('Crear') }}
                            </x-jet-button>
                        @else
                            <x-jet-button type="submit" class="mt-4 mb-4 ml-4" wire:click.prevent="update">
                                {{ __('Actualizar') }}
                            </x-jet-button>
                        @endif


                    </div>

                    </form>
                    @livewire('instructor.evaluations-table', ['course' => $course])

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<x-slot name="js">

    <script>
        window.initSelect2 = () => {
            $('.select2').select2();
        }
        initSelect2();

        Livewire.on('select2', () => {

            initSelect2();

        });
        let CKEDITOR = null;

        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'blockQuote'],
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
            .then(editor => {
                CKEDITOR = editor;
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData(), true);
                })
            })
            .catch(error => {
                console.log(error);
            });



        $('#section_id').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('section_id', data.id, false);
        });
        Livewire.on('evaluationStore', () => {
            CKEDITOR.setData('');
            console.log('crear')
        })

        Livewire.on('editarEvaluacion', (evaluacion) => {
            console.log(evaluacion);
            if (evaluacion.description) {
                CKEDITOR.setData(evaluacion.description);
            }
        })
    </script>


</x-slot>
