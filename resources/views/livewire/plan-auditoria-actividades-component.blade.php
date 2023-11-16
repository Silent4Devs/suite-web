<div class="form-group col-md-12">

    <div class="row col-12 ml-5">
        <div class="mb-3 col-12 mt-4 " style="text-align: end">
            <button type="button" wire:click.prevent="create"
            class="btn btn-success">Agregar</button>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Descripción de actividades</h5>

                    <input id="plan_auditoria_id" name="plan_auditoria_id" type="hidden" value=" {{ $plan_auditoria_id }}"
                        wire:model="plan_auditoria_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="actividad_auditar"><i class="fas fa-clipboard-list iconos-crear"></i>
                                Actividad a Auditar<span class="text-danger">*</span></label>
                            <textarea class="form-control {{ $errors->has('actividad_auditar') ? 'is-invalid' : '' }}" name="actividad_auditar"
                                id="actividad_auditar" wire:model="actividad_auditar">{{ old('actividad_auditar') }}</textarea>
                                @if ($errors->has('actividad_auditar'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('actividad_auditar') }}
                                    </div>
                                @endif
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="fecha_auditoria"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de auditoría
                                en vigor<span class="text-danger">*</span></label>
                            <input class="form-control date {{ $errors->has('fecha_auditoria') ? 'is-invalid' : '' }}"
                                type="date" name="fecha_auditoria" id="fecha_auditoria" value="{{ $fecha_auditoria }}"
                                wire:model="fecha_auditoria">
                                @if ($errors->has('fecha_auditoria'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fecha_auditoria') }}
                                    </div>
                                @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6 mt-4">
                            <label for="horario_inicio"><i class="fas fa-clock iconos-crear"></i>Horario de inicio</label>
                            <input class="form-control date" type="time" name="horario_inicio" id="horario_inicio_actividad"
                                value="{{ old('horario_inicio') }}" wire:model="horario_inicio">
                            <small class="text-danger errores horario_inicio_error"></small>
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6 mt-4">
                            <label for="horario_termino"><i class="fas fa-clock iconos-crear"></i>Horario de término</label>
                            <input class="form-control date" type="time" name="horario_termino" id="horario_termino_actividad"
                                value="{{ old('horario_termino') }}" wire:model="horario_termino">
                            <small class="text-danger errores horario_termino_error"></small>
        
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="id_auditado"><i class="fas fa-user-tie iconos-crear"></i>Auditado(a)<span class="text-danger">*</span></label>
                            <select class="form-control  {{ $errors->has('auditado') ? 'is-invalid' : '' }}"
                                name="id_auditado" id="id_auditado" wire:model="auditado">
                                <option value="">Seleccione una opción</option>
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('auditado'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('auditado') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12"  wire:ignore>
                            <label for="id_puesto_asignada"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_asignada" readonly></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12"  wire:ignore>
                            <label for="id_area_asignada"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_asignada" readonly></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="nombre_auditor"><i class="fas fa-user-tie iconos-crear"></i>Nombre del
                                auditor asignado</label>
                            <input class="form-control {{ $errors->has('nombre_auditor') ? 'is-invalid' : '' }}"
                                type="text" name="nombre_auditor" id="nombre_auditor" value="{{ old('nombre_auditor', '') }}"
                                wire:model="nombre_auditor">
                            @if ($errors->has('nombre_auditor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre_auditor') }}
                                </div>
                            @endif
                        </div>
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
            document.getElementById('id_auditado').addEventListener('change',(e)=>{
                let seleccionado = e.target.options[e.target.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })
            Livewire.on('cargar-puesto', (empleado) => {
                console.log(empleado);
                let select = document.getElementById('id_auditado');
                let seleccionado = select.options[select.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })

            Livewire.on('abrir-modal', () => {
                document.getElementById('puesto_asignada').innerHTML = '';
                document.getElementById('area_asignada').innerHTML = '';
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
