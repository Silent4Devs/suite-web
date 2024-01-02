<table class="datatable datatable-lista-distribucion" id="datatable-lista-distribucion">
    <thead>
        <tr>
            <th>
                Modulo
            </th>
            <th>
                Submodulo
            </th>
            <th>
                Aprobadores
            </th>
            <th style="min-width: 150px; max-width:150px;">

            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($query as $modulo)
            <tr>
                <td>{{ $modulo->modulo }}</td>
                <td>{{ $modulo->submodulo }}</td>
                <td>
                    <div class="row">
                        @php
                            $participantCount = $modulo->participantes->count();
                        @endphp

                        @foreach ($modulo->participantes->take(3) as $index => $participante)
                            <div class="col-3">
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                            </div>
                        @endforeach

                        @if ($participantCount > 3)
                            <div class="col-3">
                                <button type="button" class="btn btn-round ml-2"
                                    style="border-radius: 50%;  background-color: #fff8dc;" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $modulo->id }}">+
                                    {{ $participantCount - 3 }}</button>
                            </div>
                        @endif
                    </div>

                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a href="/admin/lista-distribucion/{{ $modulo->id }}/edit" class="btn btn-sm"
                                    title="Editar"><i class="fa fa-edit"></i>&nbsp;
                                    Editar</a></li>
                            <li><a href="/admin/lista-distribucion/{{ $modulo->id }}/show" class="btn btn-sm"
                                    title="Visualizar"><i class="fa fa-eye"></i>&nbsp;Ver</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal{{ $modulo->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal content structure -->
                        <div class="modal-body">
                            <h5>Lista de Aprobadores</h5>

                            @php
                                $levels = []; // Initialize an empty array to store levels temporarily
                            @endphp

                            @foreach ($modulo->participantes as $participante)
                                @php
                                    $nivel = $participante->nivel;
                                    $levels[$nivel][] = $participante; // Group participantes by their nivel
                                @endphp
                            @endforeach

                            @foreach ($levels as $nivel => $participantesByLevel)
                                @php
                                    // Sort participantes by numero_orden within each nivel
                                    usort($participantesByLevel, function ($a, $b) {
                                        return $a->numero_orden <=> $b->numero_orden;
                                    });

                                @endphp

                                @if ($nivel == 0)
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <h6>Super Aprobadores</h6>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-2">
                                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                            class="img_empleado"
                                                            title="{{ $participante->empleado->name }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <h6>Nivel {{ $nivel }}</h6>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-2">
                                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                            class="img_empleado"
                                                            title="{{ $participante->empleado->name }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>

{{-- @foreach ($query as $key => $modulo)
@endforeach --}}
