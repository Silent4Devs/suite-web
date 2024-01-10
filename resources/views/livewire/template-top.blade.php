<div>
    <div class="titulo">
        Análisis de Brechas
    </div>
    <div class="row">
        <div class="card card-body mt-3 shadow-sm" style="width:1030px;">
            <div class="titulo-card">Templates generados
                <hr>
            </div>
            <div class="datatable-rds datatable-fix">
                <table id="datatable_analisisbrechas" class="table w-100" style="width:100%">
                    <thead>
                        <tr>
                            <th style="max-width:300px !important;background-color:rgb(255, 255, 255); color:#414141;">ID
                            </th>
                            <th style="min-width:200px; background-color:rgb(255, 255, 255); color:#414141;">Nombre del
                                template
                            </th>
                            <th style="max-width:80px;background-color:rgb(255, 255, 255); color:#414141;">
                                Fecha de creación</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">No de preguntas</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">Top 8</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top_analisis as $key => $analisis)
                            <tr>
                                <td>
                                    {{ $analisis->id }}
                                </td>
                                <td>
                                    {{ $analisis->nombre_template }}
                                </td>
                                <td>
                                    {{ $analisis->created_at }}
                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault{{ $analisis->id }}"
                                            {{ $analisis->top ? 'checked' : '' }}
                                            {{ $registrosactivos >= $limit_registros && !$analisis->top ? 'disabled' : '' }}
                                            wire:click = 'top({{ $analisis->id }})'>
                                        <label class="form-check-label" for="flexCheckDefault">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    @if (!$analisis->innamovible)
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.templates.edit', $analisis->id) }}">
                                                    <div class="d-flex align-items-start">
                                                        <i class="material-icons-outlined"
                                                            style="width: 24px;font-size:18px;">edit_outline</i>
                                                        Editar
                                                    </div>
                                                </a>
                                                <a class="dropdown-item"
                                                    wire:click="$emit('delete',{{ $analisis->id }})">
                                                    <div class="d-flex align-items-start">
                                                        <i class="material-icons-outlined"
                                                            style="width: 24px;font-size:18px;">delete_outlined</i>
                                                        Eliminar
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <p>No permitido</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-left:40px;">

        </div> --}}
    </div>
    <div class="row d-flex justify-content-end">
        <div>
            <a class="btn btn-light text-primary border border-primary"
                href="{{ route('admin.analisisdebrechas-2022.create') }}" style="width: 136px;">
                Regresar
            </a>
        </div>
    </div>

    @yield('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("delete", id => {
                Swal.fire({
                    title: "Eliminar Template de brechas",
                    text: "¿Esta seguro que desea eliminar?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('template-top', 'destroy', id);
                        Swal.fire({
                            title: "Eliminado",
                            text: "El análisis de brechas se elimino con éxito",
                            icon: "success"
                        });
                    }
                });
            })
        });
    </script>
</div>
