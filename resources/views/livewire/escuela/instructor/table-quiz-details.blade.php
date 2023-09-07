<div>
    <h1 class="mt-4 mb-4 ml-5 text-2xl font-bold ">Evaluaciones</h1>

    <div class="overflow-hidden bg-white sm:rounded-lg">
        <div class="container px-5 py-5 mx-auto">
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label>Alumno:</label>
                    <select class="form-control  block w-full mt-2 mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                        name="user_id" id="user_id" wire:model.defer="user_id">
                        <option value="" selected>
                            Selecciona una opción
                        </option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Evaluación</label>
                    <select class="form-control  block w-full mt-2 mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                        name="user_id" id="user_id" wire:model.defer="evaluation_id">
                        <option value="" selected>
                            Selecciona una opción
                        </option>
                        @foreach ($evaluations as $evaluationIt)
                            <option value="{{ $evaluationIt->id }}">
                                {{ $evaluationIt->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="flex items-center justify-end mt-4">
                <button type="submit" wire:click.prevent="findEvaluation">
                    {{ __('Buscar') }}
                </button>
            </div>

            @if ($course != null && $evaluation != null)
                @livewire(
                    'escuela.instructor.quiz-details',
                    [
                        'course' => $course,
                        'evaluation' => $evaluation,
                        'user' => $user,
                    ],
                    key($user)
                )
            @endif

        </div>
    </div>



</div>
