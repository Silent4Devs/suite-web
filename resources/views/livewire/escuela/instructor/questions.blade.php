{{-- <div wire:model="open">
    @if ($edit)
        <h4 name="title">
            Editar preguntas de la evaluación {{$questionModel->id}}
        </h4>
    @else
        <h4 name="title">
            Agregar preguntas a la evaluación
        </h4>
    @endif

        <div name="content">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left" style="min-width:500px;">

                <div class="mt-2">
                    <label class="block mt-4">
                        <span class="text-gray-700">Pregunta<span style="color:red">*</span></span>

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
                <textarea wire:model.defer="explanation"
                    class="form-control block w-full
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
                <i wire:click="removeInput({{ $key }})" class="text-sm text-red-500 fas fa-trash-alt"></i>
                @endif

            </label>
            @endforeach
            @error('answers')
            <p><small class="ml-5 text-xs text-red-700 ">{{ $message }}</small></p>
            @enderror
            <div class="w-1/4" wire:click.prevent="addInput" style="cursor: pointer">
                <i class="mt-4 mr-2 fas fa-plus"></i>Agregar Opción
            </div>
        </div>
        <div name="footer">
            <button wire:click="$set('open',false)">
                Cancelar
            </button>
            @if ($edit)
            <button style="background-color:#333" wire:click.prevent="update({{ $questionModel->id }})">
                Actualizar
            </button>
            @else
            <button style="background-color:#333" wire:click.prevent="save">
                Guardar
            </button>
            @endif
        </div>
</div> --}}



<div style="display:inline-block">
    @if ($edit)
        <i class="ml-2 fas fa-edit" style="font-size:10px;"
            data-toggle="modal" data-target="#updateDataModal{{ $questionModel->id }}"></i>
    @else
        @if ($onlyIcon)
            <i class="ml-2 fas fa-plus-square" style="font-size:10px;"
                data-toggle="modal" data-target="#createDataModal"></i>
        @else
            <button class="btn btn-light text-primary" data-toggle="modal"
                data-target="#createDataModal">
                AGREGAR PREGUNTAS <i class="fas fa-plus"></i>
            </button>
        @endif
    @endif

    @if ($edit)
        @include('livewire.escuela.instructor.update', ['questionModel' => $questionModel])
    @else
        @include('livewire.escuela.instructor.create')
    @endif



    {{-- {{$questionModel}} --}}

</div>
