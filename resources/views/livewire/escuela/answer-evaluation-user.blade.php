<div>
    @if (!$showResults)
        <div class="p-5 mx-2 mt-4 bg-white rounded-lg shadow-lg md:p-20">
            {{-- <div class="px-3 py-3 m-3 text-sm text-gray-800 border-2 border-gray-300 rounded-lg max-w-auto ">
            Hola
        </div> --}}
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
                {{-- <button wire:click="nextQuestion" type="submit"
                class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                {{ __('MOSTRAR RESULTADO') }}
            </button> --}}
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
                                href="{{ route('admin.courses.quizdetails', [
                                    'course' => $course->id,
                                    'evaluation' => $evaluation->id,
                                ]) }}">Detalles
                                de tu evaluación</a></p>
                        <progress class="mx-auto text-base leading-relaxed xl:w-2/4 lg:w-3/4"
                            id="quiz-{{ $userEvaluationId }}" value="{{ round($percentage) }}" max="100">
                            {{ round($percentage) }} </progress> <span> {{ round($percentage) }}% </span>
                    </div>
                    <div class="flex flex-wrap -mx-2 lg:w-4/5 sm:mx-auto sm:mb-2">
                        <div class="w-full p-2 sm:w-1/2">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg fill=" none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="mr-5 font-medium text-purple-700 title-font">Respuestas
                                    correctas</span><span class="font-medium title-font">{{ $correctQuestions }}</span>
                            </div>
                        </div>
                        <div class="w-full p-2 sm:w-1/2">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="mr-5 font-medium text-purple-700 title-font">Total de preguntas</span><span
                                    class="font-medium title-font">{{ $totalQuizQuestions }}</span>
                            </div>
                        </div>
                        <div class="w-full p-2 sm:w-1/2">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="mr-5 font-medium text-purple-700 title-font">Porcentaje
                                </span><span class="font-medium title-font">{{ round($percentage) . '%' }}</span>
                            </div>
                        </div>
                        <div class="w-full p-2 sm:w-1/2">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="mr-5 font-medium text-purple-700 title-font">Estado de la
                                    evaluación</span><span
                                    class="font-medium title-font">{{ round($percentage) > 60 ? 'Aprobado' : 'Reprobado' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">

                        <a href="{{ route('admin.curso-estudiante', ['course' => $course->id]) }}"
                            class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                            Regresar</a>

                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
