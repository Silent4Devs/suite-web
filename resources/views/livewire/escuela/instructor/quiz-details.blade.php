<div>
    @if ($evaluationUser)
        <div class="card shadow-sm mt-4">
            <div class="px-4 py-2">
                <h5 class="text-sm font-medium leading-6 text-gray-900">
                    Información de la evaluación
                </h1>
                <p class="mt-1">
                    Realizaste esta evaluación el <span
                        class="px-2 bg-success text-white rounded">{{ $evaluationUser ? $evaluationUser->created_at->format('d-m-Y') : 'Evaluación no realizada' }}
                    </span>
                </p>
            </div>
            <div class="border-top">
                <div>
                    <div class="px-4 py-2 row">
                        <div class="col-3">
                            Lección evaluada
                        </div>
                        <div class="mt-1 col-3 d-flex justify-content-center">
                            {{ $evaluation->section->name }}

                        </div>
                    </div>
                    <div class="px-4 py-2 row">
                        <div class="col-3">
                            Estatus
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <span
                                class="bg-success text-white rounded px-2">Terminado</span>

                        </div>
                    </div>
                    <div class="px-4 py-2 row">
                        <div class="col-3">
                            Total de preguntas
                        </div>
                        <div class="col-3  d-flex justify-content-center">
                            {{ $totalQuizQuestions }}
                        </div>
                    </div>
                    <div class="px-4 py-2 row">
                        <div class="col-3">
                            Porcentaje
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <span class="bg-success text-white rounded  px-2">
                                {{ round($percentageEvaluationUser) }} %
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        Sin información
    @endif
    @if (count($evaluation->questions) > 0)
        @foreach ($evaluation->questions as $key => $question)
            @php
                $userAnswer = [];
                foreach ($userAnswers as $answer) {
                    if ($answer->evaluation_id == $evaluation->id && $answer->question_id == $question->id && $answer->user_evaluation_id == $evaluationUser->id) {
                        $userAnswer = [
                            'evaluation_id' => $answer->evaluation_id,
                            'question_id' => $answer->id,
                            'is_correct' => $answer->is_correct,
                            'question' => $answer->question->question,
                            'answer_id' => $answer->answer_id,
                            'answer' => $answer->answer->answer,
                        ];
                        break;
                    }
                }
            @endphp
            @if (count($userAnswers))
                <div class="card shadow-sm">

                    <div class="px-4 py-5 sm:px-6">
                        <span class="mr-2 font-extrabold"> {{ $loop->iteration }}.-</span><span
                            style="text-transform: capitalize">{{ $question->question }}</span>
                        <div x-data={show:false} class="block text-xs">
                            <div class="p-1" id="headingOne">
                                <button @click="show=!show"
                                    class="btn btn-link"
                                    type="button">
                                    Más detalle
                                </button>
                            </div>
                            <div x-show="show" class="block p-2 text-xs bg-green-100">
                                {{ $question->explanation }}
                            </div>
                            @php
                                $correctAnswer = null;
                            @endphp
                            @foreach ($question->answers as $key => $answer)
                                @php
                                    $correctAnswer = $question->answers
                                        ->filter(function ($item) {
                                            return $item->is_correct == 'true';
                                        })
                                        ->first();

                                @endphp
                                @isset($userAnswer['answer_id'])
                                    @if ($answer->id == $userAnswer['answer_id'])
                                        @if ($userAnswer['is_correct'])
                                            <div
                                                class="px-2 mt-1 bg-success text-white rounded">
                                                <span class="mr-2 font-extrabold">{{ $alphabet[$key] }}</span>
                                                {{ $answer->answer }}

                                            </div>
                                        @else
                                            <div
                                                class="px-2 mt-1 ">
                                                <span class="mr-2 font-extrabold">{{ $alphabet[$key] }}</span>
                                                {{ $correctAnswer->answer }}
                                                <span class="p-1 font-extrabold">(Correct
                                                    Answer)</span>
                                            </div>

                                            <div
                                                class="px-2 mt-1 text-sm font-extrabold text-white bg-red-600 rounded-lg max-w-auto">
                                                <span class="mr-2 font-extrabold">{{ $alphabet[$key] }} </span>
                                                {{ $answer->answer }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="px-2 mt-1 text-sm text-black bg-gray-300 rounded-lg max-w-auto">
                                            <span class="mr-2 font-extrabold">{{ $alphabet[$key] }} </span>
                                            {{ $answer->answer }}
                                        </div>
                                    @endif
                                @endisset
                            @endforeach
                        </div>
                    </div>

                </div>
            @endif
        @endforeach
    @else
        Sin información
    @endif
    {{-- $user es nulo cuando se muestra los resultados de la evaluación para el mismo usuario --}}
    @if ($user->id == null)
        <div class="flex items-center justify-end mt-4">
            <a type="submit"
                class="inline-flex items-center px-4 py-2 m-4 btn cancel" href="{{ route('admin.curso.evaluacion', ['course' => $course->id, 'evaluation' => $evaluation->id]) }}">
                {{ __('Regresar') }}
            </a>
        </div>
    @endif

</div>
