<div>

    <div class="col-12" >
        <i title="Eliminar" style="color:white;" class="fa-solid fa-trash"></i>
        <i title="Editar" style="color:white" class="ml-2 fa-solid fa-pen" data-toggle="modal" data-target="#nivelesedit" data-whatever="@mdo" data-whatever="@mdo"></i>
    </div>

    <div wire:ignore class="modal fade" id="nivelesedit" tabindex="-1" aria-labelledby="niveleslecLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="niveleseditTitulo" id="exampleModalLabel" style="color:black">Editar Nivel de Impacto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="row">
                    <div class="form-group col-8">
                        <label for="recipient-name" class="col-form-label required">Nivel</label>
                        <input type="number" class="form-control" id="niveles" >
                        @error('nivelImpacto')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="recipient-name" class="col-form-label required">Color:</label>
                        <input class="form-control" id="color" type="color" >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label required">Clasificación:</label>
                        <input type="text" class="form-control" id="clasificacion">
                        @error('clasificacionImpacto')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="guardarNivel" >Guardar</button>
            </div>
          </div>
        </div>
    </div>


</div>
