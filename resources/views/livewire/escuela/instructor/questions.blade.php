<div style="display:inline-block">
    @if ($edit)
        <i class="ml-2 fas fa-edit" style="font-size:10px;"
            data-toggle="modal" data-target="#updateDataModal{{ $questionModel->id }}"></i>
    @else
        @if ($onlyIcon)

            <i class="ml-2 fas fa-plus-square" style="font-size:10px;"
                data-toggle="modal" data-target="#createDataModal{{$evaluation_id}}" title="Agregar pregunta"></i>
        @else
            <button class="btn btn-light text-primary" data-toggle="modal"
                data-target="#createDataModal{{$evaluation_id}}">
                AGREGAR PREGUNTAS <i class="fas fa-plus"></i>
            </button>
        @endif
    @endif

    @if ($edit)
        @include('livewire.escuela.instructor.update', ['questionModel' => $questionModel])
    @else
        @include('livewire.escuela.instructor.create', ['evaluacion_id' => $evaluation_id])
    @endif


</div>
