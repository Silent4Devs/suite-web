@extends('layouts.admin')
@section('content')

@section('styles')
    <style type="text/css">

        .logo_organizacion_politica {
            width: 60%;
            float: right;
            margin-right: 20%;
        }

        .caja_titulo h1 {
            position: absolute;
            width: 300px;
            font-weight: bold;
            color: #00abb2;
            bottom: 0;
        }

        .a_reporte{
            display: inline-block !important;
            background-color: #001B44;
            color: #fff;
            margin-top: 70px;
            text-align: center;
            transition: 0.1s;
            position: relative;
        }
        .a_reporte:hover{
            color: #fff;
            text-decoration: none;
            opacity: 0.9;
        }
        .a_reporte:before{
            content: "";
            position: absolute;
            right: 0;
            width: 1px;
            height: 70%;
            top: 15%;
            background-color: #fff;
            opacity: 0.8;
        }
        .a_reporte i{
            width: 100px;
            height: 100px;
            margin: auto;
            margin-top: -50px;
            background-color: #00abb2;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 100px;
            font-size: 30pt;
            transition: 0.1s;
        }
        .a_reporte:hover i{
            font-size: 40pt;
        }
        .a_reporte h4{
            margin-top: 15px;
            font-weight: bold;
        }
        .a_reporte p{
            text-align: justify;
            font-size: 9pt;
        }

    </style>
@endsection
{{ Breadcrumbs::render('admin.portal-comunicacion.reportes') }}

<div class="card">

    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2 text-center text-white"><strong>Archivo de Capacitaciones</strong></h3>
    </div>
    <div class=" card-body">
        <div class="row">

            <div class="col-md-9">
                <div class="px-1 py-2 rounded" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6; margin: auto;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Esta sección es un canal de comunicación para que los colaboradores de la Organización puedan
                            reportarnos un incidente de Seguridad, un riesgo identificado o compartirnos sus sugerencias, quejas o denuncias,
                            cuando se tengan ideas de mejora, se identifiquen casos que estén fuera de lo indicado en el manual de conducta y
                            código de ética, o bien, fuera de los valores de la Organización.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-3 caja_titulo">
                @php
                    use App\Models\Organizacion;
                    $organizacion = Organizacion::first();
                    $logotipo = $organizacion->logotipo;
                @endphp
                <img src="{{ asset($logotipo) }}" class="logo_organizacion_politica">

            </div>
            <div style="margin: auto; text-align: center;" class="col-12 row mt-4 justify-content-center">


                <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                    <i class="fas fa-lightbulb"></i>
                    <h4>Sugerencia</h4>
                    <p>
                        Si quieres aportar alguna idea o
                        propuesta para la Empresa o área en
                        particular, ¡Te escuchamos!
                    </p>
                    <p>
                        Una sugerencia es un planteamiento,
                        idea o recomendación que se presenta
                        con el objetivo de proponer una o
                        más acciones para la Empresa.

                    </p>
                    <p>
                        Las sugerencias serán recibidas por el
                        área de Gestión de Talento quienes
                        llevarán un control y seguimiento de
                        las propuestas recibidas y las
                        canalizarán a las áreas
                        correspondientes.
                    </p>
                </a>
                <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                    <i class="fas fa-rocket"></i> 
                    <h4>Mejora</h4>
                    <p>
                        Puedes proponer mejoras en los
                        procesos y servicios actuales, por lo
                        cual se establecen las siguientes
                        categorías para los tipos demejora:
                    </p>
                    <p>
                        Mejoras Estratégicas: Son aquellas
                        mejoras que impactan directamente a
                        las estrategias y objetivos del negocio.
                        Mejoras de Procesos: Son aquellas
                        mejoras que su impacto se ve
                        reflejado en los procesos de la
                        organización.
                        Mejoras Operativas: Son aquellas
                        mejoras que su impacto se ve
                        reflejado en la operación del día a día.
                    </p>
                </a>
                <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                    <i class="fas fa-frown"></i>
                    <h4>Queja</h4>
                    <p>
                        Cuando exista cualquier tipo de
                        reclamación generada por
                        descontentos o disgustos por alguna
                        situación vivida dentro de la empresa
                        y que se considere injusta.
                        Normalmente se incumple con algún
                        punto del Código de Conducta y Ética
                        de la empresa y/o al manual de
                        Políticas .
                    </p>
                    <p>
                        Cuando te hayas visto involucrado en
                        malos tratos o tu espació de trabajo
                        es inseguro en algún aspecto, existe
                        coercion mental o física y abusos
                        verbales por parte de los líderes hacia
                        sus subordinados.

                    </p>
                </a>
                <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                    <i class="fas fa-hand-paper"></i>
                    <h4>Denuncia</h4>
                    <p>
                        Cuando desees hacer una acusación
                        grave en contra de un colaborador de
                        la Empresa. Darán seguimiento
                        específico los miembros del comité de
                        ética y se tomarán las acciones
                        pertinentes según sea el caso
                        pudiendo llegar hasta la rescición del
                        contrato y cuando se considere
                        necesario elevarse a las autoridades
                        competentes de la Ciudad de México.
                    </p>
                    <p>
                        Podrás externar temas sensibles los
                        cuales serán tratados con extricta
                        confiddencialidad. Son casos graves
                        que no se podrán dejar pasar por
                        ninguna circunstancia.

                    </p>
                </a>
                <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Incidente de Seguridad</h4>
                    <p>
                        Aquí podrás reportar un incidente de
                        seguridad de la información el cual
                        podría ser un intento de acceso, uso,
                        divulgación, modificación o
                        destrucción no autorizada de
                        información; un impedimento en la
                        operación normal de las redes,
                        sistemas o recursos informáticos; o
                        una violación a una Política de
                        Seguridad de la Información de la
                        Organización. La notificación de los
                        incidentes permite responder de
                        forma sistemática, minimizar su
                        ocurrencia e impacto y facilitar una
                        recuperación rápida y eficiente de
                        las actividades minimizando la pérdida
                        de información y la interrupción de los
                        Servicios.
                    </p>
                </a>
                <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}" class="a_reporte col-center col-lg-3 col-md-4 col-sm-12">
                   <i class="fas fa-shield-virus"></i>
                    <h4>Riesgo Identificado</h4>
                    <p>
                       En caso de identificar un evento que
                        pueda afectar los objetivos de la
                        organización o que ponga en peligro la
                        integridad física de los colaboradores
                        podrá reportarlo desde aquí
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
