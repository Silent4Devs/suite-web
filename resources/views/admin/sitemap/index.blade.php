@extends('layouts.admin')
@section('content')

  <head>

      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <link rel="stylesheet" href="https://mdbootstrap.com/docs/jquery/content/icons-list/">
      <link rel='stylesheet' id='wsl-widget-css'  href='https://mdbootstrap.com/wp-content/plugins/wordpress-social-login/assets/css/style.css?ver=5.5.1' type='text/css' media='all' />

  </head>



<style>
  .switch-version {
    z-index: 1000;
  }

  .switch-to.mdb-standard {
    background-position: 0 -160px;
  }
</style>

<style>
    .divided-list li {
        padding-bottom: 10px;
        padding-top: 10px;
        border-bottom: 1px solid #eee;
        font-size: 1rem;
    }
</style>



      <div class="card card-cascade narrower mt-5">

        <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2  text-center text-white"><strong>Site Map</strong></h3>
        </div>





          <div class="card-body">
            <div class="row">
              <div class="col-md-12">


                <div class="row">

                    <!--Grid column-->
                    <div class="col-lg-12 col-md-6">

                        <!--Card-->
                        <div class="card card-cascade narrower mt-5">

                            <!--Card image-->


                            <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-30px; ">
                                <h4 class="mb-2  text-center text-white"><i class="fas fa-home"></i> Menu</h4 >
                            </div>

                            <!--/Card image-->

                            <!--Card content-->
                            <div class="card-body card-body-cascade">

                                <ul class="divided-list list-unstyled text-center">
                                    <li><a href="" target="_blank"> Mi organización</a></li>
                                    <li><a href="" target="_blank">Dashboard</a></li>
                                    <li><a href="" target="_blank"> Implementación</a>
                                    <div class="contenido_modificado" style="margin-right:20px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Introducción</a></div>
                                    <div class="contenido_modificado" style="margin-left:55px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Guía de Implementación</a></div>
                                    <div class="contenido_modificado" style="margin-left:33px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Plan de Trabajo Base</a></div>
                                    <div class="contenido_modificado" style="margin-left:27px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Consultoría en línea</a></div>
                                    </li>
                                    <li><a href="" target="_blank"> Documentación</a>
                                    <div class="contenido_modificado" style="margin-right:40px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Carpetas</a></div>
                                    <div class="contenido_modificado" style="margin-right:40px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Archivos</a></div>
                                    </li>
                                    <li><a href="" target="_blank"> Glosario</a></li>
                                </ul>

                            </div>
                            <!--/.Card content-->

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->



                    <hr class="my-5">



                    <!--Section: -->
                    <section id="">

                        <h2 class="title text-primary text-center" style="margin-top:20px;"><strong> Normas</strong></h2>

                        <!--Title-->
                        <h4 class="text-info"><strong><i class="fas fa-globe text-info" style="margin-left:20px;"></i> ISO 27001</strong></h4>

                        <!--Description-->
                        <p class="description"></p>

                        <!--Section: Live preview-->
                        <section>

                            <!--Grid row-->
                            <div class="row mb-5 mt-5">

                                <!--Grid column-->
                                <div class="col-lg-3 col-md-6" >

                                    <!--Card-->
                                    <div class="card card-cascade narrower">

                                        <!--Card image-->
                                        <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                            <h4 class="mb-2  text-center text-white"><i class="fas fa-archive"></i> Contexto</h4 >
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="" target="_blank">Entendimiento de la Organización</a></li>
                                                <li><a href="" target="_blank">Expectativas</a><br>
                                                <div class="contenido_modificado" style="margin-left:40px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Partes interesadas</a></div>
                                                <div class="contenido_modificado" style="margin-left:44px;margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Matriz de requisitos Legales</a></div>
                                                </li>
                                                <li><a href="" target="_blank">Determinación de Alcance </a></li>
                                                <li><a href="" target="_blank">SGSI</a></li>

                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->



                                <!--Grid column-->
                                <div class="col-lg-3 col-md-6">

                                    <!--Card-->
                                    <div class="card card-cascade narrower">

                                        <!--Card image-->

                                        <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                            <h4 class="mb-2  text-center text-white"><i class="fas fa-child"></i> Liderazgo</h4 >
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="" target="_blank">Liderazgo y Compromiso</a></li>
                                                <li><a href="" target="_blank">Politica</a></li>
                                                <li><a href="" target="_blank">Roles y Responsabilidades</a></li>

                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->




                                <!--Grid column-->
                                <div class="col-lg-3 col-md-6">

                                    <!--Card-->
                                    <div class="card card-cascade narrower">

                                        <!--Card image-->
                                        <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                            <h4 class="mb-2  text-center text-white"><i class="fas fa-tasks"></i> Planificación</h4>
                                        </div>

                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="" target="_blank">Riesgos y Oportunidades</a></li>
                                                <li><a href="" target="_blank">Objetivos de Seguridad</a></li>

                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->




                                <!--Grid column-->
                                <div class="col-lg-3 col-md-6">

                                    <!--Card-->
                                    <div class="card card-cascade narrower">

                                        <!--Card image-->

                                        <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                            <h4 class="mb-2  text-center text-white"><i class="fas fa-headset"></i> Soporte</h4>
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="" target="_blank">Recursos</a></li>
                                                <li><a href="" target="_blank">Competencias</a></li>
                                                <li><a href="" target="_blank">Concientización</a>
                                                    <div class="contenido_modificado" style="margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Concientización SGSI</a></div>
                                                    <div class="contenido_modificado" style="margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Material Introducción SGSI</a></div>
                                                    <div class="contenido_modificado" style="margin-left:14px; margin-top:10px; font-size:11pt;"><a href="" target="_blank"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Material ISO 27001:2013</a></div>
                                                </li>
                                                <li><a href="" target="_blank">Comunicación</a></li>
                                                <li><a href="" target="_blank">Información Documentada</a></li>

                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->





                            <!--Grid row-->
                            <div class="row mt-5">

                                <!--Grid column-->
                              <div class="col-lg-3 col-md-6">

                                    <!--Card-->
                                    <div class="card card-cascade narrower">

                                        <!--Card image-->

                                        <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                            <h4 class="mb-2  text-center text-white"><i class="fas fa-briefcase"></i> Operación</h4>
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="" target="_blank">Planificación y Control</a></li>
                                                <li><a href="" target="_blank">Apreciación de Riesgos</a></li>
                                                <li><a href="" target="_blank">Tratamiento de los riesgos</a></li>


                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->


                                <div class="col-lg-3 col-md-6">

                                      <!--Card-->
                                      <div class="card card-cascade narrower">

                                          <!--Card image-->

                                          <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                              <h4 class="mb-2  text-center text-white"><i class="fas fa-file-signature"></i> Evaluación</h4>
                                          </div>
                                          <!--/Card image-->

                                          <!--Card content-->
                                          <div class="card-body card-body-cascade">

                                              <ul class="divided-list list-unstyled text-center">
                                                  <li><a href="" target="_blank">Monitoreo de Análisis</a></li>
                                                  <li><a href="" target="_blank">Auditoria Interna </a></li>
                                                  <li><a href="" target="_blank">Revisión por Dirección</a></li>


                                              </ul>

                                          </div>
                                          <!--/.Card content-->

                                      </div>
                                      <!--/.Card-->

                                  </div>
                                  <!--Grid column-->





                                  <div class="col-lg-3 col-md-6">

                                        <!--Card-->
                                        <div class="card card-cascade narrower">

                                            <!--Card image-->

                                            <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                <h4 class="mb-2  text-center text-white"><i class="fas fa-infinity"></i> Mejora</h4>
                                            </div>
                                            <!--/Card image-->

                                            <!--Card content-->
                                            <div class="card-body card-body-cascade">

                                                <ul class="divided-list list-unstyled text-center">
                                                    <li><a href="" target="_blank">Acciones Correctivas </a></li>
                                                    <li><a href="" target="_blank">Acciones de Mejora</a></li>



                                                </ul>

                                            </div>
                                            <!--/.Card content-->

                                        </div>
                                        <!--/.Card-->

                                    </div>
                                    <!--Grid column-->




                                    <div class="col-lg-3 col-md-6">

                                          <!--Card-->
                                          <div class="card card-cascade narrower">

                                              <!--Card image-->

                                              <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                  <h4 class="mb-2  text-center text-white"><i class="fas fa-calendar"></i> Planeación de Actividades</h4>
                                              </div>

                                              <!--/Card image-->

                                              <!--Card content-->
                                              <div class="card-body card-body-cascade">

                                                  <ul class="divided-list list-unstyled text-center">
                                                      <li><a href="" target="_blank">Actividades</a></li>



                                                  </ul>

                                              </div>
                                              <!--/.Card content-->

                                          </div>
                                          <!--/.Card-->

                                      </div>
                                      <!--Grid column-->


                            </div>
                            <!--Grid row-->















                            <!--Section: -->
                            <section id="">


                                <!--Title-->
                                <h4 class="text-info"><strong><i class="fas fa-globe text-info" style="margin-top:70px;margin-left:20px;"></i> ISO 22301</strong></h4>



                             <section id="">


                                  <!--Title-->
                                 <h4 class="text-info"><strong><i class="fas fa-globe text-info" style="margin-top:70px;margin-left:20px;"></i> ISO 31000</strong></h4>




                             <!--Section: -->
                             <section id="">

                                 <h2 class="title text-primary text-center" style="margin-top:40px;"><strong> Administración</strong></h2>





                                     <!--Grid row-->
                                     <div class="row mt-5">

                                         <!--Grid column-->
                                       <div class="col-lg-3 col-md-6">

                                             <!--Card-->
                                             <div class="card card-cascade narrower">

                                                 <!--Card image-->

                                                 <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                     <h4 class="mb-2  text-center text-white"><i class="fas fa-users"></i> Ajustes</h4>
                                                 </div>
                                                 <!--/Card image-->

                                                 <!--Card content-->
                                                 <div class="card-body card-body-cascade">

                                                     <ul class="divided-list list-unstyled text-center">
                                                         <li><a href="" target="_blank">Permisos</a></li>
                                                         <li><a href="" target="_blank">Roles</a></li>
                                                         <li><a href="" target="_blank">Usuarios</a></li>
                                                         <li><a href="" target="_blank">Controles</a></li>
                                                         <li><a href="" target="_blank">Audit Logs</a></li>
                                                         <li><a href="" target="_blank">Áreas</a></li>
                                                         <li><a href="" target="_blank">Organización</a></li>
                                                         <li><a href="" target="_blank">Tipos de Activos</a></li>
                                                         <li><a href="" target="_blank">Puestos</a></li>
                                                         <li><a href="" target="_blank">User Alerts</a></li>
                                                         <li><a href="" target="_blank">Sedes</a></li>
                                                         <li><a href="" target="_blank">Enlaces Ejecutar</a></li>
                                                         <li><a href="" target="_blank">Teams</a></li>
                                                         <li><a href="" target="_blank">Estado Incidentes</a></li>
                                                         <li><a href="" target="_blank">Estatus Plan de Trabajo</a></li>
                                                         <li><a href="" target="_blank">Estado Documentos</a></li>
                                                     </ul>

                                                 </div>
                                                 <!--/.Card content-->

                                             </div>
                                             <!--/.Card-->

                                         </div>
                                         <!--Grid column-->


                                         <div class="col-lg-3 col-md-6">

                                               <!--Card-->
                                               <div class="card card-cascade narrower">

                                                   <!--Card image-->

                                                   <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                       <h4 class="mb-2  text-center text-white"><i class="fas fa-cogs"></i> Plan de Trabajo Base</h4>
                                                   </div>
                                                   <!--/Card image-->

                                                   <div class="card-body card-body-cascade">

                                                       <ul class="divided-list list-unstyled text-center">
                                                           <li><a href="" target="_blank">Plan de Trabajo Base</a></li>




                                                       </ul>

                                                   </div>
                                                   <!--/.Card content-->


                                               </div>
                                               <!--/.Card-->

                                           </div>
                                           <!--Grid column-->





                                           <div class="col-lg-3 col-md-6">

                                                 <!--Card-->
                                                 <div class="card card-cascade narrower">

                                                     <!--Card image-->

                                                     <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                         <h4 class="mb-2  text-center text-white"><i class="fas fa-question"></i> Preguntas Frecuentes</h4>
                                                     </div>
                                                     <!--/Card image-->

                                                     <!--Card content-->
                                                     <div class="card-body card-body-cascade">

                                                         <ul class="divided-list list-unstyled text-center">
                                                             <li><a href="" target="_blank">Preguntas Frecuentes</a></li>


                                                         </ul>

                                                     </div>
                                                     <!--/.Card content-->

                                                 </div>
                                                 <!--/.Card-->

                                             </div>
                                             <!--Grid column-->




                                             <div class="col-lg-3 col-md-6">

                                                   <!--Card-->
                                                   <div class="card card-cascade narrower">

                                                       <!--Card image-->

                                                       <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                           <h4 class="mb-2  text-center text-white"><i class="fas fa-key"></i> Cambiar Contraseña</h4>
                                                       </div>

                                                       <!--/Card image-->

                                                       <!--Card content-->
                                                       <div class="card-body card-body-cascade">

                                                           <ul class="divided-list list-unstyled text-center">
                                                               <li><a href="" target="_blank">Cambiar Contraseña</a></li>



                                                           </ul>

                                                       </div>
                                                       <!--/.Card content-->

                                                   </div>
                                                   <!--/.Card-->

                                               </div>
                                               <!--Grid column-->


                                     </div>
                                     <!--Grid row-->






                                     <!--Grid row-->
                                     <div class="row mb-5 mt-5">

                                         <!--Grid column-->
                                         <div class="col-lg-6 col-md-6" >

                                             <!--Card-->
                                             <div class="card card-cascade narrower">

                                                 <!--Card image-->
                                                 <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                     <h4 class="mb-2  text-center text-white"><i class="fas fa-project-diagram"></i> Site Map</h4 >
                                                 </div>
                                                 <!--/Card image-->

                                                 <!--Card content-->
                                                 <div class="card-body card-body-cascade">

                                                     <ul class="divided-list list-unstyled text-center">
                                                         <li><a href="" target="_blank">Site Map</a></li>


                                                     </ul>

                                                 </div>
                                                 <!--/.Card content-->

                                             </div>
                                             <!--/.Card-->

                                         </div>
                                         <!--Grid column-->






                                         <!--Grid column-->
                                         <div class="col-lg-6 col-md-6">

                                             <!--Card-->
                                             <div class="card card-cascade narrower">

                                                 <!--Card image-->

                                                 <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                     <h4 class="mb-2  text-center text-white"><i class="fas fa-arrow-right"></i> Salir</h4>
                                                 </div>
                                                 <!--/Card image-->

                                                 <!--Card content-->
                                                 <div class="card-body card-body-cascade">

                                                     <ul class="divided-list list-unstyled text-center">
                                                         <li><a href="" target="_blank">Salir</a></li>
                                                     </ul>

                                                 </div>
                                                 <!--/.Card content-->

                                             </div>
                                             <!--/.Card-->

                                         </div>
                                         <!--Grid column-->

                                     </div>
                                     <!--Grid row-->

















              </div>
            </div>
          </div>

        </div>

@endsection
