<div class="row g-3 needs-validation" novalidate>
    <div class="col-12 text-center header-text">
        <h3>REGISTRO DE ENTRADA</h3>
        <p>Por favor, ingresa tus datos para poder registrarte</p>
    </div>
    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre(s) <sup class="text-danger">*</sup></label>
        <input wire:model.defer="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
            id="nombre" placeholder="--" required>
        @error('nombre')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="apellidos" class="form-label">Apellido(s) <sup class="text-danger">*</sup></label>
        <input wire:model.defer="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror"
            id="apellidos" placeholder="--" required>
        @error('apellidos')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="correo" class="form-label">Correo <sup class="text-danger">*</sup></label>
        <input wire:model.defer="correo" type="text" class="form-control @error('correo') is-invalid @enderror"
            id="correo" placeholder="--" required>
        @error('correo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="celular" class="form-label">Teléfono / Celular</label>
        <input wire:model.defer="celular" type="text" class="form-control @error('celular') is-invalid @enderror"
            id="celular" placeholder="--">
        @error('celular')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    {{-- <div class="col-md-12">
        <label for="empresa" class="form-label">Empresa</label>
        <input wire:model.defer="empresa" type="text" class="form-control @error('empresa') is-invalid @enderror"
            id="empresa" placeholder="--">
        @error('empresa')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div> --}}

    <div class="col-12">
        <div class="row">
            @foreach ($dispositivos as $key => $dispositivo)
                <div class="col-1 mb-3">
                    <label for="dispositivo{{ $key }}" class="form-label">Número</label>
                    <input type="text" class="form-control" disabled readonly value="{{ $key + 1 }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="dispositivo{{ $key }}" class="form-label">Dispositivo Eléctrónico</label>
                    <input wire:model.defer="dispositivos.{{ $key }}.dispositivo" type="text"
                        class="form-control @error('dispositivos.' . $key . '.dispositivo') is-invalid @enderror"
                        id="dispositivo{{ $key }}" placeholder="--" required>
                    @error('dispositivos.' . $key . '.dispositivo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="marca{{ $key }}" class="form-label">Marca</label>
                    <input wire:model.defer="dispositivos.{{ $key }}.marca" type="text"
                        class="form-control @error('dispositivos.' . $key . '.marca') is-invalid @enderror"
                        id="marca{{ $key }}" placeholder="--" required>
                    @error('dispositivos.' . $key . '.marca')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="serie{{ $key }}" class="form-label">No. de Serie o Badge</label>
                    <input wire:model.defer="dispositivos.{{ $key }}.serie" type="text"
                        class="form-control @error('dispositivos.' . $key . '.serie') is-invalid @enderror"
                        id="serie{{ $key }}" placeholder="--" required>
                    @error('dispositivos.' . $key . '.serie')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-1 d-flex" style="align-items: center">
                    @if ($key > 0)
                        <div wire:click="removeInput({{ $key }})"
                            class="flex items-center justify-end text-red-600 text-sm w-full cursor-pointer"
                            style="cursor: pointer;font-size: 26px;display: flex;align-items: center;">
                            <i class="bi bi-trash"></i>
                        </div>
                    @else
                        <div wire:click="addInput"
                            class="flex items-center justify-center text-blue-600 text-sm py-4 w-full cursor-pointer"
                            style="cursor: pointer;font-size: 26px;display: flex;align-items: center;">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="col-12">
                <label for="motivo">Motivo de la visita <sup class="text-danger">*</sup></label>
                <textarea wire:model.defer="motivo" class="form-control @error('motivo') is-invalid @enderror" placeholder="--"
                    id="motivo" name="motivo" style="height: 150px"></textarea>
            </div>
        </div>
    </div>

    <div class="col-12" style="text-align: end">
        <a href="{{ route('visitantes.presentacion') }}" class="btn btn-primary">Salir</a>
        <button class="btn btn-primary" wire:click.prevent="increaseStep()" type="submit">Siguiente</button>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded',()=>{
            Livewire.on('coincidenciasNombreVisitantes',()=>{

            })
        })
    </script> --}}
</div>
