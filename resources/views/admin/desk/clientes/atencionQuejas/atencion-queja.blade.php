<div class="">
    <div class="">
        <div class="px-1 py-2 mx-3 mb-4 rounded shadow col-12"
            style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
                    </p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                        conteste el siguiente formulario para la atención de la queja.
                    </p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                    </p>

                </div>
            </div>
        </div>

        <div class="row ml-2 col-12">
            <strong style="font-size: 18px; color:#1E3A8A ">{{ $quejasClientes->folio }}
            </strong>
        </div>


        <h4 class="text-center" style="font-size: 16px; color:#3086AF;">{{ $quejasClientes->titulo }}
        </h4>

        <div class="mt-4 form-group col-md-12 ml-2">
            <b style="font-size:11pt">Descripción</b>
        </div>

        <div class="form-group col-md-12 ml-2">
            <p style="text-align: justify; font-size:13px;" class="text-align: justify">
                {{ $quejasClientes->descripcion }}</p>
        </div>

        <div class="mt-4 form-group col-md-12">
            <label class="form-label">1. ¿Realizará alguna acción inmediata?<sup>*</sup></label>
        </div>

        <div class="row col-12">
            <div class="card-body" style="margin-top:-30px;">
                <div class="accion_inmediata">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="realizar_accion" id="realizarAccion"
                            value="1"
                            {{ old('realizar_accion', $quejasClientes->realizar_accion) == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="realizar_accion">
                            Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="realizar_accion" value="2"
                            {{ old('realizar_accion', $quejasClientes->realizar_accion) == false ? 'checked' : '' }}>
                        <label class="form-check-label" for="realizar_accion">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <span class="realizar_accion_error text-danger errores"></span>
        </div><br>

        <div class="form-group col-md-12 col-sm-12 col-lg-12" style="margin-top:-20px;">
            <div id="contenidoAccion" style="display: none;">
                <label class="form-label">¿Cuál?</label>
                <textarea name="cual_accion" class="form-control">{{ $quejasClientes->cual_accion }}</textarea>
            </div>
        </div>

        <div class="mt-1 form-group col-md-12">
            <label class="form-label">2. ¿Qué acciones posteriores tomará para la resolución de la queja?<sup>*</sup></label>
        </div>


        <div class="form-group col-12">
            <textarea name="acciones_tomara_responsable"
                class="form-control">{{ $quejasClientes->acciones_tomara_responsable }}</textarea>
            <span class="acciones_tomara_responsable_error text-danger errores"></span>
        </div>


        <div class="mt-4 form-group col-md-12">
            <label class="form-label">3. Fecha compromiso para la resolución de la queja</label>
        </div>

        <div class="mt-2 form-group col-md-4">

            <input type="date" name="fecha_limite" class="form-control"
                value="{{ old('fecha_limite',$quejasClientes->fecha_limite ? \Carbon\Carbon::parse($quejasClientes->fecha_limite)->format('Y-m-d') : '') }}">
        </div>

        <div class="mt-4 form-group col-md-12">
            <label class="form-label">4. Adjunte la evidencia de la atención de la queja </label>
        </div>


        @if ($cierre->count() == 0)
            <div class="mt-2 form-group col-md-12">

                <input type="file" name="cierre[]" class="form-control" multiple="multiple">
            </div>
        @else
            <div class="row ml-1">
                <div class="form-group col-md-8">
                    <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                </div>
                <div class="form-group col-md-4">
                    <span type="button" class="mt-2 mr-5" data-toggle="modal"
                        data-target="#evidenciaDeCierreAgregada">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Ver
                        evidencia(s) de cierre
                    </span>
                </div>
            </div>
        @endif


        <!-- modal Evidencia Cierre -->
        <div class="modal fade" id="evidenciaDeCierreAgregada" tabindex="-1" role="dialog"
            aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        @if (count($quejasClientes->cierre_evidencias))
                            <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                <ol class='carousel-indicators'>
                                    @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                        <li data-target='#carouselExampleIndicators' data-slide-to='{{ $idx }}'
                                            class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                    @endforeach
                                </ol>
                                <div class='carousel-inner'>
                                    @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                        <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                            <iframe class='img-size'
                                                src='{{ asset('storage/evidencias_quejas_clientes_cerrado' . '/' . $cierre->cierre) }}'></iframe>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-4 form-group col-md-12">
            <label class="form-label">5. Solicitar el cierre de la queja </label>
        </div>

        <div class="mt-3 form-group col-12">
            <buttom type="submit" class="btn btn-success" id="cierra_queja_btn_correo">Enviar Solicitud</buttom>
        </div>



        <div class="mt-4 form-group col-md-12">
            <label class="form-label"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios</label>
            <textarea type="text" name="comentarios_atencion"
                class="form-control">{{ $quejasClientes->comentarios_atencion }}</textarea>
        </div>

        <div class="mt-4 text-right form-group col-12">
            <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
            {{-- <input type="submit" class="btn btn-success" value="Guardar" id="siguiente_atencionQueja"> --}}
            <button type="submit" class="btn btn-success" id="btn-guardar-atencion">Guardar</button>
            @if ($quejasClientes->empleado_reporto_id == auth()->user()->empleado->id)
                <button id="siguiente_atencion" type="submit" class="btn btn-success">Siguiente</button>
            @endif

        </div>




    </div>
</div>





<script type="text/javascript">
    let queja = @json($id_quejas);
    document.getElementById("cierra_queja_btn_correo").addEventListener("click", (event) => {
        event.preventDefault();
        console.log('click');
        let empleado_reporto_id = @json($quejasClientes->empleado_reporto_id);
        sendEmailCierre(empleado_reporto_id, queja);
    });

    function sendEmailCierre(empleado_reporto_id, queja) {
        let url = "{{ route('admin.desk.quejas-clientes.correoSolicitarCierreQueja') }}";
        Swal.fire({
            title: `¿Está seguro(a) de enviar el correo al responsable?`,
            showCancelButton: true,
            confirmButtonText: `Si, enviar`,
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                console.log(login);

                return fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': _token,
                            'Content-Type': 'application/json',
                            Accept: 'application/json'
                        },
                        body: JSON.stringify({
                            id: queja,
                            empleado_reporto_id: empleado_reporto_id,
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
