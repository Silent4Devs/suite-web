<div>
    <div class="container">
        <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá habilitar/deshabilitar la información
                        que aparecera en la sección de mi organización para que el usuario pueda visualizar la información.
                    </p>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label class="required" for="logotipo_id"><i class="fas fa-image iconos-crear"></i>Logo</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="logotipo_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label class="required" for="empresa_id"><i class="far fa-building iconos-crear"></i>Nombre de la Empresa</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="empresa_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label class="required" for="direccion_id"> <i class="fas fa-map-marker-alt iconos-crear"></i>Dirección</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="direccion_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="razon_social_id"><i class="far fa-building iconos-crear"></i>Razón Social</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="razon_social_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="rfc_id"><i class="fas fa-file-alt iconos-crear"></i>RFC</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="rfc_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label class="required" for="telefono_id"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="telefono_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label class="required" for="correo_id"><i class="far fa-envelope iconos-crear"></i>Correo</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="correo_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                {{-- {{$pagina_web_id}} --}}
                <label  for="pagina_web_id"><i class="far fa-envelope iconos-crear"></i> Página Web</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="pagina_web_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>

            <div class="form-group col-sm-3">
                <label  for="schedule_id"><i class="iconos-crear fas fa-calendar-alt"></i>Horario Laboral</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="schedule_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="representante_legal_id"><i class="iconos-crear fas fa-user"></i>Representante Legal </label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="representante_legal_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="fecha_constitucion_id"><i class="iconos-crear fas fa-calendar-alt"></i>Fecha de
                    constitución</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="fecha_constitucion_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="num_empleados_id"><i class="iconos-crear fas fa-users"></i>Número
                    de empleados</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="num_empleados_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="tamano_id"><i class="iconos-crear fas fa-building"></i>Tamaño</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="tamano_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="giro_id"> <i class="fas fa-briefcase iconos-crear"></i>Giro</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="giro_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="servicios_id"><i class="fas fa-briefcase iconos-crear"></i>Servicios</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="servicios_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="mision_id"><i class="fas fa-flag iconos-crear"></i>Misión</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="mision_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="vision_id"><i class="far fa-eye iconos-crear"></i>Visión</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="vision_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="valores_id"><i class="far fa-heart iconos-crear"></i>Valores</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="valores_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="antecedentes_id"><i class="far fa-file-alt iconos-crear"></i>Antecedentes</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="antecedentes_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="linkedln_id"><i class="fab fa-linkedin iconos-crear"></i>Linkedln</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="linkedln_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="facebook_id"><i class="fab fa-facebook-square iconos-crear"></i>Facebook</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="facebook_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label for="youtube_id"><i class="fab fa-youtube iconos-crear"></i>Youtube</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="youtube_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group col-sm-3">
                <label  for="twitter_id"><i class="fab fa-twitter-square iconos-crear"></i>Twitter</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="twitter_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            {{-- <div class="form-group col-sm-3">
                <label class="required" for="team_id_id"><i class="far fa-file-alt iconos-crear"></i>Team</label>
                <br>
                <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                    <input type="checkbox" wire:model.debounce.800ms="team_id_id" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div> --}}
        </div>
    </div>

</div>
