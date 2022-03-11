<div>
    <div class="col-12 mb-3" style="position-absolute; margin-left:90%">
        <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
        data-toggle="modal" data-target="#niveleslec" data-whatever="@mdo" data-whatever="@mdo" title="Agregar Nivel de Impacto"><i
            class="fas fa-plus"></i></button>
    </div>
    <table class="table table-bordered w-100 datatable datatable-Sede">
        <thead class="thead-dark">
            <tr>
                <th>
                    Tipo de Impacto
                </th>
                <th>
                    Criterio
                </th>
                <th>
                    Base
                </th>
                @foreach($columnas as $columna)
                <th>
                    {{$columna['nivel']}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
        </tbody>
    </table>

    <div class="col-12 mb-3">
        <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
        data-toggle="modal" data-target="#tipoimpactolec" data-whatever="@mdo" data-whatever="@mdo" title="Agregar Tipo Impacto"><i
            class="fas fa-plus"></i></button>
    </div>


    <div wire:ignore class="modal fade" id="niveleslec" tabindex="-1" aria-labelledby="niveleslecLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="nivelesTitulo" id="exampleModalLabel">Nuevo Nivel de Impacto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="row">
                    <div class="form-group col-8">
                        <label for="recipient-name" class="col-form-label">Nivel:</label>
                        <input type="text" class="form-control" id="niveles" wire:model='indexColumna'>
                        <span class="text-danger" id="niveles_error" class="nivel_error"></span>
                    </div>
                    <div class="form-group col-4">
                        <label for="recipient-name" class="col-form-label">Color:</label>
                        <input class="form-control" id="color" type="color">
                        <span class="text-danger" id="color_error" class="color_error"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Clasificación:</label>
                        <input wire:model='clasificacion' type="text" class="form-control" id="clasificacion">
                        <span class="text-danger" id="clasificacion_error" class="clasificacion_error"></span>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="guardarNivel" wire:click.prevent="addColumn({{$indexColumna+1}})">Guardar</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="tipoimpactolec" tabindex="-1" aria-labelledby="tipoimpactolecLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tipoimpactolec" id="exampleModalLabel">Nuevo Tipo Impacto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Tipo de Impacto:</label>
                        <input type="text" class="form-control" id="nombre_impacto">
                        <span class="text-danger" id="nombre_impacto_error" class="nombre_impactp_error"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Criterio:</label>
                        <textarea class="form-control" id="criterio" type="text"></textarea>
                        <span class="text-danger" id="criterio_error" class="criterio_error"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Base:</label>
                        <textarea type="text" class="form-control" id="base"></textarea>
                        <span class="text-danger" id="base_error" class="base_error"></span>
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="guardar_marca">Guardar</button>
            </div>
          </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        Livewire.on('cerrarModal',()=>{
        console.log('cerrarModal');
        $('#niveleslec').modal('hide');
        document.querySelector('.modal-backdrop').style.display='none'
         });
    })

</script>
