<link rel="stylesheet" type="text/css" href="{{ asset('css/tablas/tablas.css') }}">


{{--@dump($contratos)--}}

<div>
    <h1>Contratos de la Organización </h1>
</div>

<div class="caja_tabla_responsiva col s12 datatable-fix">

        <table class="table" id="contratos-table-all">
            <thead>
                <tr>
                    <th class="estilotd contratos-table">No.&nbsp;Contrato&nbsp;@for ($i = 0; $i < 15; $i++)&nbsp;@endfor</th>
                    <th class="estilotd contratos-table">Tipo</th>
                    <th class="estilotd contratos-table">Proveedor</th>
                    <th class="estilotd contratos-table">Número&nbsp;de&nbsp;Proyecto</th>
                    <th class="estilotd contratos-table">Servicio&nbsp;@for ($i = 0; $i < 80; $i++)&nbsp;@endfor</th>
                    <th class="estilotd contratos-table">Objetivo&nbsp;@for ($i = 0; $i < 100; $i++)&nbsp;@endfor</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Fecha&nbsp;Inicio</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Fecha&nbsp;Fin</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Cumple</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Vigencia&nbsp;@for ($i = 0; $i < 50; $i++)&nbsp;@endfor</th>
                    <th class="estilotd contratos-table">Pagos</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table-2">Administrador</th>
                    {{-- <th style="background-color:#787676; color:#ffff;">Descripción Servicios</th> --}}
                    <th class="estilotd contratos-table">Fecha&nbsp;Firma&nbsp;</th>{{-- Nueva --}}
                    {{-- <th style="background-color:#787676; color:#ffff;">Periodo Pagos</th> --}}
                    <th class="estilotd contratos-table">Monto Pago</th>{{-- Nueva --}}
                    {{-- <th style="background-color:#787676; color:#ffff;">Fecha Inicio del Pago</th> --}}
                    <th class="estilotd contratos-table">Mínimo</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Máximo</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Área</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Área Admin.</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Puesto</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">PMP Asignado</th>{{-- Nueva --}}
                    {{-- <th style="background-color:#787676; color:#ffff;">Clasificación</th> --}}
                    <th class="estilotd contratos-table">Fase</th>
                    <th class="estilotd contratos-table">¿Ampliado?</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">¿Convenio?</th>{{-- Nueva --}}
                    <th class="estilotd contratos-table">Estatus</th>
                    <th class="botones_accion estilotd">Opciones</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($contratos as $contrato)
                    <tr>
                        <td >{{ $contrato->no_contrato }}</td>
                        <td class="espaciotd">{{ $contrato->tipo_contrato }}</td>
                        <td class="espaciotd">{{ $contrato->nombre_comercial }}</td>
                        <td class="espaciotd">{{ $contrato->no_proyecto }}</td>
                        <td>{{ $contrato->nombre_servicio }}</td>
                        <td>{{ $contrato->objetivo }}</td>{{-- nuevo --}}
                        <td>
                            @if(is_null($contrato->fecha_inicio))
                                 No hay fecha
                            @else
                               {{ Carbon\Carbon::createFromFormat('Y-m-d', $contrato->fecha_inicio)->format('d-m-Y') }}
                            @endif
                        </td>
                        {{-- nuevo --}}
                        <td>
                            @if(is_null($contrato->fecha_fin))
                                 No hay fecha
                            @else
                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $contrato->fecha_fin)->format('d-m-Y') }}
                            @endif
                        </td>
                        {{-- nuevo --}}
                        <td class="espaciotd">
                            @if ($contrato->cumple != null && $contrato->cumple != '0')
                                Si
                            @else
                                No
                            @endif
                        </td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->vigencia_contrato }}</td>
                        <td class="espaciotd">{{ $contrato->no_pagos }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->administrador_contrato }}</td>
                        {{-- <td style="text-align: center">{{ $contrato->cargo_administrador }}</td> --}}
                        {{-- <td style="text-align: center">{{ $contrato->servicios_descripcion }}</td> --}}
                        <td style="text-align: center">
                            {{ $contrato->fecha_firma != null ? Carbon\Carbon::createFromFormat('Y-m-d', $contrato->fecha_firma)->format('d-m-Y') : 'Sin fecha de firma' }}
                        </td>{{-- nuevo --}}
                        {{-- <td style="text-align: center">{{ $contrato->periodo_pagos }}</td> --}}
                        <td class="espaciotd">{{ '$' . number_format($contrato->monto_pago, 2) }}</td>
                        {{-- nuevo --}}
                        {{-- <td style="text-align: center">{{ $contrato->fecha_inicio_pago }}</td> --}}
                        <td class="espaciotd">{{ '$' . number_format($contrato->minimo, 2) }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ '$' . number_format($contrato->maximo, 2) }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->area }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->area_administrador }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->puesto }}</td>{{-- nuevo --}}
                        <td class="espaciotd">{{ $contrato->pmp_asignado }}</td>{{-- nuevo --}}
                        {{-- <td style="text-align: center">{{ $contrato->clasificacion }}</td> --}}
                        <td class="espaciotd">{{ $contrato->fase }}</td>
                        <td class="espaciotd">
                            @if ($contrato->contrato_ampliado != null && $contrato->contrato_ampliado != 0)
                                Si
                            @else
                                No
                            @endif
                        </td>{{-- nuevo --}}
                        <td class="espaciotd">
                            @if ($contrato->convenio_modificatorio != null && $contrato->convenio_modificatorio != 0)
                                Si
                            @else
                                No
                            @endif
                        </td>{{-- nuevo --}}
                        <td style="text-align: center">
                            @if($contrato->estatus == 'vigentes')
                            Vigente
                            @elseif($contrato->estatus == 'renovaciones')
                            Renovación
                            @else
                            Cerrado
                            @endif
                        </td>
                        <td class="botones_accion" style="min-width: 100px;">
                            {!! Form::open(['route' => ['contract_manager.contratos-katbol.destroy', $contrato->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('contract_manager.contratos-katbol.show', [$contrato->id]) }}"
                                    style="color:#2395AA;"><i class="fa-solid fa-eye" title="Mostrar"> </i>
                                </a>
                                @can('katbol_contratos_modificar')
                                @if ($areas->count() > 0)
                                    <a href="{{ route('contract_manager.contratos-katbol.edit', [$contrato->id]) }}"
                                    style="color:#2395AA;"><i class="fas fa-edit" title="Editar"></i></a>
                                @endif

                                @endcan
                                @can('katbol_contratos_eliminar')
                                    {!! Form::button('<i class="fas fa-trash text-danger"></i>', ['type' => 'submit', 'style' => 'color:#2395AA', 'onclick' => "return confirm('Esta seguro de eliminar el registro?')"]) !!}
                                @endcan
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- <p class="lead">
        <button id="json" class="btn btn-primary">TO JSON</button>
        <button id="csv" class="btn btn-info">TO CSV</button>
        <button id="pdf" class="btn btn-danger">TO PDF</button>
        <button id="txt" class="btn btn-success">TO TXT</button>
    </p> --}}
</div>
