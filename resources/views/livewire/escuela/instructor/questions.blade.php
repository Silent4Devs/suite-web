<div style="display:inline-block">
    <x-loading-indicator wire:loading/>

    @if ($edit)
        <i class="ml-2 text-blue-500 cursor-pointer fas fa-edit" wire:click="$set('open', true)"
            style="display:inline-block; font-size:10pt; "></i>
    @else
        @if ($onlyIcon)
            <i class="ml-2 fas fa-plus-square" wire:click="$set('open', true)"
                style="font-size:10pt; display:inline-block; font-weight:400;"></i>
        @else
            <div style="background-color:#333; cursor:pointer" class="btn btn-primary btn-sm"
                wire:click="$set('open', true)">
                Agregar
            </div>
        @endif
    @endif

    <x-jet-dialog-modal wire:model="open">
        @if ($edit)
            <x-slot name="title">
                Editar preguntas de la evaluación
            </x-slot>
        @else
            <x-slot name="title">
                Agregar preguntas a la evaluación
            </x-slot>
        @endif

        <x-slot name="content">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left" style="min-width:500px;">

                <div class="mt-2">
                    <label class="block mt-4">
                        <span class="text-gray-700">Pregunta<span
                            style="color:red">*</span></span>

                        <input class="block w-full mt-2 mb-2 form-input" type="text" value="" id="title"
                            wire:model.defer="question">
                        @error('question')
                            <p class="text-xs text-red-700">El campo pregunta es obligatorio.</p>
                        @enderror
                        
                    </label>

                </div>
            </div>

            <div class="block mt-4 mb-4 ml-4" wire:ignore>
                <span class="text-gray-700">Descripción</span>
                <textarea wire:model.defer="explanation" class="form-control block w-full
                px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded transition ease-in-out m-0  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="explanation"></textarea>
                @error('explanation')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror

            </div>
            @foreach ($answers as $key => $answer)
                <label class="flex items-center">

                    <input wire:model.defer="answers.{{ $key }}.is_correct" type="hidden" value="0"
                        name="answers[1][is_checked]">
                    <input wire:model.defer="answers.{{ $key }}.is_correct" type="checkbox" value="1"
                        name="answers[1][is_checked]">
                    @error('answers.' . $key . '.is_correct')
                        <small class="text-xs text-red-700">El campo correcta es obligatorio</small>
                    @enderror
                    <span class="w-11/12 px-5 ">
                        <input wire:model.defer="answers.{{ $key }}.answer" name="answers[1][answer]"
                            value="{{ old('answers.1.answer') }}" type="text"
                            class="block w-full mt-1 text-xs bg-gray-200 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" />
                        @error('answers.' . $key . '.answer')
                            <small class="text-xs text-red-700">El campo respuesta es obligatorio</small>
                        @enderror
                    </span>
                    @if ($key > 1)
                        <i wire:click="removeInput({{ $key }})"
                            class="text-sm text-red-500 fas fa-trash-alt"></i>
                    @endif

                </label>
            @endforeach
            @error('answers')
                <p><small class="ml-5 text-xs text-red-700 ">{{ $message }}</small></p>
            @enderror
            <div class="w-1/4" wire:click.prevent="addInput" style="cursor: pointer">
                <i class="mt-4 mr-2 fas fa-plus"></i>Agregar Opción
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            @if ($edit)
                <x-jet-danger-button style="background-color:#333" wire:click.prevent="update({{ $questionModel->id }})">
                    Actualizar
                </x-jet-danger-button>
            @else
                <x-jet-danger-button style="background-color:#333" wire:click.prevent="save">
                    Guardar
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>


</div>


