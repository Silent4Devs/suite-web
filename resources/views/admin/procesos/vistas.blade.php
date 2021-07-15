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
            height: 100px;
            width: 100px;
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
            height: 100px;
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

</style>


<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"> </h3>
    </div>
    <div class="w-full px-8 py-4 mb-16 bg-white rounded-lg shadow-lg">
        <div class="mb-3 ml-5 row caja_btn_a ">
            <a href="#vista-previa" class="btn_a_seleccionado" style="text-decoration:none;"><div class="col-12 btn-jerarquia cambiocolor">
             Vista Previa
            </div></a>

            <a href="#resumen"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Resumen
            </div></a>

            <a href="#indicadores"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Indicadores
            </div></a>

            <a href="#versiones"  style="text-decoration:none;"><div class="col-12 btn-grupo cambiocolor2">
                Versiones
            </div></a>

        </div>

        <section id="vista-previa" class="d-block">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">

            </div>

        </section>

        <section id="resumen">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label>
                            Código:</label>
                        <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                        Test
                        </div>

                    </div>

                    <div class="form-group col-sm-6">
                        <label>
                            Nombre del Documento:</label>
                            <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                Test
                            </div>

                    </div>


                    <div class="form-group col-sm-3">
                        <label >
                            Tipo:</label>
                            <div class="pt-2 pl-2 text-center card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                Proceso
                            </div>

                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-sm-3">
                        <label class="required" for="codigo">
                            Estatus:</label>

                            <div class="pt-2 pl-2 text-center card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                Test
                            </div>

                    </div>


                    <div class="form-group col-sm-4">
                        <label>
                            Macroproceso:</label>
                            <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                Test
                            </div>

                    </div>

                    <div class="form-group col-sm-2">
                        <label>
                            Versión:</label>
                            <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                Test
                            </div>

                    </div>


                    <div class="form-group col-sm-3">
                        <label>
                            Fecha:</label>

                                <div class="card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                                    <div class="row">
                                        <div class="pt-2 pl-4 col-sm-8">
                                            Test
                                        </div>
                                        <div class="ml-1 col-sm-3" style="width:30px; height:35px; background:#00abb2" >
                                            <i class="pt-2 pl-2 fas fa-calendar-alt" style="font-size:18px; color:#fff;"></i>
                                        </div>

                                    </div>



                                 </div>


                    </div>

                </div>

                <div class="row">
                    <div class="form-group col sm-3">
                       <label>Elaboró</label>
                    </div>

                    <div class="form-group col sm-3">
                        <label>Revisó</label>
                    </div>
                    <div class="form-group col sm-3">
                        <label>Aprobó</label>
                    </div>
                    <div class="form-group col sm-3">
                        <label>Responsable</label>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-3 info-personal">
                        <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                            <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                            <div class="caja_img_perfil">
                                <img src="">
                            </div>
                            <h5></h5>
                            <p></p>

                        </div>

                    </div>


                    <div class="col-lg-3 info-personal">
                        <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                            <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                            <div class="caja_img_perfil">
                                <img src="">
                            </div>
                            <h5></h5>
                            <p></p>

                        </div>

                    </div>

                    <div class="col-lg-3 info-personal">
                        <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                            <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                            <div class="caja_img_perfil">
                                <img src="">
                            </div>
                            <h5></h5>
                            <p></p>

                        </div>

                    </div>

                    <div class="col-lg-3 info-personal">
                        <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                            <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                            <div class="caja_img_perfil">
                                <img src="">
                            </div>
                            <h5></h5>
                            <p></p>

                        </div>

                    </div>
                </div>



            </div>

        </section>

        <section id="indicadores">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">

        </section>

        <section id="versiones">

            <div class="pt-4 ml-5 col-sm-11 card" style="box-shadow: 0px 0px 0px 2px rgba(77, 72, 77, 0.133)">

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
