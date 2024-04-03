@extends('layouts.admin')
@section('content')
    <div class="card card-body">
        <nav class="mt-4 d-flex justify-content-center">
            <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                <a class="nav-link active" id="nav-registros-tab" data-type="registros" data-toggle="tab" href="#nav-registros"
                    role="tab" aria-controls="nav-registros" aria-selected="true">
                    Objetivos
                </a>
                <a class="nav-link" id="nav-empleados-tab" data-type="empleados" data-toggle="tab" href="#nav-empleados"
                    role="tab" aria-controls="nav-empleados" aria-selected="false">
                    Competencias
                </a>
            </div>
        </nav>

        <div class="tab-content mt-2" id="nav-tabContent">
            <div class="tab-pane mb-4 fade show active" id="nav-registros" role="tabpanel"
                aria-labelledby="nav-registros-tab">
                @livewire('cuestionario-evaluacion-desempeno-objetivos', ['id_evaluacion' => $evaluacion, 'id_evaluado' => $evaluado])
            </div>
            <div class="tab-pane mb-4 fade" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
                {{-- @livewire('cuestionario-evaluacion-desempeno-competencias', ['id_evaluacion' => $evaluacion, 'id_evaluado' => $evaluado]) --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    {{-- <script>
        // document.addEventListener('livewire:load', function() {
        //     Dropzone.options.myDropzone = {
        //         paramName: "file",
        //         maxFilesize: 2, // MB
        //         dictDefaultMessage: "Drag & drop files here or click to upload",
        //         acceptedFiles: ".jpg, .jpeg, .png, .gif",
        //         addRemoveLinks: true,
        //         init: function() {
        //             this.on("success", function(file, response) {
        //                 Livewire.emit('fileUploaded', response);
        //             });
        //             this.on("error", function(file, response) {
        //                 console.error("Error uploading file:", response);
        //             });
        //         }
        //     };
        // });
    </script> --}}
    {{-- <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('fileUploaded', function(filePath) {
                // Update Livewire component state with uploaded file path
                @this.set('filePath', filePath);
            });
        });
    </script> --}}
    <script>
        document.addEventListener('livewire:load', function() {
            // Get file input element
            const fileInput = document.getElementById('fileInput');

            // Listen for changes in the file input
            fileInput.addEventListener('change', function(event) {
                // Get the selected file
                const file = event.target.files[0];

                // Trigger Livewire method with the file as parameter
                Livewire.emit('agregarEvidencia', file);
            });
        });
    </script>
@endsection
