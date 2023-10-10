<div class="mt-3">
    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label class="required" for="cursoscapacitaciones">
                <i class="fab fa-discourse iconos-crear"></i> Título
            </label>
            <input required class="form-control {{ $errors->has('cursoscapacitaciones') ? 'is-invalid' : '' }}" type="text"
                name="cursoscapacitaciones" id="cursoscapacitaciones"
                value="{{ old('cursoscapacitaciones', $recurso->cursoscapacitaciones) }}" autocomplete="off">
            <span class="cursoscapacitaciones_error text-danger errores"></span>
            @if ($errors->has('cursoscapacitaciones'))
                <div class="invalid-feedback">
                    {{ $errors->first('cursoscapacitaciones') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <label class="required" for="categoria_capacitacion_id"><i class="fab fa-discourse iconos-crear"></i>
                        Categoría
                    </label>
                </div>
                <div class="col-11 pr-1">
                    @livewire('categoria-capacitacion-select',['categoria_seleccionada'=>$recurso->categoria_capacitacion_id])
                    <span class="categoria_capacitacion_id_error text-danger errores"></span>
                </div>
                <div class="col-1 pl-0">
                    <button id="btnAgregarCategoriaCapacitacion" onclick="event.preventDefault();"
                        class="text-white btn btn-sm" style="background:#3eb2ad;height: 34px;" data-toggle="modal"
                        data-target="#tipoCategoriaCapacitacionModal" title="Agregar Categoría">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                @livewire('categoria-capacitacion-create')
            </div>
            @if ($errors->has('categoria_capacitacion_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('categoria_capacitacion_id') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
        </div>
        <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label class="required" for="tipo"><i class="fab fa-discourse iconos-crear"></i> Tipo</label>

            <select required name="tipo" id="tipo" class="form-control">
                <option value="" selected disabled>-- Selecciona una opción --</option>
                @foreach (\App\Models\Recurso::TIPOS as $tipo)
                    <option value="{{ $tipo }}" {{ old('tipo', $recurso->tipo) == $tipo ? 'selected' : '' }}>
                        {{ $tipo }}
                    </option>
                @endforeach
            </select>
            <span class="tipo_error text-danger errores"></span>
            @if ($errors->has('tipo'))
                <div class="invalid-feedback">
                    {{ $errors->first('tipo') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label class="required" for="modalidad"> <i class="fas fa-laptop iconos-crear"></i>Modalidad</label>
            <select required name="modalidad" class="form-control" id="select_modalidad">
                <option selected value="">-- Seleccionar modalidad --</option>
                <option value="presencial"
                    {{ old('modalidad', $recurso->modalidad) == 'presencial' ? ' selected="selected"' : '' }}>
                    Presencial
                </option>
                <option value="linea"
                    {{ old('modalidad', $recurso->modalidad) == 'linea' ? ' selected="selected"' : '' }}>En linea
                </option>
            </select>
            <span class="modalidad_error text-danger errores"></span>
        </div>
        <input type="checkbox" class="form-control d-none" id="isElearning" name="isElearning">
        <div id="contenedorSeleccionModalidad" class="col-sm-12 col-md-12 col-lg-6">
            <div class="form-group">
                <label class="required" for="ubicacion"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                    @php
                        $modalidad = 'Ubicación';
                        if ($recurso->modalidad == 'linea') {
                            $modalidad = 'Enlace';
                        }
                    @endphp
                    <font id="font_modalidad_seleccionada">{{ $modalidad }}</font>
                    </font>
                </label>
                <input required type="text" name="ubicacion" class="form-control"
                    value="{{ old('ubicacion', $recurso->ubicacion) }}" id="ubicacionConfInicial">
                <span class="ubicacion_error text-danger errores"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label class="required" for="fecha_curso"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                Inicio</label>
            <input required class="form-control" type="datetime-local" id="fecha_curso" name="fecha_curso" min="1945-01-01T00:00"
                value="{{ old('fecha_curso', \Carbon\Carbon::parse($recurso->fecha_curso)->format('Y-m-d\TH:i')) }}">
            <span class="fecha_curso_error text-danger errores"></span>
            @if ($errors->has('fecha_curso'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_curso') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-12 col-md-12 col-lg-6">
            <label class="required" for="fecha_fin">
                <i class="fas fa-calendar-alt iconos-crear"></i>
                Fecha Fin
            </label>
            <input required class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin" min="1945-01-01T00:00"
                value="{{ old('fecha_fin', \Carbon\Carbon::parse($recurso->fecha_fin)->format('Y-m-d\TH:i')) }}">
            <span class="fecha_fin_error text-danger errores"></span>
            @if ($errors->has('fecha_fin'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_fin') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label class="required" for="instructor"><i
                    class="fas fa-user iconos-crear"></i>{{ trans('cruds.recurso.fields.instructor') }}</label>
            <input required class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}" type="text"
                name="instructor" id="instructor" value="{{ old('instructor', $recurso->instructor) }}">
            <span class="instructor_error text-danger errores"></span>
            @if ($errors->has('instructor'))
                <div class="invalid-feedback">
                    {{ $errors->first('instructor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.instructor_helper') }}</span>
        </div>
        <div class="form-group col-md-6 col-sm-6 col-12 col-lg-12">
            <label for="recurso_capacitacion"><i class="fas fa-file iconos-crear"></i>Recurso de la
                capacitación (.pdf)</label>
            <input type="file" id="recurso_capacitacion" class="form-control" name="recurso_capacitacion">
            <span class="recurso_capacitacion_error text-danger errores"></span>
        </div>
        <div class="form-group col-md-6 col-sm-6 col-12 col-lg-12">
            <label for="descripcion"> <i class="fas fa-lightbulb iconos-crear"></i>
                Descripción</label>
            <textarea class="form-control descripcion {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                id="descripcion">{{ old('descripcion', $recurso->descripcion) }}</textarea>
            <span class="descripcion_error text-danger errores"></span>
            @if ($errors->has('descripcion'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="text-right form-group col-12">
    <a href="{{ route('admin.recursos.index') }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger btnGuardarDraftRecurso" type="submit" id="btnGuardarDraftRecurso">
        Borrador
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="elearningCargando" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="elearningCargandoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="https://c.tenor.com/1qrYT711uEoAAAAC/cargando.gif" alt="">
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //Contantes de pestaña conf. inicial para añadir eventos
        const nombreCapacitacion = document.getElementById('cursoscapacitaciones');
        const categoria = document.getElementById('categoria_capacitacion_id');
        const selectTipo = document.getElementById('tipo');
        const selectModalidad = document.getElementById('select_modalidad');
        const ubicacionConfInicial = document.getElementById('ubicacionConfInicial');
        const fechaCurso = document.getElementById('fecha_curso');
        const fechaFin = document.getElementById('fecha_fin');
        const instructor = document.getElementById('instructor');
        const descripcion = document.getElementById('descripcion');
        // Constantes de la pestaña enviar invitación
        const tituloInvitaciones = document.getElementById('titulo_invitaciones');
        const categoriaInvitaciones = document.getElementById('categoria_invitaciones');
        const tipoInvitaciones = document.getElementById('tipo_invitaciones');
        const modalidadInvitaciones = document.getElementById('modalidad_invitaciones');
        const ubicacionInvitaciones = document.getElementById('ubicacion_invitaciones');
        const fechaInicioInvitaciones = document.getElementById('fecha_inicio_invitaciones');
        const fechaFinInvitaciones = document.getElementById('fecha_fin_invitaciones');
        const instructorInvitaciones = document.getElementById('instructor_invitaciones');
        const descripcionInvitaciones = document.getElementById('descripcion_invitaciones');

        // Lecciones
        const tituloCapacitacionLecciones = document.getElementById('tituloCapacitacionLecciones');

        //Inicializar fechas
        fechaInicioInvitaciones.innerHTML = new Date(Date()).toLocaleString();
        fechaFinInvitaciones.innerHTML = new Date(Date()).toLocaleString();

        //Inicializar informacion cuando se muestra edicion
        inicializarInformacionGeneral();

        function inicializarInformacionGeneral() {
            tituloInvitaciones.innerHTML = nombreCapacitacion.value;
            categoriaInvitaciones.innerHTML = categoria.options[categoria.selectedIndex].getAttribute(
                'data-nombre');
            tipoInvitaciones.innerHTML = selectTipo.value;
            modalidadInvitaciones.innerHTML = selectModalidad.value;
            ubicacionInvitaciones.innerHTML = ubicacionConfInicial.value;
            fechaInicioInvitaciones.innerHTML = new Date(fechaCurso.value).toLocaleString();
            fechaFinInvitaciones.innerHTML = new Date(fechaFin.value).toLocaleString();
            instructorInvitaciones.innerHTML = instructor.value;
            descripcionInvitaciones.innerHTML = descripcion.value ? descripcion.value : 'Sin descripción';
        }

        nombreCapacitacion.addEventListener('keyup', function(e) {
            tituloInvitaciones.innerHTML = this.value;
            tituloCapacitacionLecciones.innerHTML = this.value;
        })

        $('#categoria_capacitacion_id').on('select2:select', function(e) {
            categoriaInvitaciones.innerHTML = e.target.options[e.target.options.selectedIndex]
                .getAttribute(
                    'data-nombre')
            console.log("texto");
        });

        selectTipo.addEventListener('change', function(e) {
            tipoInvitaciones.innerHTML = this.value;
        });

        selectModalidad.addEventListener('change', function(e) {
            modalidadInvitaciones.innerHTML = this.value;
        });

        ubicacionConfInicial.addEventListener('keyup', function(e) {
            ubicacionInvitaciones.innerHTML = this.value;
        })

        fechaCurso.addEventListener('change', function(e) {
            fechaInicioInvitaciones.innerHTML = new Date(this.value).toLocaleString();
        })

        fechaFin.addEventListener('change', function(e) {
            fechaFinInvitaciones.innerHTML = new Date(this.value).toLocaleString();
        })

        instructor.addEventListener('keyup', function(e) {
            instructorInvitaciones.innerHTML = this.value;
        })

        descripcion.addEventListener('keyup', function(e) {
            descripcionInvitaciones.innerHTML = this.value;
        })
    })
</script>
