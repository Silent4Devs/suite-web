@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.accion-correctivas.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Acción Correctiva</h5>
    <div class="mt-4 card">
        @include('layouts.errors')

        <div class="card-body">

            <div class="container">
                <div class="row">

                    <div class="caja_botones_menu">
                        <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-diagnoses"
                                style="font-size:30px;" style="text-decoration:none;"></i>Acción Correctiva</a>
                        {{-- <a href="#" data-tabs="contenido2"><i class="mr-2 fab fa-medapps" style="font-size:30px;"
                                style="text-decoration:none;"></i> Ánalisis de causa raíz</a>
                        <a href="#" data-tabs="contenido3"><i class="mr-2 fas fa-file-alt" style="font-size:30px;"
                                style="text-decoration:none;"></i>Plan de acción</a> --}}
                    </div>


                    {{-- <button id="acollapseExample" data-toggle="collapse" onclick="closetabcollap1()"
                            data-target="#collapseExample" class="btn btn-danger">Acción Correctiva</button>
                        <button id="acollapseplan" data-toggle="collapse" onclick="closetabcollap2()"
                            data-target="#collapseplan" class="btn btn-primary">Análisis de causa raíz</button>
                        <button id="acollapseactividad" data-toggle="collapse" onclick="" data-target="#"
                            class="btn btn-primary">Plan de acción</button> --}}
                    <div class="caja_caja_secciones">
                        <div class="caja_secciones">

                            <section id="contenido1" class="caja_tab_reveldada">
                                <div>

                                    <div id="test-nl-1" class="mt-5 content">
                                        @include('admin.accionCorrectivas.createform1')

                                    </div>

                                </div>
                            </section>

                            <section id="contenido2">
                                <div>
                                    <div class="mt-5 ml-2">
                                        @include('admin.accionCorrectivas.createform2')
                                    </div>
                                </div>
                            </section>

                            <section id="contenido3">
                                <div>

                                </div>
                            </section>

                        </div>
                    </div>


                </div>
            @endsection

            @section('scripts')
                <script>
                    $("#acollapseExample").click(function() {

                        $("#acollapseExample").removeClass('btn btn-primary').addClass("btn btn-danger");
                        $("#acollapseplan").removeClass('btn btn-danger').addClass("btn btn-primary");
                    });

                    $("#acollapseplan").click(function() {
                        $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
                        $(this).toggleClass("btn btn-danger");
                        $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
                    });
                    $("#form-siguienteaccion").click(function() {
                        $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
                        $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
                    });



                    function closetabcollap1() {
                        $('#collapseExample').collapse('show');
                        $('#collapseplan').collapse('hide');
                        $('#collapseactividad').collapse('hide');
                    }



                    function closetabcollap2() {
                        $('#collapseExample').collapse('hide');
                        $('#collapseplan').collapse('show');
                        $('#collapseactividad').collapse('hide');
                    }

                    function closetabcollanext2() {
                        $('#collapseExample').collapse('hide');
                        $('#collapseplan').collapse('show');
                        $('#collapseactividad').collapse('hide');
                    }

                    function closetabcollap3() {
                        $('#collapseExample').collapse('hide');
                        $('#collapseplan').collapse('hide');
                        $('#collapseactividad').collapse('show');
                    }
                </script>


                <script>
                    Dropzone.options.documentometodoDropzone = {
                        url: "{{ route('admin.accion-correctivas.storeMedia') }}",
                        maxFilesize: 4, // MB
                        maxFiles: 1,
                        addRemoveLinks: true,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        params: {
                            size: 4
                        },
                        success: function(file, response) {
                            $('form').find('input[name="documentometodo"]').remove()
                            $('form').append('<input type="hidden" name="documentometodo" value="' + response.name +
                                '">')
                        },
                        removedfile: function(file) {
                            file.previewElement.remove()
                            if (file.status !== 'error') {
                                $('form').find('input[name="documentometodo"]').remove()
                                this.options.maxFiles = this.options.maxFiles + 1
                            }
                        },
                        init: function() {
                            @if (isset($accionCorrectiva) && $accionCorrectiva->documentometodo)
                                var file = {!! json_encode($accionCorrectiva->documentometodo) !!}
                                this.options.addedfile.call(this, file)
                                file.previewElement.classList.add('dz-complete')
                                $('form').append('<input type="hidden" name="documentometodo" value="' + file.file_name + '">')
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
                    document.addEventListener('DOMContentLoaded', function(e) {

                        let reporto = document.querySelector('#id_reporto');
                        let area_init = reporto.options[reporto.selectedIndex].getAttribute('data-area');
                        let puesto_init = reporto.options[reporto.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('reporto_puesto').innerHTML = recortarTexto(puesto_init);
                        document.getElementById('reporto_area').innerHTML = recortarTexto(area_init);

                        let registro = document.querySelector('#id_registro');
                        let area = registro.options[registro.selectedIndex].getAttribute('data-area');
                        let puesto = registro.options[registro.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('registro_puesto').innerHTML = recortarTexto(puesto);
                        document.getElementById('registro_area').innerHTML = recortarTexto(area);


                        reporto.addEventListener('change', function(e) {
                            e.preventDefault();
                            let area = this.options[this.selectedIndex].getAttribute('data-area');
                            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                            document.getElementById('reporto_puesto').innerHTML = recortarTexto(puesto);
                            document.getElementById('reporto_area').innerHTML = recortarTexto(area);
                        })
                        registro.addEventListener('change', function(e) {
                            e.preventDefault();
                            let area = this.options[this.selectedIndex].getAttribute('data-area');
                            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                            document.getElementById('registro_puesto').innerHTML = recortarTexto(puesto);
                            document.getElementById('registro_area').innerHTML = recortarTexto(area);
                        })

                    });

                    function recortarTexto(texto, length = 30) {
                        let trimmedString = texto?.length > length ?
                            texto.substring(0, length - 3) + "..." :
                            texto;
                        return trimmedString;
                    }
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', function(e) {


                        let atencion = document.querySelector('#id_atencion');
                        let area_init = atencion.options[atencion.selectedIndex].getAttribute('data-area');
                        let puesto_init = atencion.options[atencion.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('atencion_puesto').innerHTML = recortarTexto(puesto_init);
                        document.getElementById('atencion_area').innerHTML = recortarTexto(area_init);

                        let autorizo = document.querySelector('#id_autorizo');
                        let area = autorizo.options[autorizo.selectedIndex].getAttribute('data-area');
                        let puesto = autorizo.options[autorizo.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('autorizo_puesto').innerHTML = recortarTexto(puesto);
                        document.getElementById('autorizo_area').innerHTML = recortarTexto(area);

                        atencion.addEventListener('change', function(e) {
                            e.preventDefault();
                            let area = this.options[this.selectedIndex].getAttribute('data-area');
                            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                            document.getElementById('atencion_puesto').innerHTML = recortarTexto(puesto);
                            document.getElementById('atencion_area').innerHTML = recortarTexto(area);
                        })
                        autorizo.addEventListener('change', function(e) {
                            e.preventDefault();
                            let area = this.options[this.selectedIndex].getAttribute('data-area');
                            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                            document.getElementById('autorizo_puesto').innerHTML = recortarTexto(puesto);
                            document.getElementById('autorizo_area').innerHTML = recortarTexto(area);
                        })

                        function recortarTexto(texto, length = 30) {
                            let trimmedString = texto?.length > length ?
                                texto.substring(0, length - 3) + "..." :
                                texto;
                            return trimmedString;
                        }


                    });
                </script>

                <script type="text/javascript">
                    $(document).on('change', '#select_metodos', function(event) {
                        $(".caja_oculta_dinamica").removeClass("d-block");
                        var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
                        $(document.getElementById(metodo_v)).addClass("d-block");
                    });

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
                            let texto_activos = document.querySelector(
                                '.procesos_multiselect #texto_activos');

                            texto_activos.value += `${this.value}, `;

                        });
                    });
                    document.addEventListener('DOMContentLoaded', function() {
                        let select_activos = document.querySelector('.activos_multiselect #activos');
                        select_activos.addEventListener('change', function(e) {
                            e.preventDefault();
                            let texto_activos = document.querySelector(
                                '.activos_multiselect #texto_activos');

                            texto_activos.value += `${this.value}, `;

                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        CKEDITOR.replace('descripcion', {
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
                            ]
                        });

                    });
                </script>
                <script>
                    $(document).ready(function() {
                        CKEDITOR.replace('comentarios', {
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
                            ]
                        });

                    });
                </script>
            @endsection
