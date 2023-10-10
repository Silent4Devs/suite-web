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


                  <div class=" col-md-11 col-sm-10  py-2 card card-body bg-info align-self-center " style=" margin-left:40px;  z-index:20;">
                      <h4 class="mb-2  text-center text-white"><i class="fas fa-home"></i> Menú</h4 >
                  </div>


                    <!--Grid column-->
                    <div class="col-lg-6 col-md-6" style="margin-top:-80px;">

                        <!--Card-->
                        <div class="card card-cascade narrower mt-5">





                                <ul class="divided-list list-unstyled text-center">
                                    <li><a href="{{ route("admin.organizacions.index") }}" > Mi organización</a>
                                    </li>
                                    <li><a href="{{ route("admin.home") }}">Dashboard</a>
                                    </li>

                                    <li><a href="{{ route("admin.implementacions.index") }}"> Implementación</a>
                                    <div class="contenido_modificado" style="margin-right:20px;margin-top:10px; font-size:11pt;"><a><p class="text-primary"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Introducción</a></p></div>
                                    <div class="contenido_modificado" style="margin-left:55px;margin-top:10px; font-size:11pt;"><a><p class="text-primary"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Guía de Implementación</a></p></div>
                                    <div class="contenido_modificado" style="margin-left:33px;margin-top:10px; font-size:11pt;"><a><p class="text-primary"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Plan de Trabajo Base</a></p></div>
                                    <div class="contenido_modificado" style="margin-left:27px;margin-top:10px; font-size:11pt;"><a><p class="text-primary"><i class="fas fa-circle" style="-webkit-transform:scale(.6);"></i> Consultoría en línea</a></p></div>
                                  </li>

                                </ul>

                            </div>
                            <!--/.Card content-->

                        </div>
                        <!--/.Card-->






                        <!--Grid column-->
                        <div class="col-lg-6 col-md-6"style="margin-top:-80px;">

                            <!--Card-->
                            <div class="card card-cascade narrower mt-5">

                                <!--Card image-->




                                <ul class="divided-list list-unstyled text-center">
                                    <li><a href="{{ route("admin.carpeta.index") }}"> Documentos</a>
                                    </li>
                                    <li><a href="{{ route("admin.systemCalendar") }}">Calendario</a>
                                    </li>
                                    <li><a href="{{ route("admin.glosarios.index") }}">Glosario</a>
                                    </li>
                                </ul>
                            </div>

                          </div>

                      </div>
                      <!--Grid column-->



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
                                            <h4 class="mb-2 text-center text-white"><i class="fas fa-archive"></i> Contexto</h4 >
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-body card-body-cascade">

                                            <ul class="divided-list list-unstyled text-center">
                                                <li><a href="{{ route("admin.entendimiento-organizacions.index") }}" >Entendimiento de la Organización</a></li>
                                                <li><a href="{{ route("admin.partes-interesadas.index") }}" > Partes interesadas</a></li>
                                                <li><a href="{{ route("admin.matriz-requisito-legales.index") }}" >Matriz de requisitos Legales</a></li>
                                                <li><a href="{{ route("admin.alcance-sgsis.index") }}" >Determinación de Alcance </a></li>


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
                                                <li><a href="{{ route("admin.comiteseguridads.index") }}">Conformación del Comité de Seguridad</a></li>
                                                <li><a href="{{ route("admin.minutasaltadireccions.index") }}">Minutas de Sesiones con Alta Direccion</a></li>
                                                <li><a href="{{ route("admin.evidencias-sgsis.index") }}" >Evidencias de Asignación de Recursos al SGSI</a></li>
                                                <li><a href="{{ route("admin.politica-sgsis.index") }}" >Política del Sistema de Gestión</a></li>
                                                <li><a href="{{ route("admin.roles-responsabilidades.index") }}">Roles y Responsabilidades</a></li>
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
                                                <li><a href="{{ route("admin.riesgosoportunidades.index") }}">Riesgos y Oportunidades</a></li>
                                                <li><a href="{{ route("admin.objetivosseguridads.index") }}">Objetivos de Seguridad</a></li>

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
                                                <li><a href="{{ route("admin.recursos.index") }}">Recursos</a></li>
                                                <li><a href="{{ route("admin.competencia.index") }}">Competencias</a></li>
                                                <li><a href="{{ route("admin.concientizacion-sgis.index") }}">Concientización SGSI</a></li>
                                                <li><a href="{{ route("admin.material-sgsis.index") }}">Material SGSI</a></li>
                                                <li><a href="{{ route("admin.material-iso-veinticientes.index") }}" > Material ISO 27001:2013</a></li>
                                                <li><a href="{{ route("admin.comunicacion-sgis.index") }}">Comunicación SGSI</a></li>
                                                <li><a href="{{ route("admin.politica-del-sgsi-soportes.index") }}">Política de SGSI</a></li>
                                                <li><a href="{{ route("admin.control-accesos.index") }}">Control de Accesos</a></li>
                                                <li><a href="{{ route("admin.informacion-documetadas.index") }}">Información Documentada</a></li>

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
                              <div class="col-lg-4 col-md-6">

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
                                                <li><a  href="{{ route("admin.planificacion-controls.index") }}">Planificación y Control</a></li>
                                                <li><a href="{{ route("admin.activos.index") }}">Apreciación de Riesgos</a></li>
                                                <li><a href="{{ route("admin.tratamiento-riesgos.index") }}">Tratamiento de los riesgos</a></li>


                                            </ul>

                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                    <!--/.Card-->

                                </div>
                                <!--Grid column-->


                                <div class="col-lg-4 col-md-6">

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
                                                  <li><a href="{{ route("admin.indicadores-sgsis.index") }}">Indicadores SGSI</a></li>
                                                  <li><a href="{{ route("admin.incidentes-de-seguridads.index") }}">Incidentes de Seguridad </a></li>
                                                  <li><a href="{{ route("admin.indicadorincidentessis.index") }}">Indicador Incidentes</a></li>
                                                  <li><a href="{{ route("admin.auditoria-anuals.index") }}">Programa Anual de Auditoria</a></li>
                                                  <li><a href="{{ route("admin.plan-auditoria.index") }}">Plan de Auditoria</a></li>
                                                  <li><a href="{{ route("admin.auditoria-internas.index") }}">Auditoria Interna</a></li>
                                                  <li><a href="{{ route("admin.revision-direccions.index") }}">Revisión por dirección </a></li>
                                              </ul>

                                          </div>
                                          <!--/.Card content-->

                                      </div>
                                      <!--/.Card-->

                                  </div>
                                  <!--Grid column-->





                                  <div class="col-lg-4 col-md-6">

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
                                                    <li><a href="{{ route("admin.accion-correctivas.index") }}">Acción Correctiva </a></li>
                                                    <li><a href="{{ route("admin.planaccion-correctivas.index") }}" >Plan Acción</a></li>
                                                    <li><a href="{{ route("admin.registromejoras.index") }}" >Registro Mejora</a></li>
                                                    <li><a href="{{ route("admin.dmaics.index") }}">DMAIC</a></li>
                                                    <li><a href="{{ route("admin.plan-mejoras.index") }}">Plan Implementación</a></li>
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
                                <h4 class="text-info"><strong><i class="fas fa-globe text-info" style="margin-top:30px;margin-left:20px;"></i> ISO 22301</strong></h4>



                                <!--Grid row-->
                                <div class="row mb-5 mt-5">

                                    <!--Grid column-->
                                    <div class="col-lg-12 col-md-6" >

                                        <!--Card-->
                                        <div class="card card-cascade narrower">

                                            <!--Card image-->
                                            <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                <h4 class="mb-2 text-center text-white"><i class="fas fa-archive"></i> ISO 22301</h4 >
                                            </div>
                                            <!--/Card image-->

                                            <!--Card content-->
                                            <div class="card-body card-body-cascade">

                                                <ul class="divided-list list-unstyled text-center">
                                                    <li><a href="{{ route("admin.adquirirveintidostrecientosunos.index") }}">Adquirir Módulo</a></li>

                                                </ul>

                                            </div>
                                            <!--/.Card content-->

                                        </div>
                                        <!--/.Card-->

                                    </div>

                                </div>

                             <section id="">


                                  <!--Title-->
                                 <h4 class="text-info"><strong><i class="fas fa-globe text-info" style="margin-left:20px;"></i> ISO 31000</strong></h4>



                                       <!--Grid row-->
                                       <div class="row mb-5 mt-5">

                                           <!--Grid column-->
                                           <div class="col-lg-12 col-md-6" >

                                               <!--Card-->
                                               <div class="card card-cascade narrower">

                                                   <!--Card image-->
                                                   <div class="col-md-11 col-sm-9 py-2 card card-body bg-info align-self-center " style="margin-top:-25px;">
                                                       <h4 class="mb-2 text-center text-white"><i class="fas fa-archive"></i> ISO 31000</h4 >
                                                   </div>
                                                   <!--/Card image-->

                                                   <!--Card content-->
                                                   <div class="card-body card-body-cascade">

                                                       <ul class="divided-list list-unstyled text-center">
                                                           <li><a href="{{ route("admin.adquirirtreintaunmils.index") }}" >Adquirir Módulo</a></li>

                                                       </ul>

                                                   </div>
                                                   <!--/.Card content-->

                                               </div>
                                               <!--/.Card-->

                                           </div>

                                       </div>

                             <!--Section: -->
                             <section id="">

                                 <h2 class="title text-primary text-center" style="margin-top:40px;"><strong> Administración</strong></h2>





                                     <!--Grid row-->
                                     <div class="row mt-5 ">

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
                                                         <li><a href="{{ route("admin.permissions.index") }}">Permisos</a></li>
                                                         <li><a href="{{ route("admin.roles.index") }}">Roles</a></li>
                                                         <li><a href="{{ route("admin.users.index") }}">Usuarios</a></li>
                                                         <li><a href="{{ route("admin.controles.index") }}">Controles</a></li>
                                                         <li><a href="{{ route("admin.audit-logs.index") }}">Audit Logs</a></li>
                                                         <li><a href="{{ route("admin.areas.index") }}">Áreas</a></li>
                                                         <li><a href="{{ route("admin.organizaciones.index") }}">Organización</a></li>
                                                         <li><a href="{{ route("admin.tipoactivos.index") }}">Tipos de Activos</a></li>
                                                         <li><a href="{{ route("admin.puestos.index") }}">Puestos</a></li>
                                                         <li><a href="{{ route("admin.user-alerts.index") }}">User Alerts</a></li>
                                                         <li><a href="{{ route("admin.sedes.index") }}">Sedes</a></li>
                                                         <li><a href="{{ route("admin.enlaces-ejecutars.index") }}">Enlaces Ejecutar</a></li>
                                                         <li><a href="{{ route("admin.teams.index") }}">Teams</a></li>
                                                         <li><a href="{{ route("admin.estado-incidentes.index") }}">Estado Incidentes</a></li>
                                                         <li><a href="{{ route("admin.estatus-plan-trabajos.index") }}">Estatus Plan de Trabajo</a></li>
                                                         <li><a href="{{ route("admin.estado-documentos.index") }}">Estado Documentos</a></li>
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
                                                           <li><a href="{{ route("admin.plan-base-actividades.index") }}">Plan de Trabajo Base</a></li>




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
                                                             <li><a href="{{ route("admin.faq-questions.index") }}" >Preguntas Frecuentes</a></li>


                                                         </ul>

                                                     </div>
                                                     <!--/.Card content-->

                                                 </div>
                                                 <!--/.Card-->

                                             </div>
                                             <!--Grid column-->







                                         <!--Grid column-->
                                         <div class="col-lg-3 col-md-6" >

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
                                                         <li><a href="{{ url('sitemap') }}">Site Map</a></li>


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
