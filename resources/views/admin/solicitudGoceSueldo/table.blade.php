<table class="table w-100 datatable datatable-solicitud-goce-sueldo tblCSV" id="datatable-solicitud-goce-sueldo">
    <thead class="thead-dark">
        <tr>
            <th style="min-width: 110px;">
                Días Solicitados
            </th>
            <th style="min-width: 150px;">
                Nombre de permiso
            </th>
            <th style="min-width: 110px;">
                Tipo de permiso
            </th>
            <th style="min-width: 75px;">
                Fecha inicio
            </th>
            <th style="min-width: 75px;">
                Fecha fin
            </th>
            <th style="min-width: 75px;">
                Estatus
            </th>
            <th style="min-width: 150px;">
                Comentarios
            </th>
            <th style="min-width: 100px;">
                Opciones
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($query as $keySol => $sol)
            <tr>
                <td>{{ $sol->dias_solicitados }}</td>
                <td>{{ $sol->permiso['nombre'] }}</td>
                <td>
                    @switch($sol->permiso->tipo_permiso)
                        @case(1)
                            <div style="text-align:left">
                                Permisos conforme a la ley
                            </div>
                        @break

                        @case(2)
                            <div style="text-align:left">
                                Permisos otorgados por la empresa
                            </div>
                        @break

                        @default
                            <div style="text-align:left">
                                No definido
                            </div>
                    @endswitch
                </td>
                <td>{{ \Carbon\Carbon::parse($sol->fecha_inicio)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($sol->fecha_fin)->format('d-m-Y') }}</td>
                <td>
                    @switch($sol->aprobacion)
                        @case(1)
                            <div style="text-align:left">
                                <span class="badge badge-pill badge-warning">Pendiente</span>
                            </div>
                        @break

                        @case(2)
                            <div style="text-align:left">
                                <span class="badge badge-pill badge-danger">Rechazado</span>
                            </div>
                        @break

                        @case(3)
                            <div style="text-align:left">
                                <span class="badge badge-pill badge-success">Aprobado</span>
                            </div>
                        @break

                        @default
                            <span class="badge badge-pill badge-secondary">Sin Seguimiento</span>
                    @endswitch
                </td>
                <td>
                    {{ $sol->descripcion }}
                </td>
                <td>
                    @if ($sol->aprobacion == 3)
                        <div style="text-aling:center">
                            <a href="solicitud-permiso-goce-sueldo/{{ $sol->id }}/show" title="Ver Solicitud"><i
                                    class="fa-solid fa-eye fa-1x text-info text-aling:center"></i></a>
                        </div>
                    @else
                        <div style="text-aling:center">
                            <a href="solicitud-permiso-goce-sueldo/{{ $sol->id }}/show" title="Ver Solicitud"><i
                                    class="fa-solid fa-eye fa-1x text-info text-aling:center"></i></a>
                             <button
                                onclick="eliminar('{{ route('admin.solicitud-permiso-goce-sueldo.destroy') }}', {{ $sol->id }})"
                                title="Cancelar solicitud" class="btn btn-sm text-danger"
                                style="display:inline-block"><i
                                class="fa-solid fa-trash fa-1x text-danger text-aling:center"></i></button>
                        </div>
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
