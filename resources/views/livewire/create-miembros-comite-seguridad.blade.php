<div class="form-group col-md-12">
    {{-- <button type="button" class="btn-xs btn-outline-success rounded ml-2 pr-3 offset-4"><i class="pl-2 pr-3 fas fa-plus"></i> Agregar</button> --}}
    <button type="button" class="btn btn-primary offset-11" style="text-align:center;" wire:click.prevent="create">
        Agregar
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Miembro</h5>

                    <input id="comite_id" name="comite_id" type="hidden" value=" {{ $id_comite }}"
                        wire:model.defer="id_comite">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="nombre_rol"> <i class="fas fa-user-tag iconos-crear"></i>Nombre del
                            rol</label>
                        <input class="form-control {{ $errors->has('nombre_rol') ? 'is-invalid' : '' }}"
                            type="text" name="nombre_rol" id="nombre_rol" value="{{ old('nombrerol', '') }}"
                            wire:model.defer="nombre_rol">
                        @if ($errors->has('nombre_rol'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre_rol') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="fechavigor"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de entrada
                            en vigor</label>
                        <input class="form-control date {{ $errors->has('fecha_vigor') ? 'is-invalid' : '' }}"
                            type="date" name="fechavigor" id="fechavigor" value="{{ $fecha_vigor }}"
                            wire:model.defer="fecha_vigor">
                        @if ($errors->has('fecha_vigor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_vigor') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="id_asignada"><i class="fas fa-user-tie iconos-crear"></i>Colaborador(a)
                            asignado</label>
                        <select class="form-control  {{ $errors->has('colaborador') ? 'is-invalid' : '' }}"
                            name="id_asignada" id="id_asignada" wire:model.defer="colaborador">
                            <option value="">Seleccione una opción</option>
                            @foreach ($empleados as $empleado)
                                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}">
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('colaborador'))
                            <div class="invalid-feedback">
                                {{ $errors->first('colaborador') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12"  wire:ignore>
                        <label for="id_puesto_asignada"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="puesto_asignada" readonly></div>

                    </div>

                    <div class="form-group col-md-12"  wire:ignore>
                        <label for="id_area_asignada"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="area_asignada" readonly></div>
                    </div>
                    <div class="form-group col-sm-12" wire:ignore>
                        <label class="required" for="responsabilidades"> <i class="fas fa-business-time iconos-crear"></i>
                            {{ trans('cruds.comiteseguridad.fields.responsabilidades') }}</label>
                        <textarea class="form-control {{ $errors->has('responsabilidades') ? 'is-invalid' : '' }}" name="responsabilidades"
                            id="responsabilidades" wire:model.defer="responsabilidades">{{ old('responsabilidades') }}</textarea>
                        @if ($errors->has('responsabilidades'))
                            <div class="invalid-feedback">
                                {{ $errors->first('responsabilidades') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.comiteseguridad.fields.responsabilidades_helper') }}</span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('cargar-puesto', (empleado) => {
                let select = document.getElementById('id_asignada');
                let seleccionado = select.options[select.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })

            let editor = CKEDITOR.replace('responsabilidades', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            editor.on('change', function(event) {
                console.log(event.editor.getData())
                @this.set('responsabilidades', event.editor.getData());
            })
            Livewire.on('cerrar-modal',()=>{
                CKEDITOR.instances.responsabilidades.setData('');
            })
            Livewire.on('editar-modal',(data)=>{
                CKEDITOR.instances.responsabilidades.setData(data);
            })
        })
    </script>


</div>
