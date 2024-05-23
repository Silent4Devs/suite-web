<div>
    <button type="button" class="btn btn-sm" style="text-align:center;" data-toggle="modal"
        data-target="#editModal">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Agregar nuevo requisito</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Necesidad EDIT</label>
                            <input type="text" class="form-control" id="necesidades" name="nececidades"
                                aria-describedby="emailHelp" wire:model="necesidades" value="{{ old('necesidades', $id_requisito->necesidades) }}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Expectativa EDIT</label>
                            <input type="text" class="form-control" id="expectativas" name="expectativas"
                                wire:model="expectativas" value="{{ old('expectativas', $id_requisito->expectativas) }}">

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
