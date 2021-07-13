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
            border-left: 1px solid #ccc;
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
        	width: 100%;
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
                    	<h2>Incidentes de seguridad</h2>
	                    <div class="datatable-fix" style="width: 100%;">
	                       <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Fecha</th>
		                       			<th>Hora</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
		                       			<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Fecha</td>
		                       			<td>Hora</td>
		                       			<td>Descripción de inicidente</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
                    </section>
                    <section id="actividades">
                    	<h2>Riesgos</h2>
	                   <div class="datatable-fix" style="width: 100%;">
	                      <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Fecha</th>
		                       			<th>Hora</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
	                       				<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Fecha</td>
		                       			<td>Hora</td>
		                       			<td>Descripción de riesgo</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
                    </section>
                    <section id="aprobaciones">
                    	<h2>Quejas</h2>
	                     <div class="datatable-fix" style="width: 100%;">
	                        <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Anonima</th>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Queja contra</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
		                       			<td>Anonima</td>
		                       			<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Queja contro</td>
		                       			<td>Descripción</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
                    </section>
                    <section id="capacitaciones">
                    	<h2>Denuncias</h2>
	                     <div class="datatable-fix" style="width: 100%;">
	                        <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Anonima</th>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Colaborador denunciado</th>
		                       			<th>Tipo de denuncia</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
		                       			<td>Anonima</td>
		                       			<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Colaborador denunciado</td>
		                       			<td>Tipo de denuncia</td>
		                       			<td>Descripción</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
                    </section>
                    <section id="reportes"> 
                    	<h2>Mejoras</h2>
	                     <div class="datatable-fix" style="width: 100%;">
	                        <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Nombre de mejora</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
		                       			<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Nombre de mejora</td>
		                       			<td>Descripción</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
                    </section>
                    <section id="sugerencias"> 
                    	<h2>Sugerencias</h2>
	                     <div class="datatable-fix" style="width: 100%;">
	                        <table class="table">
	                       		<thead>
	                       			<tr>
		                       			<th>Nombre</th>
		                       			<th>Correo electrónico</th>
		                       			<th>Sugerencia dirigida a</th>
		                       			<th>Descripción</th>
	                       			</tr>
	                       		</thead>
	                       		<tbody>
	                       			<tr>
		                       			<td>Nombre</td>
		                       			<td>Correo electrónico</td>
		                       			<td>Sugerencia dirigida a</td>
		                       			<td>Descripción</td>
	                       			</tr>
	                       		</tbody>
	                       </table>
	                   	</div>
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








    <script type="text/javascript">
        $(document).ready(function(){
            let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar PDF',
                        orientation: 'portrait',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        },
                        customize: function(doc) {
                            doc.pageMargins = [20, 60, 20, 30];
                            // doc.styles.tableHeader.fontSize = 7.5;
                            // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10 
                        }
                    },
                    {
                        extend: 'print',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Imprimir',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Seleccionar Columnas',
                    },
                    {
                        extend: 'colvisGroup',
                        text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        show: ':hidden',
                        titleAttr: 'Ver todo',
                    },
                    {
                        extend: 'colvisRestore',
                        text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Restaurar a estado anterior',
                    }

                ];
            $(".table").DataTable({
                buttons: dtButtons,
            });
        });
    </script>
@endsection