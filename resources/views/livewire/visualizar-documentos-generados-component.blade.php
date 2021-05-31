    <div class="ml-2 btn-group dropright">
        <button type="button" class="rounded btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" wire:click="obtenerDocumentosGenerados('Estudio de Contexto')">
            <i class="far fa-eye"></i>
        </button>
        <div class="dropdown-menu" style="max-height: 100px; overflow: auto">
            @foreach ($lista_archivos_declaracion_pdf as $archivo)
                <a class="dropdown-item" target="_blank" href=" {{ asset($ISO27001_SoA_PATH . basename($archivo)) }}">
                    <i class="far fa-file-pdf text-danger"></i>
                    {{ basename($archivo) }}
                </a>
            @endforeach
            @foreach ($lista_archivos_declaracion_docx as $archivo)
                <a class="dropdown-item" target="_blank" href=" {{ asset($ISO27001_SoA_PATH . basename($archivo)) }}">
                    <i class="far fa-file-word text-primary"></i>
                    {{ basename($archivo) }}
                </a>
            @endforeach
        </div>
    </div>
