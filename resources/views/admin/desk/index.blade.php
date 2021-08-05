@extends('layouts.admin')
@section('content')
	<style type="text/css">
        body{
            background-color: #fff;
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
        
            <div class="caja_botones_menu">
                <a href="#" data-tabs="incidentes" class="btn_activo">
                	<i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
                </a>
                <a href="#" data-tabs="riesgos">
                	<i class="fas fa-shield-virus"></i> Riesgos
                </a>
                <a href="#" data-tabs="quejas">
                	<i class="fas fa-frown"></i> Quejas
                </a>
                <a href="#" data-tabs="denuncias">
                	<i class="fas fa-hand-paper"></i> Denuncias
                </a>
                <a href="#" data-tabs="mejoras">
                	<i class="fas fa-rocket"></i> Mejoras
                </a>
                <a href="#" data-tabs="sugerencias">
                	<i class="fas fa-lightbulb"></i> Sugerencias
                </a>
            </div>
        

            <div class="caja_caja_secciones">
            
                <div class="caja_secciones">
                    <section id="incidentes" class="caja_tab_reveldada">
                    	@include('admin.desk.seguridad.seguridad')
                    </section>
                    <section id="riesgos">
                        @include('admin.desk.riesgos.riesgos')
                    </section>
                    <section id="quejas">
                        @include('admin.desk.quejas.quejas')
                    </section>
                    <section id="denuncias">
                        @include('admin.desk.denuncias.denuncias')
                    </section>
                    <section id="mejoras"> 
                        @include('admin.desk.mejoras.mejoras')
                    </section>
                    <section id="sugerencias"> 
                        sugerencias
                    </section>

                </div>
            
            </div>
            
        </div>
    </div>
@endsection



@section('scripts')
    
@endsection