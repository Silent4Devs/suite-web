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


	@media(max-width: 796px){
		.info{
			width: 90%;
			margin-right: 5%;
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
	<p class="tiulo">¿CÓMO PODEMOS APOYARTE? &nbsp;&nbsp; <font>CONTÁCTANOS</font></p>

	<p class="info">
		Si quieres asesoría por parte de nuestros expertos contáctanos a través de nuestros siguientes medios.
	</p>

	<div class="caja_btn">
		<div class="boton cel"><a href="tel:525525115770"><img src="../img/implementacion/btn_cel.png"></a></div>
		<div class="boton whats"><a href="https://wa.me/525525115770" target="_blank"><img src="../img/implementacion/btn_whats.png"></a></div>
		<div class="boton correo"><a href="mailto:tabantaj@silent4business.com"><img src="../img/implementacion/btn_correo.png"></a></div>
	</div>
</div>
