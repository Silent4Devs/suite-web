@extends('layouts.admin')
@section('content')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }

    </style>
    {{-- {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }} --}}
    <h5 class="col-12 titulo_general_funcion">{{ $requisito->nombrerequisito }}</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-requisito-legales.evaluarStore', $requisito->id) }}"
                enctype="multipart/form-data" class="row">
                @csrf


                <div class="form-group col-12">
                    <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                        Verificación del Requisito</p>
                </div>
                <input type="hidden" name="id_matriz" value="{{ $requisito->id }}" />
                <div class="row col-12">
                    <div class="col-sm-6 form-group ">
                        <label class="required" for="cumplerequisito"> <i class="fas fa-question-circle iconos-crear"></i> ¿En
                            cumplimiento?</label>
                        <select required class="form-control {{ $errors->has('cumplerequisito') ? 'is-invalid' : '' }}"
                            name="cumplerequisito" id="cumplerequisito">
                            <option value disabled {{ old('cumplerequisito', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('cumplerequisito', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
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

                    <div class="col-sm-6 form-group ">
                        <label class="required" for="fechaverificacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de
                            verificación</label>
                        <input required class="form-control date {{ $errors->has('fechaverificacion') ? 'is-invalid' : '' }}"
                            type="date" name="fechaverificacion" id="fechaverificacion"
                            value="{{ old('fechaverificacion') }}">
                        @if ($errors->has('fechaverificacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fechaverificacion') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <label class="required" for="metodo"> <i class="fab fa-searchengin iconos-crear"></i> Método utilizado de
                        verificación</label>
                    <textarea required class="form-control {{ $errors->has('metodo') ? 'is-invalid' : '' }}" name="metodo"
                        id="metodo">{{ old('metodo') }}</textarea>
                    @if ($errors->has('metodo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('metodo') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12">
                    <label class="required" for="descripcion_cumplimiento"> <i class="fas fa-clipboard-list iconos-crear"></i> Descripción
                        del cumplimiento / incumplimiento</label><i class="fas fa-info-circle"
                        style="font-size:12pt; float: right;"
                        title="Describir de que forma la organización está cumpliendo/incumpliendo este requisito."></i>
                    <textarea required class="form-control {{ $errors->has('descripcion_cumplimiento') ? 'is-invalid' : '' }}"
                        name="descripcion_cumplimiento"
                        id="descripcion_cumplimiento">{{ old('descripcion_cumplimiento') }}</textarea>
                    @if ($errors->has('descripcion_cumplimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion_cumplimiento') }}
                        </div>
                    @endif
                </div>



                <div class="col-sm-12 form-group">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Evidencia</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="evidencia">

                    </div>
                </div>
                <div id="vincularRevision" class="col-12">
                    <div class="row">
                        <div class="form-group col-12">
                            <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                                Vincular revisión a plan de acción</p>
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
                            @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Matríz de
                            Requisitos
                            Legales'])
                        </div>
                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}
                        <div class="form-group col-12">
                            <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                                Colaborar que verifico</p>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                    <select required class="form-control {{ $errors->has('reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                        id="id_reviso">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}">

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reviso') }}
                        </div>
                    @endif
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
                    <textarea class="form-control {{ $errors->has('comentarios') ? 'is-invalid' : '' }}" name="comentarios"
                        id="comentarios">{{ old('comentarios') }}</textarea>
                    @if ($errors->has('comentarios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comentarios') }}
                        </div>
                    @endif
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn_cancelar">Cancelar</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            let cumple = document.getElementById('cumplerequisito');
            $("#vincularRevision").hide(1000);
            cumple.addEventListener('change', function(e) {
                let respuesta = e.target.value;
                if (respuesta == 'No') {
                    $("#vincularRevision").show(1000);
                } else {
                    $("#vincularRevision").hide(1000);
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
