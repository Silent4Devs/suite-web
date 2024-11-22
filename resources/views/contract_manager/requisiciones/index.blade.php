@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Requisiciones</h5>

    <div class="mt-5 card">
        <div class="card-body">
            <form class="text-right" action="{{ route('contract_manager.requisiciones.indexAprobadores') }}" method="GET">
                @method('GET')
                <a class="btn btn-primary" href="{{ route('contract_manager.requisiciones.create') }}">Agregar</a>
                <button class="btn btn-primary" type="submit" title="Aprobadores">
                    Aprobadores
                </button>
                <a class="btn btn-primary" href="{{ route('contract_manager.requisiciones.archivo') }}">Archivados</a>
            </form>
            <table id="dom" class="table w-100 datatable-perspectiva" style="width: 100%">
                <thead class="">
                    <tr>
                        <th style="vertical-align: top; min-width: 100px;">Folio</th>
                        <th style="vertical-align: top">Fecha De Solicitud</th>
                        <th style="vertical-align: top">Referencia</th>
                        <th style="vertical-align: top">Proveedor</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">Turno en firmar</th>
                        <th style="vertical-align: top">Proyecto</th>
                        <th style="vertical-align: top">Área que Solicita</th>
                        <th style="vertical-align: top">Solicitante</th>
                        <th style="vertical-align: top">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($requisiciones as $requisicion)
                        <tr>
                            <td>RQ-00-00-{{ $requisicion->id }}</td>
                            <td>{{ $requisicion->fecha }}</td>
                            <td>{{ $requisicion->referencia }}</td>
                            <td>{{ $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto') }}
                            </td>
                            <td>
                                @switch($requisicion->estado)
                                    @case('curso')
                                        <h5><span class="badge badge-pill badge-primary">En curso</span></h5>
                                    @break

                                    @case('aprobado')
                                        <h5><span class="badge badge-pill badge-success">Aprobado</span></h5>
                                    @break

                                    @case('cancelada')
                                        <h5><span class="badge badge-pill badge-danger">Cancelada</span></h5>
                                    @break

                                    @case('rechazado')
                                        <h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>
                                    @break

                                    @case('firmada')
                                        <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                    @break

                                    @case('firmada_final')
                                        <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-info">Por iniciar</span></h5>
                                @endswitch

                            </td>
                            @php
                                $user = Illuminate\Support\Facades\DB::table('users')
                                    ->select('id', 'name')
                                    ->where('id', $requisicion->id_user)
                                    ->first();
                            @endphp
                            <td>
                                @switch(true)
                                    @case(is_null($requisicion->firma_solicitante))
                                        <p>Solicitante: {{ $user->name ?? '' }}</p>
                                    @break

                                    @case(is_null($requisicion->firma_jefe))
                                        @php
                                            $employee = App\Models\User::find($requisicion->id_user)->empleado;
                                            if ($requisicion->registroFirmas) {
                                                $supervisorName = $requisicion->obtener_responsable_lider->name;
                                            } elseif ($employee !== null && $employee->supervisor !== null) {
                                                $supervisorName = $employee->supervisor->name;
                                            } else {
                                                $supervisorName = 'N/A'; // Or any default value you prefer
                                            }
                                        @endphp
                                        <p>Jefe: {{ $supervisorName ?? '' }} </p>
                                    @break

                                    @case(is_null($requisicion->firma_finanzas))
                                        @php
                                            if ($requisicion->registroFirmas) {
                                                $finanzasName = $requisicion->obtener_responsable_finanzas->name;
                                            } else {
                                                $finanzasName = 'Sin identificar'; // Or any default value you prefer
                                            }
                                        @endphp
                                        <p>Finanzas: {{ $finanzasName }}</p>
                                    @break

                                    @case(is_null($requisicion->firma_compras))
                                        @php
                                            if ($requisicion->registroFirmas) {
                                                $compradorName = $requisicion->obtener_responsable_comprador->name;
                                            } else {
                                                $compradorName = $requisicion->comprador->user->name;
                                            }
                                        @endphp
                                        <p>Comprador: {{ $compradorName }}</p>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-success">Completado</span></h5>
                                @endswitch
                            </td>
                            <td>{{ $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible' }}</td>
                            <td>{{ $requisicion->area }}</td>
                            <td>{{ $requisicion->user }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a href="{{ route('contract_manager.requisiciones.show', $requisicion->id) }}"
                                            class="dropdown-item">
                                            <i class="fa-solid fa-print"></i> Ver/Imprimir
                                        </a>

                                        <a onclick="mostrarAlerta2('{{ route('contract_manager.requisiciones.estado', $requisicion->id) }}')"
                                            class="dropdown-item">
                                            <i class="fa-solid fa-box-archive"></i> Archivar
                                        </a>

                                        <a onclick="mostrarAlerta('{{ route('contract_manager.requisiciones.destroy', $requisicion->id) }}')"
                                            class="dropdown-item text-danger">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>

                                        @if ($requisicion->estado == 'cancelada' || $requisicion->estado == 'rechazado')
                                            <a href="{{ route('contract_manager.requisiciones.edit', $requisicion->id) }}"
                                                class="dropdown-item">
                                                <i class="fas fa-pen"></i> Editar
                                            </a>
                                        @endif

                                        @if ($requisicion->estado == 'curso')
                                            <a onclick="mostrarAlerta3('{{ route('contract_manager.requisiciones.cancelarRequisicion', $requisicion->id) }}', 1, {{ $requisicion->id }})"
                                                class="dropdown-item">
                                                <span class="material-symbols-outlined">cancel</span> Cancelar
                                            </a>
                                        @elseif($requisicion->estado == 'aprobado' || $requisicion->estado == 'firmada')
                                            <a onclick="mostrarAlerta3('{{ route('contract_manager.requisiciones.cancelarRequisicion', $requisicion->id) }}', 2, {{ $requisicion->id }})"
                                                class="dropdown-item">
                                                <span class="material-symbols-outlined">cancel</span> Cancelar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

