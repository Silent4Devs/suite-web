@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Matriz de Requisitos Legales</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.matriz-requisito-legales.update', [$matrizRequisitoLegale->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="nombrerequisito"><i
                            class="fas fa-clipboard-list iconos-crear"></i>Fundamento</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;"
                        title="Nombre de la ley,norma,reglamento o documento donde se encuentra el requisito"></i>
                    <input class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }}" type="text"
                        name="nombrerequisito" id="nombrerequisito"
                        value="{{ old('nombrerequisito', $matrizRequisitoLegale->nombrerequisito) }}" required>
                    @if ($errors->has('nombrerequisito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombrerequisito') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-8">
                    <label for="formacumple"><i class="fas fa-file-invoice iconos-crear"></i>Apartado</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Sección,artículo,fracción,fragmento,párrafo,,donde se indique el requisito"></i>
                    <input class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }}" type="text"
                        name="formacumple" id="formacumple"
                        value="{{ old('formacumple', $matrizRequisitoLegale->formacumple) }}">
                    @if ($errors->has('formacumple'))
                        <div class="invalid-feedback">
                            {{ $errors->first('formacumple') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
                </div>

                <div class="form-group col-sm-4">
                    <label class="required"> <i class="fas fa-question-circle iconos-crear"></i>Tipo</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;"
                        title="Seleccionar el tipo de requisito según el origen de la obligación"></i>
                    <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo" required>
                        <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MatrizRequisitoLegale::TIPO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipo', $matrizRequisitoLegale->tipo) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12">
                    <label for="medio"><i class="fas fa-newspaper iconos-crear"></i> Medio de publicación</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Medio digital o físico a través del cuál se publicó el requisito a cumplir. Ejemplo:Diario Oficial de la Federación."></i>
                    <input class="form-control {{ $errors->has('medio') ? 'is-invalid' : '' }}" type="text" name="medio"
                        id="medio" value="{{ old('medio', $matrizRequisitoLegale->medio) }}">
                    @if ($errors->has('medio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-4">
                    <label for="fechaexpedicion"><i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}</label>
                    <input class="form-control date {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }}"
                        type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                        value="{{ old('fechaexpedicion', $matrizRequisitoLegale->fechaexpedicion ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechaexpedicion)->format('Y-m-d'): null) }}">
                    @if ($errors->has('fechaexpedicion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaexpedicion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
                </div>

                <div class="form-group col-sm-4">
                    <label for="fechavigor"> <i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                    <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="date"
                        name="fechavigor" id="fechavigor" min="1945-01-01"
                        value="{{ old('fechavigor', $matrizRequisitoLegale->fechavigor ? \Carbon\Carbon::parse($matrizRequisitoLegale->fechavigor)->format('Y-m-d'):null) }}">
                    @if ($errors->has('fechavigor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechavigor') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
                </div>

                <div class="form-group col-sm-4">
                    <label class="required" for="periodicidad_cumplimiento"><i class="far fa-clock iconos-crear"></i> Periodicidad de
                        verificación</label>
                    <select   class="form-control {{ $errors->has('periodicidad_cumplimiento') ? 'is-invalid' : '' }}"
                        type="text" name="periodicidad_cumplimiento" id="periodicidad_cumplimiento" required>
                    <option disabled value="{{ old('periodicidad_cumplimiento', $matrizRequisitoLegale->periodicidad_cumplimiento) }}">
                    </option>
                    @foreach (App\Models\MatrizRequisitoLegale::PERIODICIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('periodicidad_cumplimiento', '') === (string) $key ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('periodicidad_cumplimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('periodicidad_cumplimiento') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento_helper') }}</span>
                </div>

                <div class="form-group col-sm-12">
                    <label class="required" for="requisitoacumplir"> <i class="fas fa-clipboard-list iconos-crear"></i>Requisito(s) a
                        cumplir</label>
                    <textarea class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }}"
                        type="text" name="requisitoacumplir"
                        id="requisitoacumplir" required>{{ old('requisitoacumplir', $matrizRequisitoLegale->requisitoacumplir) }}</textarea>
                    @if ($errors->has('requisitoacumplir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisitoacumplir') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}</span>
                </div>

                <div class="form-group col-sm-12">
                    <label for="alcance"><i class="fas fa-binoculars iconos-crear"></i> Alcance y grado de
                        aplicabilidad</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Especificar el alcance y grado de aplicabilidad del requisito hacia la organización "></i>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text"
                        name="alcance" id="alcance">{{ old('alcance', $matrizRequisitoLegale->alcance) }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-12">
                    <label for="cumplimiento_organizacion"><i class="fas fa-clipboard-check iconos-crear"></i> Forma en que la
                        organización cumple con el requisito</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;" title="Especificar"></i>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text"
                        name="cumplimiento_organizacion" id="cumplimiento_organizacion">{{ old('cumplimiento_organizacion', $matrizRequisitoLegale->cumplimiento_organizacion) }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cumplimiento_organizacion') }}
                        </div>
                    @endif
                </div>

{{--
                <div class="form-group" style="margin-top:15px; width:100%; height:25px; background-color:#345183">
                    <p class="text-center text-light" style="font-size:11pt; width:100%; margin-left:370px; color:#ffffff;">
                        Verificación del Requisito</p>
                </div>

                <div class="form-group col-sm-6">
                    <label> <i class="fas fa-question-circle iconos-crear"></i>¿En cumplimiento?</label>
                    <select class="form-control {{ $errors->has('cumplerequisito') ? 'is-invalid' : '' }}"
                        name="cumplerequisito" id="cumplerequisito">
                        <option value disabled {{ old('cumplerequisito', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('cumplerequisito', $matrizRequisitoLegale->cumplerequisito) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('cumplerequisito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cumplerequisito') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito_helper') }}</span>
                </div>

                <div class="form-group col-sm-6">
                    <label for="fechaverificacion"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                        verificación</label>
                    <input class="form-control date {{ $errors->has('fechaverificacion') ? 'is-invalid' : '' }}"
                        type="date" name="fechaverificacion" id="fechaverificacion"
                        value="{{ old('fechaverificacion', $matrizRequisitoLegale->fechaverificacion) }}">
                    @if ($errors->has('fechaverificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaverificacion') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12">
                    <label for="metodo"><i class="fab fa-searchengin iconos-crear"></i> Método utilizado de
                        verificación</label>
                    <textarea class="form-control {{ $errors->has('metodo') ? 'is-invalid' : '' }}" type="text"
                        name="metodo" id="metodo">{{ old('metodo', $matrizRequisitoLegale->metodo) }} </textarea>
                    @if ($errors->has('metodo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('metodo') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12">
                    <label for="descripcion_cumplimiento"><i class="fas fa-clipboard-list iconos-crear"></i> Descripción del
                        cumplimiento/incumplimiento</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;"
                        title="Describir de que forma la organización está cumpliendo/incumpliendo este requisito."></i>
                    <textarea class="form-control {{ $errors->has('descripcion_cumplimiento') ? 'is-invalid' : '' }}"
                        type="text" name="descripcion_cumplimiento"
                        id="descripcion_cumplimiento">{{ old('descripcion_cumplimiento', $matrizRequisitoLegale->descripcion_cumplimiento) }} </textarea>
                    @if ($errors->has('descripcion_cumplimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion_cumplimiento') }}
                        </div>
                    @endif
                </div>



                <div class="row w-100 align-items-center" style="margin-left: 1px;">
                    @livewire('planes-implementacion-select',['planes_seleccionados'=>$planes_seleccionados])
                    <div class="pl-0 ml-0 col-2">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#planAccionModal">
                            <i class="mr-1 fas fa-plus-circle"></i> Crear
                        </button>
                    </div>
                    @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de Requisitos
                    Legales'])
                </div>



                <div class="mb-3 col-sm-12">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Evidencia</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" {{ $errors->has('evidencia') ? 'is-invalid' : '' }}"
                            multiple id="evidencia" name="files[]"
                            {{ old('evidencia', $matrizRequisitoLegale->evidencia) }}>
                        @if ($errors->has('evidencia'))
                            <div class="invalid-feedback">
                                {{ $errors->first('evidencia') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>


                <div class="form-group col-md-4">
                    <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                    <select class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                        id="id_reviso">
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_reviso', $matrizRequisitoLegale->id_reviso) == $empleado->id ? 'selected' : '' }}>

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empleados') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                </div>




                <div class="form-group col-md-4">
                    <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_reviso"></div>

                </div>


                <div class="form-group col-md-4">
                    <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_reviso"></div>

                </div>

                <div class="form-group col-sm-12">
                    <label for="comentarios"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios /
                        observaciones</label>
                    <textarea class="form-control {{ $errors->has('comentarios') ? 'is-invalid' : '' }}" type="text"
                        name="comentarios"
                        id="comentarios">{{ old('comentarios', $matrizRequisitoLegale->comentarios) }} </textarea>
                    @if ($errors->has('comentarios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comentarios') }}
                        </div>
                    @endif
                </div> --}}


                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>




                {{-- <div class="modal" tabindex="-1" id="evidencia_activa">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Descargar Documentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> --}}

                {{-- @dump(json_decode($activo->documentos_relacionados)) --}}
                {{-- @if (json_decode($matrizRequisitoLegale->evidencia))
                                    <div class="list-group">
                                        @foreach (json_decode($matrizRequisitoLegale->evidencia) as $documento)

                                            <a class="list-group-item list-group-item-action" target="_blank"
                                                href="{{ asset('storage/matriz_evidencias' . '/' . $documento) }}">
                                                <i class="mr-2 fas fa-file"></i><span>{{ $documento }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Sin archivos cargados</p>
                                @endif


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>



                        </div>
                    </div>
                </div> --}}




                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($matrizRequisitoLegale->evidencias_matriz))

                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($matrizRequisitoLegale->evidencias_matriz as $idx => $evidencia)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>

                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($matrizRequisitoLegale->evidencias_matriz as $idx => $evidencia)
                                                <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                    <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                        src="{{ asset('storage/matriz_evidencias') }}/{{ $evidencia->evidencia }}"></iframe>
                                                </div>
                                            @endforeach


                                        </div>
                                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                                            data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                                            data-slide='next'>
                                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Next</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h3 style="text-align:center" class="mt-3">Sin
                                            archivo agregado</h3>
                                        <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                            style="width:350px !important">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cumple = document.getElementById('cumplerequisito');
            cumple.addEventListener('change', function(e) {
                let respuesta = e.target.value;
                if (respuesta == 'No') {
                    $("#plan_accion_select").show(1000);
                } else {
                    $("#plan_accion_select").hide(1000);
                }
            })

            let responsable = document.querySelector('#id_reviso');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_reviso').innerHTML = puesto_init;
            document.getElementById('area_reviso').innerHTML = area_init;
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_reviso').innerHTML = puesto;
                document.getElementById('area_reviso').innerHTML = area;
            })
        })
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
@endsection
