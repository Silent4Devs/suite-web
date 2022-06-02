<div class="px-1 py-2 mx-3 mb-4 rounded shadow col-12" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                Instrucciones</p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                priorice,
                categorice, analice y determine si la queja es procedente.
            </p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
            </p>

        </div>
    </div>
</div>
<div class="row">
    <div class="mt-4 form-group col-md-12">
        <label><i class="fas fa-question-circle iconos-crear"></i>¿La queja recibida es procedente?</label>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-body" style="margin-top:-30px;">
            <div class="pregunta_queja_procedente">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="queja_procedente" id="queja_procedente" value="1"
                        {{ old('queja_procedente', $quejasClientes->queja_procedente) == true ? 'checked' : '' }}>
                    <label class="form-check-label" for="queja_procedente">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="queja_procedente" id="queja_procedente" value="2"
                        {{ old('queja_procedente', $quejasClientes->queja_procedente) == false ? 'checked' : '' }}>
                    <label class="form-check-label" for="queja_procedente">
                        No
                    </label>
                </div>
            </div>
        </div>
    </div>
</div><br>

<div class="display:none" id="porque_queja_procedente">
    <div class="row">
        <div class="form-group col-12">
            <label class="form-label">¿Por qué?</label>
            <textarea name="porque_procedente" class="form-control">{{ $quejasClientes->porque_procedente }}</textarea>
            <span class="solucion_requerida_cliente_error text-danger errores"></span>
        </div>
    </div>
</div>

<div id="contenedor_queja_procedente" style="margin-top:-25px; display: none;">
    <div class="row">
        <div class=" form-group col-md-12">
            <b>Priorización de la queja:</b>
        </div>
    </div>
    <div class="row">
        <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
            <label class="form-label"><i class="fas fa-chart-line iconos-crear"></i>Urgencia<sup>*</sup></label>
            <select class="form-control select2" name="urgencia" id="select_urgencia">
                <option value="" selected disabled>
                    Selecciona una opción</option>
                <option data-urgencia="3"
                    {{ old('urgencia', $quejasClientes->urgencia) == 'Alta' ? 'selected' : '' }}>
                    Alta</option>
                <option data-urgencia="2"
                    {{ old('urgencia', $quejasClientes->urgencia) == 'Media' ? 'selected' : '' }}>
                    Media</option>
                <option data-urgencia="1"
                    {{ old('urgencia', $quejasClientes->urgencia) == 'Baja' ? 'selected' : '' }}>
                    Baja</option>
            </select>
            <span class="urgencia_error text-danger errores"></span>
        </div>

        <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
            <label class="form-label"><i class="fas fa-compact-disc iconos-crear"></i>Impacto<sup>*</sup></label>
            <select class="form-control select2" name="impacto" id="select_impacto">
                <option value="" selected disabled>
                    Selecciona una opción</option>
                <option data-impacto="3" {{ old('impacto', $quejasClientes->impacto) == 'Alto' ? 'selected' : '' }}>
                    Alto</option>
                <option data-impacto="2" {{ old('impacto', $quejasClientes->impacto) == 'Medio' ? 'selected' : '' }}>
                    Medio</option>
                <option data-impacto="1" {{ old('impacto', $quejasClientes->impacto) == 'Bajo' ? 'selected' : '' }}>
                    Bajo</option>
            </select>
            <span class="impacto_error text-danger errores"></span>
        </div>

        <div class="mt-3 form-group col-md-4">
            <label class="form-label"><i class="fas fa-flag iconos-crear"></i>Prioridad de
                atención</label>
            <input class="form-control" id="prioridad" name="prioridad" readonly></input>
        </div>
    </div>
    <div class="row">
        <div class="mt-4 form-group col-md-12">
            <b>Categorización de la queja</b>
        </div>
    </div>
    <div class="row">
        <div class="mt-1 form-group col-6">
            <label class="form-label"><i class="fas fa-bars iconos-crear"></i> Categoría
                de la queja<sup>*</sup>
            </label>
            <select name="categoria_queja"
                class="form-control {{ $errors->has('categoria_queja') ? 'is-invalid' : '' }}" id="categoria_otros">
                <option value="" selected disabled>
                    Selecciona una opción</option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Servicio no prestado' ? 'selected' : '' }}
                    value="Servicio no prestado">Servicio no prestado/prestado parcialmente
                </option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Retraso en la prestacion' ? 'selected' : '' }}
                    value="retraso en la prestacion">Retraso en la prestación del servicio
                </option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Entregable no conforme' ? 'selected' : '' }}
                    value="Entregable no conforme">Entregable no conforme con lo solicitado
                </option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                    value="Incumplimiento de los compromisos contractuales">Incumplimiento de
                    los
                    compromisos contractuales</option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                    value="Incumplimiento de los compromisos contractuales">Incumplimiento de
                    los
                    niveles de servicio</option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                    value="Incumplimiento de los compromisos contractuales">Canales de
                    comunicación
                    inadecuados</option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Negativa de prestación del servicio' ? 'selected' : '' }}
                    value="Negativa de prestación del servicio">Negativa de prestación del
                    servicio
                </option>
                <option
                    {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incorrecta facturacion' ? 'selected' : '' }}
                    value="Incorrecta facturacion">Incorrecta facturación</option>
                <option {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Otro' ? 'selected' : '' }}
                    value="Otro">Otro</option>
            </select>
            <span class="categoria_queja_error text-danger errores"></span>
        </div>

        <div class="mt-1 form-group col-sm-6 col-md-6 d-none" id="camposQuejaOtro">
            <label>¿Cuál?</label>
            <input class="form-control {{ $errors->has('otro_categoria') ? 'is-invalid' : '' }}" type="text"
                name="otro_categoria" value="{{ old('otro_categoria', $quejasClientes->otro_categoria) }}">
        </div>
    </div>
    <div class="row">
        <div class="mt-4 form-group col-md-12">
            <b>Responsable de la atención de la queja</b>
        </div>
    </div>



    <div class="row">
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="responsable_atencion_queja_id"><i class="fas fa-user-tie iconos-crear"></i>Nombre<sup>*</sup></label>
            <select class="form-control {{ $errors->has('responsable_atencion_queja_id') ? 'is-invalid' : '' }}"
                name="responsable_atencion_queja_id" id="responsable_atencion_queja_id">
                <option
                    value="" selected disabled>Selecciona una opción</option>
                @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                        data-area="{{ $empleado->area->area }}"
                        {{ old('responsable_atencion_queja_id', $quejasClientes->responsable_atencion_queja_id) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('responsable_atencion_queja_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('responsable_atencion_queja_id') }}
                </div>
            @endif
            <span class="responsable_atencion_queja_id_error text-danger errores"></span>
        </div>

        <div class="form-group col-md-4">
            <label><i class="fas fa-briefcase iconos-crear"></i>Puesto<sup>*</sup></label>
            <div class="form-control" id="atencion_puesto" readonly></div>
        </div>


        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label><i class="fas fa-street-view iconos-crear"></i>Área<sup>*</sup></label>
            <div class="form-control" id="atencion_area" readonly></div>
        </div>
    </div>

    <div class="row">
        <div class="mt-4 form-group col-md-12">
            <label><i class="fas fa-question-circle iconos-crear"></i>¿Notificar al responsable para la atención de la queja?</label>
        </div>
    </div>

    <div class="mt-2 form-group col-12">
        <buttom type="submit" class="btn btn-success" id="atencion_queja_btn_correo" >Enviar Notificación
        </buttom>
    </div>



    <div class=" mt-4 row">
        <div class="mt-3 form-group col-md-12">
            <label><i class="fas fa-question-circle iconos-crear"></i>¿Se requiere levantar una acción correctiva?</label>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-body" style="margin-top:-30px;">
                <div class="levantamiento_ac">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="desea_levantar_ac" value="1"
                            {{ old('desea_levantar_ac', $quejasClientes->desea_levantar_ac) == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="desea_levantar_ac">
                            Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="desea_levantar_ac" value="2"
                            {{ old('desea_levantar_ac', $quejasClientes->desea_levantar_ac) == false ? 'checked' : '' }}>
                        <label class="form-check-label" for="desea_levantar_ac">
                            No
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    {{-- <div clas="mt-2 form-group col-md-12">
    <b class="mr-4 text-primary">Al Nota: Se enviará la solicitud de generación de
        Acción Correctiva al Responsable del Sistema de
        Gestión
    </b>
</div> --}}


    <div class="row">
        <div class="col-12" id="indicaciones_levantamiento" style="display: none; margin-top:-20px;">
            <div class="row">
                <div class="col-12">
                    <b class="mr-4 ">Seleccione al responsable del Sistema de
                        Gestión
                    </b>
                </div>
            </div>

            <div class="row">
                <div class="mt-3 form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="responsable_sgi_id"><i class="fas fa-user-tie iconos-crear"></i>Nombre<sup>*</sup></label>
                    <select class="form-control {{ $errors->has('responsable_sgi_id') ? 'is-invalid' : '' }}"
                        name="responsable_sgi_id" id="responsable_sgi_id">
                        <option value="" selected disabled>Selecciona una opción</option>
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('responsable_sgi_id', $quejasClientes->responsable_sgi_id) == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsable_sgi_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable_sgi_id') }}
                        </div>
                    @endif
                    <span class="responsable_sgi_id_error text-danger errores"></span>
                </div>
                <div class="mt-3 form-group col-md-4">
                    <label><i class="fas fa-briefcase iconos-crear"></i>Puesto<sup>*</sup></label>
                    <div class="form-control" id="responsable_sgi_puesto" readonly></div>
                </div>
                <div class="mt-2 form-group col-sm-12 col-md-4 col-lg-4">
                    <label><i class="bi bi-geo mr-2 iconos-crear"></i>Área<sup>*</sup></label>
                    <div class="form-control" id="responsable_sgi_area"readonly></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="float-left mt-4 text-right form-group col-12">
        <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
        <button type="submit" class="btn btn-success" id="btn-guardar-analisis">Guardar</button>
        <button id="siguiente_analisis" type="submit" class="btn btn-success" >Siguiente</button>
    </div>
</div>



<script type="text/javascript">
    let id_quejas = @json($id_quejas);
    document.getElementById("atencion_queja_btn_correo").addEventListener("click", (event) => {
        event.preventDefault();
        let responsable_atencion_queja_id = document.getElementById("responsable_atencion_queja_id").value;
        sendEmail(responsable_atencion_queja_id,id_quejas);
    });
    function sendEmail(responsable_atencion_queja_id,id_quejas) {
        let url = "{{ route('admin.desk.quejas-clientes.correoResponsable') }}";
        Swal.fire({
            title: `¿Está seguro(a) de enviar el correo al responsable?`,
            showCancelButton: true,
            confirmButtonText: `Si, enviar`,
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {

                return fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': _token,
                            'Content-Type': 'application/json',
                            Accept: 'application/json'
                        },
                        body: JSON.stringify({
                            id: id_quejas,
                            responsable_atencion_queja_id: responsable_atencion_queja_id,
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire(
                        `${result.value.message}`,
                        ``,
                        'success'
                    ).then(() => {

                    });

                }

            }
        })
    }
</script>
