
                        <div class="row">
                            <div class="mb-3 col-sm-4 col-lg-4 col-md-4 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $accionCorrectiva->folio }}</strong>
                            </div>
                            <div class="mb-3 col-sm-6 col-lg-6 col-md-6 text-primary ">
                                <strong
                                    style="font-size:13pt; text-transform: lowercase;">{{ $accionCorrectiva->titulo }}</strong>
                            </div>
                        </div>
                        <div class="" style=" position: relative; ">
                            <h5 style=" position: ;"><b>Acciones para la Atención de la Queja Cliente</b></h5>
                            <button style="position:absolute; right: 2px; top:2px;"
                                class="btn btn-success btn_modal_form" id="vincularPlan">Vincular Plan</button>
                            @if (count($accionCorrectiva->planes))
                                @foreach ($accionCorrectiva->planes as $plan)
                                    <a style="position:absolute; right: 170px; top:2px;"
                                        href="{{ route('admin.planes-de-accion.show', $plan->id) }}"
                                        class="btn btn-success"><i class="mr-2 fas fa-stream"></i> Plan De
                                        Acción {{ $plan->parent }}</a>
                                @endforeach
                            @endif
                        </div>
                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}

                        <div class="row w-100">

                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i
                                    class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de
                                acción?</label>

                            @livewire('planes-implementacion-select',['planes_seleccionados'=>$accionCorrectiva->planes->pluck('id')->toArray()])

                            <div class="pl-0 ml-0 col-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">

                                    <i class="mr-1 fas fa-plus-circle"></i> Crear

                                </button>
                            </div>

                            @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Acciones
                            Correctivas'])

                        </div>


                        {{-- <div class="seccion_div">
                            <div class="mt-2" style=" position: relative; ">
                                <h5 style=" position: ;"><b>Acciones para la Atención de Acciones Correctivas</b></h5>
                                <button style="position:absolute; right: 2px; top:2px;"
                                    class="btn btn-success btn_modal_form">Agregar actividad</button>
                                @if (count($accionCorrectiva->planes))
                                    <a style="position:absolute; right: 170px; top:2px;"
                                        href="{{ route('admin.planes-de-accion.show', $accionCorrectiva->planes->first()->id) }}"
                                        class="btn btn-success"><i class="mr-2 fas fa-stream"></i> Plan De
                                        Acción</a>
                                @endif
                            </div>
                            <div class="mt-4 datatable-fix" style="width: 100%;">
                                <table id="tabla_plan_accion" class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Actividad</th>
                                            <th>Fecha&nbsp;de&nbsp;inicio</th>
                                            <th>Fecha&nbsp;de&nbsp;fin</th>
                                            <th>Prioridad</th>
                                            <th>Tipo</th>
                                            <th>Responsable(s)</th>
                                            <th>Comentarios</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        <div class="modal_form_plan">
                            <div class="fondo_modal"></div>
                            <form class="card" id="form_plan_accion" method="POST"
                                action="{{ route('admin.accion-correctiva-actividades.store') }}">
                                <input type="hidden" name="accion_correctiva_id" value="{{ $accionCorrectiva->id }}">
                                <div class="text-center card-header" style="background-color: #345183;">
                                    <strong style="font-size: 16pt; color: #fff;"><i
                                            class="mr-4 fas fa-tasks"></i>Crear: Plan de Acción</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label"><i
                                                    class="fas fa-wrench iconos-crear"></i>Actividad</label>
                                            <input type="" name="actividad" class="form-control" id="actividad">
                                            <span class="text-danger error_actividad errors"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                                                inicio</label>
                                            <input type="date" name="fecha_inicio" class="form-control"
                                                id="fecha_inicio">
                                            <span class="text-danger error_fecha_inicio errors"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-calendar-alt iconos-crear"></i>Fecha de fin</label>
                                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
                                            <span class="text-danger error_fecha_fin errors"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-flag iconos-crear"></i>Prioridad</label>
                                            <select class="form-control" name="prioridad" id="prioridad_ju">
                                                <option value="Alta">Alta</option>
                                                <option value="Media">Media</option>
                                                <option value="Baja">Baja</option>
                                            </select>
                                            <span class="text-danger error_prioridad errors"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-list-alt iconos-crear"></i>Tipo</label>
                                            <select class="form-control" name="tipo" id="tipo">
                                                <option value="Acción inmediata">Acción inmediata</option>
                                                <option value="Acción subsecuente">Acción subsecuente</option>
                                                <option value="Acción posterior">Acción posterior </option>
                                            </select>
                                            <span class="text-danger error_tipo errors"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label"><i
                                                    class="fas fa-users iconos-crear"></i>Responsables</label>
                                            <select class="form-control select2" name="responsables[]" multiple
                                                id="responsables">
                                                @foreach ($empleados as $empleado)
                                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error_responsables errors"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label"><i
                                                    class="fas fa-comments iconos-crear"></i>Comentarios</label>
                                            <textarea class="form-control" name="comentarios"
                                                id="comentarios"></textarea>
                                            <span class="text-danger error_comentarios errors"></span>
                                        </div>
                                        <div class="text-right form-group col-md-12">
                                            <a href="#" class="btn btn_cancelar">Cancelar</a>
                                            <input type="submit" value="Guardar"
                                                class="btn btn-success btn_enviar_form_modal">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
