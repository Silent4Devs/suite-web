@extends('layouts.admin')
@section('content')
    @include('admin.ContenedorMatrizOctave.styles')



    <h5 class="col-12 titulo_general_funcion">Registrar: </strong>Contenedores Matriz Octave</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.contenedores.update', ['contenedore' => $contenedor]) }}"
                enctype="multipart/form-data" id="form_edit">
                @csrf
                @method('PUT')
                <div class="py-1 text-center form-group col-12"
                    style="background-color:#345183; border-radius:100px; color: white;">REGISTRO DE CONTENEDORES</div>

                {{-- <div class="form-group">
                <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
            </div> --}}

                <div class="row">
                    <div class="form-group col-md-2 col-lg-2 col-sm-12">
                        <label for="identificador_contenedor"><i class="fas fa-table iconos-crear"></i>ID</label>
                        <input class="form-control {{ $errors->has('identificador_contenedor') ? 'is-invalid' : '' }}"
                            type="text" name="identificador_contenedor" id="identificador_contenedor"
                            value="{{ old('identificador_contenedor', $contenedor->identificador_contenedor) }}">
                        @if ($errors->has('identificador_contenedor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador_contenedor') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-8 col-lg-8 col-sm-12">
                        <label for="nom_contenedor"><i class="fas fa-table iconos-crear"></i>Nombre del Contenedor</label>
                        <input class="form-control {{ $errors->has('nom_contenedor') ? 'is-invalid' : '' }}" type="text"
                            name="nom_contenedor" id="nom_contenedor"
                            value="{{ old('nom_contenedor', $contenedor->nom_contenedor) }}">
                        @if ($errors->has('nom_contenedor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nom_contenedor') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-2 col-lg-2 col-sm-12">
                        <label for="riesgo"><i class="fas fa-table iconos-crear"></i>Riesgo</label>
                        <input class="form-control {{ $errors->has('riesgo') ? 'is-invalid' : '' }}" type="text"
                            name="riesgo" id="riesgo" value="{{ old('riesgo', $contenedor->riesgo) }}" readonly>
                        @if ($errors->has('riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgo') }}
                            </div>
                        @endif
                    </div>

                    {{-- <div class="form-group col-md-3 col-lg-3 col-sm-12">
                    <label for="vinculado_ai"><i class="fas fa-table iconos-crear"></i>Vinculado al AI</label>
                    <input class="form-control {{ $errors->has('vinculado_ai') ? 'is-invalid' : '' }}" type="text"
                        name="vinculado_ai" id="vinculado_ai" value="{{ old('vinculado_ai', '') }}">
                    @if ($errors->has('vinculado_ai'))
                        <div class="invalid-feedback">
                            {{ $errors->first('vinculado_ai') }}
                        </div>
                    @endif
                </div> --}}

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label for="descripcion"><i class="fas fa-table iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                            name="descripcion" id="descripcion"
                            required>{{ old('descripcion', $contenedor->descripcion) }}</textarea>
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
                        <label for="identificador_escenario"><i class="fas fa-table iconos-crear"></i>ID</label>
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
                        <label for="nom_escenario"><i class="fas fa-table iconos-crear"></i>Nombre del Escenario</label>
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
                        <label for="descripcion"><i class="fas fa-table iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                            name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label><br>
                        <select class="form-control select2 {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
                            name="confidencialidad" id="confidencialidad_informacion">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <small class="text-danger errores confidencialidad_error"></small>
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="disponibilidad"><i class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label><br>
                        <select class="form-control select2 {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
                            name="disponibilidad" id="disponibilidad_informacion">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <small class="text-danger errores disponibilidad_error"></small>
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label><br>
                        <select class="form-control select2 {{ $errors->has('integridad') ? 'is-invalid' : '' }}"
                            name="integridad" id="integridad_informacion">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <small class="text-danger errores integridad_error"></small>
                    </div>

                    {{-- <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="confidencialidad"><i class="fas fa-table iconos-crear"></i>Confidencialidad</label>
                    <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" type="text"
                        name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', '') }}">
                    @if ($errors->has('confidencialidad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('confidencialidad') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="integridad"><i class="fas fa-table iconos-crear"></i>Integridad</label>
                    <input class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}" type="text"
                        name="integridad" id="integridad" value="{{ old('integridad', '') }}">
                    @if ($errors->has('integridad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('integridad') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="disponibilidad"><i class="fas fa-table iconos-crear"></i>Disponibilidad</label>
                    <input class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}" type="text"
                        name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', '') }}">
                    @if ($errors->has('disponibilidad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('disponibilidad') }}
                        </div>
                    @endif
                </div> --}}
                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label><i class="fas fa-user iconos-crear"></i>Controles Aplicables</label>
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
                    <button class="btn btn-danger" id="agregarEscenario">
                        Agregar
                    </button>
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
                                <th style="min-width:300px;">Controles Aplicables</th>
                                {{-- <th>Opciones</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
            document.getElementById('btn_actualizar').addEventListener('click', (e)=>{
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
                        data: 'confidencialidad'
                    },
                    {
                        data: 'integridad'
                    },
                    {
                        data: 'disponibilidad'
                    },
                    {
                        data: 'controles',
                        render:function(data, type, row, meta) {

                            if (row.controles.length > 0) {
                                let html = '<ul>'
                                    row.controles.forEach(item=>{
                                        html+=`<li>${item.anexo_politica}</li>`;
                                    })
                                html+='</ul>'
                                return html;
                            }
                            return 'sin controles';


                        }
                    },
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                }
            })
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
            }
            function limpiarErrores(){
                document.querySelectorAll('.errores').forEach(element => {
                element.innerHTML = '';
                });
            }


        })
    </script>
@endsection
