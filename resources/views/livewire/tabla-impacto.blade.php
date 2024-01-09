<div>
    <div class="col-12 mb-3" style="position-absolute; margin-left:90%">
        <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
        data-toggle="modal" data-target="#niveleslec" data-whatever="@mdo" data-whatever="@mdo" title="Agregar Nivel de Impacto"><i
            class="fas fa-plus"></i></button>
    </div>

    <div class="col-12" style="overflow-x:auto" >
        <table class="table table-bordered w-100 datatable" id="tabladeImpacto">
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
                    <th style="min-width:300px; background:{{$columna['color']}}">

                            @livewire('edit-tabla-impacto')

                        <div class="text-center">
                             {{$columna['nivel']}}
                        </div>
                        <div class="text-center">
                            {{$columna['clasificacion']}}
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                    @foreach($filas as $index=>$fila)
                <tr>
                    <td>
                        {{$fila['nombre_impacto']}}
                    </td>
                    <td>
                        {{$fila['criterio']}}
                    </td>
                    <td>
                        {{$fila['base']}}
                    </td>
                    @foreach($columnas as $i=>$columna)
                    <td style="width:100px;">
                        <textarea  type="text" class="form-control contenido-impactos" data-tipo="{{$fila['id']}}" data-nivel="{{$columna['id']}}"></textarea>
                    </td>
                    @endforeach
                </tr>
                    @endforeach

            </tbody>
        </table>
    </div>


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
                        <label for="recipient-name" class="col-form-label required">Nivel:</label>
                        <input type="number" class="form-control" id="niveles" wire:model="nivelImpacto">
                        @error('nivelImpacto')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="recipient-name" class="col-form-label required">Color:</label>
                        <input class="form-control" id="color" type="color"  wire:model="colorImpacto">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label required">Clasificación:</label>
                        <input type="text" class="form-control" id="clasificacion" wire:model="clasificacionImpacto">
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
              <button type="button" class="btn btn-primary" id="guardarNivel" wire:click.prevent="addColumn({{$indexColumna+1}})">Guardar</button>
            </div>
          </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="tipoimpactolec" tabindex="-1" aria-labelledby="tipoimpactolecLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tipoTitulo" id="exampleModalLabel">Nuevo Tipo Impacto</h5>
              <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Tipo de Impacto:</label>
                        <input type="text" class="form-control" id="nombre_impacto" wire:model="nombreImpacto">
                        <span class="text-danger" id="nombre_impacto_error"  class="nombre_impacto_error"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Criterio:</label>
                        <textarea class="form-control" id="criterio" type="text" wire:model="criterioImpacto"></textarea>
                        <span class="text-danger" id="criterio_error" class="criterio_error"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="recipient-name" class="col-form-label">Base:</label>
                        <textarea type="text" class="form-control" id="base" wire:model="baseImpacto"></textarea>
                        <span class="text-danger" id="base_error" class="base_error"></span>
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="guardar_marca" wire:click.prevent="addRow({{$indexRow+1}})">Guardar</button>
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
         Livewire.on('cerrarModalImpacto',()=>{
        console.log('cerrarModalImpacto');
        $('#tipoimpactolec').modal('hide');
        document.querySelector('.modal-backdrop').style.display='none'
         });

         document.getElementById('tabladeImpacto').addEventListener('keyup',(e)=>{
            if(e.target.tagName == "TEXTAREA"){
                let contenido= e.target.value;
                let tipo = e.target.getAttribute('data-tipo');
                let nivel = e.target.getAttribute('data-nivel');
                @this.guardarContenido(tipo,nivel, contenido);
            }
         })
         obtenerContenidoImpactos();
         function obtenerContenidoImpactos(){
            document.querySelectorAll('.contenido-impactos').forEach(async (item)=>{
            // item.innerHTML =`<i class="fas fa-circle-notch fa-spin"></i> Cargando`;
            let tipo = item.getAttribute('data-tipo');
            let nivel = item.getAttribute('data-nivel');
               let contenido = await @this.obtenerContenido(tipo,nivel);
               console.log(contenido);
               item.innerHTML = contenido;
            })
         }

    })



</script>
