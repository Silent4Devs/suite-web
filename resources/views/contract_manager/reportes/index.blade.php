@extends('layouts.admin')
@section('content')
@section('titulo', 'Reportes')

<link rel="stylesheet" type="text/css" href="{{ asset('css/reports.css/reports.css') }}{{ config('app.cssVersion') }}" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">

<style type="text/css">
    .caja_general_p {
        display: flex;
        align-items: center;
    }

    .a_btn {
        width: 100px;
        height: 100px;
        /* background-color: #0ebfbf; */
        display: inline-block;
        position: relative;
        margin-left: 3%;
        text-align: center;
        border-radius: 5px;
        transition: 0.1s;
        /*box-shadow: 0px 3px 5px -2px #888;*/
    }

    .a_btn:hover {
        /*box-shadow: 0px 3px 6px 0px #888;*/
    }

    .icono_btn {
        position: absolute;
        top: 22px;
        font-size: 34pt;
        color: #fff !important;
    }

    .text_btn {
        position: absolute;
        top: 70px;
        font-size: 10pt;
        color: #fff !important;
    }

    section {
        display: none;
        width: 90%;
        max-width: 850px;
        min-height: 500px;
        margin: auto;
        overflow-x: auto;
        padding: 20px;
    }

    section:target {
        display: block;
    }

    section .card {
        width: 792px;
        margin: auto;
    }

    .seleccionar {
        margin-bottom: 20px;
    }

    @media(max-width: 1188px) {
        .caja_general_p {
            display: block;
        }

        .a_btn {
            margin-top: 10px;
        }
    }

    .logo_organizacion {
        width: 120px;
        height: 120px;
        margin: auto;

        @isset($logotipo->logotipo)
            background-image: url('{{ url('images/' . $logotipo->logotipo) }}');
        @endisset
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    .btn.tb-btn-primary {
        margin-top: 30px;
    }


    button i {
        margin-right: 10px;
    }

    h5 {
        margin-bottom: 20px;
        color: #777;
        border-bottom: 2px solid #bbb;
        text-align: right;
        padding-bottom: 9px;
    }


    .align {
        text-align: left !important;
        font-size: 18px;
        color: var(--color-tbj);
        opacity: 100% !important;
    }

    .titulo-form,
    .sub-titulo-form {
        font-size: 18px;
        color: var(--color-tbj);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
<div class="page-reportes">
    <div class="card card-content">
        <div class="row">
            <div class="col s12" style="margin-bottom: 30px;">
                <h4 class="titulo-form">GENERAR REPORTE</h4>
                <p class="instrucciones">Por favor seleccione el tipo de reporte</p>
            </div>
        </div>
        <center>
            <div class="row">
                <div class="col s12 m8">
                    <a href="#organizacion" class="a_btn">
                        <img src="{{ asset('img/reportes/org.svg') }}"
                            style="left: 40px; width: 100%; padding-bottom: 6px;">
                        <span style="color:var(--color-tbj)"><strong>Organización</strong></span>
                    </a>

                    <a href="#proveedores" class="a_btn">
                        <img src="{{ asset('img/reportes/prov.svg') }}"
                            style="left: 40px; width: 100%; padding-bottom: 6px;">
                        <span style="color:var(--color-tbj)"><strong>Proveedores</strong></span>
                    </a>

                    <a href="#contratos" class="a_btn">
                        <img src="{{ asset('img/reportes/contr.svg') }}"
                            style="left: 40px; width: 100%; padding-bottom: 6px;">
                        <span style="color:var(--color-tbj)"><strong>Contratos</strong></span>
                    </a>
                </div>
            </div>
        </center>

        <div class="row">
            <div class="col s12 m12">

                <section id="organizacion">
                    @include('contract_manager.reportes.organizacion')
                </section>


                <section id="proveedores">
                    @include('contract_manager.reportes.proveedor')
                </section>


                <section id="contratos">
                    @include('contract_manager.reportes.contrato')
                </section>

                <p style="opacity: 0.9; margin-top: 30px;">
                    <span style="font-weight: bold;"><span style="color: #2395AA;">Nota:</span></span> Para la
                    visualización de elementos gráficos dentro del reporte es necesario activar la opción
                    <strong>"imprimir gráficos"</strong> que se encuentra dentro de más opciones - imprimir gráficos
                </p>
            </div>
        </div>
    </div>

</div>

<script>
    function buscarproveedor(valorPuesto) {
        $.ajax({
            data: {
                valor: valorPuesto
            },
            url: '{{ route('provedor_reporte') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function() {
                $("#caja_reporte_proveedor_ajax").html(
                    "<div class='progress md-progress primary-color-dark'>\n " +
                    "<div class='indeterminate'></div>\n</div>");
            },
            success: function(data) {
                console.log(data);
                $("#caja_reporte_proveedor_ajax").html(data);

            },
            error: function(data) {
                console.log(data);
                $("#caja_reporte_proveedor_ajax").html(
                    "<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    " ¡Intente de nuevo!\n" + "</div>");
            }
        });
    }
</script>

<script>
    function buscarcontrato(valorPuesto) {
        $.ajax({
            data: {
                valor: valorPuesto
            },
            url: '{{ route('contrato_reporte') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function() {
                $("#caja_reporte_contrato_ajax").html(
                    "<div class='progress md-progress primary-color-dark'>\n " +
                    "<div class='indeterminate'></div>\n</div>");
            },
            success: function(data) {
                console.log(data);
                $("#caja_reporte_contrato_ajax").html(data);

            },
            error: function(data) {
                console.log(data);
                $("#caja_reporte_contrato_ajax").html(
                    "<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    " ¡Intente de nuevo!\n" + "</div>");
            }
        });
    }
</script>

{{-- <script type="text/javascript">
	function imprimir(el){
		var rp = document.body.innerHTML;
		var pt = document.getElementById(el).innerHTML;
		document.body.innerHTML = pt;
		window.print();
		document.body.innerHTML = rp;
	}
</script> --}}




@endsection
