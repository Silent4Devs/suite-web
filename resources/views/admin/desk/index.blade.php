@extends('layouts.admin')
@section('content')
	<style type="text/css">
        body{
            background-color: #fff;
        }
        #desk .caja_botones{
            display: flex;
        }
        #desk .caja_botones a{
            width: 200px;
            text-decoration: none;
            display: inline-block;
            color: #008186;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }
        #desk .caja_botones a:first-child{
            border-left: none;
        }
        #desk .caja_botones a:not(#desk .caja_botones a.btn_activo){
            border-bottom: 1px solid #ccc;
        }
        #desk .caja_botones a i{
            margin-right: 7px;
            font-size: 15pt;
        }
        #desk .caja_botones a.btn_activo{
            border-top: 2px solid #00abb2 !important;
            background-color: #fff;
        }
        #desk .caja_botones a:hover{
            border-top: 2px solid #00abb2 !important;
        }

        #desk .caja_caja_secciones{
            width: 100%;
            overflow: hidden;
            scroll-behavior: smooth;
        }
        #desk .caja_secciones{
            width: 600%;
            display: flex;
        }
        #desk section{
            width: 16.6666% !important;
        }
        #desk section:target{
            padding-top: 200px;
            margin-top: -200px;
        }
        #desk section:not(#desk section:target){
            height: 100px;
        }


        table, h2{
        	margin-top: 30px;
        }

        .card{
        	box-shadow: none !important;
        	background-color: rgba(0, 0, 0, 0);
        }

        .table{
        	width: 100% !important;
        }


        table i{
        	font-size: 15pt;
        	margin-right: 7px;
        }
        .fa-edit{
        	color: blue;
        }
        .fa-archive{
        	color: green;
        }
    </style>



    
    <div id="desk" class="card mt-5" style="">

	    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
	        <h3 class="mb-2  text-center text-white"><strong>Centro de Atención </strong></h3>
	    </div>
        
        <div class="caja_botones_secciones">
        
            <div class="caja_botones">
                <a href="#calendario" class="btn_activo">
                	<i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
                </a>
                <a href="#actividades">
                	<i class="fas fa-shield-virus"></i> Riesgos
                </a>
                <a href="#aprobaciones">
                	<i class="fas fa-frown"></i> Quejas
                </a>
                <a href="#capacitaciones">
                	<i class="fas fa-hand-paper"></i> Denuncias
                </a>
                <a href="#reportes">
                	<i class="fas fa-rocket"></i> Mejoras
                </a>
                <a href="#sugerencias">
                	<i class="fas fa-lightbulb"></i> Sugerencias
                </a>
            </div>
        

            <div class="caja_caja_secciones">
            
                <div class="caja_secciones">
                    <section id="calendario">
                    	@include('admin.desk.seguridad.seguridad')
                    </section>
                    <section id="actividades">
                    </section>
                    <section id="aprobaciones">

                    </section>
                    <section id="capacitaciones">

                    </section>
                    <section id="reportes"> 

                    </section>
                    <section id="sugerencias"> 

                    </section>

                </div>
            
            </div>
            
        </div>
    </div>
@endsection



@section('scripts')
    <script type="text/javascript">
        $(".caja_botones a").click(function(){
            $(".caja_botones a").removeClass("btn_activo");
            $(".caja_botones a:hover").addClass("btn_activo");
        });
    </script>
@endsection