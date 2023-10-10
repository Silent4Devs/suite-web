<div wire:ignore.self class="modal fade" id="addStudentDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="addStudentDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addStudentDataModalLabel">Agregar estudiante</h3>
            </div>
            <div class="modal-body">
                {{-- <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left" style="min-width:500px;"> --}}
                    <p lass="text-sm leading-5 text-gray-500" for="usuario">Usuario<span style="color:red">*</span></p>
                    <div class="mt-2">
                        <select class="form-control  block w-full mt-2 mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                            name="user_id" id="user_id" wire:model.defer="user_id">
                            <option value="" selected>
                                Selecciona una opción
                            </option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">
                                    {{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                {{-- </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel" data-dismiss="modal"
                    wire:click.prevent="cancel()">Cerrar</button>
                <button wire:click.prevent="save()" class="btn btn-primary close-modal" style="background-color: #345183">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- <form wire:submit.prevent="save()">
    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left" style="min-width:500px;">
        <div class="mt-2">
            <p lass="text-sm leading-5 text-gray-500" for="usuario">Usuario<span style="color:red">*</span></p>
            <select class="form-input  block w-full mt-2 mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                name="user_id" id="user_id" wire:model.defer="user_id">
                <option value="" selected>
                    Selecciona una opción
                </option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">
                        {{ $usuario->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="mt-5 sm:mt-6">
        <div class="flex justify-end mt-2 mb-3">
            <button @click="open = false"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                Cerrar
            </button>
            <button style="background-color: #333"
                class="inline-flex items-center justify-center px-4 py-2 ml-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md focus:outline-none focus:shadow-outline-red">
                Guardar
            </button>
        </div>
    </div>
</form> --}}

