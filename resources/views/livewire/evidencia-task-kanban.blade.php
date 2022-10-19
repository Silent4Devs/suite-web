<div>
    <x-loading-indicator />
    <i class="fas fa-link" style="cursor: pointer" wire:click="abrirModalEvidenciaTarea({{ $taskId }})"></i>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="taskEvidencia{{ $taskId }}" data-backdrop="static"
        data-keyboard="false" tabindex="-1" aria-labelledby="taskEvidencia{{ $taskId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskEvidencia{{ $taskId }}Label">
                        {{ $task->title }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div wire:ignore>
                        <label for="taskDescriptionEv{{ $taskId }}"><i class="fas fa-pen"></i> Evidencia
                            Textual</label>
                        <textarea name="" id="taskDescriptionEv{{ $taskId }}" cols="30" rows="10">
                            {{ $task->evidencia_textual }}
                        </textarea>
                    </div>
                    <div class="pt-4">
                        <span><i class="fas fa-image"></i> Evidencia
                            Textual</span>
                    </div>
                    <div class="text-center pt-4" x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="fileInput{{ $taskId }}" style="cursor: pointer">
                            <img src="{{ asset('img/submit.png') }}" width="50px" alt="" srcset=""> Subir
                            Archivos
                        </label>
                        <input wire:model="evidenciaFiles" type="file" multiple id="fileInput{{ $taskId }}"
                            style="display: none">

                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>

                    </div>
                </div>
                <div id="evidencias{{ $taskId }}">
                    <div class="row p-3">
                        @if (count($task->evidencias))
                            <div class="col-12 pb-2">
                                <i class="fas fa-folder-open"></i> Evidencias Cargadas
                            </div>
                        @endif
                        @foreach ($task->evidencias as $evidencia)
                            <div class="col-1" style="position: relative;">
                                <div style="position: absolute;top: -15px;right: 0; color:red; cursor: pointer;">
                                    <i class="fas fa-trash-alt" evidencia-id="{{ $evidencia->id }}"
                                        evidencia-archivo="{{ $evidencia->archivo }}"
                                        task-evd-id="{{ $taskId }}"></i>
                                </div>
                                @if (in_array($evidencia->extension, ['png', 'jpg', 'jpeg', 'bpm', 'gif']))
                                    <img src="{{ $evidencia->archivo_ruta }}" alt="{{ $evidencia->archivo }}"
                                        style="width: 100%;">
                                @else
                                    <a href="{{ $evidencia->archivo_ruta }}">
                                        <img src="{{ asset('img/file.png') }}" alt="{{ $evidencia->archivo }}"
                                            style="width: 100%;">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('cerrarModalEvidenciaTask', (taskId) => {
                $('#taskEvidencia' + taskId).modal('hide');
                document.querySelector('.modal-backdrop').style.display = "none";
            });

            Livewire.on('abrirModalEvidencia', (taskID) => {
                $('#taskEvidencia' + taskID).modal('show');
                let editorID = 'taskDescriptionEv' + taskID;
                if (CKEDITOR.instances[editorID]) {
                    CKEDITOR.instances[editorID].destroy();
                }
                var editor = CKEDITOR.replace('taskDescriptionEv' + taskID, {
                    toolbar: [{
                            name: 'styles',
                            items: ['Styles', 'Format', 'Font', 'FontSize']
                        },
                        {
                            name: 'colors',
                            items: ['TextColor', 'BGColor']
                        },
                        {
                            name: 'editing',
                            groups: ['selection'],
                            items: ['SelectAll']
                        }, {
                            name: 'clipboard',
                            groups: ['undo'],
                            items: ['Undo', 'Redo']
                        },
                        {
                            name: 'basicstyles',
                            groups: ['basicstyles', 'cleanup'],
                            items: ['Bold', 'Italic', 'Underline']
                        },
                        {
                            name: 'paragraph',
                            groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                                '-',
                                'Blockquote'
                            ]
                        },
                        {
                            name: 'links',
                            items: ['Link', 'Unlink']
                        },
                    ]
                });
                CKEDITOR.instances[editorID].on('change', function(event) {
                    // getData() returns CKEditor's HTML content.
                    @this.emit('evidenciaTextualEvent', event.editor.getData());
                });

            });

            document.getElementById('evidencias{{ $taskId }}').addEventListener('click', (e) => {
                if (e.target.getAttribute('evidencia-id')) {
                    Swal.fire({
                        title: '¿Estás seguro de eliminar esta evidencia?',
                        text: "Este procedimiento es irreversible",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let evidenciaId = e.target.getAttribute('evidencia-id');
                            let evidenciaArchivo = e.target.getAttribute('evidencia-archivo');
                            let taskId = e.target.getAttribute('task-evd-id');
                            @this.removeEvidencia(evidenciaId, evidenciaArchivo, taskId);
                        }
                    });
                }
            });
        });
    </script>

</div>
