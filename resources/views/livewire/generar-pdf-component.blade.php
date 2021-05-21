 {{-- <h3>Generador de documentos</h3> --}}
 {{-- @if (session()->has('error_organizacion'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Ha ocurrido un error!</strong> {{ session('error_organizacion') }}
             <a href="{{ route('admin.organizacions.index') }}">Registrar</a>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif
     @if (session()->has('error_control_documento'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Ha ocurrido un error!</strong> {{ session('error_control_documento') }}
             <a href="{{ route('admin.control-documentos.index') }}">Registrar</a>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif

     @if (session()->has('error_general'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Ha ocurrido un error!</strong> {{ session('error_general') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif

     @if (session()->has('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             <i class="mr-1 fas fa-check-circle"></i><strong>Bien hecho!</strong> {{ session('success') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif
     <div class="p-3 mb-3" style="border-radius:5px; border:solid 2px red;" wire:loading wire:target="generarPDF">
         <strong>Generando PDF <i class="ml-1 fas fa-file-pdf text-danger"></i></strong>
         <br>
         <div class="mr-2 spinner-border" role="status" style="width: 20px; height: 20px;">
             <span class="sr-only">Loading...</span>
         </div>
         Estamos generando el documento en formato PDF, espere un momento por favor...
     </div>
     <div class="p-3 mb-3" style="border-radius:5px; border:solid 2px rgb(35, 56, 248);" wire:loading
         wire:target="generarWord">
         <strong>Generando Word <i class="ml-1 fas fa-file-word text-primary"></i></strong>
         <br>
         <div class="mr-2 spinner-border" role="status" style="width: 20px; height: 20px;">
             <span class="sr-only">Loading...</span>
         </div>
         Estamos generando el documento en formato docx, espere un momento por favor...
     </div> --}}
 <div class="btn-group">
     <button class="ml-2 rounded btn btn-sm btn-success" wire:click="generarDocumento('{{ $nombre_documento }}')"
         wire:loading.attr="disabled" wire:target="generarDocumento">
         <span wire:loading.remove wire:target="generarDocumento">
             <i class="fas fa-file"></i>
         </span>
         <span wire:loading wire:target="generarDocumento">
             {{-- Generando --}}
             <div class="text-white spinner-border" role="status" style="width: 15px; height: 15px;">
                 <span class="sr-only">Loading...</span>
             </div>
         </span>
     </button>
     {{-- <button class="ml-2 rounded btn btn-sm btn-outline-primary" wire:click="generarWord('contexto')"
         wire:loading.attr="disabled" wire:target="generarWord">
         <span wire:loading.remove wire:target="generarWord">
             <i class="fas fa-file-word"></i>
         </span>
         <span wire:loading wire:target="generarWord">
             <div class="spinner-border text-primary" role="status" style="width: 15px; height: 15px;">
                 <span class="sr-only">Loading...</span>
             </div>
         </span>
     </button> --}}
 </div>
