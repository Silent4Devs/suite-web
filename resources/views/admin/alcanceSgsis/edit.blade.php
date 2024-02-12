@extends('layouts.admin')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .radius {
            border-radius: 16px;
            box-shadow: none;
        }

        .titulo-card {
            text-align: left;
            font: 20px Roboto;
            color: #606060;
        }

        .boton-cancelar {
            background-color: white;
            border-color: #057BE2;
            font: 14px Roboto;
            color: #057BE2;
            border-radius: 4px;
            width: 148px;
            height: 48px;
            align-content: center;
        }

        .boton-enviar {
            background-color: #057BE2;
            border-color: #057BE2;
            font: 14px Roboto;
            color: white;
            border-radius: 4px;
            width: 148px;
            height: 48px;
        }

        .form {
            background: #F8FAFC;
            border-radius: 4px;
            opacity: 1;
        }
    </style>
    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Determinación de Alcance </h5>
            <div class="card card-body" style="background-color: #5397D5; color: #fff;">
                <div class="d-flex" style="gap: 25px;">
                    <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
                    <div>
                        <br>
                        <h4>¿Qué es? Determinación de Alcance</h4>
                        <p>
                            Define y documenta de manera detallada qué trabajo se llevará a cabo y qué no se incluirá dentro de los
                            límites del proyecto.
                        </p>
                        <p>
                            Es un paso crucial que establece las bases para la planificación y ejecución exitosa de un proyecto, ya
                            que ayuda a evitar
                            la expansión no controlada del proyecto y asegura que todas las partes involucradas tengan una
                            comprensión clara de lo que se espera.
                        </p>
                    </div>
                </div>
            </div>

    <div class="mt-4 card radius">

        <div class="card-body">
            <h5 class="titulo-card">Alcance</h5>
            <hr>
            <form method="POST" action="{{ route('admin.alcance-sgsis.update', [$alcanceSgsi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group anima-focus">
                        <input class="form-control form" maxlength="255"  pattern="[a-zA-Z0-9\s\u00C0-\u024F\u1E00-\u1EFF\u0400-\u04FF\u0500-\u052F\u2DE0-\u2DFF\uA640-\uA69F\uA720-\uA7FF\uAB30-\uAB6F\uAC00-\uD7AF\u3040-\u309F\u30A0-\u30FF\u4E00-\u9FFF\u3400-\u4DBF\u20000-\u2A6DF\u2A700-\u2B73F\u2B740-\u2B81F\u2B820-\u2CEAF\u2CEB0-\u2EBEF]+"  placeholder="" id="nombre"
                            name="nombre"value="{{ old('nombre', $alcanceSgsi->nombre) }}" required>
                            {!! Form::label('nombre', 'Nombre del alcance*', ['class' => 'asterisco']) !!}
                </div>
                <div class="form-group anima-focus">
                        <textarea required placeholder="" maxlength="255"  pattern="[a-zA-Z0-9\s\u00C0-\u024F\u1E00-\u1EFF\u0400-\u04FF\u0500-\u052F\u2DE0-\u2DFF\uA640-\uA69F\uA720-\uA7FF\uAB30-\uAB6F\uAC00-\uD7AF\u3040-\u309F\u30A0-\u30FF\u4E00-\u9FFF\u3400-\u4DBF\u20000-\u2A6DF\u2A700-\u2B73F\u2B740-\u2B81F\u2B820-\u2CEAF\u2CEB0-\u2EBEF]+"  class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }} form" name="alcancesgsi"
                            id="alcancesgsi" >{!! old('alcancesgsi', strip_tags($alcanceSgsi->alcancesgsi)) !!}</textarea>
                        @if ($errors->has('alcancesgsi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('alcancesgsi') }}
                            </div>
                        @endif
                        {!! Form::label('alcancesgsi', 'Alcance*', ['class' => 'asterisco']) !!}
                </div>
                <br>
                    <div class="row">
                        <div class="form-group anima-focus col-sm-6">
                            <input required
                                class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }} form"
                                type="date" name="fecha_publicacion" placeholder="" id="fecha_publicacion" min="1945-01-01"
                                value="{{ old('fecha_publicacion', \Carbon\Carbon::parse($alcanceSgsi->fecha_publicacion)->format('Y-m-d')) }}">
                            @if ($errors->has('fecha_publicacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_publicacion') }}
                                </div>
                            @endif
                            {!! Form::label('fecha_publicacion', 'Fecha de publicación*', ['class' => 'asterisco']) !!}
                        </div>


                        <div class="form-group anima-focus col-sm-6 mb-3">
                            <input required
                                class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }} form"
                                type="date" name="fecha_revision" placeholder="" id="fecha_revision" min="1945-01-01"
                                value="{{ old('fecha_revision', \Carbon\Carbon::parse($alcanceSgsi->fecha_revision)->format('Y-m-d')) }}">
                            @if ($errors->has('fecha_revision'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_revision') }}
                                </div>
                            @endif
                            {!! Form::label('fecha_publicacion', 'Fecha de revisión*', ['class' => 'asterisco']) !!}
                        </div>
                    </div>


                    <div class="text-right form-group col-12">
                        <a href="{{ route('admin.alcance-sgsis.index') }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
            </form>
        </div>
    @endsection


    @section('scripts')
        {{-- <script>
            $(document).ready(function() {
                CKEDITOR.replace('alcancesgsi', {
                    toolbar: [
                        // {
                        //     name: 'styles',
                        //     items: ['Styles', 'Format', 'Font', 'FontSize']
                        // },
                        // {
                        //     name: 'colors',
                        //     items: ['TextColor', 'BGColor']
                        // },
                        // {
                        //     name: 'editing',
                        //     groups: ['find', 'selection', 'spellchecker'],
                        //     items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                        // }, {
                        //     name: 'clipboard',
                        //     groups: ['undo'],
                        //     items: ['Undo', 'Redo']
                        // },
                        // {
                        //     name: 'tools',
                        //     items: ['Maximize']
                        // },
                        // {
                        //     name: 'basicstyles',
                        //     groups: ['basicstyles', 'cleanup'],
                        //     items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                        //         '-',
                        //         'CopyFormatting', 'RemoveFormat'
                        //     ]
                        // },
                        // {
                        //     name: 'paragraph',
                        //     groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        //     items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        //         'Blockquote',
                        //         '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                        //         'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        //     ]
                        // },
                        // {
                        //     name: 'links',
                        //     items: ['Link', 'Unlink']
                        // },
                        // {
                        //     name: 'insert',
                        //     items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                        // },
                        // '/',


                        // // {
                        // //     name: 'others',
                        // //     items: ['-']
                        // // }
                    ]
                });
                // $('.controles-select').select2({
                //     'theme': 'bootstrap4'
                // });

            });
        </script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function(e) {

                let reviso_alcance = document.querySelector('#id_reviso_alcance');
                let area_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-area');
                let puesto_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-puesto');

                document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto_init);
                document.getElementById('area_reviso').innerHTML = recortarTexto(area_init);
                reviso_alcance.addEventListener('change', function(e) {
                    e.preventDefault();
                    let area = this.options[this.selectedIndex].getAttribute('data-area');
                    let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                    document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto);
                    document.getElementById('area_reviso').innerHTML = recortarTexto(area);
                })

            })

            function recortarTexto(texto, length = 30) {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }
        </script>
    @endsection
