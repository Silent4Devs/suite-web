<div wire:ignore.self class="modal fade" id="tipoObjetivoModal" tabindex="-1"
    aria-labelledby="tipoObjetivoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #00a57e;color: white;">
                <h5 class="modal-title" id="tipoObjetivoModalLabel"><i class="mr-2 fas fa-plus-circle"></i>Agregar Tipo
                    de
                    Objetivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                id="nombre" aria-describedby="nombre" wire:model.defer="nombre"
                                value="{{ old('nombre') }}" autocomplete="off">
                            <small>Ingresa el nombre del tipo de objetivo</small>
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="text-danger nombre_error error-ajax"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
                        <div wire:ignore class="input-group is-invalid">
                            <div class="form-group" style="width: 100%;border: solid 1px #cecece;">
                                <div class="row align-items-center" style="padding: 20px 0;">
                                    <div class="col-md-6 col-sm-6 col-12 d-flex justify-content-center">
                                        <label style="cursor: pointer" for="fotoPerspectiva">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <i class="fas fa-image iconos-crear"
                                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                                    <span id="texto-imagen-perspectiva" class="pl-2">
                                                        Subir imágen
                                                        <small class="text-danger" style="font-size: 10px">
                                                            (Requerida)</small>
                                                    </span>
                                                </h5>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="text-center col-6">
                                        <img id="uploadPreviewPerspectiva" class="imagen-preview"
                                            src="{{ asset('img/not-available.png') }}" width="150" height="150"
                                            accept="image/png, image/gif, image/jpeg" style="clip-path: circle(60px at 50% 50%);
                                            height: 120px;" />
                                        @if ($errors->has('fotoPerspectiva'))
                                            <span
                                                class="text-danger">{{ $errors->first('fotoPerspectiva') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-danger fotoPerspectiva_error error-ajax"></span>
                                <input name="fotoPerspectiva" type="file" accept="image/png, image/jpeg"
                                    class="form-control-file" id="fotoPerspectiva" wire:model.defer="fotoPerspectiva"
                                    hidden>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" wire:click.prevent="save">Guardar</button>
            </div>
        </div>
    </div>
</div>
