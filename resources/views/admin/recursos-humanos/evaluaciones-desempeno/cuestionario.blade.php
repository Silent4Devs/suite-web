@extends('layouts.admin')
@section('content')
    <style>
        /* Handle */
        .scroll_estilo::-webkit-scrollbar-thumb {
            background: #9BA7E2;
            border-radius: 50px;
        }

        .scroll_estilo::-webkit-scrollbar-thumb:hover {
            background: #9BA7E2;
        }

        .card-complement {
            flex-direction: row;
            width: 100%;
            height: 90px;
            overflow: hidden;
            border-radius: 6px !important;
            position: relative;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            display: flex;
        }

        .bg-objet {
            width: 40px;
            height: 110px;
            transition: 0.2s;
            position: absolute;
            z-index: 0;
        }

        .card-complement:hover .bg-objet {
            filter: brightness(0.8);
            width: 100%;
        }

        .card-comple-info {
            padding-left: 50px !important;
            box-sizing: border-box;
            position: relative;
            z-index: 1;
            color: #818181;
            transition: 0.2s;
        }

        .card-complement:hover .card-comple-info {
            color: #fff;
        }

        .card-complement:hover .card-comple-info .card-status-title {
            color: #fff;
        }

        .card-complement:hover .card-comple-info .card-status-value {
            color: #fff;
        }

        .card-complement:hover .card-comple-info .sat {
            color: #fff;
        }

        .card-complement:hover .card-comple-info .sob {
            color: #fff;
        }

        .card-status-title {
            text-align: left;
            font: normal normal medium 22px Roboto;
            color: #3086AF;
            opacity: 1;
        }

        .card-status-value {
            text-align: left;
            font: normal normal medium 28px Roboto;
            letter-spacing: 0px;
            color: #3086AF;
            opacity: 1;
        }

        .sat {
            text-align: left;
            font: normal normal normal 10px Roboto;
            letter-spacing: 0px;
            color: #78BB50;
            opacity: 1;
        }

        .sob {
            text-align: left;
            font: normal normal normal 10px Roboto;
            letter-spacing: 0px;
            color: #0481FF;
            opacity: 1;
        }

        .tab-objetivos {
            width: 440px;
            height: 75px;
            background: #8C91D6 0% 0% no-repeat padding-box;
            border-radius: 22px 22px 0px 0px;
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .tab-competencia {
            width: 440px;
            height: 75px;
            background: #BB68A8 0% 0% no-repeat padding-box;
            border-radius: 22px 22px 0px 0px;
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .tab-option:hover .icon-tab {
            transform: translate(-4px, -6px);
            transition: transform 0.4s ease-in-out;
        }

        .th-table-objetive {
            text-align: center;
            font: normal normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            opacity: 1;
        }

        .th-objetive {
            background: #3F79B7 0% 0% no-repeat padding-box;
            color: #FFFFFF;
            min-width: 412px;
        }

        .th-metrica {
            background: #FFE8E8 0% 0% no-repeat padding-box;
            color: #2E2E2E;
            min-width: 155px;
        }

        .th-custom {
            min-width: 105px;
            text-align: center;
            font: normal normal normal 12px/18px Roboto;
            letter-spacing: 0px;
            color: #2E2E2E;
        }

        .th-auto-evaluation {
            background: #FFECAF 0% 0% no-repeat padding-box;
            color: #2E2E2E;
            min-width: 127px;
        }

        .th-evidencie {
            background: #CFD9FF 0% 0% no-repeat padding-box;
            color: #2E2E2E;
            min-width: 225px;
        }

        .th-evaluation {
            background: #B7EBFF 0% 0% no-repeat padding-box;
            color: #2E2E2E;
            min-width: 127px;
        }

        .th-options {
            background: #D5D5D5 0% 0% no-repeat padding-box;
            color: #2E2E2E;
            min-width: 60px;
        }

        .tr-sections {
            background: #E3E9FF 0% 0% no-repeat padding-box;
            opacity: 1;
            font: normal normal normal 11px/17px Roboto;
            letter-spacing: 0px;
            color: #575757;
            height: 68px;
        }

        .td-f1 {
            width: 5px;
            height: 107px;
            background: #EBEBEB 0% 0% no-repeat padding-box;
            opacity: 1;
        }

        .custom-progress {
            background-color: #FFCB80;
            border-radius: 29px;
        }

        .btn-evidencia {
            width: 131px;
            height: 34px;
            background: #EBEBEB 0% 0% no-repeat padding-box;
            border: 1px solid #CCCCCC;
            border-radius: 4px;
            opacity: 1;
            text-align: center;
            font: normal normal normal 12px/18px Roboto;
            letter-spacing: 0px;
            color: #818181;
        }

        .drag-area {
            border: 1px dashed #AAAAAA;
            height: 141px;
            width: 100%;
            border-radius: 5px;
            display: flex;
            align-items: end;
            justify-content: center;
            flex-direction: column-reverse;
            margin-bottom: 28px;
        }

        .autoevaluacion {
            background: #FFF9E6 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            border-radius: 0px 0px 12px 12px;
            opacity: 1;
            width: 425px;
            height: 67px;
        }

        .evaluacion {
            background: #E1F5FF 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            border-radius: 0px 0px 12px 12px;
            opacity: 1;
            width: 425px;
            height: 67px;
            margin-left: 13px;
        }

        .evaluacion-global {
            background: #78BB50 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            border-radius: 0px 0px 12px 12px;
            opacity: 1;
            width: 425px;
            height: 67px;
        }

        .text-evaluations {
            text-align: center;
            font: normal normal medium 22px/17px Roboto;
            letter-spacing: 0px;
            color: #575757;
            opacity: 1;
        }

        .th-icon {
            width: 80px;
            height: 69px;
            background: #E5C4DD 0% 0% no-repeat padding-box;
            opacity: 1;
        }

        .td-comp {
            width: 500px;
        }

        .td-comp-evaluacion {
            width: 100px;
        }

        .td-comp-cal {
            width: 400px;
        }

        .auto-cal {
            background: #E2FBFF 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            border-radius: 4px;
            opacity: 1;
            width: 151px;
            height: 31px;
        }

        .par {
            background: #FFFFFF;
        }

        .impar {
            background: #F0ECF0;
        }

        .input-cal {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            border-radius: 4px;
            opacity: 1;
        }

        .title-nombre {
            text-align: left;
            font: normal normal medium 18px/22px Roboto;
            letter-spacing: 0px;
            color: #464646;
            opacity: 1;
        }

        .title-puesto {
            text-align: left;
            font: normal normal normal 12px/17px Roboto;
            letter-spacing: 0px;
            color: #575757;
            opacity: 1;
        }

        .vertical-line {
            width: 0px;
            height: 78px;
            border: 1px solid var(--unnamed-color-b5b5b5);
            border: 1px solid #B5B5B5;
            opacity: 1;
            margin-top: 16px;
        }

        .title-status {
            text-align: center;
            font: normal normal normal 10px/20px Roboto;
            letter-spacing: 0px;
        }

        .status-procces {
            background: #D1EBFF;
            border-radius: 7px;
            opacity: 1;
            color: #0274AF;
            width: 55px;
            margin-top: 11px;
        }

        .status-pendding {
            background: #FFECAF;
            color: #FF9900;
            border-radius: 7px;
            opacity: 1;
            width: 55px;
            margin-top: 11px;
        }

        .status-confirm {
            background: #DEFFF2;
            color: #47AF02;
            border-radius: 7px;
            opacity: 1;
            width: 55px;
            margin-top: 11px;
        }

        .option-q-active {
            width: 104px;
            height: 40px;
            background: #3F79B7 0% 0% no-repeat padding-box;
            border: 1px solid #C5C5C5;
            border-radius: 8px 8px 0px 0px;
            opacity: 1;
            text-align: left;
            font: normal normal medium 15px/18px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .option-q-inactive {
            width: 104px;
            height: 40px;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #C5C5C5;
            border-radius: 8px 8px 0px 0px;
            opacity: 1;
            text-align: left;
            font: normal normal medium 15px/18px Roboto;
            letter-spacing: 0px;
            color: #3F79B7;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    @include('admin.recursos-humanos.evaluaciones-desempeno.components.status-cards')

    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @if ($evaluacionDesempeno->activar_objetivos && $acceso_objetivos)
                <li class="nav-item" role="presentation">
                    <div class="tab-objetivos tab-option" id="objetive-tab" data-toggle="tab" data-target="#objetive"
                        type="button" role="tab" aria-controls="objetive" aria-selected="true">
                        <div class="d-flex align-items-center" style="height: 200px; color: #f8f9fa;"><i
                                class="icon-tab fa-solid fa-bullseye" style="font-size: 28px; margin-right:5px;"></i>
                            <h5 class="m-0">EVALUA TUS OBJETIVOS</h5>
                        </div>
                    </div>
                </li>
            @endif
            @if ($evaluacionDesempeno->activar_competencias && $acceso_competencias)
                <li class="nav-item" role="presentation">
                    <div class="tab-competencia tab-option" id="competencies-tab" data-toggle="tab"
                        data-target="#competencies" type="button" role="tab" aria-controls="competencies"
                        aria-selected="{{ $acceso_objetivos ? 'false' : 'true' }}">
                        <div class="d-flex align-items-center" style="height: 200px; color: #f8f9fa;"><i
                                class="icon-tab material-symbols-outlined" style="font-size: 32px;">star </i>
                            <h5 class="m-0">EVALUA TUS COMPETENCIAS</h5>
                        </div>
                    </div>
                </li>
            @endif
        </ul>

        <div class="tab-content" id="myTabContent">
            @if ($evaluacionDesempeno->activar_objetivos && $acceso_objetivos)
                <div class="tab-pane fade{{ $acceso_objetivos ? ' show active' : '' }}" id="objetive" role="tabpanel"
                    aria-labelledby="objetive-tab">
                    <div class="card">
                        <div class="card-body">
                            @livewire('cuestionario-evaluacion-desempeno-objetivos', ['id_evaluacion' => $evaluacionDesempeno->id, 'id_evaluado' => $evaluado, 'id_periodo' => $periodo])
                        </div>
                    </div>
                </div>
            @endif
            @if ($evaluacionDesempeno->activar_competencias && $acceso_competencias)
                <div class="tab-pane fade{{ !$acceso_objetivos ? ' show active' : '' }}" id="competencies" role="tabpanel"
                    aria-labelledby="competencies-tab">
                    @livewire('cuestionario-evaluacion-desempeno-competencias', ['id_evaluacion' => $evaluacionDesempeno->id, 'id_evaluado' => $evaluado, 'id_periodo' => $periodo])
                </div>
            @endif
        </div>

    </div>{{-- <div class="card card-body">
        @livewire('cierre-cuestionario', ['id_evaluacion' => $evaluacion, 'id_evaluado' => $evaluado])
    </div>  --}}
    @endsection @section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>{{-- <script>
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
    </script> --}} {{-- <script>
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