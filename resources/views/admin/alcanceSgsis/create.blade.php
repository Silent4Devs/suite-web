@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion"> Registrar: Determinación de Alcance</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.alcance-sgsis.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label class="required" for="nombre"><i class="fas fa-file-signature iconos-crear"></i>Nombre de Alcance</label>
                        <input type="text" class="form-control" id="nombre"  name="nombre"
                        value="{{ old('nombre') }}" required>
                            @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>

                    <label class="required" for="alcancesgsi"> <i class="fas fa-shield-alt iconos-crear"></i>Alcance </label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Actividad clave que determina la base necesaria para las actividades de implementación del SGSI."></i>
                    <textarea required class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }}" name="alcancesgsi"
                        id="alcancesgsi">{{ old('alcancesgsi') }}</textarea>
                    @if ($errors->has('alcancesgsi'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcancesgsi') }}
                        </div>
                    @endif
                </div>

                <div class="row">

                    <div class="form-group col-sm-4">
                        <label class="required" for="fecha_publicacion"><i class="far fa-calendar-alt iconos-crear"></i> Fecha de
                            publicación</label>
                        <input required class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                            value="{{ old('fecha_publicacion') }}">
                        @if ($errors->has('fecha_publicacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_publicacion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="required" for="fecha_entrada"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de entrada en
                            vigor</label>
                        <input required class="form-control {{ $errors->has('fecha_entrada') ? 'is-invalid' : '' }}" type="date"
                            name="fecha_entrada" id="fecha_entrada" min="1945-01-01"
                            value="{{ old('fecha_entrada') }}">
                        @if ($errors->has('fecha_entrada'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_entrada') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="required" for="fecha_revision"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                            revisión</label>
                        <input required class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }}" type="date"
                            name="fecha_revision" id="fecha_revision" min="1945-01-01"
                            value="{{ old('fecha_revision') }}">
                        @if ($errors->has('fecha_revision'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_revision') }}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="mt-1 form-group col-12">
                        <b>Revisó alcance:</b>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required" for="id_reviso_alcance"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                        <select required class="form-control select2 {{ $errors->has('reviso_alcance') ? 'is-invalid' : '' }}"
                            name="id_reviso_alcance" id="id_reviso_alcance">
                            <option disabled selected>Seleccionar colaborador</option>
                            @foreach ($empleados as $empleado)
                                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}"
                                    {{ old('id_reviso_alcance') == $empleado->id ? ' selected="selected"' : '' }}>
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_reviso_alcance'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_reviso_alcance') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                        <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="puesto_reviso" readonly></div>
                    </div>


                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                        <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="area_reviso" readonly></div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="required" for="normas"><i class="fas fa-ruler-vertical iconos-crear"></i>Norma(s)</label>
                        <select required
                        class="form-control js-example-basic-multiple controles-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
                        name="normas[]" id="controles" multiple="multiple">
                        <option value disabled>
                            Selecciona una opción</option>
                        @foreach ($normas as $norma)
                        <option value="{{ $norma->id }}" data-area="{{ $norma->norma }}"
                            {{ old('norma') == $norma->id ? ' selected="selected"' : '' }}>
                            {{ $norma->norma }}
                        </option>
                        @endforeach
                        </select>
                            @if ($errors->has('norma'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('normas') }}
                                </div>
                            @endif
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
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('alcancesgsi', {
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
            $('.controles-select').select2({
                'theme': 'bootstrap4'
            });

        });
    </script>

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
