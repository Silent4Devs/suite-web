<div class="form-group col-md-12">

    <div class="row col-12 ml-5">
        <div class="mb-3 col-12 mt-4 " style="text-align: end">
            <button type="button" wire:click.prevent="create" class="btn btn-success">Agregar</button>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Hallazgos</h5>

                    <input id="auditoria_internas_id" name="auditoria_internas_id" type="hidden"
                        value=" {{ $auditoria_internas_id }}" wire:model.defer="auditoria_internas_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="required" for="incumplimiento_requisito"><i class="fas fa-clipboard-list iconos-crear"></i>
                                Requisito</label>
                            <textarea class="form-control {{ $errors->has('incumplimiento_requisito') ? 'is-invalid' : '' }}"
                                name="incumplimiento_requisito" id="incumplimiento_requisito" wire:model.defer="incumplimiento_requisito">{{ old('incumplimiento_requisito') }}</textarea>
                            @if ($errors->has('incumplimiento_requisito'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incumplimiento_requisito') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="required"  for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>
                                Descripción</label>
                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion"
                                wire:model.defer="descripcion">{{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="clasificacion_hallazgo"><i
                                    class="fas fa-user-tie iconos-crear"></i>Clasificación del Hallazgo</label>
                            <input class="form-control {{ $errors->has('clasificacion_hallazgo') ? 'is-invalid' : '' }}"
                                type="text" name="clasificacion_hallazgo" id="clasificacion_hallazgo"
                                value="{{ old('clasificacion_hallazgo', '') }}"
                                wire:model.defer="clasificacion_hallazgo">
                            @if ($errors->has('clasificacion_hallazgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clasificacion_hallazgo') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="proceso_id"><i
                                    class="fas fa-cogs iconos-crear"></i></i>Proceso</label>
                            <select class="form-control {{ $errors->has('proceso') ? 'is-invalid' : '' }}"
                                name="proceso_id" id="proceso_id" wire:model.defer="proceso">
                                <option value="">Seleccione un proceso</option>
                                @foreach ($procesos as $proceso)
                                    <option value="{{ $proceso->id }}">
                                        {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('proceso'))
                                <div class="text-danger">
                                    {{ $errors->first('proceso') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-12 col-lg-12">
                            <label for="area_id"><i
                                    class="fas fa-street-view iconos-crear"></i>Área</label>
                            <select class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area_id"
                                id="area_id" wire:model.defer="area">
                                <option value="">Seleccione un proceso</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">
                                        {{ $area->area }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('area'))
                                <div class="text-danger">
                                    {{ $errors->first('area') }}
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
            document.getElementById('id_auditado').addEventListener('change', (e) => {
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
            Livewire.on('cerrar-modal', () => {
                CKEDITOR.instances.responsabilidades.setData('');
            })
            Livewire.on('editar-modal', (data) => {
                CKEDITOR.instances.responsabilidades.setData(data);
            })

            window.initSelect2 = () => {
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
                $('#proceso_id').on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log(data);
                    @this.set('proceso', data.id);
                });
            }

            initSelect2();

            Livewire.on('select2', () => {
                initSelect2();
            });


        })
    </script>


</div>
