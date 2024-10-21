<div>
    <div class="card">
        <div class="card-body">
            <div class="row m-0 p-0">
                <div class="col-12">
                    <h5 class="title-grafics">
                        Análisis de riesgos
                    </h5>
                </div>
            </div>
            <hr style="margin-top: 0px; margin-bottom:25px;">
            <div class="row">
                <div class="col-8">
                    <div class="form-group pl-0 anima-focus">
                        <input class="form-control" placeholder="" wire:model="name">
                        <label for="valor">Nombre de plantilla</label>
                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group pl-0 anima-focus">
                        <input class="input-disabled form-control" placeholder="" wire:model="norma" disabled>
                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group pl-0 anima-focus">
                        <textarea class="form-control" placeholder="" style="min-height: 86px;" wire:model="description"></textarea>
                        <label for="valor">Descripción de plantilla</label>
                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
