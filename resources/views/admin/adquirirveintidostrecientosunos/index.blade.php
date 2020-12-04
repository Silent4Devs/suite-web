@extends('layouts.admin')
@section('content')


<style type="text/css">
	body{
			margin: 0;
		}
	.contacto{
		width: 90%;
		height: 471px;
		max-width: 900px;
		background-image: url(../img/consultores.jpg);
		background-size: cover;
		background-color: #ccc;
		margin-left:47px;
		font-family: calibri;
	}
	.tiulo {
		width: 100%;
		margin: 0;
		margin-top: 30px;
    margin-left:30px;
		font-size: 30pt;
		float: left;
		color: #285a9d;
	}
	.tip{
		font-size: 31pt;
		font-weight: bolder;
		color: #30289d;
    margin-left:130px;

	}
	.info{
		width: 475px;
		margin: 0;
		font-size: 17pt;
		font-weight: lighter;
		float: left;
		margin-left:10px;
		text-align: center;
  	color: #000000;
	}
	.caja_btn{
		width: 400px;
		height: 200px;
		float: left;
		margin-top:5px;
		margin-right: 130px;
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

		margin-top: 15px;
	}
	.cel{
			margin-left:35%;
	}
	.whats{
			margin-left:25%;
	}
	.correo{
		margin-left:20%;
	}


	@media(max-width: 796px){
		.info{
			width: 90%;
			margin-right: 5%;
}
		.contacto{
		  width: 100%;
			margin-left:0px;
			background-image: url(../img/consultores_2.jpg);

}

		.tiulo {
			margin-top: 20px;
			margin-left:20px;
}

		.tip{

			margin-left:110px;

}
}
	@media(max-width: 600px){
		.caja_btn{
			float:right;
		}
		.contacto{
			height: 600px;
			margin-left:0px;
				background-image: url(../img/consultores.jpg);

	}
		.cel{
			margin-left:220px;
	}
		.whats{
			margin-left:190px;
	}
		.correo{
			margin-left:150px;
	}

	.tip{
		font-size: 25pt;
		margin-left:90px;

	}

	.tiulo {
		font-size:30px;

	}

}
</style>

<div class="card card-cascade narrower mt-5">

    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>ISO 22301</strong></h3>
    </div>


    <div class="card-body">
      <div class="contacto">
      	<p class="tiulo">¿Deseas adquirir este módulo? &nbsp;&nbsp;</p>
          <p class="tip"><font>CONTÁCTANOS</font></p>

      	<p class="info">
      	 Si te interesa adquirirlo o conocer más sobre él, contacta alguno de nuestros asesores a través de nuestros siguientes medios.
      	</p>

      	<div class="caja_btn">
      		<div class="boton cel"><a href="tel:525525115770"><img src="../img/implementacion/btn_cel.png"></a></div>
      		<div class="boton whats"><a href="https://wa.me/525525115770" target="_blank"><img src="../img/implementacion/btn_whats.png"></a></div>
      		<div class="boton correo"><a href="mailto:tabantaj@silent4business.com"><img src="../img/implementacion/btn_correo.png"></a></div>
      	</div>
      </div><!--contacto-->
    </div><!--card-body-->
</div><!--card-->


@endsection
