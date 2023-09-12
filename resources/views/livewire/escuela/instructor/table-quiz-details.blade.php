<div>
    <h3 class="mt-4 mb-4 ml-5">Evaluaciones</h3>

    <div class="card shadow-sm">
        <div class="row">
            <div class="col-12">
                <div class="row  mx-n2">
                    <div class="col-6 px-4 pt-4">
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

                    <div class="col-6 px-4 pt-4">
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
            </div>
            <div class="col-12 d-flex flex-row-reverse">
                <button type="submit" wire:click.prevent="findEvaluation" class="btn btn-primary mx-4 my-4">
                    {{ __('Buscar') }}
                </button>
            </div>
        </div>
        <div wire:loading class="mt-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
        </div>
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
