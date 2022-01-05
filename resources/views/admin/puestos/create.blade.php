@extends('layouts.admin')
@section('content')


    {{ Breadcrumbs::render('perfil-puesto-create') }}
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Puesto</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.puestos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row col-12">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="puesto"><i
                                class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.puesto.fields.puesto') }}</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text" name="puesto"
                            id="puesto" value="{{ old('puesto', '') }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_reporta"><i class="fas fa-user-tie iconos-crear"></i>Reporta a</label>
                        <select class="form-control {{ $errors->has('id_reporta') ? 'is-invalid' : '' }}" name="id_reporta" id="id_reporta">
                            @foreach ($reportas as $reporta)
                            <option  value="{{ $reporta->id }}">
                                {{ $reporta->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('reporta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reporta') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_area"><i class="fas fa-user-tie iconos-crear"></i>Área</label>
                        <select class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" name="id_area" id="id_area">
                            @foreach ($areas as $area)
                            <option  value="{{ $area->id }}">
                                {{ $area->area }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_area') }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="descripcion"><i class="fas fa-file-signature iconos-crear"></i>Descripción<span
                            class="text-danger">*</span></label>
                    <textarea class="form-control date" type="text" name="descripcion" id="descripcion">
                                        {{ old('descripcion') }}
                                    </textarea>
                    @if ($errors->has('descripcion'))
                        <span class="text-danger">
                            {{ $errors->first('descripcion') }}
                        </span>
                    @endif
                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="estudios"><i class="fas fa-file-signature iconos-crear"></i>Estudios<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="estudios" id="estudios">
                                            {{ old('estudios') }}
                                        </textarea>
                        @if ($errors->has('estudios'))
                            <span class="text-danger">
                                {{ $errors->first('estudios') }}
                            </span>
                        @endif
                    </div>

                {{-- <div class="row col-12"> --}}
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="experiencia"><i class="fas fa-file-signature iconos-crear"></i>Experiencia<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="experiencia" id="experiencia">
                                            {{ old('experiencia') }}
                                        </textarea>
                        @if ($errors->has('experiencia'))
                            <span class="text-danger">
                                {{ $errors->first('experiencia') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos"><i class="fas fa-file-signature iconos-crear"></i>Conocimientos<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="conocimientos" id="conocimientos">
                                            {{ old('conocimientos') }}
                                        </textarea>
                        @if ($errors->has('conocimientos'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="certificaciones"><i class="fas fa-file-signature iconos-crear"></i>Certificaciones<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="certificaciones" id="certificaciones">
                                            {{ old('certificaciones') }}
                                        </textarea>
                        @if ($errors->has('certificaciones'))
                            <span class="text-danger">
                                {{ $errors->first('certificaciones') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos_esp"><i class="fas fa-file-signature iconos-crear"></i>Conocimientos Especiales<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="conocimientos_esp" id="conocimientos_esp">
                                            {{ old('conocimientos_esp') }}
                                        </textarea>
                        @if ($errors->has('conocimientos_esp'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos_esp') }}
                            </span>
                        @endif
                    </div>




{{-- bueno --}}
                    {{-- <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <div class="">
                                <label for="idioma"><i class="fas fa-user-tie iconos-crear"></i>Idioma</label>
                                <select class="form-control selectpicker {{ $errors->has('idioma') ? 'is-invalid' : '' }}" name="idioma" id="choices-multiple-remove-button" placeholder="selecciona" multiple>
                                    @foreach ($idis as $idi)
                                    <option  value={{$idi->abr}}>{{ $idi->idioma }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idioma'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('idioma') }}
                                </div>
                                @endif
                        </div>
                    </div> --}}


                    {{-- <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label for="idioma"><i class="fas fa-user-tie iconos-crear"></i>Idioma</label>
                        <select class="form-control selectpicker {{ $errors->has('idioma') ? 'is-invalid' : '' }}" name="idioma" id="idioma" multiple data-live-search="true">
                            @foreach ($lenguajes as $lenguaje)
                            <option  value={{$lenguaje->abr}}>{{ $lenguaje->idioma }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('idioma'))
                        <div class="invalid-feedback">
                            {{ $errors->first('idioma') }}
                        </div>
                        @endif
                    </div> --}}

                    {{-- <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label class="required" for="porcentaje"><i
                                class="fas fa-briefcase iconos-crear"></i>Porcentaje</label>
                        <input class="form-control {{ $errors->has('porcentaje') ? 'is-invalid' : '' }}" type="number" name="porcentaje"
                            id="porcentaje" value="{{ old('porcentaje', '') }}"  min="0" max="100" required>
                        @if ($errors->has('porcentaje'))
                            <div class="invalid-feedback">
                                {{ $errors->first('porcentaje') }}
                            </div>
                        @endif
                    </div> --}}
                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <table class="table" id="user_table">
                            <tbody>
                                <div class="">
                                    <label class="col-md-3 col-sm-3" for="working_day" style="text-align: center;"><i
                                            class="fas fa-calendar-alt iconos-crear"></i>Idioma</label>
                                    <label class="col-md-3 col-sm-3" for="working_day" style="text-align: center;"><i
                                            class="fas fa-clock iconos-crear"></i>Porcentaje</label>
                                </div>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
                <div class="row col-12">

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="lugar_trabajo"><i class="far fa-building iconos-crear"></i>Lugar de trabajo</label>
                        {{-- <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}" name="lugar_trabajo" id="lugar_trabajo"> --}}
                        <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}" name="lugar_trabajo" id="lugar_trabajo">
                            <option value="" selected>Selecciona</option>
                            <option value="Home Office">Home Office</option>
                            <option value="Oficina">Oficina</option>
                            <option value="Cliente">Cliente</option>
                        </select>
                        {{-- </select> --}}
                        @if ($errors->has('lugar_trabajo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lugar_trabajo') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="sueldo"><i class="fas fa-dollar-sign iconos-crear"></i>Sueldo</label>
                        <input class="form-control {{ $errors->has('sueldo') ? 'is-invalid' : '' }}" type="text" name="sueldo"
                            id="sueldo" value="{{ old('sueldo', '') }}" data-type='currency' required>
                        @if ($errors->has('sueldo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sueldo') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-sm-2 col-md-2 col-lg-2">
                        <label class="required" for="horario_inicio"><i class="fas fa-clock iconos-crear"></i>Horario</label>
                               <input  class="form-control {{ $errors->has('horario_inicio') ? 'is-invalid' : '' }}" type="time" name="horario"
                                    id="horario_inicio" value="{{ old('horario_inicio', '') }}" required>
                                @if ($errors->has('horario_inicio'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('horario_inicio') }}
                                    </div>
                                @endif
                            {{-- <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span> --}}

                    </div>

                    <div class="form-group col-sm-2 col-md-2 col-lg-2 ">
                        <label class="mt-3" for="horario_termino"></label>
                               <input  class="form-control {{ $errors->has('horario_termino') ? 'is-invalid' : '' }}" type="time" name="horario_termino"
                                    id="horario_termino" value="{{ old('horario_termino', '') }}" required>
                                @if ($errors->has('horario_termino'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('horario_termino') }}
                                    </div>
                                @endif
                            {{-- <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span> --}}

                    </div>

                </div>
                <div class="row col-12">

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="genero"><i class="fas fa-restroom iconos-crear"></i>Género</label>
                        <select class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero" id="genero">
                            <option value="" selected>Selecciona</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Indistinto">Indistinto</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="estado_civil"><i class=" fas fa-heart iconos-crear"></i>Estado Civil</label>
                        <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" name="estado_civil" id="estado_civil">
                            <option value="" selected>Selecciona</option>
                            <option value="Soltero">Soltero(a)</option>
                            <option value="Casado">Casado(a)</option>
                            <option value="Indistinto">Indistinto</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-2 col-md-2 col-lg-2">
                        <label class="required" for="edad_de"><i class="fas fa-user-tie iconos-crear"></i>Edad</label>
                        <input class="form-control {{ $errors->has('edad_de') ? 'is-invalid' : '' }}" type="number" name="edad_de"
                            id="edad_de" value="{{ old('edad_de', '') }}" required>
                        @if ($errors->has('edad_de'))
                            <div class="invalid-feedback">
                                {{ $errors->first('edad_de') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span> --}}
                    </div>

                    <div class="form-group mt-2 col-sm-2 col-md-2 col-lg-2">
                        <label  for="edad_a"></label>
                        <input class="form-control {{ $errors->has('edad_a') ? 'is-invalid' : '' }}" type="number" name="edad_a"
                            id="edad_a" value="{{ old('edad_a', '') }}" required>
                        @if ($errors->has('edad_a'))
                            <div class="invalid-feedback">
                                {{ $errors->first('edad_a') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span> --}}
                    </div>


                </div>
                <div class="form-group col-12 text-right" style="margin-left:15px;">
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

        function initInpusToMoneyFormat() {
            document.querySelectorAll("input[data-type='currency']").forEach(element => {
                formatCurrency($(element));
            })
        }

        function inputsToMoneyFormat() {
            $("input[data-type='currency']").on({
                init: function() {
                    console.log(this);
                },
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }



    </script>

    {{-- <script>

        $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:182,
                searchResultLimit:182,
                renderChoiceLimit:182
            });
        });

    </script> --}}

    <script>
        $(document).ready(function () {
          var count = 1;

          dynamic_field(count);

          function dynamic_field(number) {
            html = "<tr>";
            html +=
                '<td><select type="" name="first_name[]" class="form-control col-md-4" /></td>';
            html +=
                '<td><input type="text" name="last_name[]" class="form-control" /></td>';
            //   html +=
            //   '<td><input type="text" name="last_name[]" class="form-control" /></td>';
            if (number > 1) {
              html +=
                '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
              $("#user_table tbody").append(html);
            } else {
              html +=
                '<td col-2><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
              $("#user_table tbody").html(html);
            }
          }

          $(document).on("click", "#add", function () {
            count++;
            dynamic_field(count);
          });

          $(document).on("click", ".remove", function () {
            count--;
            $(this).closest("tr").remove();
          });


        });
      </script>


@endsection
