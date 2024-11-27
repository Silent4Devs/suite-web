<div wire:ignore.self class="modal fade" id="addStudentDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="addStudentDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addStudentDataModalLabel">Agregar estudiante</h3>
            </div>
            <div class="modal-body">
                <div class="mt-2 form-group anima-focus">
                    <select class="form-control  block w-full mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                        name="user_id" id="user_id" wire:model="user_id" placeholder="">
                        <option value="" selected>
                            Selecciona una opción
                        </option>
                        @foreach ($usuarios_manual as $usuario)
                            <option value="{{ $usuario['id'] }}">
                                {{ $usuario['name'] }}</option>
                        @endforeach
                    </select>
                    <label for="user_id">Usuario*</label>
                    @error('user_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-dismiss="modal"
                    wire:click.prevent="cancel()">Cerrar</button>
                <button wire:click.prevent="save()" data-dismiss="modal" class="btn btn-primary close-modal"
                    style="background-color: #345183">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
