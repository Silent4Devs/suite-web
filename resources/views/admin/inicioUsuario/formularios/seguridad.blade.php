@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">

    <style type="text/css">
        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }

    </style>
    
    @if(asset('admin/inicioUsuario') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('seguridad-create-perfil') }}
    @endif
    @if(asset('admin/portal-comunicacion/reportes') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('seguridad-create-portal') }}
    @endif
    @if(asset('admin/desk') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('seguridad-create') }}
    @endif
    
    <h5 class="col-12 titulo_general_funcion">Incidentes de Seguridad</h5>
    <div class="container">
        <div class="card card_formulario">
            
            <div class="card-body">
                <div class="titulo-formulario">
                    <i class="bi bi-exclamation-octagon mr-3"></i> Incidentes de seguridad
                </div>

                <hr style="">

                <div class="mt-4">
                    <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"
                </div>

                <form method="POST" action="{{ route('admin.reportes-seguridad-store') }}" class="row"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Datos generales:</strong>
                        </label>
                    </div>

                    <div class="mt-2 form-group col-4">
                        <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                        <div class="form-control">{{ auth()->user()->empleado->name }}</div>
                    </div>

                    <div class="mt-2 form-group col-4">
                        <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
                    </div>

                    <div class="mt-2 form-group col-4">
                        <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Área</label>
                        <div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
                    </div>

                    <div class="mt-2 form-group col-6">
                        <label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electrónico</label>
                        <div class="form-control">{{ auth()->user()->empleado->email }}</div>
                    </div>

                    <div class="mt-2 form-group col-6">
                        <label class="form-label"><i class="fas fa-phone iconos-crear"></i> Teléfono</label>
                        <div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
                    </div>

                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Descripción del incidente:</strong>
                        </label>
                    </div>

                    <div class="mt-2 form-group col-md-8">
                        <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Título corto del
                            incidente<sup>*</sup></label>
                        <input type="" name="titulo" class="form-control" required>
                    </div>

                    <div class="mt-2 form-group col-md-4">
                        <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y hora de
                            ocurrencia<sup>*</sup></label>
                        <input type="datetime-local" name="fecha" class="form-control" required>
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
                        <input type="" name="ubicacion" class="form-control">
                    </div>

                    <div class="mt-2 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente el
                            incidente<sup>*</sup></label>
                        <textarea name="descripcion" class="form-control" required></textarea>
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
                        <textarea name="areas_afectados" class="form-control" id="texto_activos" required></textarea>
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
                        <textarea name="procesos_afectados" class="form-control" id="texto_activos" required></textarea>
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
                        <textarea name="activos_afectados" class="form-control" id="texto_activos" required></textarea>
                    </div>





                    <div class="mt-4 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Evidencia</label>
                        <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
                    </div>





                    <div class="mt-2 text-right form-group col-12">
                        <a href="{{ asset('admin/inicioUsuario') }}#reportes" class="btn btn_cancelar">Cancelar</a>
                        <input type="submit" name="" class="btn btn-success" value="Enviar" id="btn_enviar">
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection


@section('scripts')



    <script>
        let archivos = [];
        let contador = 1;
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.material-sgsis.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                console.log(file);
                console.log(response);
                $('form').find('input[name="archivo"]').remove()
                // $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
                archivos.push(response.name);
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($incidenteSeguridad) && $incidenteSeguridad->archivo)
                    var file = {!! json_encode($incidenteSeguridad->archivo) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="archivo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

        document.getElementById('btn_enviar').addEventListener('click', function(e) {

            let input = `<input type="hidden" multiple name="archivo" value="${archivos}">`;

            $('form').append(input);

        });
    </script>




    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.areas_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.areas_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.procesos_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.procesos_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.activos_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.activos_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });
    </script>



@endsection
