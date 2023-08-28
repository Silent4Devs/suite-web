<div>

    {{-- <h4 class="mb-4 text-2xl font-bold">Estudiantes del curso</h4> --}}

    @livewire('escuela.estudiantes-crear', ['course' => $course])



        @if ($students->count())
            <table class="table table-bordered w-100 datatable-User">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="{{ $student->profile_photo_url }}"
                                            alt="{{ $student->name }}">

                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $student->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->email }}</div>
                            </td>
                            <td>
                                <i style="font-size:12pt; color:red" class="ml-2 fas fa-trash" data-toggle="tooltip"
                                    data-placement="top" title="Eliminar"
                                    wire:click.prevent="destroy({{ $student->id }})"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4">
                {{ $students->links() }}
            </div>
        @else
            <div class="card-body">
                <p>No hay usuarios registrados con estos parametros ...</p>
            </div>
        @endif



</div>
{{-- @section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@stop --}}
