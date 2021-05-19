 <div id="inicio" class="content" role="tabpanel" aria-labelledby="inicio-trigger">
     {{-- <h3>Generador de documentos</h3> --}}
     <div class="row align-items-top justify-content-center">
         <div class="col-md-8">
             @if (session()->has('error_organizacion'))
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
             Instrucciones ... Test...
             <br><br>
             @livewire('barra-progreso-component')
             <button class="mt-3 next btn btn-sm btn-outline-danger" wire:click="generarPDF('contexto','pdf')"
                 wire:loading.attr="disabled" wire:target="generarPDF">
                 <i class="fas fa-file-pdf"></i>
                 <span wire:loading.remove wire:target="generarPDF">
                     Generar PDF
                 </span>
                 <span wire:loading wire:target="generarPDF">
                     Generando
                     <div class="spinner-border text-danger" role="status" style="width: 15px; height: 15px;">
                         <span class="sr-only">Loading...</span>
                     </div>
                 </span>
             </button>
             <button class="mt-3 next btn btn-sm btn-outline-primary" wire:click="generarWord('contexto')"
                 wire:loading.attr="disabled" wire:target="generarWord">
                 <i class="fas fa-file-word"></i>
                 <span wire:loading.remove wire:target="generarWord">
                     Generar Word
                 </span>
                 <span wire:loading wire:target="generarWord">
                     Generando
                     <div class="spinner-border text-primary" role="status" style="width: 15px; height: 15px;">
                         <span class="sr-only">Loading...</span>
                     </div>
                 </span>
             </button>
         </div>
         <div class="col-md-4">
             <img src="{{ asset('img/analisis.png') }}" alt="generador-img" class="img-fluid">
         </div>
     </div>
 </div>
