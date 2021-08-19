@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Vista del documento:
                    {{ $documento->nombre }}</strong></h3>
            @can('documentos_download')
                <embed src="{{ asset($path_documento . '/' . $documento->archivo) }}" class="mt-5 w-100" style="height: 800px"
                    frameborder="0" id="pdf">
            @else
                <embed id="documento" src="{{ asset($path_documento . '/' . $documento->archivo) }}#toolbar=0&navpanes=0"
                    class="mt-5 w-100" style="height: 800px" frameborder="0" id="pdf">
            @endcan
        </div>

    </div>

@endsection
@section('scripts')
    <script>
        var msg = "¡El botón derecho está desactivado para este sitio !";

        function disableIE() {
            if (document.all) {
                alert(msg);
                return false;
            }
        }

        function disableNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    alert(msg);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = disableNS;
        } else {
            document.onmouseup = disableNS;
            document.oncontextmenu = disableIE;
        }
        document.oncontextmenu = ev => {
            ev.preventDefault();
            console.log("Prevented to open menu!");
        }
    </script>
@endsection
