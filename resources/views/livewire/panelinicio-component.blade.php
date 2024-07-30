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
                    que aparecera en la sección del perfil del empleado al ingresar al portal tabantaj.
                </p>

            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="form-group col-sm-3">
            <label class="required" for="nombre_id"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="nombre_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>--}}
        <div class="form-group col-sm-3">
            <label class="required" for="nempleado_id"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="nempleado_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="jefe_id"><i class="fas fa-user iconos-crear"></i>Jefe
                Inmediato</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="jefe_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="area_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="puesto_id"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="puesto_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="perfil_id"><i class="fas fa-briefcase iconos-crear"></i>Perfil</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="perfil_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                ingreso</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="fechaingreso_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="genero_id"><i class="fas fa-user iconos-crear"></i>Género</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="genero_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-business-time iconos-crear"></i>Estatus
                empleado</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="estatusemp_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="correo_id"><i class="far fa-envelope iconos-crear"></i>Correo
                electrónico</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="correo_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-mobile-alt iconos-crear"></i></i>Teléfono
                móvil</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="telefono_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        {{-- <div class="form-group col-sm-3">
            <label class="required" for="teloficina_id"><i class="fas fa-phone iconos-crear"></i>Teléfono
                oficina</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="teloficina_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div> --}}
        <div class="form-group col-sm-3">
            <label class="required" for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="sede_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="dire_id"><i class="fas fa-map iconos-crear"></i>Dirección</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="dire_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="cumpleanos_id"><i
                    class="fas fa-birthday-cake iconos-crear"></i>Cumpleaños</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.live.debounce.800ms="cumpleanos_id" class="c-switch-input">
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
    </div>
</div>
