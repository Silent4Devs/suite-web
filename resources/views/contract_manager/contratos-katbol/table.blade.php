{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/tablas/tablas.css') }}"> --}}


        <div id="modal1" class="modal">
            <div class="modal-content" id="contrato-modal"></div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
        </div>
{{--@dump($contratos)--}}
<div>
    <h1>Contratos del Área</h1>
</div>

<div class="caja_tabla_responsiva col s12 datatable-fix">
    <table class="table" id="contratos-table">
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
                <th class="estilotd contratos-table" style="min-width: 150px;">Monto Pago</th>{{-- Nueva --}}
                {{-- <th style="background-color:#787676; color:#ffff;">Fecha Inicio del Pago</th> --}}
                <th class="estilotd contratos-table" style="min-width: 150px;">Mínimo</th>{{-- Nueva --}}
                <th class="estilotd contratos-table" style="min-width: 150px;">Máximo</th>{{-- Nueva --}}
                <th class="estilotd contratos-table"  style="min-width: 150px;">Área</th>{{-- Nueva --}}
                <th class="estilotd contratos-table"  style="min-width: 150px;">Área Admin.</th>{{-- Nueva --}}
                <th class="estilotd contratos-table"  style="min-width: 150px;">Puesto</th>{{-- Nueva --}}
                <th class="estilotd contratos-table" style="min-width: 150px;">PMP Asignado</th>{{-- Nueva --}}
                {{-- <th style="background-color:#787676; color:#ffff;">Clasificación</th> --}}
                <th class="estilotd contratos-table" style="min-width: 150px;">Fase</th>
                <th class="estilotd contratos-table">¿Ampliado?</th>{{-- Nueva --}}
                <th class="estilotd contratos-table">¿Convenio?</th>{{-- Nueva --}}
                <th class="estilotd contratos-table">Estatus</th>
                <th class="estilotd contratos-table">Download files</th>
                <th class="botones_accion estilotd">Opciones</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($contratos as $contrato)
                @if($usuario_actual->area_id == $contrato->area_id)
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
                        <td style="text-align: center">
                            <button class="waves-effect waves-light btn" data-action="contrato" data-contrato-id="{{$contrato->id}}">Archivos</button>
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
                @endif
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

<script>

    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("contratos-table").addEventListener("click", (e)=>{
            let url = "{{route('contract_manager.contratos-katbol.obtenerArchivos')}}"
            if(e.target.getAttribute("data-action") == "contrato" ) {
                let contratoId = e.target.getAttribute("data-contrato-id");
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },
                    data: {contratoId},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        let {contrato, facturas, entregables, convenios} = response;
                        let html = `
                        <div>
                    <h4 style="font-size: 20px">Contratos</h4>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Contrato</th>
                                <th>Nombre de contrato</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>${contrato.no_contrato}</td>
                                <td>${contrato.tipo_contrato}</td>
                                <td><a href='${contrato.archivo}' download class="btn btn-primary">Download</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div>
                    <h4 style="font-size: 20px">Facturación</h4>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Factura</th>
                                <th>Concepto</th>
                            </tr>
                        </thead>
                        <tbody>`
                            facturas.forEach(factura => {
                                html+=`
                                <tr>
                                    <td>${factura.no_factura}</td>
                                    <td>${factura.concepto}</td>
                                    <td><a href='${factura.archivo}' download class="btn btn-primary">Download</a></td>
                                </tr>
                                `
                            });

                        html+=`</tbody>
                    </table>
                </div>
                <div>
                    <h4 style="font-size: 20px">Entregables mensuales</h4>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Concepto</th>
                            </tr>
                        </thead>
                        <tbody>`
                            entregables.forEach(entregable => {
                                html+=`
                                <tr>
                                    <td>${entregable.nombre_entregable}</td>
                                    <td>${entregable.descripcion}</td>
                                    <td><a href='${entregable.archivo}' download class="btn btn-primary">Download</a></td>
                                </tr>
                                `
                            });
                            html+=`</tbody>
                    </table>
                </div>
                <div>
                    <h4 style="font-size: 20px">Convenios modificatorios</h4>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Concepto</th>
                            </tr>
                        </thead>
                        <tbody>`
                            convenios.forEach(convenio => {
                                html+=`
                                <tr>
                                    <td>${convenio.no_convenio}</td>
                                    <td>${convenio.descripcion}</td>
                                    <td><a href='${convenio.archivo}' download class="btn btn-primary">Download</a></td>
                                </tr>
                                `
                            });
                            html+=`</tbody>
                    </table>
                </div>
                        `
                        let contenedor = document.getElementById("contrato-modal");
                        contenedor.innerHTML = html;
                        var Modalelem = document.querySelector('#modal1');
                        var instance = M.Modal.init(Modalelem);
                        instance.open();
                    }
                });
            }
        })

    })

</script>
