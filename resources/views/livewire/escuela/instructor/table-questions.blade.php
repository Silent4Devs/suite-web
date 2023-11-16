<div>
    <style>
        .card-answer {
            margin-left: 35px;
        }

        .advance {
            background-color: #345183;
            color: #FFFFFF;
        }

        .advance:hover {
            color: #FFFFFF;
        }
    </style>
    <x-loading-indicator wire:loading />
    <div class="card shadow-none" wire:ignore>

        <h4 class="card-answer mt-4">Nombre Evaluación</h4>
        <h6 class="card-answer">{{ $evaluation->name }}</h6>

        <h4 class="card-answer mt-4">Descripción</h4>
        <p class="card-answer mt-2">{{ $evaluation->description }}</p>

        <div class="d-flex justify-content-end m-3">
            @livewire('escuela.instructor.questions', ['evaluation_id' => $evaluation->id, 'edit' => false, 'onlyIcon' => false], key($evaluation->id))
        </div>
    </div>
    {{-- <x-table-responsive> --}}
    <table class="table">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    ID
                </th>
                <th scope="col"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Pregunta
                </th>
                <th scope="col"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Descripción
                </th>
                <th scope="col"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluation->questions as $question)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loop->iteration }}.-
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $question->question }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $question->explanation }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @livewire('escuela.instructor.questions', ['evaluation_id' => $evaluation->id, 'questionModel' => $question, 'edit' => true], key($question->id))
                        <i style="font-size:10px;" class="ml-2 fa-regular fa-trash-can"
                            wire:click.prevent="destroy({{ $question->id }})">
                        </i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn advance mb-3" href="{{ route('admin.courses.edit', $course) }}" role="button">REGRESAR</a>

    {{-- </x-table-responsive> --}}
    {{-- @push('js')

            <script>
                Livewire.on('deleteQuestion', questionId => {
                    Swal.fire({
                        title: '¿Desea eliminar la pregunta actual?',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit('destroyQuestion', questionId);

                        }
                    })
                });
            </script>
        @endpush --}}
</div>

@section('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('.modal').modal('hide');
            $('.modal-backdrop').remove();
        })
    </script>
@endsection
