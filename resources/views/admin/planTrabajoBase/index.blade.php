@extends('layouts.admin')
@section('content')

<style>

	body{
		background-color: #fff !important;
	}

	.resEdit {
		padding: 15px;
	}

	.resLine {
		width: 95%;
		padding: 3px;
		margin: 5px;
		border: 1px solid #d0d0d0;
	}


	.ganttButtonBar h1{
		color: #000000;
		font-weight: bold;
		font-size: 28px;
		margin-left: 10px;
	}

	#TWGanttArea{
		height: 550px !important;
	}

	#__popup__1{
		background-color: rgba(0, 0, 0, 0.5) !important;
	}
	.bwinPopupd{
		position: absolute;
		width: 90%;
		max-width: 600px;
		top: 0px;
		left: 0;
		right: 0;
		bottom: 0;
		margin: auto;
		margin-top: 100px !important;
		height: 400px;
	}




	.gdfTable.table.ganttFixHead thead tr .gdfColHeader.gdfied.unselectable{
		font-size: 12px !important;
	}

	.gdfTable.table.ganttFixHead{
		display: none !important;
	}

	

	.ganttFixHead{
		border-bottom: 1px solid #ccc !important;
	}

	.table thead th{
		border-bottom: none !important;
		border-top: none !important;
	}


	/*.taskBox.taskBoxSVG.taskStatusSVG.deSVGdrag.deSVG rect:nth-child(even){
		fill: #fff !important;
		height: 15px !important;
	}*/


	#workSpace{
		border: none !important;
	}

	table.gdfTable thead > tr:nth-child(1n){
		position: sticky;
		top: 0;
		background-color: #fff !important;
		z-index: 2;
	}

	
	.icons_propios_gantt{
		transform: scale(1.2);
		color: #34495e !important;
	}
	.icons_propios_gantt.guardar{
		transform: scale(1.5);
		color: #00abb2 !important;
	}


	.botones_vistas_gantt{
		width: 100%;
		text-align: right;
	}
	.botones_vistas_gantt div{
		width: 100px;
		display: inline-block;
		height: auto;
		padding: 5px 10px;
		background-color: #fff;
		color: #00abb2;
		font-size: 9pt;
		cursor: pointer;
		border: 1px solid #00abb2;
		border-radius: 5px;
		text-align: center;
		vertical-align: middle;
	}
	.botones_vistas_gantt div:hover{
		border: 1px solid #00abb2;
		background-color: #00abb2;
		color: #fff;
	}
	.boton_activo{
		border: 1px solid #00abb2 !important;
		background-color: #00abb2 !important;
		color: #fff !important;
	}

	.botones_vistas_gantt div i{
		font-size: 11pt;
		margin-right: 5px;
	}

	select.formElements option{
		text-transform: capitalize !important;
	}

	.splitterContainer rect:nth-child(1){
		rx: 10px;
		ry: 10px;
		width: calc(+ 20px);
	}
	.splitterContainer rect[height="3"]{
		height: 10px;
		fill: #00abb2 !important;
		rx: 5px;
		ry: 5px;
	}
	.splitterContainer rect[height="60%"]{
		transform: scaleX(0.9) translate(5%);
		rx: 5px;
		ry: 5px;
	}





	@media print{
		header, footer, .sistema_gantt p, .botones_vistas_gantt, body.font-lato{
			display: none !important;
		}
		*{
			transform: scale(1.001);
		}
	}

</style>

	<div class="mt-5 mb-5">
	    <div class="py-3 col-12 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
	        <h3 class="mb-2 text-center text-white"><strong>Plan de Trabajo </strong></h3>
	    </div>

	    	
	    	<div class="botones_vistas_gantt">
	    		<div class="btn_gantt_vista boton_activo"><i class="fas fa-stream"></i>Gantt</div>
	    		<div class="btn_gantt_tabla_vista"><i class="fas fa-table"></i>Tabla</div>
	    		<div class="btn_gantt_calendario_vista"><i class="fas fa-calendar-alt"></i></i>Calendario</div>
	    	</div>

	    	<section id="original_gantt">
	    		@include('admin.planTrabajoBase.gantt')
			</section>

			<section id="tabla_gantt" style="display: none;">
				@include('admin.planTrabajoBase.tabla')
			</section>

			<section id="calendario_gantt" style="display: none;">
				@include('admin.planTrabajoBase.calendario')
			</section>


	</div>





@endsection

@section('scripts')

	<script type="text/javascript">
		$(".btn_gantt_vista").click(function(){
			$("section").css("display","none");
			$("#original_gantt").css("display","block");
		});
		$(".btn_gantt_tabla_vista").click(function(){
			$("section").css("display","none");
			$("#tabla_gantt").css("display","block");
		});

		$(".btn_gantt_calendario_vista").click(function(){
			$("section").css("display","none");
			$("#calendario_gantt").css("display","block");
		});		
	</script>


	<script type="text/javascript">
		$(".botones_vistas_gantt div").click(function(){
			$(".botones_vistas_gantt div").removeClass("boton_activo");
			$(".botones_vistas_gantt div:hover").addClass("boton_activo");
		});
	</script>
@endsection