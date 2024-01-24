@extends('layouts.admin')
@section('content')
    @can('procesos_agregar')
        <h5 class="col-12 titulo_general_funcion">Procesos</h5>
    @endcan
    <div class="text-right">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.procesos.create') }}" type="button" class="btn btn-primary">Registrar Proceso</a>
        </div>
    </div>
    <div class="mt-5 card">

        <div class="card-body">
            <div class="datatable-fix datatable-rds">
                <h3 class="title-table-rds">Procesos</h3>
                <table class="table table-bordered datatable-procesos w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th class="estilotd contratos-table">Codigo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th>
                                Nombre&nbsp;del&nbsp;proceso
                            </th>

                            <th class="estilotd contratos-table">Macroproceso&nbsp;
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
                        @foreach ($query as $proceso)
                            <tr>
                                <td>{{ $proceso->codigo ?? '' }}</td>
                                <td>{{ $proceso->nombre ?? '' }}</td>
                                <td>{{ $proceso->macroproceso->nombre ?? '' }}</td>
                                <td>{{ $proceso->descripcion ?? '' }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @can('procesos_ver')
                                            <a href="{{ route('admin.procesos.show', $proceso->id) }}" class="btn rounded-0"
                                                title="Ver"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        @can('procesos_editar')
                                            <a href="{{ route('admin.procesos.edit', $proceso->id) }}" class="btn rounded-0"
                                                title="Ver"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('procesos_eliminar')
                                            <button onclick="Eliminar(this)"
                                                data-url="{{ route('admin.procesos.destroy', $proceso->id) }}"
                                                class="btn rounded-0 text-danger" title="Ver"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        @endcan
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
@section('scripts')
    @parent
    <script>
        $(function() {
            window.Eliminar = (e) => {
                let url = $(e).data('url');
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
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Eliminado!',
                                        'El proceso ha sido eliminado.',
                                        'success'
                                    ).then().then(() => {
                                        table.ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            }

            let dtButtons = [];




            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-procesos').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //            Vista Global de Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('vista-global-vacaciones', titulo_tabla);
            // });

        });
    </script>
@endsection
