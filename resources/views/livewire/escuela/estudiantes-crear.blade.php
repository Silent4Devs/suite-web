<section>
    <div class="" x-data="{ open: @entangle('open').live }">
        <!-- Button (blue), duh! -->
        <div class="row justify-content-start">
            <div class="col-9">
                <h4>Estudiantes del curso</h4>
            </div>
            <div class="col-3 d-flex justify-content-end">
                <button class="btn btn-light text-primary border border-primary" data-toggle="modal"
                data-target="#addStudentDataModal">Agregar Estudiante <i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        <hr class="mt-2 mb-6 bg-primary">

        @include("livewire.escuela.instructor.addstudent")
        {{-- <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full"
            style="background-color: rgba(0,0,0,.5);" x-show="open">
            <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                @click.away="open = false">
                <form wire:submit="save()">

                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left" style="min-width:500px;">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Agregar estudiante
                        </h3>
                        <div class="mt-2">

                            <p lass="text-sm leading-5 text-gray-500" for="usuario">Usuario<span
                                    style="color:red">*</span></p>
                            <select
                                class="form-input  block w-full mt-2 mb-2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                name="user_id" id="user_id" wire:model.live="user_id">
                                <option value="" selected>
                                    Selecciona una opción
                                </option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-red-600">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <div class="flex justify-end mt-2 mb-3">
                            <button @click="open = false" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                                Cerrar
                            </button>
                            <button  style="background-color: #333" class="inline-flex items-center justify-center px-4 py-2 ml-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md focus:outline-none focus:shadow-outline-red">
                                Guardar
                            </button>
                        </div>

                    </div>


                </form>
            </div>
        </div> --}}
    </div>
    {{-- <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,

                toggle() {
                    this.open = ! this.open
                }
            }))
        })
    </script> --}}
    {{-- @section('scripts') --}}
    <script>
        window.addEventListener('closeModal', event => {
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
            })
    </script>
    {{-- @endsection --}}
</section>

