@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.plan-auditoria.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Plan de Auditoría</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plan-auditoria.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                {{ Form::hidden('pdf-value', 'planAuditoria') }}


                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_auditoria"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de inicio</label>
                    <input class=" mt-2 form-control  {{ $errors->has('fecha_auditoria') ? 'is-invalid' : '' }}"
                        name="fecha_auditoria" type="datetime-local" id="fecha_auditoria" value="{{ old('fecha_auditoria') }}">
                    @if ($errors->has('fecha_auditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_auditoria') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_auditoria"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha fin</label>
                    <input class=" mt-2 form-control  {{ $errors->has('fecha_auditoria') ? 'is-invalid' : '' }}" type="datetime-local"
                        name="fecha_auditoria" id="fecha_auditoria" value="{{ old('fecha_auditoria') }}">
                    @if ($errors->has('fecha_auditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_auditoria') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="id_equipo_auditores"><i
                            class="fas fa-users iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.equipoauditoria') }}</label>
                    <select multiple
                        class="form-control select2 {{ $errors->has('id_equipo_auditores') ? 'is-invalid' : '' }}"
                        name="equipo[]" id="id_equipo_auditores">
                        @foreach ($equipoauditorias as $equipoauditoria)
                            <option value="{{ $equipoauditoria->id }}"
                                {{ old('id_equipo_auditores') == $equipoauditoria->id ? 'selected' : '' }}>
                                {{ $equipoauditoria->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('equipoauditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('equipoauditoria') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="objetivo"><i
                            class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.objetivo') }}</label>
                    <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo"
                        id="objetivo">{{ old('objetivo') }}</textarea>
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.objetivo_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="alcance"><i
                            class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.alcance') }}</label>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="alcance"
                        id="alcance">{{ old('alcance') }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="criterios"><i
                            class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.criterios') }}</label>
                    <textarea class="form-control {{ $errors->has('criterios') ? 'is-invalid' : '' }}" name="criterios"
                        id="criterios">{{ old('criterios') }}</textarea>
                    @if ($errors->has('criterios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('criterios') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.criterios_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="documentoauditar"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.documentoauditar') }}</label>
                    <textarea class="form-control {{ $errors->has('documentoauditar') ? 'is-invalid' : '' }}"
                        name="documentoauditar" id="documentoauditar">{{ old('documentoauditar') }}</textarea>
                    @if ($errors->has('documentoauditar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('documentoauditar') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.planAuditorium.fields.documentoauditar_helper') }}</span>
                </div>
                {{-- <div class="form-group col-12">
                <label for="equipoauditor"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.equipoauditor') }}</label>
                <input class="form-control {{ $errors->has('equipoauditor') ? 'is-invalid' : '' }}" type="text" name="equipoauditor" id="equipoauditor" value="{{ old('equipoauditor', '') }}">
                @if ($errors->has('equipoauditor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipoauditor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.equipoauditor_helper') }}</span>
            </div> --}}
                {{-- <div class="form-group col-12">
                <label for="auditados"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.auditados') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="select-all btn btn-info btn-xs" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('auditados') ? 'is-invalid' : '' }}" name="auditados[]" id="auditados" multiple>
                    @foreach ($auditados as $id => $auditados)
                        <option value="{{ $id }}" {{ in_array($id, old('auditados', [])) ? 'selected' : '' }}>{{ $auditados }}</option>
                    @endforeach
                </select>
                @if ($errors->has('auditados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auditados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.auditados_helper') }}</span>
            </div> --}}


                {{-- <div class="form-group col-12">
                    <label for="descripcion"><i
                            class="fas fa-align-left iconos-crear"></i>Descripción de actividades</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.descripcion_helper') }}</span>
                </div> --}}

                <div class="row col-12 ml-2">
                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                        Descripción de actividades</span>
                    </div>
                </div>

                <div class="row col-12 ">
                    <div class="col-sm-12 col-lg-12 col-md-12 mt-2">
                        <label for="nombre_contacto_int"><i class="fas fa-clipboard-list iconos-crear"></i>Actividad a Auditar</label>
                        <input class="form-control {{ $errors->has('nombre_contacto_int') ? 'is-invalid' : '' }}" name="actividad_auditar" id="auditar_actividad" value="{{ old('actividad_auditar') }}">
                            <small class="text-danger errores actividad_auditar_error"></small>
                    </div>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3">
                    <label for="fecha"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de auditaría</label>
                    <input class=" mt-2 form-control  {{ $errors->has('fecha') ? 'is-invalid' : '' }}"
                        name="fecha" type="date" id="fecha_act_auditoria" value="{{ old('fecha') }}">
                    <small class="text-danger errores fecha_error"></small>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-4">
                    <label for="hora_inicio"><i class="fas fa-clock iconos-crear"></i>Horario de inicio<span class="text-danger">*</span></label>
                    <input class="form-control date" type="time" name="hora_inicio" id="hora_inicio_actividad"
                        value="{{ old('hora_inicio') }}">
                    <small class="text-danger errores hora_inicio_error"></small>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-4">
                    <label for="hora_termino"><i class="fas fa-clock iconos-crear"></i>Horario de término<span class="text-danger">*</span></label>
                    <input class="form-control date" type="time" name="hora_fin" id="hora_fin_actividad"
                        value="{{ old('hora_termino') }}">
                    <small class="text-danger errores hora_fin_error"></small>

                </div>

                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="elaboro_id"><i class="fas fa-user-tie iconos-crear"></i>Auditado</label>
                    <select class="form-control {{ $errors->has('elaboro_id') ? 'is-invalid' : '' }}" name="elaboro_id" id="elaboro_id">
                        <option value="" selected disabled>
                            -- Selecciona el nombre del empleado --
                        </option>
                        @foreach ($empleados as $empleado)
                        <option data-image="{{ $empleado->foto}}" data-id-empleado="{{ $empleado->id }}"
                            data-gender="{{ $empleado->genero }}" data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">
                            {{ $empleado->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="text-danger errores auditado_error"></small>
                </div>

                <div class="form-group col-md-6">
                    <label><i class="fas fa-briefcase iconos-crear"></i>Area</label>
                    <div class="form-control" id="area_contacto"></div>
                    <small class="text-danger errores area_error"></small>
                </div>

                <div class="row col-12">
                    <div class="mb-3 col-12 mt-4 " style="text-align: end">
                        <button type="button" name="btn-suscribir-actividad" id="btn-suscribir-actividad"
                        class="btn btn-success">Agregar</button>
                    </div>
                </div>


                <div class="row col-12">
                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                        <table class="table w-100" id="contactos_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Fecha de auditoría</th>
                                    <th>Horario de inicio</th>
                                    <th>Horario de término</th>
                                    <th>Auditado</th>
                                    <th>Área</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_auditados">

                            </tbody>
                        </table>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $("#id_equipo_auditores").select2({
                theme: "bootstrap4",
            });


            CKEDITOR.replace('alcance', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('alcance', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('criterios', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('documentoauditar', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('objetivo', {
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

<script>

$(document).ready(function () {
        const $actividadesAuditoria=@json($actividadesAuditoria);
        console.log(contactos);
        let fila = 0;


    function agregarFilaAuditoria(contable,formulario) {
          console.log(contact)
          const contenedorAuditados=document.getElementById('contenedor_auditados');
          let html=`
          <tr>
            <td><input type="hidden" name="contactos[${contable}][id]"  value="${formulario.id?formulario.id:0}"><textarea class="form-control" style="min-height: 25px !important;" type="text" name="contactos[${contable}][actividad_auditar]" value="" >${formulario.actividadAuditar}</textarea></td>
            <td><input name="contactos[${contable}][fecha_act_auditoria]" value="${formulario.fechaAuditar}" >
            </td>
            <td><input name="contactos[${contable}][hora_inicio]" value="${formulario.horarioInicio}" >
            </td>
            <td><input name="contactos[${contable}][hora_fin]" value="${contact.id?contact.id:0}" value="${formulario.horarioFin}">
            </td>
            <td><select class="form-control" value="${formulario.nombreAuditado}" name="contactos[${contable}][contacto_puesto_id]">`
                auditados.forEach(auditado=>{
                html+=`<option data-puesto="${auditado.name}" data-contact="${contact.id}" value="${auditado.id}" ${contact.puestoContacto ==  auditado.id ? "selected":''} >${auditado.name}</option>`
            })
            html+=`</select>
            </td >
            <td><div class="form-control" style="white-space:nowrap" id="puesto${contact.id}">${contact.areaAuditado}</div>
            <td><button type="button"  name="btn-remove-actividad" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
          contenedorAuditados.innerHTML += html;
          limpiarFormularioAuditoria();

        }

        function limpiarFormularioAuditoria(){

          const actividadAuditar = document.getElementById('auditar_actividad').value;
          const fechaAuditar = document.getElementById('fecha_act_auditoria').value;
          const horarioInicio = document.getElementById('hora_inicio_actividad').value
          const horarioFin = document.getElementById('hora_fin_actividad').value;
          const nombreAuditado = document.getElementById('nombre_auditado').value;
          const areaAuditado = document.getElementById('area_auditado').innerText=null;

      }

        function limpiarErrores() {
            document.querySelectorAll('.errores').forEach(item => {
                item.innerText = null
            })
        }

      $(document).on("click", "#btn-suscribir-actividad", function () {
        limpiarErrores()

        const actividadAuditar = document.getElementById('auditar_actividad').value;
        const fechaAuditar = document.getElementById('fecha_act_auditoria').value;
        const horarioInicio = document.getElementById('hora_inicio_actividad').value;
        const horarioFin = document.getElementById('hora_fin_actividad').value;
        const nombreAuditado = document.getElementById('nombre_auditado').value;
        const areaAuditado = document.getElementById('area_contacto').innerText;




        if (actividadAuditar == "" || fechaAuditar == "" || horarioInicio == "" || horarioFin == "" || nombreContacto == "" || areaContacto == "") {
            if (actividadAuditar == "") {
                document.querySelector('.contacto_puesto_error').innerText =
                    "Debes agregar la actividad a auditar";
            }
            if (fechaAuditar == "") {
                document.querySelector('.contacto_area_error').innerText =
                    "Debes seleccionar la fecha";
            }
            if (horarioInicio == "") {
                document.querySelector('.descripcion_contacto_error').innerText =
                    "Debes agregar la hora de inicio";
            }
            if (horarioFin == "") {
                document.querySelector('.descripcion_contacto_error').innerText =
                    "Debes agregar la hora de fin";
            }
            if (nombreContacto == "") {
                document.querySelector('.auditado_error').innerText =
                    "Debes seleccionar el nombre del auditado";
            }
            if (areaContacto == "") {
                document.querySelector('.area_error').innerText =
                    "Debes seleccionar el nombre del auditado";
            }
        } else {
            let contact = {
                actividadAuditar,
                fechaAuditar,
                horarioInicio,
                horarioFin,
                nombreContacto,
                areaContacto
            }

            agregarFilaAuditoria(fila, formulario);
            fila++;
        }

         });

           // darle un DATA ATTRIBUTE al select y especificarlo ahi en la linea del if con un &
        document.getElementById('contactos_table').addEventListener('change', function(e){
            console.log(e.target.tagName);
            if(e.target.tagName == 'SELECT'){
            const area=e.target.options[e.target.selectedIndex].getAttribute('data-area');
            const contact=e.target.options[e.target.selectedIndex].getAttribute('data-contact');
            document.getElementById(`puesto${contact}`).innerText=area;
            }

        })


        $(document).on("click", ".btn-remove-actividad", function () {
            $(this).closest("tr").remove();
            fila --;
     });

 });

</script>
