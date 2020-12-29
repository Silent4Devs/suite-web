@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Acción Correctiva </h3>
    </div>
    
    <div class="card-body">
        <div class="container">
            <div class="row">

                <div class="col-md-12 mt-5">
                    <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap1()" id="acollapseExample" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Acción Correctiva
                    </a>
                    <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap2()" id="acollapseplan" href="#collapseplan" role="button" aria-expanded="false" aria-controls="collapseplan">
                        Análisis de causa raíz
                    </a>
                    <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap3()" id="acollapseactividad" href="#collapseactividad" role="button" aria-expanded="false" aria-controls="collapseactividad">
                        Plan de acción
                    </a>
                    </p>
                    <div class="collapse show" id="collapseExample">
                        <div class="card card-body">
                            <div id="test-nl-1" class="content">
                            @include('admin.accionCorrectivas.editform1')

                                    <a class="btn btn-primary" onclick="closetabcollap1next()" id="nextcollapseForm1" role="button">
                                        Siguiente
                                    </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseplan">
                        <div class="card card-body">
                        @include('admin.accionCorrectivas.editform2')
                        </div>
                    </div>
                    <div class="collapse" id="collapseactividad">
                        <div class="card card-body">
                            

<!--@include('admin.accionCorrectivas.edit_planaccion')-->
                        
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



</div>

@endsection

@section('scripts')
<script>
    function closetabcollap1() {
        $('#collapseExample').collapse('show');
        $('#collapseplan').collapse('hide');
        $('#collapseactividad').collapse('hide');
    }

    function closetabcollap1next() {
        $('#collapseExample').collapse('hide');
        $('#collapseplan').collapse('show');
        $('#collapseactividad').collapse('hide');
    }

    function closetabcollap2() {
        $('#collapseExample').collapse('hide');
        $('#collapseplan').collapse('show');
        $('#collapseactividad').collapse('hide');
    }

    function closetabcollap3() {
        $('#collapseExample').collapse('hide');
        $('#collapseplan').collapse('hide');
        $('#collapseactividad').collapse('show');
    }
</script>
@endsection