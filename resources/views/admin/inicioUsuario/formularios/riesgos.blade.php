@extends('layouts.admin')
@section('content')
    <style type="text/css">
        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }
    </style>

    @if (asset('admin/inicioUsuario') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create-perfil') }}
    @endif
    @if (asset('admin/portal-comunicacion/reportes') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create-portal') }}
    @endif
    @if (asset('admin/desk') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create') }}
    @endif

    <h5 class="col-12 titulo_general_funcion">Riesgo identificado</h5>
    <div class="container">
        <div class="card card_formulario">

            <div class="card-body">

                <div class="titulo-formulario">
                    <i class="bi bi-shield-exclamation mr-3"></i> Riesgo identificado
                </div>

                <hr style="">

                <div class="mt-4">
                    <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón
                    "Enviar"
                </div>

                <form class="row" method="POST" action="{{ route('admin.reportes-riesgos-store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Datos generales:</strong>
                        </label>
                    </div>
                    @if (auth()->user()->empleado)
                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                            <div class="form-control">{{ Str::limit(auth()->user()->empleado->name, 30, '...') }}</div>
                        </div>

                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
                        </div>

                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
                            <div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
                        </div>

                        <div class="mt-2 form-group col-md-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                            <div class="form-control">{{ auth()->user()->empleado->email }}</div>
                        </div>

                        <div class="mt-2 form-group col-md-6">
                            <label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                            <div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
                        </div>
                    @else
                        <p><strong>no hay un empleado vinculado a este usuario</strong></p>
                    @endif
                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Descripción del riesgo:</strong>
                        </label>
                    </div>



                    <div class="mt-2 form-group col-md-6">
                        <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título corto del
                            riesgo<sup>*</sup></label>
                        <input class="form-control" maxlength="250" name="titulo" required>
                    </div>

                    <div class="mt-2 form-group col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y hora de
                            identificación</label>
                        <input type="datetime-local" name="fecha" class="form-control">
                    </div>

                    <div class="mt-2 form-group col-md-4">
                        <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
                        <select class="form-control" name="sede">
                            <option disabled>seleccione sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2 form-group col-md-8">
                        <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
                        <input type="" name="ubicacion" maxlength="250" class="form-control">
                    </div>

                    <div class="mt-2 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Describa detalladamente el
                            riesgo identificado<sup>*</sup></label>
                        <textarea name="descripcion" maxlength="550" class="form-control" required></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 areas_multiselect">
                        <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Áreas afectadas</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar áreas</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->area }}">{{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="areas_afectados" maxlength="550" class="form-control" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 procesos_multiselect">
                        <label class="form-label"><i class="fas fa-dice-d20 iconos-crear"></i>Procesos afectados</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar procesos</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->nombre }}">{{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="procesos_afectados" maxlength="550" class="form-control" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 activos_multiselect">
                        <label class="form-label"><i class="fa-fw fas fa-laptop iconos-crear"></i>Activos afectados</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar afectados</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="activos_afectados" class="form-control" maxlength="550" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-4 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Evidencia</label>
                            <div class="mt-2" x-data="fileUpload()">
                                <input type="file" name="evidencia[]" class="form-control" multiple
                                       x-ref="fileInput" @change="handleFileChange">

                                <template x-if="hasFile">
                                    <div>
                                        <progress x-bind:value="progress" max="100%" style="width: 100%;" x-show="progress > 0 && progress < 100"></progress>
                                        <span x-show="progress > 0 && progress < 100" x-text="progress + '%'"></span>
                                    </div>
                                </template>

                                <div x-show="uploaded" class="text-success mt-2">✅ Archivo cargado</div>
                            </div>
                    </div>

                    <div class="mt-2 text-right form-group col-12">
                        <a href="{{ asset('admin/inicioUsuario') }}#reportes"
                            class="btn btn-outline-primary">Cancelar</a>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
<script>
    function fileUpload() {
        return {
            progress: 0,
            uploaded: false,
            hasFile: false,

            handleFileChange(event) {
                this.hasFile = event.target.files.length > 0;
                this.progress = 0;
                this.uploaded = false;

                // Simular carga de archivos con progreso
                if (this.hasFile) {
                    let interval = setInterval(() => {
                        if (this.progress >= 100) {
                            clearInterval(interval);
                            this.uploaded = true;
                        } else {
                            this.progress += 10; // Incremento simulado
                        }
                    }, 300);
                }
            }
        };
    }
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let select = document.querySelector('.areas_multiselect #activos');
            let textarea = document.querySelector('.areas_multiselect #texto_activos');

            select.addEventListener('change', function(e) {
                e.preventDefault();

                // Verificar si el valor ya está presente en el área de texto
                if (!textarea.value.includes(this.value)) {
                    textarea.value += `${this.value}, `;
                } else {
                    // Mostrar mensaje de advertencia si el valor ya está presente
                    alert('Este elemento ya está seleccionado.');
                    // Deseleccionar la opción
                    this.value = '';
                }
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            let select = document.querySelector('.procesos_multiselect #activos');
            let textarea = document.querySelector('.procesos_multiselect #texto_activos');

            select.addEventListener('change', function(e) {
                e.preventDefault();

                // Verificar si el valor ya está presente en el área de texto
                if (!textarea.value.includes(this.value)) {
                    textarea.value += `${this.value}, `;
                } else {
                    // Mostrar mensaje de advertencia si el valor ya está presente
                    alert('Este elemento ya está seleccionado.');
                    // Deseleccionar la opción
                    this.value = '';
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            let select = document.querySelector('.activos_multiselect #activos');
            let textarea = document.querySelector('.activos_multiselect #texto_activos');

            select.addEventListener('change', function(e) {
                e.preventDefault();

                // Verificar si el valor ya está presente en el área de texto
                if (!textarea.value.includes(this.value)) {
                    textarea.value += `${this.value}, `;
                } else {
                    // Mostrar mensaje de advertencia si el valor ya está presente
                    alert('Este elemento ya está seleccionado.');
                    // Deseleccionar la opción
                    this.value = '';
                }
            });
        });
    </script>
@endsection
