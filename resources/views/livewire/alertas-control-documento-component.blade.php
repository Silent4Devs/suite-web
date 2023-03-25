<div>
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

    @if (session()->has('error_general'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ha ocurrido un error!</strong> {{ session('error_general') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="alert alert-danger alert-dismissible fade show {{ $show_error_alert ? 'd-block' : 'd-none' }}"
        role="alert">
        <i class="mr-1 fas fa-times-circle"></i><strong>Ha ocurrido un error!</strong> {{ $message_error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="alert alert-success alert-dismissible fade show {{ $show_success_alert ? 'd-block' : 'd-none' }}"
        role="alert">
        <i class="mr-1 fas fa-check-circle"></i><strong>Bien hecho!</strong> {{ $message_success }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>



    {{-- <div class="p-3 mb-3 {{ $show_generate_pdf ? 'd-block' : 'd-none' }}"
        style="border-radius:5px; border:solid 2px red;">
        <strong>Generando PDF <i class="ml-1 fas fa-file-pdf text-danger"></i></strong>
        <br>
        <div class="mr-2 spinner-border" role="status" style="width: 20px; height: 20px;">
            <span class="sr-only">Loading...</span>
        </div>
        Estamos generando el documento en formato PDF, espere un momento por favor...
    </div>
    <div class="p-3 mb-3 {{ $show_generate_word ? 'd-block' : 'd-none' }}"
        style="border-radius:5px; border:solid 2px rgb(35, 56, 248);">
        <strong>Generando Word <i class="ml-1 fas fa-file-word text-primary"></i></strong>
        <br>
        <div class="mr-2 spinner-border" role="status" style="width: 20px; height: 20px;">
            <span class="sr-only">Loading...</span>
        </div>
        Estamos generando el documento en formato docx, espere un momento por favor...
    </div> --}}
</div>
