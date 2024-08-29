<div class="datatable-rds datatable-fix">
    {{-- <livewire:datatable model="App\Models\Evaluation" name="evaluations" include="id, name, description, linkedTo"  /> --}}
    {{-- <x-loading-indicator wire:loading/> --}}
    {{-- <x-table-responsive> --}}
        <table id="datatable_evaluaciones-cursos" class="table">
            <thead>
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left  uppercase">
                        Nombre
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left  uppercase">
                        Descripción
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left  uppercase">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluaciones as $evaluacion)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $evaluacion->name }}</div>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900" style="text-align: justify;">{!! $evaluacion->description!!}</div>
                        </td>

                        <td class="px-3 py-2 whitespace-nowrap">

                           @livewire('escuela.instructor.questions',['evaluation_id'=>$evaluacion->id],key($evaluacion->id))

                           <a href="{{route('admin.courses.evaluation.questions',['course'=>$course->slug,'evaluation'=>$evaluacion->id])}}"><i style="font-size:10pt; color:#747474;" class="ml-1 fas fa-file-alt" title="Ver preguntas" ></i></a>

                            <i style="font-size:10pt" class="ml-1 cursor-pointer fas fa-edit btn-top"
                                wire:click.prevent="edit({{ $evaluacion->id }})" title="Editar" id="edit-evaluations"></i>

                            <i style="font-size:10pt;" class="ml-1 fa-regular fa-trash-can" title="Eliminar"

                                wire:click.prevent="destroy({{ $evaluacion->id }})"></i>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <div class="px-6 py-4">
                {{ $evaluaciones->links() }}
            </div>
    {{-- </x-table-responsive> --}}

</div>


