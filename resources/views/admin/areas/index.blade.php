@extends('layouts.admin')
<style>
    #form_id {
        display: none;
    }
</style>
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registro de Áreas</h5>
    <div class="mt-5 card">
        @can('crear_area_agregar')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'Area',
                        'route' => 'admin.areas.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan

        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Agregue las áreas de la organización
                        comenzando
                        por la de más alta jerarquía

                    </p>

                </div>
            </div>
        </div>

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="d-flex justify-content-end">
                <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-registro-area') }}">
                    <!-- <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon"> -->
                    <i class="fas fa-file-excel icon" style="font-size: 1.5rem;color:#0f6935"></i>
                </a> &nbsp;&nbsp;&nbsp;
            </div>
            <div class="datatable-fix datatable-rds">
                <table class="datatable datatable-Area">
                    <thead class="thead-dark">
                        <tr>
                            <th style="max-width: 40px;">ID</th>
                            <th>
                                Nombre&nbsp;de&nbsp;Área
                            </th>
                            <th>
                                Foto
                            </th>
                            <th>
                                Grupo
                            </th>
                            <th>
                                Reporta&nbsp;a
                            </th>
                            <th>
                                Descripción
                            </th>
                            <th>
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $keyAreas => $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->area }}</td>
                                <td>
                                    @if ($area->foto_ruta)
                                        <img src="{{ $area->foto_ruta }}" style="width:80px;" alt="Foto">
                                    @endif
                                </td>
                                <td>{{ $area->grupo->nombre ?? '' }}</td>
                                <td>
                                    <div style="text-align:left">{{ $area->supervisor->area ?? '' }}</div>
                                </td>
                                <td>
                                    <div style="text-align:left">{{ $area->descripcion ?? '' }}</div>
                                </td>
                                <td>
                                    {{-- {{ $area->id }} --}}
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('crear_area_ver')
                                                <a class="dropdown-item" href="{{ route('admin.areas.show', $area->id) }}">
                                                    <i class="fa-solid fa-eye"></i>&nbsp;Ver</a>
                                            @endcan
                                            @can('crear_area_editar')
                                                <a class="dropdown-item" href="{{ route('admin.areas.edit', $area->id) }}">
                                                    <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                            @endcan
                                            @if (!$area->utilizada)
                                                <form id="delete-form"
                                                    action="{{ route('admin.areas.destroy', $area->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @can('crear_area_eliminar')
                                                    <a class="dropdown-item delete-item"
                                                        onclick="deleteItem({{ $area->id }})">
                                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                                                @endcan
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
    </div>
@endsection

<form method="POST" id="form_id" style="position: relative; left: 10rem; " action="{{ route('admin.areas.pdf') }}">
    @csrf
    <button class="boton-transparentev2" type="submit" style="color: var(--color-tbj);">
        IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
    </button>
</form>

@section('scripts')
    @parent
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Establecemos la acción del formulario con la URL adecuada
                    var form = document.getElementById('delete-form');
                    // Enviamos el formulario
                    form.submit();
                }
            });
        }
    </script>

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'pdfHtml5',
                    title: `Áreas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    action: function(e, dt, button, config) {
                        // Aquí ejecutas la acción del formulario al presionar el botón
                        var form = document.getElementById('form_id');
                        form.submit();
                    },
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];

            @can('crear_area_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar area',
                    url: "{{ route('admin.areas.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                let btnImport = {
                    text: '<i class="pl-2 pr-3 fas fa-file-csv"></i> CSV Importar',
                    titleAttr: 'Importar datos por CSV',
                    className: "btn-xs btn-outline-primary rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        $('#csvImportModal').modal('show');
                    }
                };
                dtButtons.push(btnAgregar);
                dtButtons.push(btnImport);
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,

            };
            let table = $('.datatable-Area').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection
