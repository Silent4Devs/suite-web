@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}{{config('app.cssVersion')}}">
    <h5 class="col-12 titulo_general_funcion"> Editar: </h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.organizacions.update', [$organizacion->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="org_id" value="{{ $organizacion->id }}">


                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <p class="mb-1 text-center text-white">DATOS GENERALES</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-7">
                        <label class="required" for="empresa"><i class="far fa-building iconos-crear"></i> Nombre de la
                            Empresa</label>
                        <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                            name="empresa" id="empresa" value="{{ old('empresa', $organizacion->empresa) }}" required>
                        @if ($errors->has('empresa'))
                            <div class="invalid-feedback">
                                {{ $errors->first('empresa') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-5">
                        {{-- @dump($organizacion['logotipo']) --}}
                        <label for="logotipo">Logotipo <strong>(Selecciona tu imagen en formato .png)</strong></label>
                        <div class="mb-3 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="logotipo" id="logotipo" accept="image/*">
                                <label class="custom-file-label"
                                    for="inputGroupFile02">{{ $organizacion->logotipo != null ? $organizacion->logotipo : 'imagenes' }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="required" for="direccion"><i
                                class="fas fa-map-marker-alt iconos-crear"></i>{{ trans('cruds.organizacion.fields.direccion') }}</label>
                        <textarea class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                            name="direccion" id="direccion" required
                            style="min-height: 0px; max-height: 200px; height: 35px;">{{ old('direccion', $organizacion->direccion) }}</textarea>
                        @if ($errors->has('direccion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('direccion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="" for="razon_social">Razón Social</label>
                        <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text" name="razon_social" id="razon_social" value="{{ old('razon_social', $organizacion->razon_social) }}" >
                        @if ($errors->has('razon_social'))
                            <div class="invalid-feedback">
                                {{ $errors->first('razon_social') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-sm-6">
                        <label class="" for="rfc">RFC</label>
                        <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" value="{{ old('rfc', $organizacion->rfc) }}" >
                        @if ($errors->has('rfc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rfc') }}
                            </div>
                        @endif

                    </div>
                </div> --}}

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="" for="razon_social">Razón Social</label>
                        <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text"
                            name="razon_social" id="razon_social"
                            value="{{ old('razon_social', $organizacion->razon_social) }}">
                        @if ($errors->has('razon_social'))
                            <div class="invalid-feedback">
                                {{ $errors->first('razon_social') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="" for="rfc">RFC</label>
                        <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                            name="rfc" id="rfc" value="{{ old('rfc', $organizacion->rfc) }}">
                        @if ($errors->has('rfc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rfc') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                        <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                            name="telefono" id="telefono" value="{{ old('telefono', $organizacion->telefono) }}"
                            step="1">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="correo"> <i
                                class="far fa-envelope iconos-crear"></i>{{ trans('cruds.organizacion.fields.correo') }}</label>
                        <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email"
                            name="correo" id="correo" value="{{ old('correo', $organizacion->correo) }}">
                        @if ($errors->has('correo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('correo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="pagina_web"><i class="fas fa-pager iconos-crear"></i>Página Web</label>
                        <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="text"
                            name="pagina_web" id="pagina_web" value="{{ old('pagina_web', $organizacion->pagina_web) }}">
                        @if ($errors->has('pagina_web'))
                            <div class="invalid-feedback">
                                {{ $errors->first('pagina_web') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="linkedln"> <i class="fab fa-linkedin iconos-crear"></i>Linkedln</label>
                        <input class="form-control {{ $errors->has('linkedln') ? 'is-invalid' : '' }}" type="url"
                            name="linkedln" id="linkedln" value="{{ old('linkedln', $organizacion->linkedln) }}">
                        @if ($errors->has('linkedln'))
                            <div class="invalid-feedback">
                                {{ $errors->first('linkedln') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="youtube"><i class="fab fa-youtube iconos-crear"></i>YouTube</label>
                        <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="url"
                            name="youtube" id="youtube" value="{{ old('youtube', $organizacion->youtube) }}">
                        @if ($errors->has('youtube'))
                            <div class="invalid-feedback">
                                {{ $errors->first('youtube') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="facebook"><i class="fab fa-facebook-square iconos-crear"></i>Facebook</label>
                        <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="url"
                            name="facebook" id="facebook" value="{{ old('facebook', $organizacion->facebook) }}">
                        @if ($errors->has('facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="twitter"><i class="fab fa-twitter-square iconos-crear"></i>Twitter</label>
                        <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="url"
                            name="twitter" id="twitter" value="{{ old('twitter', $organizacion->twitter) }}">
                        @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                    </div>
                </div>

                <div class="form-group col-12 mt-2">
                    <table class="table" id="user_table">
                        <tbody>
                            <div class=" row col-12 p-0 m-0">
                                <label class="col-md-3 col-sm-3" for="working_day" style="text-align: center;"><i
                                        class="fas fa-calendar-alt iconos-crear"></i>Día Laboral</label>
                                <label class="col-md-3 col-sm-3" for="working_day" style="text-align: center;"><i
                                        class="fas fa-clock iconos-crear"></i>Horario Laboral Inicio</label>
                                <label class="col-md-3 col-sm-3" for="working_day" style="text-align: center;"><i
                                        class="fas fa-clock iconos-crear"></i>Horario Laboral Fin</label>
                                <label class="col-md-3 col-sm-3" for="working_day"
                                    style="text-align: center;"></i>Opciones</label>
                            </div>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>


                <div class="row">

                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <p class="mb-1 text-center text-white">DATOS COMPLEMENTARIOS</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="" for="representante_legal">Representante Legal</label>
                        <input class="form-control {{ $errors->has('representante_legal') ? 'is-invalid' : '' }}"
                            type="text" name="representante_legal" id="representante_legal"
                            value="{{ old('representante_legal', $organizacion->representante_legal) }}">
                        @if ($errors->has('representante_legal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('representante_legal') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha_constitucion">Fecha de constitución</label>
                        <input class=" form-control date {{ $errors->has('fecha_constitucion') ? 'is-invalid' : '' }}"
                            type="date" name="fecha_constitucion" id="fecha_constitucion"
                            value="{{ old('fecha_constitucion', $organizacion->fecha_constitucion) }}">
                        @if ($errors->has('fecha_constitucion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_constitucion') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="" for="num_empleados">Número de empleados</label>
                        <input class="form-control {{ $errors->has('num_empleados') ? 'is-invalid' : '' }}" type="number"
                            name="num_empleados" id="num_empleados" value="{{ old('num_empleados', $countEmpleados) }}"
                            readonly>
                        @if ($errors->has('num_empleados'))
                            <div class="invalid-feedback">
                                {{ $errors->first('num_empleados') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="" for="tamano">Tamaño</label>
                        <input class="form-control {{ $errors->has('tamano') ? 'is-invalid' : '' }}" type="text"
                            name="tamano" id="tamano" value="{{ old('tamano', $tamanoEmpresa) }}" readonly>
                        @if ($errors->has('tamano'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tamano') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="giro"><i
                                class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.organizacion.fields.giro') }}</label>
                        <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text"
                            name="giro" id="giro" value="{{ old('giro', $organizacion->giro) }}">
                        @if ($errors->has('giro'))
                            <div class="invalid-feedback">
                                {{ $errors->first('giro') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.giro_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="servicios"><i class="fas fa-briefcase iconos-crear"></i>
                            {{ trans('cruds.organizacion.fields.servicios') }}</label>
                        <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}" type="text"
                            name="servicios" id="servicios" value="{{ old('servicios', $organizacion->servicios) }}">
                        @if ($errors->has('servicios'))
                            <div class="invalid-feedback">
                                {{ $errors->first('servicios') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="mision"><i class="fas fa-flag iconos-crear"></i>Misión </label>
                        <textarea class="form-control {{ $errors->has('mision') ? 'is-invalid' : '' }}" name="mision"
                            id="mision">{{ old('mision', $organizacion->mision) }}</textarea>
                        @if ($errors->has('mision'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mision') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="vision"><i class="far fa-eye iconos-crear"></i>
                            {{ trans('cruds.organizacion.fields.vision') }}</label>
                        <textarea class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision"
                            id="vision">{{ old('vision', $organizacion->vision) }}</textarea>
                        @if ($errors->has('vision'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vision') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="valores"><i class="far fa-heart iconos-crear"></i>
                            {{ trans('cruds.organizacion.fields.valores') }}</label>
                        <textarea class="form-control {{ $errors->has('valores') ? 'is-invalid' : '' }}" name="valores"
                            id="valores">{{ old('valores', $organizacion->valores) }}</textarea>
                        @if ($errors->has('valores'))
                            <div class="invalid-feedback">
                                {{ $errors->first('valores') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="antecedentes"> <i class="far fa-file-alt iconos-crear"></i>Antecedentes</label>
                        <textarea class="form-control {{ $errors->has('antecedentes') ? 'is-invalid' : '' }}"
                            name="antecedentes"
                            id="antecedentes">{{ old('antecedentes', $organizacion->antecedentes) }}</textarea>
                        @if ($errors->has('antecedentes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('antecedentes') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.antecedentes_helper') }}</span> --}}
                    </div>
                </div>
                <div class="form-group">
                    <button class="float-right btn btn-danger " type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(function() {
            $('.fantasma').change(function() {
                if (!$(this).prop('checked')) {
                    $('#dvOcultar').hide();
                } else {
                    $('#dvOcultar').show();
                }

            })

        })
    </script>


    <script>
        $(document).ready(function() {




            function dynamic_field(number, element) {


                if (element === undefined) {
                    console.log(0);

                    html = "<tr>";
                    html +=
                        '<td class="col-3"><input class="form-control" type="hidden" value="0"  name="working[' +
                        number + '][id][]"><select class="workingSelect form-control" name="working[' + number +
                        '][day][]" id="working_day"><option value="">Seleccione una opción</option>';
                    html += '<option value="Lunes" >Lunes</option>';
                    html += '<option value="Martes" >Martes</option>';
                    html += '<option value="Miercoles" >Miercoles</option>';
                    html += '<option value="Jueves" >Jueves</option>';
                    html += '<option value="Viernes" >Viernes</option>';
                    html += '<option value="Sabado" >Sabado</option>';
                    html += '<option value="Domingo" >Domingo</option>';
                    html += '</select></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" name="working[' + number +
                        '][start_time][]" id="start_work_time" ></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" name="working[' + number +
                        '][end_time][]" id="end_work_time" ></td>';

                    if (number > 1) {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="remove" id="" class="btn btn-danger remove col-3" style="background-color: #d96161 !important;"><i class="fas fa-trash-alt"></i></button></td></tr>';
                        $("#user_table tbody").append(html);
                    } else {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="add" id="add" class="btn btn-success col-3" ><i class="fas fa-plus-square"></i></button></td></tr>';
                        $("#user_table tbody").html(html);
                    }

                } else {

                    if (element.working_day == "Lunes") {
                        var Lunes = " selected ";
                    } else if (element.working_day == "Martes") {
                        var Martes = " selected ";
                    } else if (element.working_day == "Miercoles") {
                        var Miercoles = " selected ";
                    } else if (element.working_day == "Jueves") {
                        var Jueves = " selected ";
                    } else if (element.working_day == "Viernes") {
                        var Viernes = " selected ";
                    } else if (element.working_day == "Sabado") {
                        var Sabado = " selected ";
                    } else if (element.working_day == "Domingo") {
                        var Domingo = " selected ";
                    }

                    html = "<tr>";
                    html += '<td class="col-3"><input class="form-control" type="hidden" value="' + element
                        .id + '" name="working[' + number +
                        '][id][]"><select class="workingSelect form-control" data-model-id="' + element
                        .id + '" data-type-input="working_day" name="working[' + number +
                        '][day][]" id="working_day"><option value="">Seleccione una opción</option>';
                    html += '<option value="Lunes" ' + Lunes + ' >Lunes</option>';
                    html += '<option value="Martes" ' + Martes + ' >Martes</option>';
                    html += '<option value="Miercoles" ' + Miercoles + ' >Miercoles</option>';
                    html += '<option value="Jueves" ' + Jueves + ' >Jueves</option>';
                    html += '<option value="Viernes" ' + Viernes + ' >Viernes</option>';
                    html += '<option value="Sabado" ' + Sabado + ' >Sabado</option>';
                    html += '<option value="Domingo" ' + Domingo + ' >Domingo</option>';
                    html += '</select></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" data-model-id="' + element
                        .id + '" data-type-input="start_work_time" name="working[' + number +
                        '][start_time][]" id="start_work_time" value="' + element.start_work_time + '" ></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" data-model-id="' + element
                        .id + '" data-type-input="end_work_time" name="working[' + number +
                        '][end_time][]" id="end_work_time" value="' + element.end_work_time + '"></td>';
                    // console.log(html);
                    if (number > 1) {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="remove" id="" class="btn btn-danger remove col-3 removeWithFetch" style="background-color: #d96161 !important;" data-model-id="' +
                            element.id + '"><i class="fas fa-trash-alt"></i></button></td></tr>';
                        $("#user_table tbody").append(html);
                    } else {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="add" id="add" class="btn btn-success col-3" ><i class="fas fa-plus-square"></i></button></td></tr>';
                        $("#user_table tbody").html(html);
                    }
                }
            }

            $(document).on("click", "#add", function() {
                count++;
                var divs = document.getElementsByClassName("workingSelect").length;
                // console.log("Hay " + divs + " elementos");
                if (divs <= 7) {
                    dynamic_field(count);
                }
            });

            $(document).on("click", ".remove", function() {
                count--;
                $(this).closest("tr").remove();
            });



            let schedule = @json($schedule);
            let dscheduleSize = schedule.length;
            let count = dscheduleSize > 0 ? dscheduleSize : 1;
            if (dscheduleSize) {
                schedule.forEach((element, index) => {
                    ++index;
                    dynamic_field(index, element);

                });
            } else {
                dynamic_field(count);
            }
            $("#user_table").on("change", "input", async function(e) {
                const target = e.target;

                const value = target.value;
                const modelId = target.getAttribute('data-model-id')
                const typeInput = target.getAttribute('data-type-input');

                if (typeInput && modelId) {
                    const url = `/admin/organizacions/${modelId}/update-schedule`;

                    const response = await fetch(url, {

                        method: 'POST',

                        body: JSON.stringify({

                            value,

                            typeInput

                        }),

                        headers: {

                            Accept: "application/json",

                            "Content-Type": "application/json",

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                        },

                    })

                    const data = await response.json();

                    // console.log(data);
                }
            })
            $('#user_table').on('click', '.removeWithFetch', function(e) {
                e.preventDefault()
                let = target = e.target;
                if (target.tagName == 'I') {
                    target = e.target.parentElement
                }

                const modelId = target.getAttribute('data-model-id')



                const url = `/admin/organizacions/${modelId}/delete-schedule`;
                Swal.fire({

                    title: '¿Quieres eliminar este registro?',

                    text: "Este dato ya está almacenado",

                    icon: 'question',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Eliminar',

                    cancelButtonText: 'Cancelar'

                }).then(async (result) => {

                    if (result.isConfirmed) {
                        const response = await fetch(url, {

                            method: 'POST',

                            headers: {

                                Accept: "application/json",

                                "Content-Type": "application/json",

                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),

                            },

                        })

                        const data = await response.json();
                        count--;
                        $(this).closest("tr").remove();
                        console.log(data);
                    }

                })



            });


        });
    </script>

    <script>
        CKEDITOR.replace('mision', {
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
    </script>
    <script>
        CKEDITOR.replace('vision', {
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
    </script>
    <script>
        CKEDITOR.replace('valores', {
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
    </script>
    <script>
        CKEDITOR.replace('antecedentes', {
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
    </script>

    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("logotipo").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    </script>


    <script>
        Dropzone.options.logotipoDropzone = {
            url: '{{ route('admin.organizacions.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="logotipo"]').remove()
                $('form').append('<input type="hidden" name="logotipo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logotipo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($organizacion) && $organizacion->logotipo)
                    var file = {!! json_encode($organizacion->logotipo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logotipo" value="' + file.file_name + '">')
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
@endsection
