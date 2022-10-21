<div>
    <x-loading-indicator />
    <form action="" class="p-4">
        <h5 class="pb-3">Creación de un nuevo plan de acción basado en Kanban</h5>
        <div class="row pb-3">
            <div class="col-6">
                <label for="titlePAK" class="required">Titulo <span class="text-danger">*</span></label>
                <input type="text" id="titlePAK" wire:model.defer="title" class="form-control">
            </div>
            <div class="col-6">
                <label for="titlePAK">Norma(s)</label>
                <select name="" id="" class="form-control" wire:model.defer="normasVinculadas" multiple>
                    @foreach ($normas as $norma)
                        <option value="{{ $norma->id }}">
                            {{ $norma->norma }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="descripcionPAK">Descripción</label>
                <textarea name="" id="descripcionPAK" cols="30" rows="10" class="form-control"
                    wire:model.defer="descripcion"></textarea>
            </div>
        </div>
        <button wire:click.prevent="{{ $edit ? 'update' : 'save' }}"
            class="btn btn-success">{{ $edit ? 'Editar' : 'Guardar' }}</button>
    </form>
</div>
