<link rel="stylesheet" type="text/css" href="{{ asset('css/tablas/tablas.css') }}">

<div class="col s12 datatable-fix caja_tabla_responsiva" style="margin-top:30px;">
    <table id="proveedores-table">
        <thead>
            <tr>
                <th rowspan="2" class="estilotd">Razón social</th>
                <th rowspan="2" class="estilotd" style="min-width: 150px;">Nombre comercial del cliente</th>
                <th rowspan="2" class="estilotd" style="min-width: 150px;">RFC persona moral o persona física</th>
                <th colspan="6" class="estilotd">DOMICILIO FISCAL</th>
                <th colspan="4" class="estilotd">DATOS DEL CONTACTO</th>
                <th colspan="2" class="estilotd">PRODUCTOS Y/O SERVICIOS</th>
                <th rowspan="2" class="estilotd">Opciones</th>
            </tr>
            <tr>
                <th class="estilotd">Calle y Número</th>
                <th class="estilotd">Colonia</th>
                <th class="estilotd" style="min-width: 150px;">Ciudad o Municipio/ País</th>
                <th class="estilotd">Código postal</th>
                <th class="estilotd">Teléfonos con lada</th>
                <th class="estilotd">Página Web</th>

                <th class="estilotd" style="min-width: 150px;">Nombre completo del contacto:</th>
                <th class="estilotd">Puesto</th>
                <th class="estilotd">Correo electrónico</th>
                <th class="estilotd">Celular</th>

                <th class="estilotd">
                    Objeto&nbsp;social&nbsp;/&nbsp;Descripción&nbsp;del&nbsp;servicio&nbsp;o&nbsp;producto </th>
                <th class="estilotd">
                    Cobertura,&nbsp;Rango&nbsp;geográfico&nbsp;en&nbsp;el&nbsp;cual&nbsp;presta&nbsp;los&nbsp;servicios
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedores)
                <tr>
                    <td>{{ $proveedores->razon_social }}</td>
                    <td>{{ $proveedores->nombre_comercial }}</td>
                    <td>{{ $proveedores->rfc }}</td>
                    <td>{{ $proveedores->calle }}</td>
                    <td>{{ $proveedores->colonia }}</td>
                    <td>{{ $proveedores->ciudad }}</td>
                    <td>{{ $proveedores->codigo_postal }}</td>
                    <td>{{ $proveedores->telefono }}</td>
                    <td>{{ $proveedores->pagina_web }}</td>
                    <td>{{ $proveedores->nombre_completo }}</td>
                    <td>{{ $proveedores->puesto }}</td>
                    <td>{{ $proveedores->correo }}</td>
                    <td>{{ $proveedores->celular }}</td>
                    <td>{{ $proveedores->objeto_descripcion }}</td>
                    <td>{{ $proveedores->cobertura }}</td>
                    <td>
                        {!! Form::open(['route' => ['contract_manager.proveedor.destroy', $proveedores->id], 'method' => 'delete']) !!}
                        <div class='row'>
                            <div class="col s4">
                                <a href="{{route('contract_manager.proveedor.show', [$proveedores->id]) }}"
                                    style="color:#2395AA;">
                                    <i class="fa-solid fa-eye" title="Mostrar"> </i>
                                </a>
                            </div>
                            <div class="col s4">
                                @can('katbol_proveedores_modificar')
                                    <a href="{{route('contract_manager.proveedor.edit', [$proveedores->id]) }}"
                                        style="color:#2395AA;">
                                        <i class="fas fa-edit" title="Editar"></i>
                                    </a>
                                @endcan
                            </div>
                            <div class="col s4">
                                @can('katbol_proveedores_eliminar')
                                    {!! Form::button('<i class="fas fa-trash" title="Borrar"></i>', ['type' => 'submit', 'style' => 'color: #2395AA;', 'onclick' => "return confirm('Esta seguro de eliminar el registro?')"]) !!}
                                @endcan
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>





<!-- botonos e cada celda

<td class="td_botones">
                    <a href="" class='btn btn-default btn-xs botones_tabla'>
                        <i class="material-icons">remove_red_eye</i>
                    </a>
                </td>
                <td class="td_botones">
                    <a href="" class='btn btn-default btn-xs botones_tabla'>
                        <i class="material-icons">edit</i>
                    </a>
                </td>
                <td class="td_botones">
                    <a href="" class="btn btn-default btn-xs botones_tabla">
                        <i class="material-icons">delete_outline</i>
                    </a>
                </td>

            -->
