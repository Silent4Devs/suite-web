@extends('layouts.frontend')
@section('content')



    {{ Breadcrumbs::render('frontend.declaracion-aplicabilidad-2022.index') }}

    <div class="mt-5 card" id="d-aplicabilidad">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Declaración de Aplicabilidad</strong></h3>
        </div>

        <div class="caja_botones_menu">
            <a class="btn_activo" href="#" data-tabs="declaracion" >
                Declaración Aplicabilidad
            </a>

            <a href="#" data-tabs="dashboard">
                Dashboard
            </a>
        </div>

        <div class="caja_caja_secciones">

            <div class="caja_secciones">

                <section style="margin-top:30px;" id="declaracion" class="caja_tab_reveldada">

                    @include('frontend.declaracionaplicabilidad-2022.declaracion')

                </section>

                <section style="margin-top:30px;" id="dashboard">

                    @include('frontend.declaracionaplicabilidad-2022.declaracion-dashboard')

                </section>
            </div>
        </div>


    </div>


@endsection

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> --}}

@section('scripts')

    <script>

            document.addEventListener('DOMContentLoaded', function(e) {

                let btnReporte = document.querySelector('.generar-reporte');
                btnReporte.addEventListener('click', function(e) {
                    e.preventDefault();
                    let url = $(btnReporte).attr('url');
                    Swal.fire({
                        title: '¿Desea generar el Reporte?',
                        text: "Nota: La generación del reporte puede demorar algunos minutos",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, Generar Reporte!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                '¡Generando Reporte!',
                                'Abrimos otra pestaña para generar el reporte',
                                'success'
                            )
                            window.open(url, '_blank');
                        }
                    })
                });
            });
    </script>

    <script>
        @section('x-editable')
            $(document).ready(function () {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            //categories table
            $(".justificacion").editable({
            dataType: 'json',
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });
            $(".aplica").editable({
            dataType: 'json',
            source: [{
            value: '1',
            text: 'Si'
            },
            {
            value: '2',
            text: 'No'
            },

            ],
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });
            $(".aplica2").editable({
            dataType: 'json',
            source: [{
            value: '1',
            text: 'Si'
            },
            {
            value: '2',
            text: 'No'
            },

            ],
            success: function (response, newValue) {
            console.log('Actualizado, response')
            }
            });


            });

        @endsection
    </script>



@endsection
