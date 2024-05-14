<style type="text/css">
	body{
			margin: 0;
		}
	.contacto{
		width: 100%;
		height: 471px;
		max-width: 1000px;
		background-image: url(../img/implementacion/fondo_consultoria.jpg);
		background-size: cover;
		background-color: #ccc;
		font-family: calibri;
	}
	.tiulo {
		width: 100%;
		margin: 0;
		margin-top: 30px;
		text-align: center;
		font-size: 30pt;
		float: left;
		color: #285a9d;
	}
	.tiulo font{
		font-size: 31pt;
		font-weight: bolder;
		color: #30289d;
	}
	.info{
		width: 475px;
		margin: 0;
		margin-top: 30px;
		font-size: 17pt;
		font-weight: lighter;
		float: right;
		margin-right: 10%;
		text-align: center;
		color: #05192c;
	}
	.caja_btn{
		width: 400px;
		height: 200px;
		float: left;
		margin-top: 20px;
		margin-left: 190px;
	}
	.caja_btn img{
		height: 40px;
		transition: 0.1s;
	}
	.caja_btn img:hover{
		transform: scale(1.1);
		filter: saturate(150%);
		opacity: 0.8;
	}
	.boton{
		float: left;
		margin-top: 15px;
	}
	.cel{
		margin-left: 0;
	}
	.whats{
		margin-left: 20px;
	}
	.correo{
		margin-left: 40px;
	}
	.btn_consultores{
		width: 140px;
		height: 37px;
		border: 1px solid #fff;
		position: absolute;
		bottom: 15px;
		left: 15px;
		color: #fff;
		font-size: 12pt;
		border-radius: 8px;
		box-shadow: 0px 0px 5px -1px;
		cursor: pointer;

		display: flex;
		align-items: center;
		justify-content: center;
	}
	.btn_consultores:hover{
		transform: scale(1.08);
		transition: 0.1s;
	}
	.tabla_consultores{
		width: 100%;
		margin-top: 30px;
		display: none;
	}
	.contacto table{
		width: 670px;
		margin: auto;
		color: #fff;
	}
	.contacto table thead tr{
		background-color: #008398;
		transform: scale(1.01);
		box-shadow: 0px 3px 5px -3px #000;
	}
	.contacto table th{
		border-bottom: 1px;
		padding: 10px;
		text-align: center;
	}
	.contacto table td{
		padding: 10px;
	}
	.contacto table tbody tr{
		border-bottom: 1px solid rgba(255,255,255,0.3);
		background-color: rgba(0,0,0,0.4);
		transition: 0.1s;
	}
	.contacto table tbody tr:hover{
		transform: scale(1.015);

		background-color: rgba(0,0,0,0.5);
	}
	.btn_cerrar{
		display: none;
		width: 50px;
		height: 50px;
		right: 30px;
		position: absolute;
	}
	.icono_cerrar{
		font-size: 50px;
		cursor: pointer;
		color: #ccc;
		margin-top: -25px;
	}





	@media(max-width: 1100px){
		.contacto table{
			width: 100%;
		}
	}
	@media(max-width: 796px){
		.info{
			width: 90%;
			margin-right: 5%;
		}
		.contacto table{
			width: 100%;
		}
		.contacto table tr{
			display: flex;
			flex-direction: column;
		}
		.tabla_consultores{
			width: 100%;
			height: 450px;
			overflow-y: scroll;
			overflow-x: hidden;
		}
	}
	@media(max-width: 600px){
		.caja_btn{
			margin-left: 5%;
		}
		.contacto{
			height: 600px;
		}
	}
</style>

<div class="contacto">

	<div class="btn_cerrar"><i class="far fa-times-circle icono_cerrar"></i></div>

	<div class="btn_consultores">Consultores</div>

	<div class="genreal">
		<p class="tiulo">¿CÓMO PODEMOS APOYARTE? &nbsp;&nbsp; <font>CONTÁCTANOS</font></p>

		<p class="info">
			Si quieres asesoría por parte de nuestros expertos contáctanos a través de nuestros siguientes medios.
		</p>

		<div class="caja_btn">
			<div class="boton cel"><a href="tel:525525115770"><img src="../img/implementacion/btn_cel.png"></a></div>
			<div class="boton whats"><a href="https://wa.me/525525115770" target="_blank"><img src="../img/implementacion/btn_whats.png"></a></div>
			<div class="boton correo"><a href="mailto:contacto@silent4business.com"><img src="../img/implementacion/btn_correo.png"></a></div>
		</div>
	</div>

	<div class="tabla_consultores">
		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Puesto</th>
					<th>Teléfono</th>
					<th>Correo</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Enrique Cáliz</td>
					<td>Consultor Estratégico Jr.</td>
					<td>5578232000 Ext. 146</td>
					<td>enrique.caliz@silent4business.com</td>
				</tr>
				<tr>
					<td>Erika Rosales</td>
					<td>Especialista de Consultoría Estratégica</td>
					<td>5578232000 Ext. 146</td>
					<td>erika.rosales@silent4business.com</td>
				</tr>

				<tr>
					<td>Alejandro Said Pacheco Salas</td>
					<td>Consultor Estratégico Jr.</td>
					<td>5578232000 Ext. 146</td>
					<td>alejandro.pacheco@silent4business.com</td>
				</tr>
				<tr>
					<td>Yediael Ceja</td>
					<td>Consultor Estratégico Jr.</td>
					<td>5578232000 Ext. 146</td>
					<td>yediael.ceja@silent4business.com</td>
				</tr>
				<tr style="border: none;">
					<td>Marco Luna Robles</td>
					<td>Líder de Consultoría Estratégica</td>
					<td>5578232000 Ext. 158</td>
					<td>marco.luna@silent4business.com</td>
				</tr>
			</tbody>
		</table>
	</div>


</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
	$(".btn_consultores").click(function(){
		$(".genreal").fadeOut(180);
		$(".tabla_consultores").delay(180).fadeIn(180);
		$(".btn_consultores").fadeOut(180);
		$(".btn_cerrar").delay(180).fadeIn(180);
	});
	$(".btn_cerrar").click(function(){
		$(".genreal").delay(180).fadeIn(180);
		$(".tabla_consultores").fadeOut(180);
		$(".btn_consultores").delay(180).fadeIn(180);
		$(".btn_cerrar").fadeOut(180);
	});
</script>
