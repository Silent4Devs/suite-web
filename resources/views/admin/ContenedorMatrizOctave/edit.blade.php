@extends('layouts.admin')
@section('content')
    @include('admin.ContenedorMatrizOctave.styles')
    <style>
        #contenedores tr td:nth-child(4) {
            background-color: green;
            position: relative;
            padding: 0;
        }

        #contenedores tr td:nth-child(5) {
            background-color: green;
            position: relative;
            padding: 0;
        }

        #contenedores tr td:nth-child(6) {
            background-color: green;
            position: relative;
            padding: 0;
        }

        #contenedores tr td:nth-child(7) {
            background-color: green;
            position: relative;
            padding: 0;
        }

        /* #contenedores tr td:nth-child(8){
                background-color: green;
                position: relative;
                padding: 0;
            } */

    </style>




    <h5 class="col-12 titulo_general_funcion">Registrar: </strong>Contenedores Matriz Octave</h5>
    <div class="mt-4 card">
        <div class="card-body">

            @include('admin.OCTAVE.menu')
            <form method="POST" action="{{ route('admin.contenedores.update', ['contenedore' => $contenedor]) }}"
                enctype="multipart/form-data" id="form_edit">
                @csrf
                @method('PUT')
                <div class="py-1 text-center form-group col-12"
                    style="background-color:#345183; border-radius:100px; color: white;">REGISTRO DE CONTENEDORES</div>

                {{-- <div class="form-group">
                <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
            </div> --}}
            <input type="hidden" name="matriz_id" value="{{$matriz}}"/>
                <div class="row">
                    <div class="form-group col-md-2 col-lg-2 col-sm-12">
                        <label for="identificador_contenedor"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                        <input class="form-control {{ $errors->has('identificador_contenedor') ? 'is-invalid' : '' }}"
                            type="text" name="identificador_contenedor" id="identificador_contenedor"
                            value="{{ old('identificador_contenedor', $contenedor->identificador_contenedor) }}">
                        @if ($errors->has('identificador_contenedor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador_contenedor') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-10 col-lg-10 col-sm-12">
                        <label for="nom_contenedor"><i class="fas fa-box-open iconos-crear"></i>Nombre del
                            Contenedor</label>
                        <input class="form-control {{ $errors->has('nom_contenedor') ? 'is-invalid' : '' }}" type="text"
                            name="nom_contenedor" id="nom_contenedor"
                            value="{{ old('nom_contenedor', $contenedor->nom_contenedor) }}">
                        @if ($errors->has('nom_contenedor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nom_contenedor') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="riesgo"><i class="fas fa-bullseye iconos-crear"></i>Valor del Riesgo</label>
                        <input class="form-control {{ $errors->has('riesgo') ? 'is-invalid' : '' }}" type="text"
                            name="riesgo" id="riesgo" value="{{ old('riesgo', $contenedor->riesgo) }}" readonly>
                        @if ($errors->has('riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="riesgo"><i class="fas fa-bullseye iconos-crear"></i>Nivel del Riesgo</label>
                        <input class="form-control" id="nivelRiesgoText" readonly>
                    </div>


                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label for="descripcion"><i class="far fa-file-alt iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                            id="descripcion" required>{{ old('descripcion', $contenedor->descripcion) }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                    </div>
                </div>

            </form>
            <form method="POST" action="{{ route('admin.contenedores.escenarios.store', $contenedor) }}"
                id="form-escenarios">
                <div class="py-1 text-center form-group col-12"
                    style="background-color:#345183; border-radius:100px; color: white;">ESCENARIOS</div>

                <div class="row">
                    <div class="form-group col-md-2 col-lg-2 col-sm-12">
                        <label for="identificador_escenario"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                        <input class="form-control {{ $errors->has('identificador_escenario') ? 'is-invalid' : '' }}"
                            type="text" name="identificador_escenario" id="identificador_escenario"
                            value="{{ old('identificador_escenario', '') }}">
                        <small class="identificador_escenario_error errores text-danger"></small>
                        @if ($errors->has('identificador_escenario'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador_escenario') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-10 col-lg-10 col-sm-12">
                        <label for="nom_escenario"><i class="fas fa-camera-retro iconos-crear"></i>Nombre del
                            Escenario</label>
                        <input class="form-control {{ $errors->has('nom_escenario') ? 'is-invalid' : '' }}" type="text"
                            name="nom_escenario" id="nom_escenario" value="{{ old('nom_escenario', '') }}">
                        <small class="nom_escenario_error errores text-danger"></small>
                        @if ($errors->has('nom_escenario'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nom_escenario') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label for="descripcion"><i class="far fa-file-alt iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                            id="descripcion" required>{{ old('descripcion') }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                    </div>

                    <div id="caja_select_color" class="form-group col-md-4 col-sm-12">
                        <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label><a
                            id="btnAgregarTipo" onclick="event.preventDefault();" style="font-size:12pt; float: right;"
                            data-toggle="modal" data-target="#marcaslec" data-whatever="@mdo" data-whatever="@mdo"
                            title="Dar click"><i class="fas fa-info-circle"></i></a>
                        <br>
                        <select
                            class="form-control sumatoria-select select2 {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
                            name="confidencialidad" id="confidencialidad_informacion">
                            <option value="0">0 - Sin Impacto</option>
                            <option value="1">1 - Muy Bajo</option>
                            <option value="2">2 - Bajo</option>
                            <option value="3">3 - Medio</option>
                            <option value="4">4 - Alto</option>
                            <option value="5">5 - Crítico</option>
                        </select>
                        <small class="text-danger errores confidencialidad_error"></small>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 caja_select_color">
                        <label for="disponibilidad"><i class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label><a
                            id="btnAgregarTipo" onclick="event.preventDefault();" style="font-size:12pt; float: right;"
                            data-toggle="modal" data-target="#modelolec" data-whatever="@mdo" data-whatever="@mdo"
                            title="Dar click"><i class="fas fa-info-circle"></i></a>
                        </a>
                        <br>
                        <select
                            class="form-control sumatoria-select select2 {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
                            name="disponibilidad" id="disponibilidad_informacion">
                            <option value="0">0 - Sin Impacto</option>
                            <option value="1">1 - Muy Bajo</option>
                            <option value="2">2 - Bajo</option>
                            <option value="3">3 - Medio</option>
                            <option value="4">4 - Alto</option>
                            <option value="5">5 - Crítico</option>
                        </select>
                        <small class="text-danger errores disponibilidad_error"></small>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 caja_select_color">
                        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label><br>
                        <select
                            class="form-control sumatoria-select select2 {{ $errors->has('integridad') ? 'is-invalid' : '' }}"
                            name="integridad" id="integridad_informacion">
                            <option value="0">0 - Sin Impacto</option>
                            <option value="1">1 - Muy Bajo</option>
                            <option value="2">2 - Bajo</option>
                            <option value="3">3 - Medio</option>
                            <option value="4">4 - Alto</option>
                            <option value="5">5 - Crítico</option>
                        </select>
                        <small class="text-danger errores integridad_error"></small>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Valor Promedio del
                            CID</label><br>
                        <div class="mt-2 form-control" id="valor_criticidad"></div>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Nivel Promedio del
                            CID</label><br>
                        <div class="mt-2 form-control" id="valorCriticidadTxt"></div>
                    </div>

                    <div id="omitir_color" class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label><i class="fa-solid fa-check-to-slot iconos-crear"></i>Políticas/Control asociado al
                            Riesgo</label>
                        <select
                            class="form-control js-example-basic-multiple controles-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
                            name="controles[]" id="controles" multiple="multiple">
                            <option value disabled>
                                Selecciona una opción</option>
                            @foreach ($controles as $control)
                                <option value="{{ $control->id }}">
                                    {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('controles'))
                            <div class="invalid-feedback">
                                {{ $errors->first('controles') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 mr-4 col-12 mt-4 text-right">
                        <button class="btn btn-danger" id="agregarEscenario">
                            Agregar
                        </button>
                    </div>
                </div>

                <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                    <table class="scroll_estilo table table-responsive" id="contenedores" style="width:100%">
                        <thead>
                            {{-- <tr class="negras">
                            <th class="text-center" style="background-color:#3490DC;" colspan="8">Descripción
                                General
                            </th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">Evaluación del
                                Escenario</th>
                            <th class="text-center" style="background-color:#3490DC;" colspan="1">Evaluación del
                                Riesgo</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </tr> --}}
                            <tr>
                                <th style="min-width:300px;">ID</th>
                                <th style="min-width:300px;">Nombre del Escenario</th>
                                <th style="min-width:300px;">Descripción</th>
                                <th style="min-width:300px;">Confidencialidad</th>
                                <th style="min-width:300px;">Integridad</th>
                                <th style="min-width:300px;">Disponibilidad</th>
                                <th style="min-width:300px;">Promedio CID</th>
                                <th style="min-width:300px;">Controles Aplicables</th>
                                <th>Opciones</th>
                                {{-- <th>Opciones</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="marcaslec" tabindex="-1" aria-labelledby="marcaslecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marcaslec" id="exampleModalLabel">Impacto Operacional</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Pérdida de contratos de clientes no relevantes y
                                            acciones legales con poca afectación</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Operación con licencias restringidas sin afectar a
                                            los clientes sin llegar a demandas</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Demandas y revocación de contratos de uno o varios
                                            clientes relevantes</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Cierre de negocios relevantes e incremento de
                                            demandas</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modelolec" tabindex="-1" aria-labelledby="modelolecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Impacto Cumplimiento</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color:#1168af;">
                                        <strong style="color:#fff" class="text-center">0 - Sin Impacto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">No se considera riesgo legal asociado al riesgo
                                            evaluado</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(61, 114, 77);">
                                        <strong style="color:#fff" class="text-center">1 - Muy Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Sin requerimientos y observaciones por él
                                            regulados</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(50, 205, 63)">
                                        <strong style="color:#fff" class="text-center">2 - Bajo</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Requerimientos de Información</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: yellow;">
                                        <strong class="text-center">3 - Medio</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Visitas de Inspección con observaciones</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: rgb(255, 136, 0);">
                                        <strong style="color:#fff" class="text-center">4 - Alto</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Suspensión de operaciones > 1 día</span>
                                    </div>
                                </div>
                                <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                    <div class="col-4" style="background-color: red;">
                                        <strong style="color:#fff" class="text-center">5 - Crítico</strong>
                                    </div>
                                    <div class="col-8">
                                        <span style="justify-content;">Revocación de concesiones y autorización de
                                            operación</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" id="btn_actualizar">
                    Actualizar
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
            $('.controles-select').select2({
                'theme': 'bootstrap4'
            });
            let riesgo = @json($sumatoria);
            calcularRiesgo(riesgo);
            document.getElementById('btn_actualizar').addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('form_edit').submit();
            })

            let contenedores = $('#contenedores').DataTable({
                ajax: '{{ route('admin.contenedores.escenarios.get', $contenedor) }}',
                columns: [{
                        data: 'identificador_escenario'
                    },
                    {
                        data: 'nom_escenario'
                    },
                    {
                        data: 'descripcion'

                    },
                    {
                        data: 'confidencialidad',
                        render: function(data, type, row, meta) {
                            let {
                                texto,
                                contenedor
                            } = obtenerColorCid(data);
                            return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${contenedor}; color:${texto}">${data} - ${obtenerNivel(data)}
                                </div>`
                        }
                    },
                    {
                        data: 'integridad',
                        render: function(data, type, row, meta) {
                            let {
                                texto,
                                contenedor
                            } = obtenerColorCid(data);
                            return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${contenedor}; color:${texto}">${data} - ${obtenerNivel(data)}
                                </div>`
                        }
                    },
                    {
                        data: 'disponibilidad',
                        render: function(data, type, row, meta) {
                            let {
                                texto,
                                contenedor
                            } = obtenerColorCid(data);
                            return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${contenedor}; color:${texto}">${data} - ${obtenerNivel(data)}
                                </div>`
                        }
                    },
                    {
                        data: 'sumatoria',
                        render: function(data, type, row, meta) {
                            let {
                                texto,
                                contenedor
                            } = obtenerColorCid(data);
                            return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${contenedor}; color:${texto}">${data} - ${obtenerNivel(data)}
                                </div>`
                        }
                    },
                    // {
                    //     data: 'impactoProceso',
                    //     render:function(data, type, row, meta) {
                    //         if(data == null){
                    //             return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:#F5F5F5; color:black">Sin evaluar </div>`;
                    //         }else{
                    //             let {texto,contenedor}=obtenerColorImpacto(data);
                    //             return `<div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${contenedor}; color:${texto}">${data} - ${obtenerNivelImpacto(data)}
                //                 </div>`
                    //             }
                    //         }

                    // },
                    {
                        data: 'controles',
                        render: function(data, type, row, meta) {

                            if (row.controles.length > 0) {
                                let html = '<ul>'
                                row.controles.forEach(item => {
                                    html +=
                                        `<li>${item.anexo_indice} - ${item.anexo_politica}</li>`;
                                })
                                html += '</ul>'
                                return html;
                            }
                            return 'sin controles';


                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let contenedor = @json($contenedor);
                            let html = `
                            <button onclick="event.preventDefault();eliminarEscenario('${data}','${contenedor.id}')" class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                            `
                            return html
                        }

                    },
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                }
            })
            window.eliminarEscenario = (escenario, contenedor) => {
                Swal.fire({
                    title: '¿Desea eliminar este escenario?',
                    text: "No podrás revertir esto",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('admin.contenedores.escenarios.destroy') }}",
                            data: {
                                escenario,
                                contenedor
                            },
                            dataType: "json",
                            success: function(response) {
                                toastr.success('Escenario eliminado con éxito')
                                calcularRiesgo(response.riesgo);
                                contenedores.ajax.reload();
                            }
                        });
                    }
                })

            }
            window.obtenerNivel = (sumatoria) => {
                let resultado = "";
                if (sumatoria <= 1) {
                    resultado = "Muy Bajo"
                }
                if (sumatoria == 2) {
                    resultado = "Baja"
                }
                if (sumatoria == 3) {
                    resultado = "Medio"
                }
                if (sumatoria == 4) {
                    resultado = "Alta"
                }
                if (sumatoria == 5) {
                    resultado = "Crítica"
                }
                return resultado;
            }

            window.obtenerColorCid = (sumatoria) => {
                let colores = {
                    texto: "",
                    contenedor: ""
                };
                if (sumatoria <= 1) {
                    colores.texto = "white";
                    colores.contenedor = "green";
                }
                if (sumatoria == 2) {
                    colores.texto = "white";
                    colores.contenedor = "rgb(50, 205, 63)";
                }
                if (sumatoria == 3) {
                    colores.texto = "black";
                    colores.contenedor = "yellow";
                }
                if (sumatoria == 4) {
                    colores.texto = "white";
                    colores.contenedor = "orange";
                }
                if (sumatoria == 5) {
                    colores.texto = "white";
                    colores.contenedor = "red";
                }
                return colores;
            }

            window.obtenerNivelImpacto = (sumatoria) => {
                let resultado = "";
                if (sumatoria <= 5) {
                    resultado = "Muy Bajo"
                }
                if (sumatoria <= 10) {
                    resultado = "Baja"
                }
                if (sumatoria <= 15) {
                    resultado = "Medio"
                }
                if (sumatoria <= 20) {
                    resultado = "Alta"
                }
                if (sumatoria <= 25) {
                    resultado = "Crítica"
                }
                return resultado;
            }

            window.obtenerColorImpacto = (sumatoria) => {
                let colores = {
                    texto: "",
                    contenedor: ""
                };
                if (sumatoria <= 5) {
                    colores.texto = "white";
                    colores.contenedor = "green";
                }
                if (sumatoria <= 10) {
                    colores.texto = "white";
                    colores.contenedor = "rgb(50, 205, 63)";
                }
                if (sumatoria <= 15) {
                    colores.texto = "black";
                    colores.contenedor = "yellow";
                }
                if (sumatoria <= 20) {
                    colores.texto = "white";
                    colores.contenedor = "orange";
                }
                if (sumatoria <= 25) {
                    colores.texto = "white";
                    colores.contenedor = "red";
                }
                return colores;
            }
            document.getElementById('agregarEscenario').addEventListener('click', (e) => {
                e.preventDefault();
                limpiarErrores();
                let formulario = document.getElementById('form-escenarios');
                let url = formulario.getAttribute('action');
                let data = new FormData(formulario);
                let boton = e.target;
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        boton.setAttribute('disabled', true);
                    },
                    success: function(response) {
                        calcularRiesgo(response.riesgo);
                        contenedores.ajax.reload();
                        limpiarFormulario(formulario);
                        boton.removeAttribute('disabled');
                        limpiarErrores();
                    },
                    error: function(request, status, error) {
                        boton.removeAttribute('disabled');
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            $(`small.${indexInArray}_error`).text(valueOfElement[0]);
                        });
                    }
                });
            })



            function limpiarFormulario(formulario) {
                formulario.reset();
                $('#confidencialidad_informacion').val('0').trigger('change');
                $('#disponibilidad_informacion').val('0').trigger('change');
                $('#integridad_informacion').val('0').trigger('change');
                $('#controles').val([]).trigger('change');
            }

            function calcularRiesgo(valorCalculado) {
                let riesgo = document.getElementById('riesgo');
                riesgo.value = valorCalculado;
                let nivelRiesgoText = document.getElementById('nivelRiesgoText');
                let texto = "";
                let colores = {
                    texto: "",
                    contenedor: ""
                };
                if (valorCalculado <= 1) {
                    colores.texto = "white";
                    colores.contenedor = "green";
                    texto = "Muy Bajo";
                }
                if (valorCalculado == 2) {
                    colores.texto = "white";
                    colores.contenedor = "rgb(50, 205, 63)";
                    texto = "Bajo";
                }
                if (valorCalculado == 3) {
                    colores.texto = "black";
                    colores.contenedor = "yellow";
                    texto = "Medio";
                }
                if (valorCalculado == 4) {
                    colores.texto = "white";
                    colores.contenedor = "orange";
                    texto = "Alto";
                }
                if (valorCalculado == 5) {
                    colores.texto = "white";
                    colores.contenedor = "red";
                    texto = "Crítico";
                }
                riesgo.style.backgroundColor = colores.contenedor;
                riesgo.style.color = colores.texto;
                nivelRiesgoText.style.backgroundColor = colores.contenedor;
                nivelRiesgoText.style.color = colores.texto;
                nivelRiesgoText.value = texto;
            }

            function limpiarErrores() {
                document.querySelectorAll('.errores').forEach(element => {
                    element.innerHTML = '';
                });
            }

            obtenerCriticidad()

            let confidencial = document.getElementById('confidencialidad_informacion');
            let integridad = document.getElementById('integridad_informacion');
            let disponibilidad = document.getElementById('disponibilidad_informacion');
            $('#confidencialidad_informacion').on('select2:select', function(e) {
                e.preventDefault();
                obtenerCriticidad();
            });
            $('#integridad_informacion').on('select2:select', function(e) {
                e.preventDefault();
                obtenerCriticidad();
            });
            $('#disponibilidad_informacion').on('select2:select', function(e) {
                e.preventDefault();
                obtenerCriticidad();
            });


            function obtenerCriticidad() {
                console.log('criticidad');
                let contenedorTxt = document.getElementById('valorCriticidadTxt');
                contenedorTxt.innerHTML = null;
                let contenedorValor = document.getElementById('valor_criticidad');
                contenedorValor.innerHTML = null;
                let sumatoria = 0;
                document.querySelectorAll('.sumatoria-select').forEach(element => {
                    sumatoria = sumatoria + Number(element.options[element.selectedIndex].value);
                });
                sumatoria = Math.round(sumatoria / 3)
                let resultado = "";
                if (sumatoria <= 1) {
                    resultado = "Muy Bajo"
                    contenedorTxt.style.background = "green"
                    contenedorValor.style.background = "green"
                    contenedorTxt.style.color = "white"
                    contenedorValor.style.color = "white"
                }
                if (sumatoria == 2) {
                    resultado = "Baja"
                    contenedorTxt.style.background = "rgb(50, 205, 63)"
                    contenedorValor.style.background = "rgb(50, 205, 63)"
                    contenedorTxt.style.color = "white"
                    contenedorValor.style.color = "white"
                }
                if (sumatoria == 3) {
                    resultado = "Medio"
                    contenedorTxt.style.background = "yellow"
                    contenedorValor.style.background = "yellow"
                    contenedorTxt.style.color = "black"
                    contenedorValor.style.color = "black"
                }
                if (sumatoria == 4) {
                    resultado = "Alta"
                    contenedorTxt.style.background = "orange"
                    contenedorValor.style.background = "orange"
                    contenedorTxt.style.color = "white"
                    contenedorValor.style.color = "white"

                }
                if (sumatoria == 5) {
                    resultado = "Crítica"
                    contenedorTxt.style.background = "red"
                    contenedorValor.style.background = "red"
                    contenedorTxt.style.color = "white"
                    contenedorValor.style.color = "white"

                }
                console.log(sumatoria);
                document.getElementById('valor_criticidad').innerHTML = sumatoria;
                document.getElementById('valorCriticidadTxt').innerHTML = resultado;
            }

        })
    </script>
@endsection
