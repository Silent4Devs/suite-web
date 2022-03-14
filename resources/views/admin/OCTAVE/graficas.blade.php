@extends('layouts.admin')
@section('content')

    <style type="text/css">
        .caja-grafica{
            border-bottom: 1px solid #aaa;
            border-left: 1px solid #aaa;
            padding: 20px;
            margin:auto;
            position: relative;
        }
        .info-grafica{
            position: absolute;
        }
        .tabla-grafica-1 td{
            width: 300px;
            height: 250px;
            border: 2px solid #fff;
            vertical-align: middle;
            text-align: center;
            color: #000;
            font-weight: bolder;
            position: relative;
        }
        .tabla-grafica-1 td span{
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            text-align: center;
        }
        .circle-s{
            width: 45px;
            height: 45px;
            background: radial-gradient(circle, rgba(63,251,249,1) 0%, rgba(70,147,252,1) 70%);
            border-radius: 100px;
            display: inline-block;
            margin: 5px;
            padding-top: 10px;
            color: #000;
            box-shadow: 0px 1px 5px 1px rgba(0, 0, 0, 0.5);
            text-align: center;
            padding-top: 10px;
            color: #fff;
            cursor: pointer;
            transition: 0.1s;
        }
        .circle-s:hover{
            transform: scale(1.1);
        }


        .tabla-grafica-2 .info-td{
            font-size: 10px;
            background-color: #eee;
            border: 1px solid #e1e1e1;
            min-height: 40px;
        }
        .tabla-grafica-2 .info-td .vertical{
            transform: rotate(270deg);
        }

        .td-verde-o{
            background-color: green;
        }
        .td-verde{
            background-color: limegreen;
        }
        .td-amarillo{
            background-color: #F1F120;
        }
        .td-naranja{
            background-color: orange;
        }
        .td-rojo{
            background-color: red;
        }
        .color-td{
            min-width: 150px;
            height: 100px;
            border: 3px solid #fff;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Matriz de Riesgo</h5>

    <div class="mt-5 card card-body">
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor, seleccione opciones para mostrar sus
                        datos</p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="form-group col-md-4">
                <label>Sede</label>
                <select class="form-control"></select>
            </div>
            <div class="form-group col-md-4">
                <label>Area</label>
                <select class="form-control"></select>
            </div>
            <div class="form-group col-md-4">
                <label>Proceso</label>
                <select class="form-control"></select>
            </div>
        </div>

        <div class="row caja-graf" id="caja_graf_ev">

            <h5 class="col-12 my-5"><strong>Evaluación de Procesos</strong></h5>

            <div class="col-md-4 mt-3">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Riesgo</th>
                            <th scope="col">Probabilidad</th>
                            <th scope="col">Impacto</th>
                            <th scope="col">Nivel riesgo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Riesgo</td>
                            <td scope="col">Probabilidad</td>
                            <td scope="col">Impacto</td>
                            <td scope="col">Nivel riesgo</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-8">
                
                <div class="caja-grafica" style="width: 650px;">
                    <div class="info-grafica" style="transform: rotate(270deg); left:0; top:250px; margin-left:-50px;">Probabilidad</div>
                    <table class="tabla-grafica-1">
                        <tr>
                            <td bgcolor="#F1F120">
                                <span> Riesgos a considerar</span>
                            </td>
                            <td bgcolor="#F15B5B">
                                <span> Riesgos de prioridad</span>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#7CCD30">
                                <span> Riesgos a monitorear</span>
                            </td>
                            <td bgcolor="#F9AB10">
                                <span> Riesgos relevantes</span>

                                <div class="circle-s">S1</div>
                                <div class="circle-s">S2</div>
                            </td>
                        </tr>
                    </table>
                    <div class="info-grafica" style="left:300px; margin-top: 20px;">Impacto</div>
                </div>
            </div>    
        </div>

        <div class="row caja-graf d-none" id="caja_graf_act">
            <h5 class="col-12 my-5 d-flex justify-content-between"><strong>Mapa de Riesgos de Activos</strong> <i class="fa-solid fa-arrow-left regreso_gen"></i></h5>
            <div class="col-md-4 mt-3">
                <table class="table table-responsive">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Riesgo</th>
                        <th scope="col">Probabilidad</th>
                        <th scope="col">Impacto</th>
                        <th scope="col">Nivel riesgo</th>
                    </thead>
                    <tbody>
                        <td scope="col">#</td>
                        <td scope="col">Riesgo</td>
                        <td scope="col">Probabilidad</td>
                        <td scope="col">Impacto</td>
                        <td scope="col">Nivel riesgo</td>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                
                <div class="caja-grafica" style="width: 850px;">
                    <div class="info-grafica" style="transform: rotate(270deg); left:0; top:250px; margin-left:-50px;">Probabilidad</div>
                    <table class="tabla-grafica-2">
                        <tr>
                            <td class="info-td"><div class="vertical">Muy&nbsp;Probable</div></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-rojo"></td>
                            <td class="color-td td-rojo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Probable</div></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-rojo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Posible</div></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja">
                                <div class="circle-s">S1</div>
                                <div class="circle-s">S2</div>
                            </td>
                            <td class="color-td td-naranja"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Poco&nbsp;Probable</div></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Improbable</div></td>
                            <td class="color-td td-verde-o"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"></td>
                            <td class="info-td">Muy Bajo</td>
                            <td class="info-td">Bajo</td>
                            <td class="info-td">Medio</td>
                            <td class="info-td">Alto</td>
                            <td class="info-td">Critico</td>
                        </tr>
                    </table>
                    <div class="info-grafica" style="left:300px; margin-top: 20px;">Impacto</div>
                </div>
            </div>
        </div>

        <div class="row caja-graf d-none" id="caja_graf_con">
            <h5 class="col-12 my-5 d-flex justify-content-between"><strong>Mapa de Riesgos de Contenedor</strong><i class="fa-solid fa-arrow-left regreso_gen"></i></h5>
            <div class="col-md-4 mt-3">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Riesgo</th>
                            <th scope="col">Probabilidad</th>
                            <th scope="col">Impacto</th>
                            <th scope="col">Nivel riesgo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Riesgo</td>
                            <td scope="col">Probabilidad</td>
                            <td scope="col">Impacto</td>
                            <td scope="col">Nivel riesgo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8 mt-4">
                
                <div class="caja-grafica" style="width: 850px;">
                    <div class="info-grafica" style="transform: rotate(270deg); left:0; top:250px; margin-left:-50px;">Probabilidad</div>
                    <table class="tabla-grafica-2">
                        <tr>
                            <td class="info-td"><div class="vertical">Muy&nbsp;Probable</div></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-rojo"></td>
                            <td class="color-td td-rojo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Probable</div></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-naranja"></td>
                            <td class="color-td td-rojo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Posible</div></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja">
                                <div class="circle-s">S1</div>
                                <div class="circle-s">S2</div>
                            </td>
                            <td class="color-td td-naranja"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Poco&nbsp;Probable</div></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-amarillo"></td>
                            <td class="color-td td-naranja"></td>
                        </tr>
                        <tr>
                            <td class="info-td"><div class="vertical">Improbable</div></td>
                            <td class="color-td td-verde-o"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-verde"></td>
                            <td class="color-td td-amarillo"></td>
                        </tr>
                        <tr>
                            <td class="info-td"></td>
                            <td class="info-td">Muy Bajo</td>
                            <td class="info-td">Bajo</td>
                            <td class="info-td">Medio</td>
                            <td class="info-td">Alto</td>
                            <td class="info-td">Critico</td>
                        </tr>
                    </table>
                    <div class="info-grafica" style="left:300px; margin-top: 20px;">Impacto</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script type="text/javascript">
        $('#caja_graf_ev .circle-s').click(function(){
            $('.caja-graf').addClass('d-none');
            $('#caja_graf_act').removeClass('d-none');
        });
        $('#caja_graf_act .circle-s').click(function(){
            $('.caja-graf').addClass('d-none');
            $('#caja_graf_con').removeClass('d-none');
        });

        $('.regreso_gen').click(function(){
            $('.caja-graf').addClass('d-none');
            $('#caja_graf_ev').removeClass('d-none');
        });

        
    </script>
@endsection