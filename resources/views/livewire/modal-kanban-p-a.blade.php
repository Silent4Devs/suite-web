<div>
    <x-loading-indicator />
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="kanbanModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="kanbanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kanbanModalLabel">{{ $title }}</h5>
                    <button id="cerrarModalKaX" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="form-group" id="formularioTaskKanban">
                        @if ($task)
                            <label for="titleTask" class="required">Titulo</label>
                            <input type="text" id="titleTask" class="form-control" placeholder="{{ $title }}"
                                value="{{ $title }}">

                            <label for="estatusTask" class="required">Estatus</label>
                            <select name="estatusTask" id="estatusTask" class="custom-select">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ $task->group_kanban_p_a_s_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->label }}</option>
                                @endforeach
                            </select>
                            <label for="description">Descripción</label>
                            <textarea name="" id="description" class="form-control" cols="30" rows="1">{{ $task->description }}</textarea>
                            <label for="responsableTask" class="required">Responsable(s)</label>
                            <select name="responsableTask"multiple id="responsableTask" class="custom-select select2">
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ in_array($empleado->id, $responsables_seleccionados) ? 'selected' : '' }}>
                                        {{ $empleado->name }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-4">
                                    <label for="taskStartDate">Fecha Inicio</label>
                                    <input type="date" name="" value="{{ $task->fecha_inicio }}"
                                        id="taskStartDate" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="taskEndDate">Fecha Fin</label>
                                    <input type="date" name="" id="taskEndDate"
                                        value="{{ $task->fecha_fin }}" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="taskDuration">Duración (Hrs)</label>
                                    <input type="number" max="24" min="1" name="" id="taskDuration"
                                        class="form-control" value="{{ $task->duracion }}">
                                </div>
                            </div>
                            <label for="aceptacion">Criterio de Aceptación</label>
                            <textarea name="" id="aceptacion" class="form-control" cols="30" rows="10">{{ $task->aceptacion }}</textarea>
                        @endif

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrarModalKa" class="btn btn-secondary"
                        data-dismiss="modal">Descartar</button>
                    <button type="button" class="btn btn-success" wire:click="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('formularioTaskKanban').addEventListener('keyup', (e) => {
                // console.log(e.target.getAttribute('id'));
                if (['titleTask'].includes(e.target.getAttribute('id'))) {
                    @this.set('title', e.target.value, true);
                    document.getElementById('kanbanModalLabel').innerHTML = e.target.value;
                }

                if (e.target.getAttribute('id') == 'description') {
                    @this.set('description', e.target.value, true);
                }

                if (e.target.getAttribute('id') == 'aceptacion') {
                    @this.set('aceptacion', e.target.value, true);
                }

                if (e.target.getAttribute('id') == 'taskDuration') {
                    if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }

                    if (e.target.value <= 0) {
                        e.target.value = null;
                    }

                    if (e.target.value > 24) {
                        e.target.value = 24;
                    }
                    @this.set('duracion', e.target.value, true);
                }
            })
            document.getElementById('formularioTaskKanban').addEventListener('change', (e) => {
                // yconsole.log(e.target.getAttribute('id'));
                if (['estatusTask'].includes(e.target.getAttribute('id'))) {
                    @this.set('group_kanban_p_a_s_id', e.target.value, true);
                }

                if (e.target.getAttribute('id') == 'taskDuration') {
                    if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }

                    if (e.target.value <= 0) {
                        e.target.value = null;
                    }

                    if (e.target.value > 24) {
                        e.target.value = 24;
                    }
                    @this.set('duracion', e.target.value, true);
                }

                if (e.target.getAttribute('id') == 'taskStartDate') {
                    @this.set('fecha_inicio', e.target.value, true);
                }

                if (e.target.getAttribute('id') == 'taskEndDate') {
                    @this.set('fecha_fin', e.target.value, true);
                }

            })

            $('form').on('select2:select select2:unselect', '.select2', function(e) {
                var items = $(this).val();
                @this.set('responsables', items, true);
            });

            function initSelect2() {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });
            }

            Livewire.on('select2', () => {
                initSelect2();
            })

            Livewire.on('openModalK', (task, responsablesSeleccionados) => {
                $('#kanbanModal').modal('show');
                initSelect2();
                $(".select2").val(responsablesSeleccionados).change();

            });
            Livewire.on('closeModalK', () => {
                $('#kanbanModal').modal('hide');

            });

            // document.getElementById('cerrarModalKa').addEventListener('click', () => {
            //     $(".select2").val('').change();
            // });
            // document.getElementById('cerrarModalKaX').addEventListener('click', () => {
            //     $(".select2").val('').change();
            // });

        });
    </script>

</div>
