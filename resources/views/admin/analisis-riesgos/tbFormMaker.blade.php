{{-- Form Maker inputs --}}
@switch($question->type)
    @case('1')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                <input class="form-control" placeholder="" name="qs-{{ $question->id }}" maxlength="255"
                    required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
            </div>
        </div>
    @break

    @case('2')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                <textarea style="min-height: 100px;" class="form-control" placeholder="" name="qs-{{ $question->id }}"
                    required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value"></textarea>
            </div>
        </div>
    @break

    @case('3')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                <input min="{{ $question->dataQuestions[0]->minimum }}" max="{{ $question->dataQuestions[0]->maximum }}"
                    type="number" inputmode="numeric" pattern="\d*" class="form-control" placeholder=""
                    name="qs-{{ $question->id }}-min" required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
            </div>
            <strong style="font-style: italic; font-size:11px;">Tu valor debe encontrase entre el
                {{ $question->dataQuestions[0]->minimum }} y el {{ $question->dataQuestions[0]->maximum }}</strong>
        </div>
    @break

    @case('4')
        select
    @break

    @case('5')
        @foreach ($question->dataQuestions as $dataQuestion)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="qs-{{ $question->id }}" id="qs-{{ $question->id }}-dq"
                    value="{{ $dataQuestion->id }}" required="{{ $question->obligatory }}">
                <label class="form-check-label" for="qs-{{ $question->id }}-dq" >
                    {{ $dataQuestion->title }}
                </label>
            </div>
        @endforeach
    @break

    @case('6')
        @foreach ($question->dataQuestions as $dataQuestion)
            <div class="form-check">
                <input name="qs-{{ $question->id }}-dq-{{ $dataQuestion->id }}" class="form-check-input" type="checkbox"
                    value="{{ $dataQuestion->id }}" id="qs-{{ $question->id }}-dq" wire:model.defer="answersForm.{{$question->id}}.value">
                <label class="form-check-label" id="qs-{{ $question->id }}-dq">
                    {{ $dataQuestion->title }}
                </label>
            </div>
        @endforeach
    @break

    @case('7')
        <select class="form-control" name="qs-{{ $question->id }}" required="{{ $question->obligatory }}">
            <option selected value="" disabled>Selecciona una opción</option>
            @foreach ($question->dataQuestions as $dataQuestion)
                <option value="{{ $dataQuestion->id }}"> {{ $dataQuestion->title }}</option>
            @endforeach
        </select>
    @break

    @case('8')
        <div class="form-group pl-0 mb-0 anima-focus">
            <input type="date" class="form-control" placeholder="" name="qs-{{ $question->id }}"
                required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
        </div>
    @break

    @case('9')
        <div class="form-group pl-0 mb-0 anima-focus">
            <input type="time" class="form-control" placeholder="" name="qs-{{ $question->id }}"
                required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
        </div>
    @break

    @case('10')
        <div class="fileContainer">
            <img src="{{ asset('storage/analisis_riesgo/template/questions/' . $question->dataQuestions[0]->url) }}"
                class="img-fluid fileImg" />
        </div>
    @break

    @case('11')
        <div>
            {{ $question->getFormula->formula }}
            {{$question->id}}
            <input class="form-control" placeholder="" id="qs-{{ $question->id }}" name="qs-{{ $question->id }}"
                maxlength="255" required="{{ $question->obligatory }}" readonly wire:model.defer="answersForm.{{$question->id}}.value">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const inputId = @json($question->id);
                    const inputFormula = document.getElementById(`qs-${inputId}`);
                    const formula = @json($question->getFormula->formula);
                    console.log(formula)
                    const numbers = formula.match(/\$fv(\d+)/g).map(num => num.replace('$fv', ''));
                    numbers.map((number) => {
                        const inputId = `qs-${number}`;
                        const inputElement = document.getElementById(inputId);

                        if (inputElement) {
                            inputElement.addEventListener('input', actualizarFormula);
                        }
                    });

                    function actualizarFormula() {
                        let formulaActualizada = formula.replace(/x/g, '*');
                        numbers.map((item) => {
                            const inputId = `qs-${item}`;
                            const inputElement = document.getElementById(inputId);
                            const valor = inputElement ? inputElement.value : 0;
                            if (valor !== '') {
                                formulaActualizada = formulaActualizada.replace(`$fv${item}`, valor);
                            } else {

                                // quitar el operador que lo sigue si no hay valor
                                formulaActualizada = formulaActualizada.replace(`$fv${item}`, '');
                                // quita el operador que pueda estar antes o después
                                formulaActualizada = formulaActualizada.replace(/\s*[\+\-\*\/]\s*/, '');
                            }
                        });
                        const formulaParcial = formulaActualizada.replace(/\$fv\d+/g, '');

                        try {
                            let resultado = math.evaluate(formulaParcial);

                            if(resultado === undefined){
                                resultado = 0;
                            }

                            inputFormula.value = resultado;
                            console.log("Resultado:", resultado);
                        } catch (error) {
                            inputFormula.value = formulaParcial;
                            console.log("Fórmula parcial:", formulaParcial);
                        }
                    }
                });
            </script>
        </div>
    @break

    @case('12')
        <div>
            {{-- {{$question->id}} --}}
            {{-- {{isset($answersForm[$question->id]) && isset($answersForm[$question->id]->value) ? $answersForm[$question->id]->value : '' }} --}}
            <div class="form-group pl-0 mb-0 anima-focus">
                <input class="form-control" placeholder="" name="qs-{{ $question->id }}"
                    required="{{ $question->obligatory }}"  wire:model.defer="answersForm.{{$question->id}}.value" >
                    {{-- value="{{isset($answersForm[$question->id]->value) ? $answersForm[$question->id]->value : '' }}" --}}
            </div>
        </div>
    @break

    @case('13')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                <input class="form-control" placeholder="" name="qs-{{ $question->id }}" maxlength="255"
                    required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
            </div>
        </div>
    @break

    @case('14')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                {{$question->id}}
                <input type="number" class="form-control" placeholder="" name="qs-{{ $question->id }}"
                    id="qs-{{ $question->id }}" required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
            </div>
        </div>
    @break

    @case('15')
        <div>
            <div class="form-group pl-0 mb-0 anima-focus">
                <input min="{{ $question->dataQuestions[0]->minimum }}" max="{{ $question->dataQuestions[0]->maximum }}"
                    type="number" inputmode="numeric" pattern="\d*" class="form-control" placeholder=""
                    name="qs-{{ $question->id }}-min" required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value">
            </div>
            <strong style="font-style: italic; font-size:11px;">Tu valor debe encontrase entre el
                ${{ $question->dataQuestions[0]->minimum }} y el ${{ $question->dataQuestions[0]->maximum }}</strong>
        </div>

        @default
    @endswitch
