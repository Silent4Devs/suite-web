<div>

    {{-- <h4 class="mb-4 text-2xl font-bold">Estudiantes del curso</h4> --}}

    @livewire('escuela.estudiantes-crear', ['course' => $course])

    @if ($students->count())
    <div class="datatable-rds datatable-fix">
        <table id="datatable_students" class="table w-100 ">
            <thead >
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left ">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody >
                @foreach ($students as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="d-flex align-items-center d-inline">
                                <div class="circulo-kaans">
                                    @if (isset($student->empleado->avatar_ruta))
                                    <img src="{{ $student->empleado->avatar_ruta  }}" alt="{{ $student->name }}">
                                    @else
                                    <img src="{{ asset('img/avatars/escuela-instructor.png') }}">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    {{ $student->name }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $student->email }}</div>
                        </td>
                        <td>
                            <i style="font-size:12pt" class="m-1 fa-regular fa-trash-can" data-toggle="tooltip"
                                data-placement="top" title="Eliminar"
                                wire:click.prevent="destroy({{ $student->id }})"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="px-6 py-4">
            {{ $students->links() }}
        </div> --}}
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
