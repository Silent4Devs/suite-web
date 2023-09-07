{{-- @extends('layouts.admin')
@section('content') --}}
<div>

    <style>
        .table tr td:nth-child(1) {
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 200px !important;
        }
    </style>
    {{-- @include('flash::message')
    @include('partials.flashMessages') --}}
    <h5 class="col-12 titulo_general_funcion">Cursos Generados</h5>
    <div class="mt-5 card">
        <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">

            <div class="p-2">
                <a href="{{ route('admin.courses.create') }}" class="ml-4 btn text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 cursor-pointer">Crear Curso Nuevo</a>
            </div>

        </div>
        <div class="card-body datatable-fix">
            @if ($courses->count())
            <table class="table table-bordered w-100 datatable-User">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Matriculados
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Calificación
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Estatus
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="d-flex inline">
                                <div>
                                    @isset($course->image)
                                    <img style="border-radius: 50%;width:150px;" src="{{ Storage::url($course->image->url) }}"
                                        alt="{{ $course->title }}">
                                    @else
                                    <img src="{{ asset('img/home/imagen-estudiantes.jpg') }}" id="picture" alt="Curso"
                                        class="w-full h-full rounded-full">
                                    @endisset
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $course->title }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $course->category ? $course->category->name: 'Sin registro' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $course->students->count() }}</div>
                            <div class="text-sm text-gray-500">Alumnos matriculados</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="d-flex">
                                <p>
                                    ({{ $course->rating }})
                                </p>
                                <ul class="d-flex ml-2" style="list-style: none;">
                                    <li class="mr-1">
                                        <i
                                            class="fas fa-star" style="color: {{$course->rating >= 1 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                                        </i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star" style="color: {{$course->rating >= 2 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star" style="color: {{$course->rating >= 3 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star" style="color: {{$course->rating >= 4 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                    </li>
                                    <li class="mr-1">
                                        <i class="fas fa-star" style="color: {{$course->rating >= 5 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-sm text-gray-500">Valoración del curso</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($course->status)
                            @case(1)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                Borrador
                            </span>
                            @break
                            @case(2)
                            <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                Revisión
                            </span>
                            @break
                            @case(3)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                Publicado
                            </span>
                            @break

                            @default

                            @endswitch
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-blue-500 fas fa-edit"
                                title="Editar"></a>
                            <a href="{{ route('admin.courses-quizdetails', $course) }}" class="mr-2 fas fa-file-alt"
                                style="color:#60DC8F" title="Consultar Evaluaciones"></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4">
                {{ $courses->links() }}
            </div>
            @else
            <div class="card-body">
                <p>No hay registros con estos parametros ...</p>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- @endsection --}}
