
<html lang="en">
<head>

<meta charset="utf-8">

<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">

<style>
body{
background-color:white

}
.auditado{
width:300px;

}

.nombre_auditado{

width:418px;

}


.cuadro1{
  width:150px;
  height:100px;

}

.cuadro2{
  width:400px;
  height:100px;

}

.cuadro3{
  width:150px;
  height:100px;
}

.proceso_auditado{
background-color: #321fdb;
width:291px;
height:50px;
margin-left:21px;

}

.auditado{
background-color: #321fdb;
width:300px;
height:50px;
margin-left:520px;


}

.cuadro_proceso{

width:291px;
margin-left:21px;
border-radius:0;


}

.cuadro_auditado{

width:300px;
margin-left:520px;
border-radius:0;

}

.clasificacion{

background-color: #8E9293;
height:50px;
width:822px;
margin-left:516px;
margin-top:20px;

}

.proceso_auditado{
margin-left:150px;

}

.puesto_auditado{

  margin-left:450px;
  width:300px;
}

.fecha_auditoria{

  width:500px;
  margin-left:585px;

}

.conformidad{

  margin-left:430px;
  border:none;
  margin-top:100px;
}

	@media(max-width: 796px){


.cuadro1{

  width:150px;
  height:100px;

}

.cuadro2{
  width:600px;
  height:100px;

}

.cuadro3{
  width:150px;
  height:100px;

}

.proceso_auditado{
background-color: #321fdb;
width:200px;
height:70px;
margin-left:37px;

}

.auditado{
background-color: #321fdb;
width:190px;
height:70px;
margin-left:100px;


}

.cuadro_proceso{

width:200px;
margin-left:0px;
margin-left:37px;


}

.cuadro_auditado{

width:190px;
margin-left:100px;
border-radius:0;

}

.clasificacion{

height:50px;
width:432px;
margin-left:280px;

}

.proceso_auditado{
margin-left:30px;
width:250px;
}

.puesto_auditado{

  margin-left:160px;
  width:300px;
}

.fecha_auditoria{

  width:350px;
  margin-left:340px;

}


.conformidad{

  margin-left:200px;
  border:none;
  margin-top:100px;
  width: 350px;
}

.clasificacion{

margin-left:274px;
width: 420px;

}


  }


</style>



<div class="col-12" style="margin-left: 15px; margin-top:25px;">
  <table
      class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PartesInteresada">
      <thead>

      <tr style="background-color: #ffffff; " class="text-white text-center">
          <th class="cuadro1"></th>
          <th class"cuadro2"><p style="color:#0B0C0B; margin-top:-50px;">Registro de Hallazgos de Auditoria</p>
          </th>
          <th class="cuadro3"><p style="color:#0B0C0B; margin-top:-50px;">F-SGI-024 V1</p></th>
      </tr>
      </thead>
      <tbody>
  </table>
</div>

<div class="col-lg-5 col-md-6 col-sm-12 offset-md-1">
  <div class="fecha_auditoria">

          <table
              class=" table table-bordered table-striped table-hover ajaxTable datatable ">
              <thead>

              <tr style="background-color: #321fdb;" class="text-white text-light text-center">
                  <th style="width:100px;"><p class="font-weight-light">Fecha de la auditoria</p></th>
                  <th style=" width:100px; background-color:#ffffff"></th>


              </tr>
              </thead>
              <tbody>
          </table>

   </div>
  </div>



      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="proceso_auditado">

                      <table class=" table table-bordered table-striped table-hover ajaxTable datatable ">
                      <thead>

                      <tr style="background-color: #321fdb;" class="text-white text-light text-center ">
                          <th style="width:100px;"><p class="font-weight-light">Proceso Auditado</p></th>


                      </tr>
                      </thead>


                      <tr style="background-color: #ffffff;" class="text-white text-light text-center">
                          <th></th>


                      </tr>
                      </thead>
                      <tbody>
                  </table>

            </div>
          </div>

          <div class="col-md-4 col-sm-4">
              <div class="puesto_auditado">

                    <table
                        class="table table-bordered table-striped table-hover ajaxTable datatable ">
                        <thead>

                        <tr style="background-color: #321fdb;" class="text-white text-light text-center">
                            <th><p class="font-weight-light">Nombres y Puesto del Auditado</p></th>


                        </tr>
                        </thead>


                        <tr style="background-color: #ffffff;" class="text-white text-light text-center">
                            <th style="width:100px;"></th>


                        </tr>
                        </thead>
                        <tbody>
                    </table>
                </div>
              </div>
            </div>


      <div class="col py-3">
        <div class=" text-white">
          <div class="clasificacion card-body text-center"><p style="margin-top:-10;">Clasificación de los Hallazgos</p></div>
        </div>
    </div>
  </div>


    <div class="col-12">

              <table style="margin-top:-20px; margin-left:20px;"
                  class=" table table-bordered table-striped table-hover ajaxTable datatable">
                  <thead>

                  <tr style="background-color: #321fdb;" class="text-white text-light text-center">
                      <th><p class="font-weight-light">Requisito/<br>
                         Control</p></th>
                      <th><p class="font-weight-light">Descripción de los<br>
                        Hallazgos Detectados</p>
                      </th>
                      <th><p class="font-weight-light">No<br> Conformidad Mayor</p></th>
                      <th><p class="font-weight-light">No<br> Conformidad Menor</p></th>
                      <th><p class="font-weight-light">Observación</p></th>

                  </tr>
                  </thead>
                  <tbody>
              </table>

    </div>



    <div class="col-5 ">

              <table
                  class=" conformidad table table-bordered table-striped table-hover ajaxTable datatable tabla_agenda">
                  <thead>


                    <tr class="text-white text-light text-center">
                        <th  style="border:none; border-top: 1px solid;  width:50px; color:#0B0C0B" ><p class="font-weight-light">Firma de Conformidad del Auditado</p></th>

                    </tr>


                  </thead>
                  <tbody>
              </table>

    </div>
