@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu-secciones.css') }}{{config('app.cssVersion')}}">
    {{ Breadcrumbs::render('EV360-Competencias-Edit') }}
    <style>
        .alerta-error {
            padding: 10px;
            background: #ffc5c594;
            border: 1px solid red;
            border-radius: 10px;
        }

    </style>
    <style>
        /* The container */
        .container-check {
            display: block;
            position: relative;
            padding-left: 33px;
            margin-bottom: 11px;
            cursor: pointer;
            font-size: 14px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 23px;
            width: 23px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container-check:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-check input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container-check input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container-check .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        #btn_cancelar{
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Editar: Competencia: ({{ $competencia->nombre }})</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form id="formGrupo" method="POST" action="{{ route('admin.ev360-competencias.update', $competencia) }}"
                class="mt-3 row" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.recursos-humanos.evaluacion-360.competencias._formEdit')
                <div class="container row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end w-100">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                            <button type="submit" class="ml-2 btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="conductasModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="conductasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #345183;color: white;">

                    <h4 class="modal-title" id="nivelEditCreate2"></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;font-size: 28px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formConductaCreate" action="{{ route('admin.ev360-conductas.store') }}" method="post">
                        @include('admin.recursos-humanos.evaluacion-360.conductas._form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelarConducta" class="btn_cancelar"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnGuardarConducta" class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.form-control-file').on('change', function(e) {
                let inputFile = e.currentTarget;
                console.log('si')
                $("#texto-imagen").text(inputFile.files[0].name);
                // Imagen previa
                var reader = new FileReader();
                reader.readAsDataURL(inputFile.files[0]);
                reader.onload = function(e) {
                    document.getElementById('uploadPreview').src = e.target.result;
                };
            });


            let dtButtons = [];
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar conducta',
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    $('#formConductaCreate').removeAttr('action');
                    $('#formConductaCreate').removeAttr('method');
                    $('#formConductaCreate').attr('action', "{{ route('admin.ev360-conductas.store') }}");
                    $('#formConductaCreate').attr('method', 'POST');
                    CKEDITOR.instances.definicion.setData('');
                    $('#conductasModal').modal('show');
                    // document.getElementById('nivelEditCreate').innerHTML =
                    //     `<i class="fas fa-circle-notch fa-spin mr-2"></i> Cargando...`;
                    let ultimo_nivel = obtenerUltimoNivel(@json($competencia->id));
                    ultimo_nivel.then(data => {
                        document.getElementById('nivelEditCreate').innerHTML =
                            `<i class="fas fa-info-circle mr-1"></i>Nivel <strong>${ data + 1 }</strong>`;
                    });
                    let ultimo_nivel2 = obtenerUltimoNivel(@json($competencia->id));
                    ultimo_nivel2.then(data => {
                        document.getElementById('nivelEditCreate2').innerHTML =
                            `<i class="mr-1 fas fa-chalkboard-teacher"></i> Conductas Esperadas - Nivel <strong>${ data + 1 }</strong>`;
                    });


                }
            };
            dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('admin.ev360-competencias.obtenerConductas', $competencia->id) }}",
                columns: [{
                    data: 'ponderacion'
                }, {
                    data: 'definicion',
                    render: function(data, type, row, meta) {
                        return $('<div/>').html(data).text();
                    },
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlBtnEditar =
                            `/admin/recursos-humanos/evaluacion-360/conductas/${data}/edit`;
                        let urlBtnActualizar =
                            `/admin/recursos-humanos/evaluacion-360/conductas/${data}`;
                        let urlBtnEliminar =
                            `/admin/recursos-humanos/evaluacion-360/conductas/${data}`;
                        let botones = `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-editar" title="Editar" onclick="event.preventDefault();Editar('${urlBtnEditar}','${urlBtnActualizar}')"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar" onclick="event.preventDefault();Eliminar('${urlBtnEliminar}')"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        `;
                        return botones;
                    }
                }],
                order: [
                    [0, 'asc']
                ],
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            window.table = $('.tblNiveles').DataTable(dtOverrideGlobals);
        });

        async function obtenerUltimoNivel(competencia_id) {
            let url = "{{ route('admin.ev360-competencias.obtenerUltimoNivel') }}";
            const rawResponse = await fetch(url, {
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                body: JSON.stringify({
                    competencia_id
                })
            });
            let siguiente_nivel = await rawResponse.json();
            return siguiente_nivel;
        }

        window.Editar = function(urlEditar, urlActualizar) {
            $.ajax({
                type: "GET",
                url: urlEditar,
                beforeSend: function() {
                    toastr.info(
                        'Recuperando información de la conducta, espere unos instantes...');
                },
                success: function({
                    conducta
                }) {
                    CKEDITOR.instances.definicion.setData(conducta.definicion);
                    document.getElementById('nivelEditCreate').innerHTML =
                        `<i class="fas fa-info-circle mr-1"></i>Nivel Actual: <strong>${ conducta.ponderacion }</strong>`;
                    $('#conductasModal').modal('show');
                    $('#formConductaCreate').removeAttr('action');
                    $('#formConductaCreate').removeAttr('method');
                    $('#formConductaCreate').attr('action', urlActualizar);
                    $('#formConductaCreate').attr('method', 'PATCH');
                },
                error: function(request, status, error) {
                    if (error != 'Unprocessable Entity') {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    } else {
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                }
            });
        }

        window.Eliminar = function(urlEliminar) {
            Swal.fire({
                title: '¿Quieres eliminar esta conducta?',
                text: "No podrás recuperar esto",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        type: "DELETE",
                        url: urlEliminar,
                        beforeSend: function() {
                            toastr.info(
                                'Eliminando la conducta, espere unos instantes...');
                        },
                        success: function(response) {
                            toastr.success('Conducta eliminada');
                            table.ajax.reload();
                        },
                        error: function(request, status, error) {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        }
                    });

                }
            })
        }

        $(document).ready(function() {
            document.getElementById('btnGuardarConducta').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                let definicion = CKEDITOR.instances.definicion.getData();
                let competencia_id = @json($competencia->id);
                // let datos = $('#formConductaCreate').serialize();
                let datos = {
                    definicion,
                    competencia_id
                }
                let url = $("#formConductaCreate").attr('action');
                let method = $("#formConductaCreate").attr('method');

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: method,
                    url: url,
                    data: datos,
                    dataType: "JSON",
                    beforeSend: function() {
                        document.querySelector("#conductasModal .modal-dialog .modal-content")
                            .style.pointerEvents = "none";
                        toastr.info(
                            'Guardando y configurando Conducta, espere unos instantes...');
                    },
                    success: function(response) {
                        document.querySelector("#conductasModal .modal-dialog .modal-content")
                            .style.pointerEvents = "all";
                        toastr.success(
                            'Conducta configurada y almacenada con éxito');
                        $('#conductasModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(request, status, error) {
                        if (error != 'Unprocessable Entity') {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        } else {
                            $.each(request.responseJSON.errors, function(indexInArray,
                                valueOfElement) {
                                document.querySelector(`span.${indexInArray}_error`)
                                    .innerHTML =
                                    `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                            });
                        }
                    }
                });
            });
        });

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }
    </script>
    <script type="text/javascript">
        Livewire.on('tipoCompetenciaStore', () => {
            $('#tipoCompetenciaModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Tipo de competencia creado con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('toda_la_empresa').addEventListener('change', function(e) {
                e.preventDefault();
                if (e.currentTarget.checked) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.ev360-competencias.obtenerNiveles') }}",
                        data: {
                            competencia_id: @json($competencia->id),
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            document.getElementById('niveles_cargando').classList.remove(
                                'd-none');
                        },
                        success: function(response) {
                            document.getElementById('niveles_cargando').classList.add('d-none');
                            let contenedor = document.getElementById(
                                'nivel_esperado_contenedor');
                            if (response.length > 0) {
                                let select = `
                                <label for="nivel_esperado">Establece el nivel esperado general
                                <span class="text-danger">*</span>
                                </label>
                                <select name="nivel_esperado" id="nivel_esperado" class="form-control" required>
                            `;
                                response.forEach(nivel => {
                                    select += `
                            <option value="${nivel.ponderacion}">${nivel.ponderacion}</option>
                            `;
                                });
                                select += "</select>";
                                contenedor.innerHTML = select;
                            } else {
                                contenedor.innerHTML = `<span class="mt-2 alerta-error">
                                    <i class='mr-2 fas fa-exclamation-triangle'></i>
                                    Debes ingresar niveles a la competencia primero, luego deselecciona y vuelve a seleccionar.
                                    </span>`;
                            }
                        }
                    });
                } else {
                    let contenedor = document.getElementById('nivel_esperado_contenedor');
                    contenedor.innerHTML = "";
                }
            })
        })
    </script>
@endsection
