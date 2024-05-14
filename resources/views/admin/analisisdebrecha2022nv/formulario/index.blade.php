@extends('layouts.admin')
@section('styles')
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            header, .c-header, .c-head, .c-header-fixed, #sidebar, .barra-herramientas-bottom-molbile, footer{
                display: none !important;
                opacity: 0 !important;

            }

            .c-main {
                margin-top: 0px !important;
                padding-top: 0px !important;
            }

            body.c-sidebar-lg-show .c-wrapper {
                margin-left: 0px !important;
            }

            .modal {
                position: relative !important;
                background-color: #FFFFFF !important;
            }
            .modal-dialog, .modal-content, .modal-body, .card {
                width: 100% !important;
                background-color: #FFFFFF !important;
                box-shadow: none !important;

            }

            .modal-dialog{
                margin-left: 0px !important;
            }
            .modal-backdrop {
                background-color: transparent !important;
            }

            .impre-header {
                background: #EBEBEB !important;
            }

            .impre-header th {
                background: #EBEBEB !important;

            }

            .impre-footer {
                background: #EEFDFF !important;
            }

            .impre-footer td {
                background: #EEFDFF !important;
            }

        }
    </style>
@endsection
@section('content')
    @include('admin.analisisdebrecha2022nv.estilos')
    <!-- Include Chart.js library -->


    @include('partials.flashMessages')

    <h5 class="titulo print-none">Formulario</h5>

    <div class="card shadow-sm instrucciones print-none" style="background: #18919F; border-radius: 16px; color:#FFFFFF;">
        <div class="card-body">
            <div class="row" style="padding-bottom: 10px;">
                <div class="col-2" style="padding-left: 25px;">
                    <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}" alt="imagen_instrucciones" style="width: 150px;
                    height: 150px; margin-left: 5px; mar">
                </div>
                <div class="col-10" style="padding-left:0px; padding-right:25px;">
                    <h5 style="font: normal normal 600 19px/26px Segoe UI;
                    letter-spacing: 0px;
                    color: #FFFFFF;
                    opacity: 1;">¿Que es? Dashboard Análisis de brechas</h5>
                    <p style="font: normal normal normal Roboto;
                    letter-spacing: 0px;
                    color: #FFFFFF;
                    opacity: 1;">
                        Es una herramienta que ayuda a las organizaciones a visualizar las brechas entre el estado actual y el
                        estado deseado. Este dashboard suele incluir indicadores clave de rendimiento KPI que miden el desempeño de la organización en las areas que se estan analizando.<br>
                        Al proporcionar una visión general de las brechas, el dashboard
                        puede ayudar a las organizaciones a priorizar las areas de mejora y a tomar medidas para cerrar las brechas.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <livewire:evaluacion-analisis-brechas-livewire :id="$id" />
    {{-- @livewire('evaluacion-analisis-brechas', ['id' => $id]) --}}
@endsection

{{-- <script>
    document.addEventListener('livewire:load', function() {

        Livewire.on('renderAreas', (grafica_cuentas, grafica_colores) => {
            // console.log(cuentas);
            // console.log(colores);

            document.getElementById('graf-parametros').remove();

            var canvas = document.createElement("canvas");
            canvas.id = "graf-parametros";
            document.getElementById("contenedor-principal").appendChild(canvas);

            let grafica_proyectos = new Chart(document.getElementById('graf-parametros'), {
                type: 'bar',
                data: {
                    datasets: [{
                        label: "Preguntas que cumplen esta valoración:",
                        data: grafica_cuentas,
                        backgroundColor: grafica_colores,
                        lineTension: 0,
                        fill: true,
                        options: {
                            indexAxis: 'y',
                        }
                    }, ]
                },
            });

        });
    });
</script> --}}
