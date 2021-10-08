
  @extends('layouts.admin')
  @section('content')

<link rel="stylesheet" type="text/css" href="{{asset('css/print_foda.css')}}">
<style>

.circulo {
	width: 60px;
	height: 60px;
	border-radius: 50%;
	display: flex !important;
    justify-content:center;
    align-items:center;
    position:absolute;
    top:10px;
    left:0px;


}

.circulo2 {
	width: 30px;
	height: 30px;
	border-radius: 50%;
	display: flex !important;
    justify-content:center;
    align-items:center;
    position:absolute;
    top:10px;
    left:0px;


}

.tit{
    display: flex !important;
    justify-content:center;
    align-items:center;

}

.centrarte{
    display: flex !important;
    justify-content:center;
    align-items:center;
    position:absolute;
}


</style>

  {{ Breadcrumbs::render('admin.entendimiento-organizacions.index') }}



    <div class="mt-5 card p-2">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Entendimiento de Organización (FODA)</strong></h3>
        </div>

        <button class="btn btn-danger" style="position: absolute; right:20px;" onclick="javascript:window.print()">
            <i class="fas fa-print"></i>
            Imprimir
        </button>

        <div id="impreso_row">
            <div style="text-align:right; margin-top:20px;" class="mr-4">
                {{$obtener_FODA->fecha}}
            </div>
            <div class="tit">
                <h5><strong>

                    {{$obtener_FODA->analisis}}
                </strong></h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="mb-3 row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Bien hecho!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif



                <div class="row">
                    <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                        <strong>INTERNAS</strong>
                    </div>


                    <div class="p-0 text-center col-md-5 col-sm-5"
                        style="border-right: solid 8px rgb(255, 104, 4); border-bottom: solid 10px #2bd1b0; min-height: 150px">
                       <div class="row">
                           <div class="col-sm-1">
                                <div class="circulo" style="background: #2bd1b0"><i class="fas fa-dumbbell" style="color: #fff; font-size:25px;"></i></div>
                           </div>
                           <div class="pl-3 col-sm-11">
                                <h5>
                                    <strong style="color: #18A98B">FORTALEZAS</strong>
                                    <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#fortalezas_modal"
                                        style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align:justify" class="px-3">
                                    @if ($obtener_FODA)
                                        {!! $obtener_FODA->fortalezas !!}
                                    @else
                                        Sin analizar
                                    @endif
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                        style=" border-bottom: solid 8px rgb(255, 89, 77); min-height: 150px">
                        <div class="row">
                            <div class="pl-3 col-sm-11">
                                <h5>
                                    <strong style="color:rgb(255, 104, 4);">
                                        DEBILIDADES
                                    </strong>

                                    <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#debilidades_modal"
                                        style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>


                                <div style="text-align: justify" class="px-3">
                                    @if ($obtener_FODA)
                                        {!! $obtener_FODA->debilidades !!}
                                    @else
                                        Sin analizar
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="circulo" style="background: rgb(255, 104, 4);"><i class="fas fa-thumbs-down" style="color: #fff; font-size:25px;"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                        <strong>EXTERNAS</strong>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                        style="border-right: solid 8px rgb(77, 184, 255); min-height: 150px">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="circulo" style="background:rgb(77, 184, 255)"><i class="fas fa-handshake" style="color: #fff; font-size:25px;"></i></div>
                            </div>
                            <div class="pl-3 col-sm-11">
                                <h5 class="mt-3">
                                    <strong style="color: rgb(77, 184, 255)">OPORTUNIDADES</strong>
                                    <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#oportunidades_modal"
                                        style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align: justify" class="px-3">
                                    @if ($obtener_FODA)
                                        {!! $obtener_FODA->oportunidades !!}
                                    @else
                                        Sin analizar
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5" style="min-height: 150px">
                        <div class="row">
                            <div class="pl-3 col-sm-11">
                                <h5 class="mt-3">
                                    <strong style="color:rgb(255, 89, 77)">AMENAZAS</strong>
                                    <button class="mr-2 btn btn-xs" type="button" data-toggle="modal" data-target="#amenazas_modal"
                                        style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align: justify" class="px-3">
                                    @if ($obtener_FODA)
                                        {!! $obtener_FODA->amenazas !!}
                                    @else
                                        Sin analizar
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="circulo" style="background:rgb(255, 89, 77)"><i class=" fas fa-bomb" style="color: #fff; font-size:25px;"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row justify-content-end">
                    @if ($obtener_FODA)
                        <a href="{{ route('admin.entendimiento-organizacions.edit', $obtener_FODA->id) }}"
                            class="mr-5 btn btn-primary"><i class="fas fa-pen"></i> Editar Análisis FODA</a>
                    @else

                        <a href="{{ route('admin.entendimiento-organizacions.create') }}" class="mr-5 btn btn-success"><i
                                class="fas fa-pen"></i> Realizar Análisis FODA</a>

                    @endif
                </div> --}}
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="fortalezas_modal" tabindex="-1" aria-labelledby="fortalezas_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <div  class="mr-5 justify-content-center" style="margin:auto">
                        <h5 class="modal-title" id="fortalezas_modalLabel">
                            <i class="fas fa-dumbbell" style="color: #2bd1b0; font-size:25px;"></i>
                            <strong class="ml-3">FORTALEZAS</strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Debemos añadir los atributos o puntos positivos que nos pueden servir para alcanzar nuestros objetivos.
                    Están relacionados tanto a los recursos materiales y su condición de uso como a los recursos humanos y
                    su nivel de capacitación para generar los mejores resultados.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="oportunidades_modal" tabindex="-1" aria-labelledby="oportunidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div  class="mr-5 justify-content-center" style="margin:auto">

                        <h5 class="modal-title" id="oportunidades_modalLabel">
                            <i class="fas fa-handshake" style="color: rgb(77, 184, 255); font-size:23px;"></i>
                            <strong class="ml-3">OPORTUNIDADES</strong>
                        </h5>
                    </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    En este cuadrante debemos de añadir lo que es perjudicial o los factores que pueden ser desfavorables
                    para nuestro objetivo. Son factores internos, por lo que la opinión del personal juega un papel
                    fundamental, y como es algo que se refleja al exterior, también cuenta la opinión de los clientes.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="debilidades_modal" tabindex="-1" aria-labelledby="debilidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div  class="mr-5 justify-content-center" style="margin:auto">
                        <h5 class="modal-title" id="debilidades_modalLabel">
                            <i class="mr-3 fas fa-thumbs-down" style="color:rgb(255, 104, 4); font-size:20px;"></i>

                            <strong class="mr-3">
                                DEBILIDADES
                            </strong>
                        </h5>
                    </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Aquí debemos tener en cuenta las condiciones externas, revisando la industria y otros factores como las
                    regulaciones que pueden afectar de forma positiva a nuestro objetivo. Son aspectos que, aunque no
                    podemos controlar, sí podemos aprovechar para mejorar o hacer crecer nuestra empresa.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="amenazas_modal" tabindex="-1" aria-labelledby="amenazas_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div  class="mr-5 justify-content-center" style="margin:auto">

                        <h5 class="modal-title" id="amenazas_modalLabel">
                        <i class="mr-3 fas fa-bomb" style="color: rgb(255, 89, 77); font-size:20px;"></i>
                            <strong class="mr-3">
                                AMENAZAS
                            </strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Añadiremos lo perjudicial, todo lo que puede amenazar nuestra supervivencia y la potencial ganancia de
                    resultados de forma externa. Estos aspectos no lo podemos controlar, pero sí podemos contraatacar para
                    enfrentarlos.
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

@endsection
