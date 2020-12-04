<style>
.botoneje {
  float: right;
}

}

</style>
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:-30px;">
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link active" id="contexto-tab" data-toggle="tab" href="#contexto" role="tab" aria-controls="contexto" aria-selected="true"><span style="color:#3c3c44;">4. CONTEXTO DE LA ORGANIZACIÓN</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="liderazgo-tab" data-toggle="tab" href="#liderazgo" role="tab" aria-controls="liderazgo" aria-selected="false"><span style="color:#3c3c44;">5. LIDERAZGO</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="planificacion-tab" data-toggle="tab" href="#planificacion" role="tab" aria-controls="planificacion" aria-selected="false"><span style="color:#3c3c44;">6. PLANIFICACIÓN</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="soporte-tab" data-toggle="tab" href="#soporte" role="tab" aria-controls="soporte" aria-selected="false"><span style="color:#3c3c44;">7. SOPORTE</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="operacion-tab" data-toggle="tab" href="#operacion" role="tab" aria-controls="operacion" aria-selected="false"><span style="color:#3c3c44;">8. OPERACIÓN</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="evaluacion-tab" data-toggle="tab" href="#evaluacion" role="tab" aria-controls="evaluacion" aria-selected="false"><span style="color:#3c3c44;">9. EVALUACIÓN DEL DESEMPEÑO</span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a style="font-size: 11px;" class="nav-link" id="mejora-tab" data-toggle="tab" href="#mejora" role="tab" aria-controls="mejora" aria-selected="false"><span style="color:#3c3c44;">10. MEJORA</span></a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="contexto" role="tabpanel" aria-labelledby="contexto-tab">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 ">

                <ul class="list-group nav" class="nav" id="myTabJust" style="margin-top:15px;">
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-dos" data-toggle="tab" href="#informacion-dos" role="tab" aria-controls="informacion-dos" aria-selected="false"><span style="color:#3c3c44;">Objetivo del SGSI
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tres" data-toggle="tab" href="#informacion-tres" role="tab" aria-controls="informacion-tres" aria-selected="false"><span style="color:#3c3c44;">4.1 Entendimiento de<br> la Organización</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-cinco" data-toggle="tab" href="#informacion-cinco" role="tab" aria-controls="informacion-cinco" aria-selected="false"><span style="color:#3c3c44;">4.2 Partes Interesadas</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-seis" data-toggle="tab" href="#informacion-seis" role="tab" aria-controls="informacion-seis" aria-selected="false"><span style="color:#3c3c44;">4.3 Alcance del Sistema <br>de Gestión </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-sgsi" data-toggle="tab" href="#informacion-sgsi" role="tab" aria-controls="informacion-sgsi" aria-selected="false"><span style="color:#3c3c44;">4.4 Sistema de Gestión <br>de Seguridad de la Información</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-dos" role="tabpanel" aria-labelledby="informacion-tab-dos">

                        <div class="card">
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

Objetivo del SGSI.
</div>
<div class="card card-body text-black  bg-light mb-3" align="justify">

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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        4.1 Entendimiento de la Organización
</div>
                        
<div class="card card-body text-black  bg-light mb-3" align="justify">

 La organizacion debe determinar las cuestiones externas e internas que son pertinentes para su propósito y que afectan a su capacidad para lograr los resultados previstos de su sistema de gestión de seguridad de la información.
                            </div>
                            <div class="card-body ">
                                <p align="justify">Los siguientes son ejemplos de áreas que se pueden considerar al evaluar problemas internos que pueden afectar en los riesgos del SGSI:</p>
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
                   
                    <div class=" tab-pane fade" id="informacion-cinco" role="tabpanel" aria-labelledby="informacion-tab-cinco">
                        <div class="card">
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

4.2 Partes Interesadas
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

                               
                                La organización debe determinar: <br>a) Las partes interesadas que son pertinentes al Sistema de Gestión de Seguridad de la Información.<br>
                                b) Los requisitos de estas partes interesadas pertinentes a seguridad de la información.


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

4.3 Alcance del Sistema de Gestión
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

                                La empresa debe determinar los límites y la aplicabilidad del Sistema de Gestión de la Seguridad de la Información para establecer su alcance:

                                Cuando se determina este alcance, la empresa debe considerar:

                                a) Las cuestiones externas e internas referenciadas al numeral 4.1
                                b) Los requisitos referidos en el numeral 4.2
                                c) Las interfaces y dependencias entre las actividades realizadas por la empresa y la que realizan otras empresas

                                El alcance debe estar disponible como información documentada.
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

                    <!--informacion-tan-sgsi-->
                    <div class=" tab-pane fade" id="informacion-sgsi" role="tabpanel" aria-labelledby="informacion-sgsi">
                        <div class="card">
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        4.4 Sistema de Gestión de Seguridad de la Información
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

                               
                               La empresa debe establecer, implantar, mantener y mejorar continuamente un Sistema de Gestión de Seguridad de la Información, según a los requisitos de la norma ISO 27001 2013.


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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-liderazgo" data-toggle="tab" href="#informacion-liderazgo" role="tab" aria-controls="informacion-liderazgo" aria-selected="false"><span style="color:#3c3c44;">5.1 Liderazgo y Compromiso
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-politicaseg" data-toggle="tab" href="#informacion-politicaseg" role="tab" aria-controls="informacion-politicaseg" aria-selected="false"><span style="color:#3c3c44;">5.2 Política de Seguridad</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-rolesresp" data-toggle="tab" href="#informacion-rolesresp" role="tab" aria-controls="informacion-rolesresp" aria-selected="false"><span style="color:#3c3c44;">5.3 Roles y Responsabilidades</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                   
                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-liderazgo" role="tabpanel" aria-labelledby="informacion-tab-liderazgo">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

5.1 Liderazgo y Compromiso
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

                                La alta dirección debe demostrar liderazgo y compromiso con respecto al Sistema de Gestión de Seguridad de la Información:

<br>a) Asegurando que se establezcan la política de la seguridad de la información y los objetivos de la seguridad de la información, y que estos sean compatibles con la dirección estratégica de la empresa
<br>b) Asegurando la integración de los requisitos del Sistema de Gestión de Seguridad de la Información en los procesos de la empresa
<br>c) Asegura que los recursos necesarios para el Sistema de Gestión de Seguridad de la Información se encuentren disponibles
<br>d) Combinar la importancia de una gestión de la seguridad de la información eficaz y de la conformidad con los requisitos del Sistema de Gestión de Seguridad de la Información
<br>e) Se debe asegurar de que el Sistema de Gestión de la Seguridad de la Información logre los resultados previstos
<br>f) Dirigiendo y apoyando a las personas, para contribuir a la eficiencia del Sistema de Gestión de Seguridad de la Información
<br>g) Promover la mejora continua
<br>h) Apoyar otros roles pertinentes de la dirección, es necesario demostrar el liderazgo aplicado a sus áreas de responsabilidad
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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

5.2 Política de Seguridad
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La alta dirección debe establecer una política de la seguridad de la información que:a) Sea adecuada al propósito de la organización
<br>b) Incluya objetivos de seguridad de la información o proporcione el marco de referencia para el establecimiento de los objetivos de la seguridad de la información
<br>c) Incluye el compromiso de cumplir con los requisitos aplicables que se relacionan con la seguridad de la información
<br>d) Incluya el compromiso de mejora continua del Sistema de Gestión de Seguridad de la Información
La política de seguridad de la información debe:
<br>a) Estar disponible como información documentada
<br>b) Comunicarse dentro de la empresa
<br>c) Estar disponible para las partes interesada


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

5.3 Roles y Responsabilidades
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La alta dirección debe asegurarse de que las responsabilidades y autoridades para los roles pertinentes a la seguridad de la información sean asignados y comunicados.La alta dirección debe asignar la responsabilidad y autoridad para:
<br>a) Asegurarse de que el Sistema de Gestión de Seguridad de la Información sea conforme a los requisitos de la norma ISO 27001
<br>b) Informar a la alta dirección sobre el desempeño del Sistema de Gestión de Seguridad de la Información


                            </div>
                            <div class="card-body ">
                                <p align="justify">Para que las actividades de seguridad de la información formen parte de las actividades diarias de una organización, las responsabilidades estarán claramente definidas y comunicadas. Aunque no existe un requisito en el estándar para el nombramiento de un representante de seguridad de la información, para algunas organizaciones, puede ser útil designar a una persona para que lidere un equipo de seguridad de la información responsable de coordinar la capacitación, el control y el control. Informar el desempeño del SGSI a la gerencia. Esta persona puede ser la responsable de la protección de datos o los servicios de TI. Sin embargo, para funcionar con eficacia, idealmente sería parte de la gerencia con conocimientos de gestión de seguridad de la información.</p>
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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-evaluacionriesg" data-toggle="tab" href="#informacion-evaluacionriesg" role="tab" aria-controls="informacion-evaluacionriesg" aria-selected="false"><span style="color:#3c3c44;">6.1 Riesgos y Oportunidades
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tratamientoriesg" data-toggle="tab" href="#informacion-tratamientoriesg" role="tab" aria-controls="informacion-tratamientoriesg" aria-selected="false"><span style="color:#3c3c44;">6.2 Objetivos de Seguridad</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                   

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-evaluacionriesg" role="tabpanel" aria-labelledby="informacion-tab-evaluacionriesg">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

6.1 Riesgos y Oportunidades
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

6.1.1 GeneralidadesAl planificar el sistema de Gestión de Seguridad de la Información, la empresa debe considerar las cuestiones referidas en el numeral 4.1 y los requisitos a que se hace referencia en el numeral 4.2 y determinar los riesgos y oportunidades que es necesario tratar.
<br>6.1.2 Valoración de riesgos de la seguridad de la informaciónLa empresa debe definir y aplicar un proceso de valoración de riesgos de la seguridad de la información.
<br>6.1.3 Tratamiento de riesgos de la seguridad de la informaciónLa empresa debe definir y aplicar un proceso de tratamiento de riesgos de la seguridad de la información.La empresa debe conservar información documentada sobre el proceso de tratamiento de riesgos de la seguridad de la información.


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

6.2 Objetivos de Seguridad
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

                          
La empresa debe establecer los objetivos de seguridad de la información en las funciones y niveles pertinentes.Los objetivos de seguridad de la información:
<br>a) Ser coherentes con la política de seguridad de la información
<br>b) Ser medibles
<br>c) Tener en cuenta los requisitos de la seguridad de la información aplicada y los resultados de la valoración y el tratamiento de los riesgos
<br>d) Ser comunicados
<br>e) Ser actualizados según sea necesarioLa empresa debe conservar información documentada sobre los objetivos de la seguridad de la información. Cuando se hace la planificación para conseguir los objetivos de seguridad de la información, la empresa debe determinar:a) Lo que se va a hacer
<br>b) Los recursos que se requieren
<br>c) Quién será la persona responsable
<br>d) Cuando se finalizará
<br>e) Como se realizará la evaluación de resultados


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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-clausoporte" data-toggle="tab" href="#informacion-clausoporte" role="tab" aria-controls="informacion-clausoporte" aria-selected="false"><span style="color:#3c3c44;">7.1 Recursos
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-competencia" data-toggle="tab" href="#informacion-competencia" role="tab" aria-controls="informacion-competencia" aria-selected="false"><span style="color:#3c3c44;">7.2 Competencia</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-concientizacion" data-toggle="tab" href="#informacion-concientizacion" role="tab" aria-controls="informacion-concientizacion" aria-selected="false"><span style="color:#3c3c44;">7.3 Concienciación</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-comunicacionsiet" data-toggle="tab" href="#informacion-comunicacionsiet" role="tab" aria-controls="informacion-comunicacionsiet" aria-selected="false"><span style="color:#3c3c44;">7.4 Comunicación</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-informaciondoc" data-toggle="tab" href="#informacion-informaciondoc" role="tab" aria-controls="informacion-informaciondoc" aria-selected="false"><span style="color:#3c3c44;">7.5 Información documentada</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-clausoporte" role="tabpanel" aria-labelledby="informacion-tab-clausoporte">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

7.1 Recursos
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La organización debe determinar y proporcionar los recursos necesarios para el establecimiento, implementación, mantenimiento y mejora continua del Sistema de Gestión de Seguridad de la Información.


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

7.2 Competencia
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La organización debe:
<br>a) Determinar la competencia necesaria de las personas que realizan, bajo su control, un trabajo que afecta su desempeño de la seguridad de la información
<br>b) Asegurarse de que dichas personas sean competentes, basándose en la educación, formación o experiencia adecuadas
<br>c) Cuando se aplicable, tomar acciones para adquirir la competencia necesaria y evaluar la eficacia de las acciones
<br>d) Conservar la información documentada apropiada, como evidencia de la competencia


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

7.3 Concienciación
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La persona que realizan el trabajo bajo el control de la empresa deben tomar conciencia de:
<br>a) La política de seguridad de la información
<br>b) Su contribución a la eficacia del Sistema de Gestión de Seguridad de la Información incluyendo los beneficios de una mejora del desempeño de la seguridad de la información
<br>c) Las implicaciones dela no conformidad con los requisitos del Sistema de Gestión de Seguridad de la Información


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

7.4 Comunicación
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La organización debe determinar las necesidades de las comunicaciones internas y externas pertinentes al Sistema de Gestión de Seguridad de la Información, que incluyan:
<br>a) El contenido de la comunicación
<br>b) Cuando comunicar
<br>c) A quien comunicar
<br>d) Quien debe comunicar
<br>e) Los procesos para llevar a cabo la comunicación


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

7.5 Información documentada
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

7.5.1 Generalidades El Sistema de Gestión de Seguridad de la Información de la empresa debe incluir:
<br>a) La información documentada requerida por la norma ISO 27001
<br>b) La información documentada que la empresa debe determinar cómo necesaria para la eficacia del Sistema de Gestión de Seguridad de la Información
<br>7.5.2 Creación y actualizaciónCuando se crea y actualiza información documentada, la empresa debe asegurarse de que lo siguiente sea apropiado:
<br>a) Identificar y describir
<br>b) Formato y medio s de soporte
c) Revisión y aprobación con respecto a la identidad y adecuación
<br>7.5.3 Control de la información documentadaLa información documentada requerida por el Sistema de Gestión de Seguridad de la Información y por la norma ISO 27001 se debe controlar para asegurarse que:
<br>a) Debe estar disponible y adecuada para su uso, donde y cuando se necesite
<br>b) Tiene que estar protegida de forma adecuada
<br>Para el control de la información documentada, la organización debe tratar las siguientes actividades según se aplique:
<br>a) Distribución, acceso, recuperación y uso
<br>b) Almacenamiento y preservación
<br>c) Control de cambios
<br>d) Retención y disposición
<br>La información documentada de origen externo, que la empresa ha determinado que es necesario para la planificación y la operación del Sistema de Gestión de Seguridad de la Información, se debe identificar y controlar.


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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-clausoperacion" data-toggle="tab" href="#informacion-clausoperacion" role="tab" aria-controls="informacion-clausoperacion" aria-selected="false"><span style="color:#3c3c44;">8.1 Operación
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-evaluacionriesgo" data-toggle="tab" href="#informacion-evaluacionriesgo" role="tab" aria-controls="informacion-evaluacionriesgo" aria-selected="false"><span style="color:#3c3c44;">8.2 Evaluación de riesgos de la <br>seguridad de la información</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-tratamientriesg" data-toggle="tab" href="#informacion-tratamientriesg" role="tab" aria-controls="informacion-tratamientriesg" aria-selected="false"><span style="color:#3c3c44;">8.3 Tratamiento de riesgos de <br>seguridad de la información</span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>

                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-clausoperacion" role="tabpanel" aria-labelledby="informacion-tab-clausoperacion">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

8.1 Operación
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La organización debe planificar, implantar y controlar los procesos necesarios para cumplir con todos los requisitos de seguridad de la información y para implantar todas las acciones determinadas en el numeral 6.1. La empresa también debe implementar planes para conseguir los objetivos del Sistema de Gestión de Seguridad de la Información.
<br>La empresa debe mantener información documentada en la medida necesaria para tener la confianza en que los procesos se han llevado a cabo según lo planificado.
<br>La empresa debe controlar los cambios planificados y revisar todas las consecuencias de los cambio son previstos, tomando acciones para mitigar todos los efectos adversos, cuando sea necesario.
<br>La empresa se debe asegurar de que todos los procesos contratados externamente se encuentren controlados.


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

8.2 Evaluación de riesgos de la Seguridad de la información
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La empresa debe llevar a cabo valoraciones de riesgos de la seguridad de la información a intervalos planificados o cuando se propagan u ocurran cambios significativos, teniendo en cuenta los criterios establecidos.
<br>La empresa debe conservar información documentada de los resultados de las valoraciones de riesgos en cuanto a la seguridad de la información.


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

8.3 Tratamiento de riesgos de seguridad de la información
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La organización debe implantar el plan de tratamiento de riesgo de la seguridad de la información.
<br>La organización debe conservar información documentada de los resultados del tratamiento de riesgos de la seguridad de la información.

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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    

                    <li class="list-group-item nav-item">
                        <a class="nav-link  text-black" id="informacion-tab-segnaeva" data-toggle="tab" href="#informacion-segnaeva" role="tab" aria-controls="informacion-segnaeva" aria-selected="false"><span style="color:#3c3c44;"><span style="color:#3c3c44;">9.1 Seguimiento, medición, <br> análisis y evaluación</span></span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-auditint" data-toggle="tab" href="#informacion-auditint" role="tab" aria-controls="informacion-auditint" aria-selected="false"><span style="color:#3c3c44;"><span style="color:#3c3c44;">9.2 Auditorías internas</span></span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-revisdir" data-toggle="tab" href="#informacion-revisdir" role="tab" aria-controls="informacion-revisdir" aria-selected="false"><span style="color:#3c3c44;"><span style="color:#3c3c44;">9.3 Revisión por la dirección</span></span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>


                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <!--informacion dos-->
                    <div class=" tab-pane fade" id="informacion-segnaeva" role="tabpanel" aria-labelledby="informacion-tab-segnaeva">
                        <div class="card">
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

9.1 Seguimiento, medición, análisis y evaluación
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La empresa debe evaluar el desempeño de la seriedad de la información y la eficacia del Sistema de Gestión de Seguridad de la Información.
<br>La empresa debe determinar:
<br>a) A qué es necesario hacer seguimiento y qué es necesario medir, incluido los procesos y controles de la seguridad de la información
<br>b) Los métodos de seguimiento, medición, análisis y evaluación, según sea aplicable, para asegurar resultados válidos
<br>c) Cuándo se debe lleva a cabo el seguimiento y la medición
<br>d) Quién debe llevar a cabo el seguimiento y la medición
<br>e) Cuándo se deben analizar y evaluar todos los resultados del seguimiento y la medición
<br>f) Quien debe analizar y evaluar todos los resultados.La empresa debe conservar información documentada apropiada como evidencia de los resultados del monitoreo y la medición


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

9.2 Auditorías internas
</div>


<div class="card card-body text-black  bg-light mb-3" align="justify">

La empresa debe llevar a cabo las auditorías internas a intervalos planificados, para proporcionar información sobre el Sistema de Gestión de Seguridad de la Información:
<br>a) Está conforme con los requisitos de la empresa para su sistema de gestión y los requisitos de la norma ISO 27001
<br>b) Está implementado y mantenido de forma eficaz
<br>La organización debe:
<br>a) Planificar, establecer, implantar y mantener uno o varios programas de auditoría que incluyan la frecuencia, los métodos, las responsabilidades, los requisitos de planificación y la elaboración de informes. Los programas de auditoría deben tener en cuenta la importancia de los procesos involucrados y los resultados de las auditorías
<br>b) Para cada auditoría, definir los criterios y el alcance de ésta
<br>c) Seleccionar a los auditores y llevar a cabo auditorías para asegurarse la objetividad y la imparcialidad del proceso de auditoría
<br>d) Asegurase de que los resultados de las auditorías se informan a la dirección pertinente
<br>e) Conservar información documentada como evidencia de la implantación del programa de auditoría y de los resultados de ésta


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
                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

9.3 Revisión por la dirección
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La alta dirección debe revisar el Sistema de Gestión de Seguridad de la Información de la organización a intervalos planificados, para asegurarse de que su conveniencia, adecuación y eficacia son continuas.
<br>La revisión por la dirección debe incluir consideraciones sobre:
<br>a) El estado de las acciones con relación a las revisiones previas por la dirección
<br>b) Los cambios en las cuestiones externas e internas que sean pertinentes al Sistema de Gestión de Seguridad de la Información
<br>c) Retroalimentación sobre el desempeño de la seguridad de la información
<br>d) Retroalimentación de las partes interesadas
<br>e) Resultados de la valoración de riesgos y estado del plan de tratamiento de riesgos
<br>f) Las oportunidades de mejora continua
<br>Los elementos de salida de la revisión por la dirección deben incluir las decisiones relacionadas con las oportunidades de mejora continua y cualquier necesidad de cambio dentro del Sistema de Gestión de Seguridad de la Información.
<br>La organización debe conservar información documentada como evidencia de los resultados de las revisiones por la dirección.


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
                    <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

                        Clausula
                    </div>


                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-nocoformidad" data-toggle="tab" href="#informacion-nocoformidad" role="tab" aria-controls="informacion-nocoformidad" aria-selected="false"><span style="color:#3c3c44;">10.1 No Conformidades y <br> Acciónes Correctivas
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>
                    <li class="list-group-item nav-item">
                        <a class="nav-link" id="informacion-tab-mcontinua" data-toggle="tab" href="#informacion-mcontinua" role="tab" aria-controls="informacion-mcontinua" aria-selected="false"><span style="color:#3c3c44;">10.2 Mejora Continua
                            </span><i class="fas fa-arrow-alt-circle-right" style="float:right; -webkit-transform:scale(1.3); color:#048c74;"></i></a>
                    </li>



                </ul>

            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="tab-content" id="myTabContentJust" style="margin-top:15px;">


                    <div class="tab-pane fade" id="informacion-nocoformidad" role="tabpanel" aria-labelledby="informacion-tab-nocoformidad">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

10.1 No conformidades y acciónes correctivas
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

Cuando ocurra una no conformidad, la empresa debe:a) Reaccionar ante la no conformidad y según sea aplicable<br>
b) Evaluar la necesidad de acciones para eliminar las causa de la no conformidad, con el fin de que no vuelva a ocurrir ni ocurra en otra parte.
<br>c) Implantar cualquier acción necesaria
<br>d) Revisar la eficacia de las acciones correctivas tomadas
<br>e) Hacer cambios en el Sistema de Gestión de Seguridad de la Información
La organización debe conservar la información documentada adecuada, como evidencia de:
<br>a) La naturaleza de las no conformidades y cualquier acción posterior tomada
<br>b) Los resultados de cualquier acción correctiva


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

                     <div class="tab-pane fade" id="informacion-mcontinua" role="tabpanel" aria-labelledby="informacion-tab-mcontinua">

                        <div class="card">

                        <div class="card-header font-weight-bold  text-white" style="background-color:#048c74;" align="justify">

10.2 Mejora continua
</div>

<div class="card card-body text-black  bg-light mb-3" align="justify">

La empresa debe mejorar continuamente la conveniencia, adecuación y Sistema de Gestión de Seguridad de la Información.


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