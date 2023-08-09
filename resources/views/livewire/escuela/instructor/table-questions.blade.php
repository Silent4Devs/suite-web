<div>
    <x-loading-indicator wire:loading />
<div wire:ignore>
    <p>Nombre:</p>
    <strong>{{ $evaluation->name }}</strong>
    <p class="mt-3">Descripción:</p>

    <div class="mb-3 ">{!! $evaluation->description !!}</div>
    <div class="flex justify-end mt-2 mb-3">
        <div>
            @livewire('instructor.questions', ['evaluation_id' => $evaluation->id, 'questionModel' => null, 'edit' => false, 'onlyIcon' => false], key($evaluation->id))
        </div>
    </div>
</div>
    <x-table-responsive>
        <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
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
                            @livewire('instructor.questions', ['evaluation_id' => $evaluation->id, 'questionModel' => $question, 'edit' => true], key($question->id))

                            <i style="font-size:10pt; color:red" class="ml-2 fas fa-trash" data-toggle="tooltip"
                                data-placement="top" title="Eliminar"
                                wire:click="$emit('deleteQuestion',{{ $question->id }})"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-table-responsive>
    @push('js')
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

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
    @endpush
</div>
