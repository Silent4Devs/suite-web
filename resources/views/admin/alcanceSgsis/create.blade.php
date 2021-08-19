@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px">
        <h3 class="mb-1 text-center text-white"><strong>
        Registrar:</strong> Determinación de Alcance </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.alcance-sgsis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="alcancesgsi"> <i class="fas fa-shield-alt iconos-crear"></i>Alcance SGSI</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;" title="Actividad clave que determina la base necesaria para las actividades de implementación del SGSI."></i>
                <textarea class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }}" name="alcancesgsi" id="alcancesgsi">{{ old('alcancesgsi') }}</textarea>
                @if($errors->has('alcancesgsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcancesgsi') }}
                    </div>
                @endif
            </div>

            <div class="row">

                <div class="form-group col-sm-4">
                    <label for="fecha_publicacion"><i class="far fa-calendar-alt iconos-crear"></i> Fecha de publicación</label>
                    <input class="form-control {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}" type="date" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion') }}" >
                    @if($errors->has('fecha_publicacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_publicacion') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-4">
                    <label for="fecha_entrada"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de entrada en vigor</label>
                    <input class="form-control {{ $errors->has('fecha_entrada') ? 'is-invalid' : '' }}" type="date" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada') }}" >
                    @if($errors->has('fecha_entrada'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_entrada') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-4">
                    <label for="fecha_revision"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de revisión</label>
                    <input class="form-control {{ $errors->has('fecha_revision') ? 'is-invalid' : '' }}" type="date" name="fecha_revision" id="fecha_revision" value="{{ old('fecha_revision') }}" >
                    @if($errors->has('fecha_revision'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_revision') }}
                        </div>
                    @endif
                 </div>
            </div>


            <div class="row">
                <div class="mt-1 form-group col-12">
                    <b>Revisó política:</b>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="id_reviso_alcance"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                    <select class="form-control select2 {{ $errors->has('reviso_alcance') ? 'is-invalid' : '' }}" name="id_reviso_alcance" id="id_reviso_alcance">
                        @foreach ($empleados as $empleado)
                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}" {{ old('id_reviso_politica')==$empleado->id ? ' selected="selected"' : '' }}>

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
                    <div class="form-control" id="puesto_reviso"></div>

                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_reviso"></div>

                </div>

            </div>


            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
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
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
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

<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        let reviso_alcance = document.querySelector('#id_reviso_alcance');
        let area_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-area');
        let puesto_init = reviso_alcance.options[reviso_alcance.selectedIndex].getAttribute('data-puesto');

        document.getElementById('puesto_reviso').innerHTML = puesto_init;
        document.getElementById('area_reviso').innerHTML = area_init;
        reviso_politica.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_reviso').innerHTML = puesto;
            document.getElementById('area_reviso').innerHTML = area;
        })

    })
</script>


@endsection
