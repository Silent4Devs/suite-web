@extends('layouts.admin')

@section('content')
<h5 class="col-12 titulo_general_funcion">Niveles</h5>
<div class="d-flex justify-content-end mb-3">
    <a class="btn btn-primary btn-sm" href="{{route('admin.levels.create')}}" style="background-color: #345183; white-space: nowrap;">CREAR NIVEL &nbsp; +</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered w-100 datatable datatable-Role">
            <thead>
                <tr>
                    <th style="background-color: #345183;">ID</th>
                    <th style="background-color: #345183;">Nombre</th>
                    <th style="background-color: #345183;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{$level->id}}</td>
                        <td>{{$level->name}}</td>
                        <td>
                            <div class="form-group">
                                <a class="btn" href="{{route('admin.levels.edit', $level)}}"><i style="font-size:12pt; color:#000" class="fas fa-edit" title="Editar"></i></a>
                                <form style="display:inline-block" action="{{route('admin.levels.destroy', $level)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn" type="submit"><i style="font-size:12pt; color:red" class="fas fa-trash"  data-toggle="tooltip" data-placement="top" title="Eliminar"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let table = null;

            function initDataTable() {
                table = $('.datatable-Role').DataTable({
                    "paging": true,
                    "ordering": true,
                    "info": true,
                    "searching": true, // Habilita la búsqueda global
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "info": "Mostrar _START_ a _END_ de _TOTAL_ registros",
                    },
                    "lengthMenu": [[5, 10, 20, 50, 100, -1], [5, 10, 20, 50, 100, "Todos"]],
                    "pageLength": 5, // Por defecto, mostrará 10 registros por página
                });
            }

            // Inicializa la tabla DataTable al cargar la página
            initDataTable();
        });
    </script>
@endsection
