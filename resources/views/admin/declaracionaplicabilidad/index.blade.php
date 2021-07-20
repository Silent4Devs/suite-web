@extends('layouts.admin')
@section('content')

<style>
    section:not(section:target){
        display:none !important;
    }

    .caja_btn_a{
			width: 100%;
			height: auto;
			text-align: center;
		}
    .caja_btn_a a{
        padding: 15px;
        margin-top: 10px;
        color: #008186;
        display: inline-block;
    }
    .caja_btn_a a:hover, .btn_a_seleccionado{
        border-bottom: 2px solid #00abb2;
        margin-right:10px;
    }

</style>

    {{ Breadcrumbs::render('admin.declaracion-aplicabilidad.index') }}

    <div class="mt-5 card" id="d-aplicabilidad">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Declaración de Aplicabilidad</strong></h3>
        </div>

    <div class="caja_btn_a">
        <a href="#declaracion"  style="text-decoration:none;">
           Declaración Aplicabilidad
        </a>

        <a href="#dashboard"  style="text-decoration:none;">
           Dashboard
        </a>
    </div>

        <section  id="declaracion" class="d-block">

            @include('admin.declaracionaplicabilidad.declaracion')

        </section>

        <section  id="dashboard">

            @include('admin.declaracionaplicabilidad.declaracion-dashboard')

        </section>

    </div>


@endsection

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> --}}

@section('scripts')

<script>

    $(".caja_btn_a a").click(function(){
        $(".caja_btn_a a").removeClass("btn_a_seleccionado");
        $(".caja_btn_a a:hover").addClass("btn_a_seleccionado");
        $("#declaracion").removeClass("d-block");

    });
</script>






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


