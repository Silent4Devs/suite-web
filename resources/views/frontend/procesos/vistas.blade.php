@extends('layouts.admin')
@section('content')

    <style>

        .info-personal .caja_img_perfil {
            border-radius: 100px;
            height: 60px;
            width: 60px;
            box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.4);
            margin: auto;
            margin-top: -50px;
            margin-bottom: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-personal img {
            height: 50px;
            clip-path: circle(50px at 50% 50%);
        }

        .info-personal .cards {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 8px;
        }

        .info-personal .cards {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 8px;
        }


        .vista-scroll::-webkit-scrollbar {
            width: 7px;
        }



        /* Track */
        .vista-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0);
        }



        /* Handle */
        .vista-scroll::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
        }



        /* Handle on hover */
        .vista-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .vista-scroll {
            overflow-y: auto;
        }

    </style>


    <style>
        body {
            background-color: #f7f7f7;

        }

        .main-timeline {
            position: relative
        }

        .main-timeline:before {
            content: "";
            display: block;
            width: 2px;
            height: 100%;
            background: #c6c6c6;
            margin: 0 auto;
            position: absolute;
            top: 0;
            left: 0;
            right: 0
        }

        .main-timeline .timeline {
            margin-bottom: 40px;
            position: relative
        }

        .main-timeline .timeline:after {
            content: "";
            display: block;
            clear: both
        }

        .main-timeline .icon {
            width: 18px;
            height: 18px;
            line-height: 18px;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0
        }

        .main-timeline .icon:before,
        .main-timeline .icon:after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.33s ease-out 0s
        }

        .main-timeline .icon:before {
            background: #fff;
            border: 2px solid #232323;
            left: -3px
        }

        .main-timeline .icon:after {
            border: 2px solid #c6c6c6;
            left: 3px
        }

        .main-timeline .timeline:hover .icon:before {
            left: 3px
        }

        .main-timeline .timeline:hover .icon:after {
            left: -3px
        }

        .main-timeline .date-content {
            width: 50%;
            float: left;
            margin-top: 22px;
            position: relative
        }

        .main-timeline .date-content:before {
            content: "";
            width: 36.5%;
            height: 2px;
            background: #c6c6c6;
            margin: auto 0;
            position: absolute;
            top: 0;
            right: 10px;
            bottom: 0
        }

        .main-timeline .date-outer {
            width: 125px;
            height: 125px;
            font-size: 16px;
            text-align: center;
            margin: auto;
            z-index: 1
        }

        /* .main-timeline .date-outer:before, */
        .main-timeline .date-outer:after {
            content: "";
            width: 125px;
            height: 125px;
            margin: 0 auto;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            transition: all 0.33s ease-out 0s
        }

        .main-timeline .date-outer:before {
            background: #fff;
            border: 2px solid #232323;
            left: -6px
        }

        .main-timeline .date-outer:after {
            border: 2px solid #c6c6c6;
            left: 6px
        }

        .main-timeline .timeline:hover .date-outer:before {
            left: 6px
        }

        .main-timeline .timeline:hover .date-outer:after {
            left: -6px
        }

        .main-timeline .date {
            width: 100%;
            margin: auto;
            position: absolute;
            top: 27%;
            left: 0
        }

        .main-timeline .month {
            font-size: 18px;
            font-weight: 700
        }

        .main-timeline .year {
            display: block;
            font-size: 30px;
            font-weight: 700;
            color: #232323;
            line-height: 36px
        }

        .main-timeline .timeline-content {
            width: 50%;
            padding: 20px 0 20px 50px;
            float: right
        }

        .main-timeline .title {
            font-size: 19px;
            font-weight: 700;
            line-height: 24px;
            margin: 0 0 15px 0
        }

        .main-timeline .description {
            margin-bottom: 0
        }

        .main-timeline .timeline:nth-child(2n) .date-content {
            float: right
        }

        .main-timeline .timeline:nth-child(2n) .date-content:before {
            left: 10px
        }

        .main-timeline .timeline:nth-child(2n) .timeline-content {
            padding: 20px 50px 20px 0;
            text-align: right
        }

        @media only screen and (max-width: 991px) {
            .main-timeline .date-content {
                margin-top: 35px
            }

            .main-timeline .date-content:before {
                width: 22.5%
            }

            .main-timeline .timeline-content {
                padding: 10px 0 10px 30px
            }

            .main-timeline .title {
                font-size: 17px
            }

            .main-timeline .timeline:nth-child(2n) .timeline-content {
                padding: 10px 30px 10px 0
            }
        }

        @media only screen and (max-width: 767px) {
            .main-timeline:before {
                margin: 0;
                left: 7px
            }

            .main-timeline .timeline {
                margin-bottom: 20px
            }

            .main-timeline .timeline:last-child {
                margin-bottom: 0
            }

            .main-timeline .icon {
                margin: auto 0
            }

            .main-timeline .date-content {
                width: 95%;
                float: right;
                margin-top: 0
            }

            .main-timeline .date-content:before {
                display: none
            }

            .main-timeline .date-outer {
                width: 110px;
                height: 110px
            }

            .main-timeline .date-outer:before,
            .main-timeline .date-outer:after {
                width: 110px;
                height: 110px
            }

            .main-timeline .date {
                top: 30%
            }

            .main-timeline .year {
                font-size: 24px
            }

            .main-timeline .timeline-content,
            .main-timeline .timeline:nth-child(2n) .timeline-content {
                width: 95%;
                text-align: center;
                padding: 10px 0
            }

            .main-timeline .title {
                margin-bottom: 10px
            }

            .date img.imagen-history {
                margin-top: -20px;
                width: 29%;
                z-index: -3;
                clip-path: circle(50% at 50% 50%);
                margin-left: -7px;
            }
        }






    .fila_activa{
        background-color:rgba(0, 255, 246, 0.15) !important;

    }

    </style>




    <div class="mt-4 card">

        <div class="">
            <div class="py-3 col-12 card-body verde_silent align-self-center" style="margin-top:-30px;">
                <h3 class="mb-1 text-center text-white">{{ $documento->codigo }} {{ $documento->nombre }}</h3>
            </div>


            <div class=" card-body">



                <div class="caja_botones_menu">
                    <a href="#" data-tabs="vista_previa" class="btn_activo"> Vista Previa</a>
                    <a href="#" data-tabs="resumen">Resumen</a>
                    <a href="#" data-tabs="riesgos">Riesgos</a>
                    <a href="#" data-tabs="indicadores">Indicadores</a>
                    <a href="#" data-tabs="versiones">Versiones</a>
                    <a href="#" data-tabs="documentos_relacionados">Documentos Relacionados</a>
                </div>

                <div class="mt-4 caja_caja_secciones">
                    <div class="caja_secciones">
                        <section class="caja_tab_reveldada" id="vista_previa" style="color:black;">


                                @include('admin.procesos.vistas.vista_previa')


                        </section>
                        <section class="" id="resumen">

                                @include('admin.procesos.vistas.resumen')

                        </section>
                        <section class="" id="riesgos">
                                @include('admin.procesos.vistas.riesgos')
                        </section>
                        <section class="" id="indicadores">
                                @include('admin.procesos.vistas.indicadores')
                        </section>
                        <section class="" id="versiones">
                                @include('admin.procesos.vistas.versiones')
                        </section>
                        <section class="" id="documentos_relacionados">
                                @include('admin.procesos.vistas.documentos_relacionados')
                        </section>
                    </div>
                </div>



                {{-- <div class="mb-3 ml-5 row caja_btn_a ">
                    <a href="#vista-previa" class="btn_a_seleccionado" style="text-decoration:none;">
                        Vista Previa</a>

                    <a href="#resumen" style="text-decoration:none;">
                        Resumen
                    </a>

                    <a href="#riesgos" style="text-decoration:none;">
                        Riesgos</a>


                    <a href="#indicadores" style="text-decoration:none;">
                        Indicadores</a>

                    <a href="#documentos_relacionados" style="text-decoration:none;">
                        Documentos Relacionados
                    </a>

                    <a href="#versiones" style="text-decoration:none;">
                        Versiones
                    </a>

                </div> --}}

                {{-- <section id="vista-previa" class="d-block">

                    <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                        @include('admin.procesos.vistas.vista_previa')
                    </div>

                </section>

                <section id="resumen">

                    @include('admin.procesos.vistas.resumen')

                </section>

                <section id="indicadores">

                    <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                        @include('admin.procesos.vistas.indicadores')
                    </div>
                </section>

                <section id="versiones">

                    <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                        @include('admin.procesos.vistas.versiones')
                    </div>
                </section>

                <section id="documentos_relacionados">

                    <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                        @include('admin.procesos.vistas.documentos_relacionados')
                    </div>
                </section> --}}



            </div>

        </div>
    </div>


@endsection

@section('scripts')


    <script type="text/javascript">
        
        $(".tbody_click tr td").click(function(){
            $(".tbody_click tr").removeClass("fila_activa");
            $(".tbody_click tr:hover").addClass("fila_activa");
        });
    </script>

    <script>
        $('#myTab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
            $('#myTab li').removeClass('active');
            $(this.parentElement).addClass('active');
            console.log(this.parentElement);
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        console.log(hash);
        $('#myTab li').removeClass('active');
        let tab = document.querySelector(`li a[href="${hash}"]`);
        console.log(tab.parentElement);
        $(tab.parentElement).addClass('active');
        $('#myTab a[href="' + hash + '"]').tab('show');
    </script>




@endsection
