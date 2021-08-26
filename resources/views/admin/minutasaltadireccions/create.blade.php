@extends('layouts.admin')
@section('content')

    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }

    </style>

    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px">
            <h3 class="mb-1 text-center text-white">
                <strong>Registrar:</strong> Minutas de Sesiones de Alta Dirección
            </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.minutasaltadireccions.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="fechareunion"><i
                            class="fas fa-calendar-alt iconos-crear"></i>{{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}</label>
                    <input class="form-control date" type="date" name="fechareunion" id="fechareunion"
                        value="{{ old('fechareunion') }}">
                    @if ($errors->has('fechareunion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechareunion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="hora_inicio"><i class="fas fa-clock iconos-crear"></i>Horario de inicio</label>
                    <input class="form-control date" type="time" name="hora_inicio" id="hora_inicio"
                        value="{{ old('hora_inicio') }}">
                    @if ($errors->has('hora_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('hora_inicio') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                </div>


                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="responsablereunion_id"><i class="fas fa-user-tie iconos-crear"></i>Elaboró</label>
                    <select class="form-control select2" name="responsablereunion_id" id="responsablereunion_id">
                        @foreach ($responsablereunions as $responsablereunion)
                            <option value="{{ $responsablereunion->id }}"
                                {{ old ('responsablereunion_id') == $responsablereunion->id ? 'selected' : '' }}>{{ $responsablereunion->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsablereunion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsablereunion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.minutasaltadireccion.fields.responsablereunion_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="hora_termino"><i class="fas fa-clock iconos-crear"></i>Horario de término</label>
                    <input class="form-control date" type="time" name="hora_termino" id="hora_termino"
                        value="{{ old('hora_termino') }}">
                    @if ($errors->has('hora_termino'))
                        <div class="invalid-feedback">
                            {{ $errors->first('hora_termino') }}
                        </div>
                    @endif
                </div>



                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="tema_reunion"><i class="fas fa-file-alt iconos-crear"></i>Tema de la reunión</label>
                    <input class="form-control date" type="text" name="tema_reunion" id="tema_reunion"
                        value="{{ old('tema_reunion') }}">
                    @if ($errors->has('tema_reunion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tema_reunion') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="objetivoreunion"><i
                            class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}</label>
                    <textarea class="form-control" name="objetivoreunion"
                        id="objetivoreunion">{{ old('objetivoreunion') }}</textarea>
                    @if ($errors->has('objetivoreunion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivoreunion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion_helper') }}</span>
                </div>






                <div class="mb-4 ml-4 w-100" style="border-bottom: solid 2px #0CA193;">
                    <span class="ml-1" style="font-size: 17px; font-weight: bold;">
                        Participantes</span>
                </div>

                <div class="pl-3 row w-100">
                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                        <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                            participante</label>
                        <input type="hidden" id="id_empleado">
                        <input class="form-control" type="text" id="participantes_search" placeholder="Busca un empleado"
                            style="position: relative" autocomplete="off" />
                        <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                            style="position: absolute; top: 43px; right: 25px;"></i>
                        <div id="participantes_sugeridos"></div>
                        @if ($errors->has('participantes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('participantes') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                        <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
                        <input class="form-control" type="text" id="email" placeholder="Correo del participante" readonly
                            style="cursor: not-allowed" />
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                        <label for="email"><i class="fas fa-at iconos-crear"></i>Puesto</label>
                        <input class="form-control" type="text" id="puesto" placeholder="Puesto del participante" readonly
                            style="cursor: not-allowed" />
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                        <label for="email"><i class="fas fa-at iconos-crear"></i>Área</label>
                        <input class="form-control" type="text" id="area" placeholder="Área del participante" readonly
                            style="cursor: not-allowed" />
                    </div>
                </div>
                <div class="col-12">
                    <button id="btn-suscribir-participante" type="submit" class="mr-3 btn btn-sm btn-outline-success"
                        style="float: right; position: relative;">
                        <i class="mr-1 fas fa-plus-circle"></i>
                        Agregar Participante
                        {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                            style="position: absolute; top: 3px;left: 8px;"></i> --}}
                    </button>
                </div>

                <div class="mt-3 col-12 w-100 datatable-fix">
                    <table class="table w-100" id="tbl-participantes">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                {{-- <th scope="col">Área</th> --}}
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <input type="hidden" name="participantes" value="" id="participantes">





                <div class="mt-3 col-sm-12 form-group">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Documento</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="evidencia">

                    </div>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="tema_tratado"><i class="fas fa-file-alt iconos-crear"></i>Temas tratados</label>
                    <textarea class="form-control date" type="text" name="tema_tratado" id="temas"
                        value="{{ old('tema_tratado') }}"></textarea>
                    @if ($errors->has('tema_tratado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tema_tratado') }}
                        </div>
                    @endif
                </div>


                {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}
                <div class="row w-100 align-items-center" style="margin-left: 1px;">
                    @livewire('planes-implementacion-select',['planes_seleccionados'=>[]])
                    <div class="pl-0 mt-2 ml-0 col-2">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#planAccionModal">
                            <i class="mr-1 fas fa-plus-circle"></i> Crear
                        </button>
                    </div>
                    @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de Requisitos
                    Legales'])
                </div>
                {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}



                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" id="btnGuardar" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.minutasaltadireccions.storeMedia') }}',
            maxFilesize: 6, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 6
            },
            success: function(file, response) {
                $('form').find('input[name="archivo"]').remove()
                $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($minutasaltadireccion) && $minutasaltadireccion->archivo)
                    var file = {!! json_encode($minutasaltadireccion->archivo) !!}
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
    </script>


    <script>
        $(document).ready(function() {
            CKEDITOR.replace('temas', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
                ]
            });

        });
    </script>

    <script type="text/javascript">
        Livewire.on('planStore', () => {
            $('#planAccionModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Plan de Acción creado con éxito');
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
        $(document).ready(function () {
        window.tblParticipantes=$('#tbl-participantes').DataTable({buttons:[]})
        $("#cargando_participantes").hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let url = "{{ route('admin.empleados.get') }}";
        //busqueda
        $("#participantes_search").keyup(function() {
            $.ajax({
                type: "POST",
                url: url,
                data: 'nombre=' + $(this).val(),
                beforeSend: function() {
                    $("#cargando_participantes").show();
                },
                success: function(data) {
                    $("#cargando_participantes").hide();
                    $("#participantes_sugeridos").show();
                    let sugeridos = document.querySelector(
                        "#participantes_sugeridos");
                    sugeridos.innerHTML = data;

                    $("#participantes_search").css("background", "#FFF");
                }
            });

        });

        document.getElementById('btn-suscribir-participante').addEventListener('click',function(e){
            e.preventDefault();
            suscribirParticipante()
        })

        document.getElementById('btnGuardar').addEventListener('click',function(e){
            // e.preventDefault();
            enviarParticipantes()
        })

        });


        //listado de los empleados
        function seleccionarUsuario(user) {
            console.log(user);
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
             $("#area").val(user.area);
            $("#participantes_sugeridos").hide();
        }


        function suscribirParticipante() {
            //form-participantes

            let participantes=tblParticipantes.rows().data().toArray();
            let arrParticipantes=[];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])

            });
            let id_empleado = $("#id_empleado").val();
            if (!arrParticipantes.includes(id_empleado)) {
                let nombre = $("#participantes_search").val();
            let puesto = $("#puesto").val();
            let email = $("#email").val();
            tblParticipantes.row.add([
                id_empleado,
                nombre,
                puesto,
                email,
            ]).draw();

            }else{
                Swal.fire('Este participante ya ha sido agregado','','error')
            }

            $("#participantes_search").val('');
            $("#id_empleado").val('');
            $("#email").val('');
            $("#puesto").val('');
            $("#area").val('');
        }

        function enviarParticipantes(){
            let participantes=tblParticipantes.rows().data().toArray();
            let arrParticipantes=[];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])

            });
            document.getElementById('participantes').value=arrParticipantes;
            console.log(arrParticipantes);
        }
    </script>


@endsection
