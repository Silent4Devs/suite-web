<style>
.botoneje {
  float: right;
}

}

</style>
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:-30px;">
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link active" id="contexto-tab" data-toggle="tab" href="#contexto" role="tab" aria-controls="contexto" aria-selected="true">4. CONTEXTO DE LA ORGANIZACIÓN</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="liderazgo-tab" data-toggle="tab" href="#liderazgo" role="tab" aria-controls="liderazgo" aria-selected="false">5. LIDERAZGO</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="planificacion-tab" data-toggle="tab" href="#planificacion" role="tab" aria-controls="planificacion" aria-selected="false">6. PLANIFICACIÓN</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="soporte-tab" data-toggle="tab" href="#soporte" role="tab" aria-controls="soporte" aria-selected="false">7. SOPORTE</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="operacion-tab" data-toggle="tab" href="#operacion" role="tab" aria-controls="operacion" aria-selected="false">8. OPERACIÓN</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="evaluacion-tab" data-toggle="tab" href="#evaluacion" role="tab" aria-controls="evaluacion" aria-selected="false">9. EVALUACIÓN DEL DESEMPEÑO</a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="mejora-tab" data-toggle="tab" href="#mejora" role="tab" aria-controls="mejora" aria-selected="false">10. MEJORA</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="contexto" role="tabpanel" aria-labelledby="contexto-tab">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-dos" data-toggle="tab" href="#informacion-dos" role="tab" aria-controls="informacion-dos" aria-selected="false">Objetivo del SGSI
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tres" data-toggle="tab" href="#informacion-tres" role="tab" aria-controls="informacion-tres" aria-selected="false">Contexto interno<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-cuatro" data-toggle="tab" href="#informacion-cuatro" role="tab" aria-controls="informacion-cuatro" aria-selected="false">Contexto externo<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-cinco" data-toggle="tab" href="#informacion-cinco" role="tab" aria-controls="informacion-cinco" aria-selected="false">Partes interesadas<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-seis" data-toggle="tab" href="#informacion-seis" role="tab" aria-controls="informacion-seis" aria-selected="false">Alcance del sistema de gestión <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-dos" role="tabpanel" aria-labelledby="informacion-tab-dos">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                El objetivo del SGSI es proteger los activos de información de la empresa para que pueda lograr los objetivos.
                            </div>


                            <div class="card-body">
                                <p align="justify">La forma y el área de prioridad dependerán del entorno en el que opera la organización. Incluyendo los siguientes niveles:</p>

                                <p align="justify">• Interno: Aspectos que la organización puede controlar.</p>

                                <p align="justify">• Externo: Aspecto que la organización no puede controlar directamente.</p>
                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-12" style="margin-left:75%">
                                <a href="{{ route("admin.entendimiento-organizacions.index") }}" class="btn btn-info" role="button">Ejecutar</a>
                            </div>
                            <br>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-tres" role="tabpanel" aria-labelledby="informacion-tab-tres">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Los siguientes son ejemplos de áreas que se pueden considerar al evaluar problemas internos que pueden afectar en los riesgos del SGSI:
                            </div>
                            <div class="card-body ">
                                <p align="justify">• Nivel de Madurez</p>
                                <p align="justify">• Cultura organizativa</p>
                                <p align="justify">• Gestión</p>
                                <p align="justify">• Recursos</p>
                                <p align="justify">• Madurez de los recursos</p>
                                <p align="justify">• Formato de los activos de información:</p>
                                <p align="justify">• Sensibilidad/valor de los activos de información</p>
                                <p align="justify">• Consistencia</p>
                                <p align="justify">• Sistemas</p>
                                <p align="justify">• Complejidad del sistema</p>
                                <p align="justify">• Espacio físico</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-cuatro" role="tabpanel" aria-labelledby="informacion-tab-cuatro">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Los siguientes son ejemplos de áreas que se pueden considerar al evaluar problemas externos que pueden afectar en los riesgos del SGSI:
                            </div>
                            <div class="card-body ">
                                <p align="justify">• Competencia</p>
                                <p align="justify">• Dueño</p>
                                <p align="justify">• Organismos reguladores</p>
                                <p align="justify">• Económico/político</p>
                                <p align="justify">• Consideraciones ambientales</p>
                                <p align="justify">• Frecuencia de ataques a la información</p>
                                <p align="justify">• Accionistas</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <div class=" tab-pane fade" id="informacion-cinco" role="tabpanel" aria-labelledby="informacion-tab-cinco">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Partes interesadas:
                            </div>
                            <div class="card-body ">
                                <p align="justify">Una parte interesada es cualquier persona que pueda ser o se considere afectada por acciones u omisiones de la organización. A lo largo de todo el análisis de los problemas internos y externos, las partes interesadas permanecerán claras. Pueden incluir accionistas, propietarios, reguladores, clientes, empleados y competidores, y pueden extenderse al público y al medio ambiente, según la naturaleza del negocio. No es necesario que intente comprender o satisfacer todos los caprichos, pero determinarán qué necesidades y expectativas están relacionadas con el SGSI.</p>

                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-12" style="margin-left:75%">
                                <a href="{{ route("admin.partes-interesadas.index") }}" class="btn btn-info" role="button">Ejecutar</a>
                            </div>
                            <br>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-cinco-->
                    <div class=" tab-pane fade" id="informacion-seis" role="tabpanel" aria-labelledby="informacion-tab-cinco">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Alcance del sistema de gestión:
                            </div>
                            <div class="card-body ">
                                <p align="justify">• Para cumplir con esta norma, documentará el alcance del SGSI. El alcance generalmente describe:</p>
                                <p align="justify">• Incluir (o no incluir) la restricción de uno o más sitios físicos;</p>
                                <p align="justify">• Incluir (o excluir) restricciones de red físicas y lógicas;</p>
                                <p align="justify">• Incluir (o excluir) el grupo de empleados internos y externos;</p>
                                <p align="justify">• Incluir (o excluir) procesos, actividades o servicios internos y externos; y La interfaz crítica que está dentro de los límites del alcance.</p>

                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-12" style="margin-left:75%">
                                <a href="{{ route("admin.alcance-sgsis.index") }}" class="btn btn-info" role="button">Ejecutar</a>
                            </div>
                            <br>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-seis-->

                </div>
                <!--Tab-content-->
            </div>
        </div>
    </div>

    <!--Tab-liderazgo-->
    <div class="tab-pane fade" id="liderazgo" role="tabpanel" aria-labelledby="liderazgo-tab">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-liderazgo" data-toggle="tab" href="#informacion-liderazgo" role="tab" aria-controls="informacion-liderazgo" aria-selected="false">Liderazgo
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-politicaseg" data-toggle="tab" href="#informacion-politicaseg" role="tab" aria-controls="informacion-politicaseg" aria-selected="false">Política de seguridad<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-rolesresp" data-toggle="tab" href="#informacion-rolesresp" role="tab" aria-controls="informacion-rolesresp" aria-selected="false">Roles y responsabilidades<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-evidenciarlid" data-toggle="tab" href="#informacion-evidenciarlid" role="tab" aria-controls="informacion-evidenciarlid" aria-selected="false">Evidenciar el liderazgo<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-liderazgo" role="tabpanel" aria-labelledby="informacion-tab-liderazgo">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                Liderazgo
                            </div>


                            <div class="card-body ">
                                <p align="justify">Liderazgo significa participar activamente en la gestión del SGSI, promoviendo la implementación del SGSI y asegurando la disponibilidad de los recursos adecuados, incluyendo:</p>

                                <p align="justify">Asegurar que el SGSI y los objetivos sean claros y coherentes con la estrategia general.
                                    Responsabilidades claras.
                                    Que el razonamiento basado en el riesgo es el núcleo de todas las decisiones; y
                                    Que esta información se comunique claramente a todos dentro del alcance del SGSI.
                                </p>

                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-politicaseg" role="tabpanel" aria-labelledby="informacion-tab-politicaseg">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Política de seguridad:
                            </div>
                            <div class="card-body ">
                                <p align="justify">Una responsabilidad importante de un líder es establecer y documentar una política de seguridad de la información consistente con los principales objetivos de la organización. Incluirá metas o un marco para establecerlas. Para demostrar que cumple con los requisitos del entorno de la organización y las partes interesadas clave, se recomienda que consulte o incluya un resumen de los principales problemas y requisitos que se gestionarán al igual que incluirán un compromiso para:</p>
                                <p align="justify">• Cumplir con los requisitos aplicables relacionados con la seguridad de la información, como los requisitos legales, expectativas del cliente y compromisos contractuales; y</p>
                                <p align="justify">• Mejorar continuamente el SGSI.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-rolesresp" role="tabpanel" aria-labelledby="informacion-tab-rolesresp">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Roles y responsabilidades
                            </div>
                            <div class="card-body ">
                                <p align="justify">Para que las actividades de seguridad de la información formen parte de las actividades diarias de una organización, las responsabilidades estarán claramente definidas y comunicadas. Aunque no existe un requisito en el estándar para el nombramiento de un representante de seguridad de la información, para algunas organizaciones, puede ser útil designar a una persona para que lidere un equipo de seguridad de la información responsable de coordinar la capacitación, el control y el control. Informar el desempeño del SGSI a la gerencia. Esta persona puede ser la responsable de la protección de datos o los servicios de TI. Sin embargo, para funcionar con eficacia, idealmente sería parte de la gerencia con conocimientos de gestión de seguridad de la información.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <div class=" tab-pane fade" id="informacion-evidenciarlid" role="tabpanel" aria-labelledby="informacion-tab-evidenciarlid">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Evidenciar el liderazgo
                            </div>
                            <div class="card-body ">
                                <p align="justify">Los gerentes serán aquellos que marquen la dirección estratégica y aprueben la asignación de recursos organizacionales dentro del SGSI. Dependiendo de la estructura de la organización, estas pueden ser o no el equipo directivo. Normalmente, los auditores evaluarán las habilidades de liderazgo entrevistando a uno o más miembros de la gerencia y evaluando el nivel de participación en: </p>
                                <p align="justify">• Evaluación de riesgos y oportunidades;</p>
                                <p align="justify">• Desarrollar y comunicar políticas;</p>
                                <p align="justify">• Establecimiento y comunicación de metas;</p>
                                <p align="justify">• Revisar y comunicar el rendimiento del sistema;</p>
                                <p align="justify">• Asignar los recursos y responsabilidades adecuados.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-cinco-->


                </div>
                <!--Tab-content-->
            </div>
        </div>


    </div>
    <div class="tab-pane fade" id="planificacion" role="tabpanel" aria-labelledby="planificacion-tab">
        <!--contenido tab clausula 6-->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-evaluacionriesg" data-toggle="tab" href="#informacion-evaluacionriesg" role="tab" aria-controls="informacion-evaluacionriesg" aria-selected="false">Evaluación de riesgos
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tratamientoriesg" data-toggle="tab" href="#informacion-tratamientoriesg" role="tab" aria-controls="informacion-tratamientoriesg" aria-selected="false">Tratamiento de riesgos<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-objetivosseg" data-toggle="tab" href="#informacion-objetivosseg" role="tab" aria-controls="informacion-objetivosseg" aria-selected="false">Objetivos de seguridad de la información y planificación<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-evaluacionriesg" role="tabpanel" aria-labelledby="informacion-tab-evaluacionriesg">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                Evaluación de riesgos
                            </div>


                            <div class="card-body ">
                                <p align="justify">La evaluación de riesgos es el corazón de cualquier SGSI eficaz. Incluso la organización más inteligente no puede descartar la posibilidad de incidentes de seguridad de la información. La evaluación de riesgos es fundamental para:</p>

                                <p align="justify">• Incrementar la posibilidad de descubrir riesgos potenciales mediante la participación de personal que utilice métodos de evaluación sistemáticos;</p>
                                <p align="justify">• Asignar recursos para enfocarse en las áreas de mayor importancia;</p>
                                <p align="justify">• Toma de decisiones estratégicas sobre cómo gestionar los principales riesgos de seguridad de la información y alcanzar los objetivos.</p>

                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-tratamientoriesg" role="tabpanel" aria-labelledby="informacion-tab-tratamientoriesg">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Tratamiento de riesgos
                            </div>
                            <div class="card-body ">
                                <p align="justify">Para cada riesgo identificado en la evaluación de riesgos, aplicará criterios para determinar si:</p>
                                <p align="justify">• Acepta el riesgo.</p>
                                <p align="justify">• Trata el riesgo (tratamiento de riesgos).</p>

                                <p align="justify">Las opciones de tratamiento de riesgo incluyen las siguientes opciones:</p>
                                <p align="justify">• Evasión: detener las actividades o procesar la información que está expuesta al riesgo.</p>
                                <p align="justify">• Eliminación: Suprimir la fuente del riesgo.</p>
                                <p align="justify">• Cambio de probabilidad: Implementar un control que disminuya los incidentes de seguridad de la información.</p>
                                <p align="justify">• Cambio en las consecuencias: Implementar un control que disminuya el impacto si llegase a ocurrir un incidente.</p>
                                <p align="justify">• Transferencia del riesgo: Externalizar una actividad o proceso a un tercero que tenga mayor capacidad para administrar el riesgo.</p>
                                <p align="justify">• Aceptar el riesgo: Si la organización no tiene disponible un método de tratamiento de riesgos real, o si el costo del método de tratamiento de riesgos se considera mayor que el costo de impacto, la organización puede tomar la decisión de aceptar el riesgo, lo cual será aprobado por la gerencia.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-objetivosseg" role="tabpanel" aria-labelledby="informacion-tab-objetivosseg">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Objetivos de seguridad de la información y planificación
                            </div>
                            <div class="card-body ">
                                <p align="justify">En los niveles relevantes, se necesitará tener objetivos documentados y relacionados con la seguridad de la información. Estos pueden estar en un nivel superior y aplicarse en toda la organización o solo a nivel departamental.
                                    Cada objetivo establecido será:
                                </p>
                                <p align="justify">• Medible.</p>
                                <p align="justify">• Alineado a la política del SGSI.</p>
                                <p align="justify">• Considerado en los requisitos a nivel de seguridad de la información.</p>
                                <p align="justify">• Considerado en los resultados de la evaluación de riesgos y de las actividades del tratamiento de riesgos.</p>
                                <p align="justify">Los objetivos más importantes para la seguridad de la información incluyen:</p>
                                <p align="justify">• No exceder la frecuencia definida para ciertos tipos de incidentes de seguridad de la información.</p>
                                <p align="justify">• Logre un cumplimiento cuantificable con el control de seguridad de la información.</p>
                                <p align="justify">• Proporcionar disponibilidad definida en los servicios de información.</p>
                                <p align="justify">• No exceder el número de errores de datos medibles.</p>
                                <p align="justify">• Mejorar los recursos disponibles mediante selección, capacitación o adquisición.</p>
                                <p align="justify">• Implementar nuevas medidas de control.</p>
                                <p align="justify">• Cumplimiento las normas relativas a la seguridad de la información.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>

                    <!--informacion-cinco-->


                </div>
                <!--Tab-content-->
            </div>
        </div>
        <!--termino contenido tab clausula 6-->
    </div>
    <div class="tab-pane fade" id="soporte" role="tabpanel" aria-labelledby="soporte-tab">
        <!--contenido tab clausula 7-->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-clausoporte" data-toggle="tab" href="#informacion-clausoporte" role="tab" aria-controls="informacion-clausoporte" aria-selected="false">Soporte
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-competencia" data-toggle="tab" href="#informacion-competencia" role="tab" aria-controls="informacion-competencia" aria-selected="false">Competencia<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-concientizacion" data-toggle="tab" href="#informacion-concientizacion" role="tab" aria-controls="informacion-concientizacion" aria-selected="false">Concienciación<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-comunicacionsiet" data-toggle="tab" href="#informacion-comunicacionsiet" role="tab" aria-controls="informacion-comunicacionsiet" aria-selected="false">Comunicación<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-informaciondoc" data-toggle="tab" href="#informacion-informaciondoc" role="tab" aria-controls="informacion-informaciondoc" aria-selected="false">Información documentada<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-clausoporte" role="tabpanel" aria-labelledby="informacion-tab-clausoporte">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                Soporte
                            </div>


                            <div class="card-body ">
                                <p align="justify">La cláusula 7 se refiere a los recursos. Esto se aplica a las personas, infraestructura, medioambiente, recursos físicos, materiales, herramientas, etc. También existe un enfoque renovado en el conocimiento como un recurso importante dentro de la organización.
                                    Al planificar los objetivos de calidad, las consideraciones importantes son la capacidad actual y las capacidades de los recursos y la capacidad de los proveedores / socios externos.
                                </p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-competencia" role="tabpanel" aria-labelledby="informacion-tab-competencia">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Competencia
                            </div>
                            <div class="card-body ">
                                <p align="justify">La implementación de medidas efectivas de control de seguridad de la información depende del conocimiento y las habilidades en las siguientes áreas: Los empleados, proveedores y contratistas. Para garantizar una base suficiente de conocimientos y habilidades, deben:</p>
                                <p align="justify">• Definir los conocimientos y habilidades requeridos;</p>
                                <p align="justify">• Determinar quién necesita conocimientos y habilidades;</p>
                                <p align="justify">• Establecer métodos para evaluar si la persona adecuada tiene los conocimientos y las habilidades adecuados.</p>

                                <p align="justify">El auditor quiere que tenga documentos que detallen los requisitos de conocimientos y habilidades. Cuando crea que se cumplen los requisitos, es necesario utilizar registros como certificados de formación, registros de asistencia a cursos o evaluaciones de capacidad internas como respaldo.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-concientizacion" role="tabpanel" aria-labelledby="informacion-tab-concientizacion">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Concienciación
                            </div>
                            <div class="card-body ">
                                <p align="justify">Además de garantizar las capacidades del personal clave en términos de seguridad de la información, los empleados, proveedores y contratistas también comprenderán los elementos del SGSI. Esto es esencial para establecer una cultura de apoyo dentro de la organización. Todos los empleados, proveedores y contratistas considerarán lo siguiente:</p>
                                <p align="justify">• La existencia de SGSI y las razones del existir.</p>
                                <p align="justify">• Tiene una política y estrategia de seguridad de la información y los elementos relacionados.</p>
                                <p align="justify">• Cómo pueden ayudar a las organizaciones a proteger la información y cómo ayudarán a las organizaciones a lograr los objetivos de seguridad de la información.</p>
                                <p align="justify">• Qué políticas, procedimientos y medidas de control se relacionan con ellos, y cuáles son las consecuencias de no cumplir con estas regulaciones</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-cuatro-->
                    <div class=" tab-pane fade" id="informacion-comunicacionsiet" role="tabpanel" aria-labelledby="informacion-tab-comunicacionsiet">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Comunicación
                            </div>
                            <div class="card-body ">
                                <p align="justify">Para que los procesos del SGSI se ejecuten de forma eficaz, se asegurará de haber planificado y gestionado cuidadosamente las actividades de comunicación. La norma los especifica de manera concisa al exigirle que determine lo siguiente:</p>
                                <p align="justify">• Qué se necesita comunicar;</p>
                                <p align="justify">• Cuando comunicarse;</p>
                                <p align="justify">• Con quién necesita comunicarse;</p>
                                <p align="justify">• Quién es responsable de la comunicación;</p>
                                <p align="justify">• Cuál es el proceso o los procesos de comunicación.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-cinco-->
                    <div class=" tab-pane fade" id="informacion-informaciondoc" role="tabpanel" aria-labelledby="informacion-tab-informaciondoc">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Información documentada
                            </div>
                            <div class="card-body ">
                                <p align="justify">Para ser útil, la información documentada para implementar y mantener SGSI debe:</p>
                                <p align="justify">• Ser preciso.</p>
                                <p align="justify">• Que las personas que lo usan de manera regular o irregular pueden entender.</p>
                                <p align="justify">• Apoyarlo para cumplir con los requisitos legales, gestionar los riesgos y lograr los objetivos.</p>
                                <p align="justify">Para que la información del documento siempre cumpla con estos requisitos, necesitará algunos procesos para garantizar que:</p>
                                <p align="justify">• A solicitud del personal apropiado, la información documentada se revisará antes de ser divulgada al público.</p>
                                <p align="justify">• El acceso a la información del documento está controlado, por lo que las personas no pueden modificarlo, destruirlo, eliminarlo o acceder a él sin permiso.</p>
                                <p align="justify">• La información se elimina de forma segura o se devuelve al propietario cuando es necesario.</p>
                                <p align="justify">• Puede realizar un seguimiento de los cambios en la información para asegurarse de que el proceso esté bajo control.</p>
                                <p align="justify">La fuente de información de archivo puede ser interna o externa, por lo que el proceso de control administrará la información de archivo de ambas fuentes al mismo tiempo.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>

                    <!--informacion-cinco-->


                </div>
                <!--Tab-content-->
            </div>
        </div>
        <!--termino contenido tab clausula 7-->
    </div>
    <div class="tab-pane fade" id="operacion" role="tabpanel" aria-labelledby="operacion-tab">
        <!--contenido tab clausula 8-->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-clausoperacion" data-toggle="tab" href="#informacion-clausoperacion" role="tab" aria-controls="informacion-clausoperacion" aria-selected="false">Operación
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-evaluacionriesgo" data-toggle="tab" href="#informacion-evaluacionriesgo" role="tab" aria-controls="informacion-evaluacionriesgo" aria-selected="false">Evaluación de riesgos de la <br>seguridad de la información<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tratamientriesg" data-toggle="tab" href="#informacion-tratamientriesg" role="tab" aria-controls="informacion-tratamientriesg" aria-selected="false">Tratamiento de riesgos de <br>seguridad de la información<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-clausoperacion" role="tabpanel" aria-labelledby="informacion-tab-clausoperacion">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                Operación
                            </div>


                            <div class="card-body ">
                                <p align="justify">Administrar los riesgos de seguridad de la información y alcanzar las metas requiere la formalización de las actividades en un conjunto de procesos claros y coherentes.
                                    Es probable que muchos de los procesos ya se encuentren en existencia y simplemente se necesiten modificaciones para incluir elementos relevantes para la seguridad de la información. Otros procesos pueden ser ad-hoc (por ejemplo, aprobaciones de proveedores), o no existir aún (por ejemplo, auditoría interna).
                                </p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-evaluacionriesgo" role="tabpanel" aria-labelledby="informacion-tab-evaluacionriesgo">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Evaluación de riesgos de la seguridad de la información
                            </div>
                            <div class="card-body ">
                                <p align="justify">Los métodos de evaluación de riesgos referenciados en la cláusula 6 se aplicarán a todos los procesos, activos, información y actividades en el alcance del SGSI.
                                    Como los riesgos no son estáticos, los resultados de las evaluaciones se revisarán con frecuencia, por lo menos una vez al año, o en caso contrario si en la evaluación se identifica la presencia de uno o más riesgos relevantes. Los riesgos también se revisarán siempre que:
                                </p>
                                <p align="justify">• Se finalice un tratamiento de riesgos</p>
                                <p align="justify">• Se produzcan cambios en los activos, información o los procesos de la organización;</p>
                                <p align="justify">• Se identifiquen nuevos riesgos;</p>
                                <p align="justify">• La información indique que la probabilidad y consecuencia del riesgo identificado ha sido cambiado.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-tratamientriesg" role="tabpanel" aria-labelledby="informacion-tab-tratamientriesg">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Tratamiento de riesgos de seguridad de la información
                            </div>
                            <div class="card-body ">
                                <p align="justify">El plan de tratamiento de riesgos que desarrolle no solo puede ser una declaración de intenciones, sino que se implementará. Cuando se requieren cambios para tener en cuenta nueva información sobre riesgos y cambios en los criterios de evaluación de riesgos, el plan se actualizará y volverse a autorizar.</p>
                                <p align="justify">También se evaluará el impacto del plan y se registrarán los resultados de la evaluación. Esto se puede hacer como parte de una auditoría interna o un proceso de auditoría de gestión, o se puede hacer mediante el uso de evaluaciones técnicas, como pruebas de penetración de la red, auditorías de proveedores o auditorías de terceros no anunciadas.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>



                </div>
                <!--Tab-content-->
            </div>
        </div>
        <!--termino contenido tab clausula 8-->
    </div>
    <div class="tab-pane fade" id="evaluacion" role="tabpanel" aria-labelledby="evaluacion-tab">
        <!--contenido tab clausula 9-->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-clausevalu" data-toggle="tab" href="#informacion-clausevalu" role="tab" aria-controls="informacion-clausevalu" aria-selected="false">Evaluación del desempeño
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-segnaeva" data-toggle="tab" href="#informacion-segnaeva" role="tab" aria-controls="informacion-segnaeva" aria-selected="false">Seguimiento, medición, análisis y evaluación<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-auditint" data-toggle="tab" href="#informacion-auditint" role="tab" aria-controls="informacion-auditint" aria-selected="false">Auditorías internas<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-revisdir" data-toggle="tab" href="#informacion-revisdir" role="tab" aria-controls="informacion-revisdir" aria-selected="false">Revisión por la dirección<i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>


                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-clausevalu" role="tabpanel" aria-labelledby="informacion-tab-clausevalu">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                Evaluación del desempeño
                            </div>


                            <div class="card-body ">
                                <p align="justify">Hay 3 maneras de evaluar el rendimiento del SGSI:</p>
                                <p align="justify">• Seguimiento de la efectividad de los controles de SGSI.</p>
                                <p align="justify">• Auditorías internas.</p>
                                <p align="justify">• En la revisión por la dirección.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-segnaeva" role="tabpanel" aria-labelledby="informacion-tab-segnaeva">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Seguimiento, medición, análisis y evaluación
                            </div>
                            <div class="card-body ">
                                <p align="justify">La organización decidirá que controlar para asegurarse de que el proceso del SGSI y los controles de seguridad de la información funcionen como se espera. No es práctico controlarlo todo el tiempo. Si intenta hacerlo, la cantidad de datos puede ser tan grande que en realidad será imposible utilizarlos de manera eficaz. Entonces, de hecho, tomarán una decisión informada sobre qué monitorear.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-tres-->
                    <div class=" tab-pane fade" id="informacion-auditint" role="tabpanel" aria-labelledby="informacion-tab-auditint">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Auditorías internas
                            </div>
                            <div class="card-body ">
                                <p align="justify">El objetivo de las auditorías internas es evaluar las deficiencias en los procesos del SGSI e identificar oportunidades de mejora. También proporcionan una verificación de la realidad para la gerencia sobre el rendimiento del SGSI. Las auditorías internas pueden ayudarlo a evitar situaciones inesperadas en las auditorías externas.</p>
                                <p align="justify">Las auditorías internas comprobarán:</p>
                                <p align="justify">• La congruencia del seguimiento de los procesos, procedimientos y controles;</p>
                                <p align="justify">• El éxito de los procesos, procedimientos y controles para conseguir las metas esperadas;</p>
                                <p align="justify">• Si el SGSI cumple con la norma ISO 27001 y los requisitos de las partes interesadas.</p>
                            </div>
                        </div>
                        <!--card-->
                    </div>
                    <!--informacion-cuatro-->
                    <div class=" tab-pane fade" id="informacion-revisdir" role="tabpanel" aria-labelledby="informacion-tab-revisdir">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                Revisión por la dirección
                            </div>
                            <div class="card-body ">
                                <p align="justify">La revisión por la dirección es un elemento indispensable del SGSI.
                                    Este es el momento oficial para que la gerencia revise la efectividad del SGSI y se asegure de que esté alineado con la dirección estratégica de la organización. La revisión por la dirección se realiza a intervalos planificados y el plan de revisión general cubre al menos la lista de áreas básicas especificadas en la sección 9.3 de la norma.
                                    No es necesario que celebre una sola reunión de revisión de la dirección que cubra toda la agenda. Si actualmente tiene una serie de reuniones que cubren áreas básicas esenciales, no es necesario que las repita.
                                    Conservará información escrita sobre dichas revisiones por la dirección. Por lo general, el acta de la reunión, o si se va a realizar una conferencia telefónica, puede ser una grabación de la llamada. No es necesario que sean extensos, pero contendrá registros de decisiones y acciones acordadas, incluidas responsabilidades y plazos
                                </p>
                            </div>
                        </div>
                        <!--card-->
                    </div>



                </div>
                <!--Tab-content-->
            </div>
        </div>
        <!--termino contenido tab clausula 9-->
    </div>
    <div class="tab-pane fade" id="mejora" role="tabpanel" aria-labelledby="mejora-tab">
        <!--contenido tab clausula 10-->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header bg-primary text-white text-center">
                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-nocoformidad" data-toggle="tab" href="#informacion-nocoformidad" role="tab" aria-controls="informacion-nocoformidad" aria-selected="false">No conformidad y <br> acción correctiva
                            <i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3);"></i></a>
                    </li>



                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-nocoformidad" role="tabpanel" aria-labelledby="informacion-tab-nocoformidad">

                        <div class="card">

                            <div class="card-header bg-primary text-white text-center">
                                No conformidad y acción correctiva
                            </div>


                            <div class="card-body ">
                                <p align="justify">Se pueden lograr mejoras al conocer los incidentes de seguridad, los problemas encontrados durante las auditorías, los problemas de rendimiento, las quejas de las partes interesadas y los conocimientos generados durante las revisiones por la dirección.</p>
                                <p align="justify">Para cada oportunidad identificada, se mantendrán registros de:</p>
                                <p align="justify">• Que pasó.</p>
                                <p align="justify">• Si el evento tiene consecuencias adversas, qué medidas se tomarán para controlarlo y mitigarlo.</p>
                                <p align="justify">• La causa raíz del incidente (si se determina).</p>
                                <p align="justify">• Medidas tomadas para eliminar la causa raíz (si es necesario).</p>
                                <p align="justify">• Evaluación de la eficacia de las medidas adoptadas.</p>
                            </div>

                        </div>
                        <!--card-->
                    </div>





                </div>
                <!--Tab-content-->
            </div>
        </div>
        <!--termino contenido tab clausula 10-->
    </div>
</div>