<div>

    <style>
        .timeline-header .userimage {
            float: inherit;
            /* width: 34px; */
            height: 250px;
            border-radius: 40px;
            overflow: hidden;
            margin: -2px 10px -2px 0
        }

        .medidas {
            max-height: 1200px;
            overflow: auto;
            margin-top: 30px;
        }

    </style>
    <div class="d-flex">
        @if (!$isPersonal)
            <button class="ml-auto btn btn-danger btn-md" wire:click="clean">Ver todo</button>
        @else
            <a class="ml-auto btn btn-danger btn-md mt-2"
                href="{{ route('admin.editarCompetencias', $empleado_id) }}">Editar</a>
        @endif
    </div>

    @if (!$isPersonal)
        <div class="row" style="margin-bottom:30px;">
            <div class="col-sm-12 col-md-6">
                <label class="required" for="tipoactivo_id"><i
                        class="fas fa-street-view iconos-crear"></i>Área</label>
                <select class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}"
                    wire:model.debounce.800ms="area_id">
                    <option value="">Seleccione el área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">
                            {{ $area->area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 col-md-6">
                <label class="required" for="tipoactivo_id"><i
                        class="fas fa-user-tie iconos-crear"></i>Empleado</label>
                <select class="form-control {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}"
                    wire:model.debounce.800ms="empleado_id" id="tipoactivo_id">
                    <option value="">Seleccione el nombre del empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif


    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::first();
        $logotipo = $organizacion->logotipo;
    @endphp

    @if ($empleado_id != '')
        <div class="___class_+?11___">
            <div class="row justify-content-center">
                <div class="mt-4 col-sm-12 col-md-12">
                    <div class="card" style="background-color:#EDEEF0" style="position-relative; height:auto">
                        <div class="caja_img_logo">
                            <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 20%;">
                        </div>
                        <div class="row medidas">
                            <div class="mt-4 ml-4 col-md-7">
                                <h5 class="py-2 pl-2"
                                    style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                    {{ $empleadoget->name }}</h5>
                                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Resumen</span>
                                </div>
                                <p style="text-transform:capitalize; text-align:justify">{{ $empleadoget->resumen }}
                                </p>
                                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Experiencia Profesional</span>
                                </div>
                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_experiencia as $experiencia)
                                    <div>
                                        <strong style="color:#00A57E;text-transform: uppercase">
                                            {{ $experiencia->empresa }}</strong>
                                        <br>
                                        <span
                                            style="text-transform:capitalize; font-weight:bold">{{ $experiencia->puesto }}
                                        </span>
                                        <br>
                                        <span style="font-weight:bold">{{ $experiencia->inicio_mes }} -
                                            {{ $experiencia->fin_mes }}</span>
                                        <span style="text-transform:capitalize; text-align:justify">
                                            <br>
                                            <p style="text-align:justify">{{ $experiencia->descripcion }}</p>
                                    </div>
                                @endforeach
                                {{-- </ul> --}}
                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Certificaciones</span>
                                </div>
                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_certificaciones as $certificaciones)
                                    <div>
                                        <strong style="color:#00A57E;text-transform: uppercase">
                                            {{ $certificaciones->nombre }}</strong>
                                        <br>
                                        @if ($certificaciones->vigencia && $certificaciones->estatus)
                                            <span>{{ $certificaciones->estatus }}</span>
                                            <br>
                                            <span>{{ $certificaciones->vigencia }}</span>
                                        @else
                                            <span>Permanente - Sin Vigencia</span>
                                        @endif
                                    </div>
                                @endforeach
                                {{-- </ul> --}}
                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Cursos / Diplomados</span>
                                </div>
                                {{-- <ul> --}}
                                @foreach ($empleadoget->empleado_cursos as $cursos)
                                    <div>
                                        <strong class="font-weight-bold"
                                            style="color:#00A57E;text-transform: uppercase">
                                            {{ $cursos->curso_diploma }}</strong>
                                        <br>
                                        <span>{{ $cursos->tipo }}</span>
                                        <br>
                                        <span>{{ $cursos->año }}</span>
                                        <br>
                                        <span>{{ $cursos->duracion }} Horas</span>
                                    </div>
                                @endforeach
                                {{-- </ul> --}}
                                <div class="mt-4 mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Educación</span>
                                </div>
                                @foreach ($empleadoget->empleado_educacion as $educacion)
                                    <div>
                                        <strong class="font-weight-bold"
                                            style="color:#00A57E;text-transform: uppercase">
                                            {{ $educacion->institucion }}</strong>
                                        <br>
                                        <span style="text-transform:capitalize">{{ $educacion->nivel }}</span>
                                        <br>
                                        <span>{{ $educacion->año_inicio }} - {{ $educacion->año_fin }}</span>
                                    </div>
                                @endforeach</ul>
                            </div>
                            <div class="mt-4 col-md-4">
                                <div
                                    style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                    <div class="text-center w-100"><img class="mt-3"
                                            style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                            src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoget->Avatar }}"
                                            alt=""></div>
                                    <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                        <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                            Datos Generales</span>
                                    </div>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-map-marker-alt"></i>Dirección</strong>
                                    <br>
                                    <span style="margin-left:28px;">{{ $empleadoget->telefono }}</span>
                                    <br>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-phone-alt"></i>Número de
                                        Teléfono</strong>
                                    <br>
                                    <span style="margin-left:29px;">{{ $empleadoget->telefono }}</span>
                                    <br>
                                    <strong><i class="ml-2 mr-2 text-white fas fa-envelope"></i>Correo
                                        Electrónico</strong>
                                    <br>
                                    <span style="margin-left:30px;">{{ $empleadoget->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 row px-5">
                <div class="col-sm-12 col-md-5 card pt-3">
                    <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                        <span style="font-size: 17px; font-weight: bold;"><i
                                class="fas fa-folder-open iconos-crear"></i>Documentos</span>
                    </div>
                    <br>
                    @foreach ($empleadoget->empleado_documentos as $documentos)
                        <ul>
                            <a href="{{ asset('storage/documentos_empleados/') . '/' . $documentos->documentos }}"
                                style="text-decoration:none" target="_blank" alt=""><span><i
                                        class="fas fa-file iconos-crear"></i>{{ $documentos->documentos }}</span></a>
                        </ul>
                    @endforeach
                    @if ($isPersonal)
                        <form action="{{ route('admin.cargarDocumentos', $empleado_id) }}" method="post"
                            id="formCargaDocumentos">
                            <input multiple type="file" name="files[]" id="cargarDocumentos" class="d-none">
                            <div class="text-center">
                                <label for="cargarDocumentos" style="cursor: pointer;" class="text-center"><i
                                        class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                    Documentos <small id="infoSelected"></small></label>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-md col"></div>
                <div class="col-sm-12 col-md-5 card pt-3">
                    <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                        <span style="font-size: 17px; font-weight: bold;"><i
                                class="fas fa-folder-open iconos-crear"></i>Certificados</span>
                    </div>
                    <br>
                    @foreach ($empleadoget->empleado_certificaciones as $certificaciones)
                        <ul>
                            <a href="{{ asset('storage/certificados_empleados/') . '/' . $certificaciones->documento }}"
                                style="text-decoration:none" target="_blank" alt=""><span><i
                                        class="fas fa-file iconos-crear"></i>{{ $certificaciones->documento }}</span></a>
                        </ul>
                    @endforeach
                    @if ($isPersonal)
                        <div x-data="{open:false}">
                            <div class="text-center">
                                <label type="button" onclick="event.preventDefault();return false;" data-toggle="modal"
                                    data-target="#modalCertificaciones" style="cursor: pointer;" class="text-center">
                                    <i class="fas fa-upload text-success" style="font-size: 15px"></i> Subir
                                    Certificación
                                </label>
                            </div>
                            <div class="modal fade" id="modalCertificaciones" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="modalCertificacionesLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCertificacionesLabel">
                                                <i class="fas fa-award mr-2"></i> Cargar Certificación
                                            </h5>
                                            <button x-on:click="open = false"
                                                onclick="limpiarForm();event.preventDefault()" type="button"
                                                class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.cargarCertificacion', $empleado_id) }}"
                                                method="POST" id="formCargarCertificacion" class="form-group m-0">
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-lg-12 col-md-12">
                                                        <label for="nombre"><i
                                                                class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                        <input
                                                            class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                            type="text" name="nombre" id="nombre_certificado"
                                                            value="{{ old('nombre', '') }}">
                                                        <span class="errors nombre_error text-danger"></span>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="aplicaVigencia"
                                                                type="checkbox" id="aplicaVigencia"
                                                                x-on:change="open = !open">
                                                            <label class="form-check-label" for="aplicaVigencia">
                                                                ¿Aplica Vigencia?
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div x-show="open" class="col-md-12 row" x-transition>
                                                        <div class="form-group col-sm-6">
                                                            <label for="vigencia"><i
                                                                    class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                                                            <input
                                                                class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}"
                                                                type="date" name="vigencia" id="vigencia"
                                                                value="{{ old('vigencia', '') }}">
                                                            <span class="errors vigencia_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="estatus"><i
                                                                    class="fas fa-street-view iconos-crear"></i>Estatus</label>
                                                            <input
                                                                class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                                type="text" name="estatus" id="vencio_alta"
                                                                value="{{ old('estatus', '') }}" readonly>
                                                            <span class="errors estatus_error text-danger"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" name="documento" id="cargarCertificacion"
                                                    class="d-none">
                                                <div class="text-center">
                                                    <label for="cargarCertificacion" style="cursor: pointer;"
                                                        class="text-center m-0"><i class="fas fa-upload text-success"
                                                            style="font-size: 15px"></i> Subir
                                                        Certificado <small
                                                            id="infoSelectedCertificacion"></small></label>
                                                </div>
                                                <div class="text-center">
                                                    <span class="errors documento_error text-danger"></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick="limpiarForm();event.preventDefault()"
                                                x-on:click="open = false">Cancelar</button>
                                            <button id="btnCargarCertificado" type="button" class="btn btn-primary"><i
                                                    class="fas fa-upload mr-2"></i>Cargar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <br>
            </div>
        </div>
    @else
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor seleccione el área y el
                        nombre del empleado que desea consultar
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <img src="{{ asset('img/cv.png') }}" class="mt-3" style="height: 400px;">
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.limpiarForm = () => {
                limpiarErroresCertificacion();
                document.getElementById('vencio_alta').style.border = 'none'
                document.getElementById('formCargarCertificacion').reset();
            }
            const btnCargarCertificado = document.getElementById('btnCargarCertificado');
            btnCargarCertificado.addEventListener('click', async (e) => {
                e.preventDefault();
                limpiarErroresCertificacion();
                console.log('click');
                const formCargarCertificacion = document.getElementById('formCargarCertificacion');
                const formData = new FormData(formCargarCertificacion);
                const aplicaVigencia = document.getElementById('aplicaVigencia');
                const url = formCargarCertificacion.getAttribute('action');
                const method = formCargarCertificacion.getAttribute('method');
                formData.append('esVigente', aplicaVigencia.checked)
                const response = await fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'),
                    },
                });
                const data = await response.json();
                if (data.errors) {
                    $.each(data.errors, function(indexInArray,
                        valueOfElement) {
                        document.querySelector(`span.${indexInArray}_error`)
                            .innerHTML =
                            `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                    });
                }
                if (data.status === "success") {
                    Swal.fire(
                        data.message,
                        '',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });

            const inputCargarCertificacion = document.getElementById('cargarCertificacion');
            inputCargarCertificacion.addEventListener('change', function(e) {
                document.getElementById('infoSelectedCertificacion').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                <label title="Remover selección" style="cursor: pointer;color:red;">&times;</label>
                `
            });

            const infoSelectedCertificacionElement = document.getElementById('infoSelectedCertificacion');
            infoSelectedCertificacionElement.addEventListener('click', function(e) {
                e.preventDefault();
                if (e.target.tagName == 'LABEL') {
                    this.innerHTML = "";
                    console.log(inputCargarCertificacion.files);
                    inputCargarCertificacion.value = null;
                    console.log(inputCargarCertificacion.files);
                }
            })

            function limpiarErroresCertificacion() {
                document.querySelectorAll('.errors').forEach(item => {
                    item.innerHTML = ""
                })
            }

            const vigenciaCertificado = document.getElementById('vigencia');
            vigenciaCertificado.addEventListener('change', function(e) {
                const vigencia = this.value;
                const estatus = document.getElementById('vencio_alta');
                if (Date.parse(vigencia) >= Date.now()) {
                    estatus.value = "Vigente"
                    estatus.style.border = "2px solid #57e262";
                } else {
                    estatus.value = 'Vencida'
                    estatus.style.border = "2px solid #FF9C08";
                }
            })

            const inputFile = document.getElementById('cargarDocumentos');
            inputFile.addEventListener('change', function(e) {
                document.getElementById('infoSelected').innerHTML = `
                ${this.files.length} documento(s) seleccionados
                `
                Swal.fire({
                    title: '¿Desea almacenar estos documentos?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cargar',
                    cancelButtonText: 'No',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const formulario = document.getElementById('formCargaDocumentos');
                        const url = formulario.getAttribute('action');
                        const method = formulario.getAttribute('method');
                        const formData = new FormData(formulario);
                        const response = await fetch(url, {
                            method: method,
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        const data = await response.json();
                        if (data.status === "success") {
                            Swal.fire(
                                data.message,
                                '',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    } else {
                        document.getElementById('infoSelected').innerHTML = ""
                    }
                })
            })
        })
    </script>
</div>
