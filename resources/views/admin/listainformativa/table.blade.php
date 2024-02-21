<table class="datatable datatable-lista-informativa" id="datatable-lista-informativa">
    <thead>
        <tr>
            <th style="min-width: 550px;">
                Módulo
            </th>
            <th style="min-width: 550px;">
                Submódulo
            </th>
            <th style="min-width: 550px;">
                Participantes
            </th>
            <th style="min-width: 550px;">

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
                            $part = $modulo->participantes->count();
                            $user = $modulo->usuarios->count();
                            $participantCount = $part + $user;
                        @endphp

                        @foreach ($modulo->participantes->take(3) as $index => $participante)
                            <div class="col-2">
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                            </div>
                        @endforeach
                        @foreach ($modulo->usuarios->take(3) as $index => $usuario)
                            <div class="col-2">
                                <img src="{{ asset('storage/empleados/imagenes/usuario_no_cargado.png') }}"
                                    class="img_empleado" title="{{ $usuario->usuario->name }}">
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
                            <li><a href="/admin/lista-informativa/{{ $modulo->id }}/edit" class="btn btn-sm"
                                    title="Editar"><i class="fa fa-edit"></i>&nbsp;
                                    Editar</a></li>
                            <li><a href="/admin/lista-informativa/{{ $modulo->id }}/show" class="btn btn-sm"
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

                            <h6 style="color:#057BE2; position: relative; left: 15rem;"> Nivel
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aprobadores
                            </h6>
                            <br>
                            <br>
                            <div class="row mb-3" style="position: relative; left: 25rem;">
                                <div class="col-6">
                                    <br>
                                    <h6> Colaboradores</h6> &nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="col-4">
                                    <div class="row" style="position: relative; right: 20rem;">
                                        @foreach ($modulo->participantes as $index => $participante)
                                            <div class="col-4">
                                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" style="position: relative; left: 15rem;">
                                <div class="col-6">
                                    <br>
                                    <h6> Usuarios</h6> &nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="col-4">
                                    <div class="row" style="position: relative; right: 20rem;">
                                        @foreach ($modulo->usuarios as $index => $usuario)
                                            <div class="col-4">
                                                <img src="{{ asset('storage/empleados/imagenes/usuario_no_cargado.png') }}"
                                                    class="img_empleado" title="{{ $usuario->usuario->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
