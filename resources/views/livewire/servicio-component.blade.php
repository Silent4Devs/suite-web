<div class="col-md-6 form-group">


        <div style="display:flex; width:100%; justify-content: space-between;">
            <label style="display:flex" for="servicio_id"><i class="fas fa-handshake iconos-crear"></i>Servicio</label>
            <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
            data-toggle="modal" data-target="#tipoimpactolec" data-whatever="@mdo" data-whatever="@mdo" title="Agregar Tipo Impacto"><i
                class="fas fa-plus"></i></button>
        </div>
        <select class="form-control">
            <option>Seleccione una opción</option>
        </select>
        {{-- <select class="sedeSelect form-control" name="servicio_id" id="servicio_id">
            <option value="" selected disabled>Seleccione una opción</option>
            @foreach ($servicios as $servicios)
                <option {{ old('servicio_id') == $servicios->id ? ' selected="selected"' : '' }}
                    value="{{ $servicios->id }}">{{ $servicios->area }}</option>
            @endforeach
        </select>
        @if ($errors->has('servicio_id'))
            <div class="invalid-feedback">
                {{ $errors->first('servicio_id') }}
            </div>
        @endif --}}

        <div class="modal fade" id="tipoimpactolec" tabindex="-1" aria-labelledby="tipoimpactolecLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tipoimpactolec" id="exampleModalLabel">Servicio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                        <div class="form-group col-12">
                            <label for="recipient-name" class="col-form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre_impacto">
                            <span class="text-danger" id="nombre_impacto_error" class="nombre_impactp_error"></span>
                        </div>

                        <div class="form-group col-12">
                            <label for="recipient-name" class="col-form-label">Nombre del Servicio</label>
                            <textarea type="text" class="form-control" id="nombre_impacto"></textarea>
                            <span class="text-danger" id="nombre_impacto_error" class="nombre_impactp_error"></span>
                        </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" id="guardar_marca">Guardar</button>
                </div>
              </div>
            </div>
        </div>

</div>
