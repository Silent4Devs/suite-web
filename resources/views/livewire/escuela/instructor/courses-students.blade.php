<div>


    <h1 class="mb-4 text-2xl font-bold">Estudiantes del curso</h1>


    @livewire('estudiantes-crear', ['course' => $course])

    <x-table-responsive>

        @if ($students->count())
            <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
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

    </x-table-responsive>


</div>
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@stop
