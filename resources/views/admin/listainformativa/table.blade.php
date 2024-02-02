<table class="datatable datatable-lista-distribucion" id="datatable-lista-distribucion">
    <thead>
        <tr>
            <th>
                Módulo
            </th>
            <th>
                Submódulo
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
                                <button type="button" class="btn btn-round ml-2 rounded-circle"
                                    style="width: 25px; height: 25px; background-color: #fff8dc; padding: 0; position: relative; right: 2rem; border: 1px solid black; border-radius: 50%;"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{ $modulo->id }}">
                                    <span
                                        style="display: inline-block; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">+{{ $modulo->participantes->count() - 3 }}</span>
                                </button>
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
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"
                    style="margin:50px 0px 50px 1230px; position: relative; top: 3rem; right: 2rem;"><i
                        class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
                </button>
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal content structure -->
                        <div class="modal-body">
                            <h5>Lista de Aprobadores</h5>

                            <hr>
                            <br>

                            @php
                                $levels = []; // Initialize an empty array to store levels temporarily
                            @endphp

                            @foreach ($modulo->participantes as $participante)
                                @php
                                    $nivel = $participante->nivel;
                                    $levels[$nivel][] = $participante; // Group participantes by their nivel
                                @endphp
                            @endforeach

                            <h6 style="color:#057BE2; position: relative; left: 15rem;"> Nivel
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aprobadores
                            </h6>
                            <br>
                            <br>
                            @foreach ($levels as $nivel => $participantesByLevel)
                                @php
                                    // Sort participantes by numero_orden within each nivel
                                    usort($participantesByLevel, function ($a, $b) {
                                        return $a->numero_orden <=> $b->numero_orden;
                                    });

                                @endphp

                                @if ($nivel == 0)
                                    {{-- <div class="row mb-3" style="position: relative; left: 6rem;">
                                        <div class="col-6">
                                            <br>
                                            <h6>Super Aprobadores</h6>
                                        </div>
                                        <div class="col-6">
                                            <div class="row" style="position: relative; right: 11rem;">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-2">
                                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                            class="img_empleado"
                                                            title="{{ $participante->empleado->name }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="row mb-3" style="position: relative; left: 15rem;">
                                        <div class="col-6">
                                            <br>
                                            <h6> Nivel {{ $nivel }}</h6> &nbsp;&nbsp;&nbsp;
                                        </div>
                                        <div class="col-4">
                                            <div class="row" style="position: relative; right: 20rem;">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-4">
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
