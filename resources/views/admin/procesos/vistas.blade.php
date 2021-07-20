@extends('layouts.admin')
@section('content')

<style>

    section:not(section:target){
        display:none;
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

    .info-personal .caja_img_perfil{
            border-radius: 100px;
            height: 60px;
            width: 60px;
            box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.4);
            margin: auto;
            margin-top: -50px;
            margin-bottom: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-personal img{
            height: 50px;
            clip-path: circle(50px at 50% 50%);
        }

        .info-personal .cards{
            border:1px solid #ccc;
            border-radius:5px;
            padding: 10px;
            margin-top: 8px;
        }

        .info-personal .cards{
            border:1px solid #ccc;
            border-radius:5px;
            padding: 10px;
            margin-top: 8px;
        }


        .vista-scroll::-webkit-scrollbar{
        width: 7px;
        }



        /* Track */
        .vista-scroll::-webkit-scrollbar-track{
        background: rgba(0, 0, 0, 0);
        }



        /* Handle */
        .vista-scroll::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 50px;
        }



        /* Handle on hover */
        .vista-scroll::-webkit-scrollbar-thumb:hover{
        background: rgba(0, 0, 0, 0.5);
        }

        .vista-scroll{
        overflow-y:auto;
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

</style>




<div class="mt-4 card">

    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top:-40px;">
        <h3 class="mb-1 text-center text-white"></h3>
    </div>


    <div class="w-full px-8 py-4 mb-16 bg-white rounded-lg ">

        <h4 class="mb-1 text-center" style="color:#008186">{{$documento->codigo}} {{$documento->nombre}} </h4>

        <div class="mb-3 ml-5 row caja_btn_a ">
            <a href="#vista-previa" class="btn_a_seleccionado" style="text-decoration:none;"><div class="col-12 btn-jerarquia cambiocolor">
            Vista Previa
            </div></a>

            <a href="#resumen"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Resumen
            </div></a>

            <a href="#riesgos"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Riesgos
            </div></a>


            <a href="#indicadores"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Indicadores
            </div></a>

            <a href="#documentos"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Documentos Relacionados
            </div></a>

            <a href="#versiones"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Versiones
            </div></a>

        </div>

        <section id="vista-previa" class="d-block">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                @include('admin.procesos.vistas.vista_previa')
            </div>

        </section>

        <section id="resumen">

           @include('admin.procesos.vistas.resumen')

        </section>

        <section id="indicadores">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">

        </section>

        <section id="versiones">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">
                @include('admin.procesos.vistas.versiones')
            </div>
        </section>



    </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">

    $(".caja_btn_a a").click(function(){
        $(".caja_btn_a a").removeClass("btn_a_seleccionado");
        $(".caja_btn_a a:hover").addClass("btn_a_seleccionado");
        $("#vista-previa").removeClass("d-block");

    });
</script>

@endsection
