<div>
    @if (!$showResults)
        <div class="p-5 mx-2 mt-4 bg-white rounded-lg shadow-lg md:p-20">
            <strong>Descripción</strong>
            <div class="text-sm text-gray-900" style="text-align: justify;">{!! $evaluation->description !!}</div>
            <div class="text-right pt-8">
                <span class="p-1 font-extrabold text-gray-400">Progreso
                    {{ $count }}/{{ $totalQuizQuestions }}</span>
            </div>
            <p>{{ $count }}. {{ $currentQuestion->question }}</p>
            @foreach ($currentQuestion->answers as $answer)
                <div class="px-3 py-3 m-3 text-sm text-gray-800 border-2 border-gray-300 rounded-lg max-w-auto form">
                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault{{ $answer->id }}" value="{{ $answer->id }}" wire:model.defer="answer">
                    <label class="form-check-label" for="flexRadioDefault{{ $answer->id }}">
                        {{ $answer->answer }}
                    </label>
                </div>
            @endforeach
            @error('answer')
                <span class="text-red-500">{{ $message }}</span>
            @enderror


            <div class="flex items-center justify-end mt-4">

                <button wire:click="nextQuestion" type="submit"
                    class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                    {{ __('SIGUIENTE') }}
                </button>
            </div>
        </div>
    @else
        <section class="text-gray-600 body-font">
            <div class="overflow-hidden bg-white border-2 border-gray-300 shadow sm:rounded-lg">
                <div class="container px-5 py-5 mx-auto">
                    <div class="justify-center mb-5 text-center">
                        <h1 class="mb-4 text-2xl font-medium text-center text-gray-900 sm:text-3xl title-font">
                            Resultados</h1>
                        <p class="mt-10 text-md"> <span class="mr-2 font-extrabold text-blue-600">
                                {{ auth()->user()->name . '!' }} </span> <a
                                class="px-2 mx-2 underline bg-green-300 rounded-lg hover:green-400"
                                href="{{ route('admin.courses.evaluation.quizdetails', [
                                    'course' => $course,
                                    'evaluation' => $evaluation,
                                ])}}">Detalles de tu evaluación</a></p>
                        <progress class="mx-auto text-base leading-relaxed xl:w-2/4 lg:w-3/4"
                            id="quiz-{{ $userEvaluationId }}" value="{{ round($percentage) }}" max="100">
                            {{ round($percentage) }} </progress> <span> {{ round($percentage) }}% </span>
                    </div>
                    <div>

                            <div class="p-4 m-3 rounded row" style="background-color:#CDD7E1;">
                                <div class="col-3">
                                    <span>Respuestas correctas</span>
                                </div>
                                <div class="col-3">
                                    <span>{{ $correctQuestions }}</span>
                                </div>
                            </div>


                            <div class="p-4 m-3 rounded row" style="background-color:#CDD7E1;">
                                <div class="col-3">
                                    <span >Total de preguntas</span>
                                </div>
                                <div class="col-3">
                                    <span >{{ $totalQuizQuestions }}</span>
                                </div>
                            </div>

                            <div class="p-4 m-3 rounded row" style="background-color:#CDD7E1;">
                                <div class="col-3">
                                    <span >Porcentaje</span>
                                </div>
                                <div class="col-3">
                                    <span>{{ round($percentage) . '%' }}</span>
                                </div>
                            </div>
                            <div class="p-4 m-3 rounded row" style="background-color:#CDD7E1;">
                                <div class="col-3">
                                    <span >Estado de la evaluación</span>
                                </div>
                                <div class="col-3">
                                    <span>{{ round($percentage) > 60 ? 'Aprobado' : 'Reprobado' }}</span>
                                </div>
                            </div>

                    </div>
                    <div class="flex items-center justify-end mt-4">

                        <a href="{{ route('admin.curso-estudiante', ['course' => $course->id]) }}"
                            class="inline-flex items-center px-4 py-2 m-4 btn cancel">
                            Regresar
                        </a>

                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
