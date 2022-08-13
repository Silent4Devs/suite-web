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

    <div class="col-12">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="dispositivo" class="form-label">Dispositivo Eléctrónico</label>
                <input wire:model.defer="dispositivo" type="text"
                    class="form-control @error('dispositivo') is-invalid @enderror" id="dispositivo" placeholder="--"
                    required>
                @error('dispositivo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label for="serie" class="form-label">No. de Serie o Badge</label>
                <input wire:model.defer="serie" type="text"
                    class="form-control @error('serie') is-invalid @enderror" id="serie" placeholder="--" required>
                @error('serie')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="motivo">Motivo <sup class="text-danger">*</sup></label>
                <textarea wire:model.defer="motivo" class="form-control @error('motivo') is-invalid @enderror" placeholder="--"
                    id="motivo" name="motivo" style="height: 150px"></textarea>
            </div>
        </div>
    </div>

    <div class="col-12" style="text-align: end">
        <a href="{{ route('visitantes.presentacion') }}" class="btn btn-primary">Salir</a>
        <button class="btn btn-primary" wire:click.prevent="increaseStep()" type="submit">Siguiente</button>
    </div>
</div>
