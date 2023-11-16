<div class="mb-4 row col-12">


    <div class="col-12">
        <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Documento(s)</label>
    </div>
    {{-- <form class="form-inline" action="{{ route('admin.minutasaltadireccions.store') }}"
        enctype="multipart/form-data"> --}}
    @csrf

    <div class="form-group mb-2 col-9">
        <div class="custom-file">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <!-- File Input -->

                <input type="file" multiple class="form-control" id="files" accept="image/*,.pdf"
                    wire:model="files">
                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2" wire:click.prevent="save" wire:loading.attr="disabled"
        wire:target="save">
        <div wire:loading.remove wire:target="save">Subir archivos(s)</div>
        <div wire:loading wire:target="save"><i class="fas fa-spinner fa-spin mr-2"></i>
            Subiendo archivos
        </div></button>
   
    {{-- </form> --}}

    <div class="col-12 form-group" style="position: relative;">
        @if (count($minutas->documentos) > 0)
            <label class="mt-4">Documento(s) asociado(s):</label>
            <ul class="list-group">
                @foreach ($minutas->documentos as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->name }}
                        <span><a href="{{$path. "/" .$item->name}}" target="_blank"><i class="fas fa-download text-primary"></i></a><i
                                class="fas fa-trash-alt text-danger ml-3"
                                wire:click.prevent="destroy({{ $item->id }})"></i></span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class=" bg-warning col-12 mt-4">
                <p class="card-text" style="color:black; text-align:center">Sin documento(s) asociados
                </p>
            </div><br>
        @endif
        <div style="
        position: absolute;
        top: 25px;
        background-color: #0000007d;
        width: 100%;
        height: 100%;
        left: 0px;
        display: none;
        justify-content: center;
        align-items: center;
        color: #ebedef;
        border-radius: 5px;" wire:loading.flex wire:target="destroy">
        <i class="fas fa-spinner fa-spin mr-2"></i>Estamos eliminando
        </div>




    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('archivosGuardados', () => {
                document.getElementById('files').value = null;
                toastr.success('Archivos Guardados');
            })
        })
    </script>

</div>
