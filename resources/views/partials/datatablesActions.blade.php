<div class="btn-group" role="group" aria-label="Basic example">
    @if ($crudRoutePart == 'users')
        <button class="btn btn-sm" onclick="AbrirModal();">
            <i class="fas fa-user-tag"></i>
        </button>
        <div id="c_modal"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

            })

            function AbrirModal() {
                $(`#vincularEmpleado${@json($row->id)}`).modal('dispose');
                document.getElementById('c_modal').innerHTML = `
                <div data-user-id="${@json($row->id)}" class="modal fade" id="vincularEmpleado${@json($row->id)}" data-backdrop="static"
                    data-keyboard="false" tabindex="-1" aria-labelledby="vincularEmpleado${@json($row->id)}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vincularEmpleado${@json($row->id)}Label">Vinculación de Empleados
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <select name="n_empleado" id="n_empleado" class="select2">
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->n_empleado }}">{{ $empleado->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="VincularEmpleado(this);">Vincular</button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $(`#vincularEmpleado${@json($row->id)}`).modal('show');
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
            }

            function VincularEmpleado(element) {
                console.log($(`#vincularEmpleado${@json($row->id)}`).attr('data-user-id'));
                let n_empleado = $("#n_empleado").val();
                let user_id = element.closest('tr').firstChildElement;
                $.ajax({
                    type: "POST",
                    url: "/admin/users/vincular",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        n_empleado,
                        user_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        </script>
    @endif
    @can($viewGate)
        <a class="mr-2 rounded btn btn-sm" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
            {{-- {{ trans('global.view') }} --}} <i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i>
        </a>
    @endcan
    @can($editGate)
        <a class="mr-2 rounded btn btn-sm" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
            {{-- {{ trans('global.edit') }} --}} <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i>
        </a>
    @endcan
    @can($deleteGate)

        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST"
            class="{{ $row->id }}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn btn-sm text-danger {{ $row->id }} rounded">
                {{-- {{ trans('global.delete') }} --}} <i class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                    title="Eliminar"></i>
            </div>


            <style type="text/css">
                .fondo_delete {
                    width: 100%;
                    height: 100%;
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 99999999999;
                    background-color: rgba(0, 0, 0, 0.5);
                    display: none;
                }

                .delete {
                    width: 400px;
                    height: 200px;
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                }

                .icono_delete {
                    margin-right: 20px;
                    color: #FF3C3C;
                }

                body.c-dark-theme .delete {
                    background: #2a2b36;
                }

                body.c-dark-theme .btn-outline-secondary {
                    border: 1px solid #ccc;
                    color: #ccc;
                }

            </style>

            <div class="fondo_delete">
                <div class="delete">
                    <h1><i class="fas fa-exclamation-triangle icono_delete"></i>Eliminar: {{ $row->id }}</h1>
                    <p class="parrafo">{{ trans('global.areYouSure') }}</p>
                    <div align="right">
                        <div class="mr-4 cancelar btn btn-outline-secondary">Cancelar</div>
                        <button class="eliminar btn btn-danger" type="submit">Eliminar</button>
                    </div>
                </div>
            </div>

        </form>
        <script>
            $(".{{ $row->id }}").click(function() {
                $(".{{ $row->id }} .fondo_delete").css("display", "block");
            });
            $(".cancelar").click(function() {
                $(".{{ $row->id }} .fondo_delete").fadeOut(100);
                $(".{{ $row->id }} .fondo_delete").css("display", "none");
            });
        </script>


        <!--
                                                                                                                                                                                                                                                                                                                                                                                                                <script>
                                                                                                                                                                                                                                                                                                                                                                                                                    var btn_delete = document.querySelector('.btn_delete');
                                                                                                                                                                                                                                                                                                                                                                                                                    btn_delete.addEventListener('click', () => {

                                                                                                                                                                                                                                                                                                                                                                                                                        document.getElementById('fondo_delete').classList.add('ver');

                                                                                                                                                                                                                                                                                                                                                                                                                        var btn_cancelar = document.querySelector('#cancelar');
                                                                                                                                                                                                                                                                                                                                                                                                                        btn_cancelar.addEventListener('click', () => {
                                                                                                                                                                                                                                                                                                                                                                                                                            document.getElementById('fondo_delete').classList.remove('ver');

                                                                                                                                                                                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                                </script>
                                                                                                                                                                                                                                                                                                                                                                                                                -->


    @endcan
</div>


<!-- {{ trans('global.areYouSure') }} -->
