{{-- Form Maker inputs --}}
@switch($question->type)
    @case('1')
        <div>
            {{-- @dump($answersForm ? $answersForm[$question->id] : '') --}}
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
        <div class="d-flex justify-content-center align-items-center gap-1">
            <div id="scaleIndicator-{{$question->id}}" style="min-width: 68px; padding: 5px 5px; border-radius:11px; text-align:center;"></div>
            <input class="form-control" placeholder="" id="qs-{{ $question->id }}" name="qs-{{ $question->id }}"
                maxlength="255" required="{{ $question->obligatory }}" readonly wire:model.defer="answersForm.{{$question->id}}.value"
                value="{{ old('answersForm.'.$question->id.'.value') ?? ($answersForm[$question->id]['value'] ?? '') }}">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const inputId = @json($question->id);
                    const sections = @json($sections);
                    const ids = @json($questionsFormulas);
                    const scales = @json($scales);
                    const inputFormula = document.getElementById(`qs-${inputId}`);
                    const inputScale = document.getElementById(`scaleIndicator-${inputId}`);
                    let resultFormula;
                    let scaleIndicator={};
                    const formula = @json($question->getFormula->formula);
                    updateStatus();

                    const numbers = formula.match(/\$fv([^+\-*\/]+)/g).map(num => num.replace('$fv', ''));
                    // console.log(numbers)
                    numbers.map((number) => {
                        const uuidFormula = number;

                        ids.map((itm)=>{
                            if(uuidFormula === itm.uuid_formula){
                                // console.log(itm.id)
                                const inputId = `qs-${itm.id}`;
                                const inputElement = document.getElementById(inputId);
                                if (inputElement) {
                                    // inputElement.addEventListener('input', actualizarFormula);
                                    // inputElement.addEventListener('input', updateStatus);
                                    inputElement.addEventListener('input', function () {
                                        actualizarFormula();
                                        updateStatus();
                                        // console.log("item")
                                    });
                                    setTimeout(() => {
                                        console.log(itm.id)
                                        Livewire.dispatch('saveCoordinates', { id: itm.id }); // Despachar evento de Livewire
                                    }, 500);

                                }
                            }
                        })
                    });

                    function actualizarFormula() {
                        let formulaActualizada = formula.replace(/x/g, '*');
                        numbers.map((item) => {
                            ids.map((itm)=>{
                                if(item === itm.uuid_formula){
                                    const inputId = `qs-${itm.id}`;
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
                                }
                            });

                        });
                        const formulaParcial = formulaActualizada.replace(/\$fv\d+/g, '');

                        try {
                            let resultado = math.evaluate(formulaParcial);

                            if(resultado === undefined){
                                resultado = 0;
                            }

                            inputFormula.value = resultado;
                            resultFormula = resultado
                            // console.log("Resultado:", resultado);
                        } catch (error) {
                            inputFormula.value = formulaParcial;
                            resultFormula= formulaParcial;
                            // console.log("Fórmula parcial:", formulaParcial);
                        }
                    }

                    function updateStatus(){
                        // console.log(resultFormula)
                        if(resultFormula === undefined){
                            resultFormula = 0;
                        }
                       const newScales = scales.find((item)=> parseInt(item.valor) >= parseInt(resultFormula));
                       scaleIndicator.name = newScales.nombre;
                       scaleIndicator.color = newScales.color;
                       inputScale.style.background = scaleIndicator.color;
                       inputScale.style.color = '#FFFFFF'
                       inputScale.innerHTML = scaleIndicator.name;

                    }

                    function getStatus(){
                        if(resultFormula === undefined || resultFormula === ''){
                            resultFormula = 0;
                        }
                        // console.log(resultFormula);
                        const newScales = scales.find((item)=> parseInt(resultFormula) <= parseInt(item.valor));
                        scaleIndicator.name = newScales.nombre;
                        scaleIndicator.color = newScales.color;
                        inputScale.style.background = scaleIndicator.color;
                        inputScale.style.color = '#FFFFFF'
                        inputScale.innerHTML = scaleIndicator.name;
                    }

                    Livewire.on("calculateScale", () => {
                        setTimeout(() => {
                            if(inputFormula.value !== undefined){
                                resultFormula = inputFormula.value
                                getStatus();
                            }
                        }, 500);
                        });
                });

            </script>
        </div>
    @break

    @case('12')
        <div>
            {{$question->id}}
            {{-- {{isset($answersForm[$question->id]) && isset($answersForm[$question->id]->value) ? $answersForm[$question->id]->value : '' }} --}}
            <div class="form-group pl-0 mb-0 anima-focus">
                <input class="form-control" placeholder="" name="qs-{{ $question->id }}"
                    required="{{ $question->obligatory }}"  wire:model="answersForm.{{$question->id}}.value" >
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

                {{-- {{$question->id}} --}}
                <input type="number" step="1" class="form-control" placeholder="" name="qs-{{ $question->id }}"
                    id="qs-{{ $question->id }}" required="{{ $question->obligatory }}" wire:model.defer="answersForm.{{$question->id}}.value"
                    min="{{ $probImpa->valor_min }}" max="{{ $probImpa->valor_max }}">
            </div>
            <strong style="font-style: italic; font-size:11px;">Tu valor debe encontrase entre el
                {{ $probImpa->valor_min }} y el {{ $probImpa->valor_max }}</strong>
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
