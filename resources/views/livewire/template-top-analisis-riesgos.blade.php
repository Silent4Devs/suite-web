<div>
    <div class="titulo">
        Análisis de Riesgos
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
                            <th style="min-width:200px; background-color:rgb(255, 255, 255); color:#414141;">Nombre del
                                template
                            </th>
                            <th style="max-width:80px;background-color:rgb(255, 255, 255); color:#414141;">
                                Fecha de creación</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">No de preguntas</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">Status</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">Top 8</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $key => $template)
                            <tr>
                                <td>
                                    {{ $template->nombre }}
                                </td>
                                <td>
                                    {{ $template->fecha }}
                                </td>
                                <td>
                                </td>
                                <td>
                                    @if ($template->status)
                                        <p class="publicado">
                                            Creada
                                        </p>
                                    @else
                                    <p class="borrador">
                                        En borrador
                                    </p>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault{{ $template->id }}"
                                            {{ $template->top ? 'checked' : '' }}
                                            {{ $registrosactivos >= $limit_registros && !$template->top ? 'disabled' : '' }}
                                            wire:click = 'top({{ $template->id }})'>
                                        <label class="form-check-label" for="flexCheckDefault">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.template-analisis-riesgo.edit', $template->id) }}">
                                                <div class="d-flex align-items-start">
                                                    <i class="material-icons-outlined"
                                                        style="width: 24px;font-size:18px;">edit_outline</i>
                                                    Editar
                                                </div>
                                            </a>
                                            <a class="dropdown-item"
                                                wire:click="$dispatch('delete',{ id: {{ $template->id }} })">
                                                <div class="d-flex align-items-start">
                                                    <i class="material-icons-outlined"
                                                        style="width: 24px;font-size:18px;">delete_outlined</i>
                                                    Eliminar
                                                </div>
                                            </a>
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
    <div class="row d-flex justify-content-end">
        <div>
            <a class="btn btn-light text-primary border border-primary"
                href="{{ route('admin.risk-analysis-index') }}" style="width: 136px; margin-bottom:64px;">
                Regresar
            </a>
        </div>
    </div>

    @yield('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("delete", id => {
                Swal.fire({
                    title: "Eliminar Registro",
                    text: "¿Esta seguro que desea eliminar?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('template-top-analisis-riesgos', 'destroy', id);
                        Swal.fire({
                            title: "Eliminado",
                            text: "El reistro se elimino con éxito",
                            icon: "success"
                        });
                    }
                });
            })
        });
    </script>
</div>
