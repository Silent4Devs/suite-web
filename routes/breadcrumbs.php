<?php

Breadcrumbs::for('admin.iso27001.index', function ($trail) {
    $trail->push('ISO 27001', route('admin.iso27001.index'));
});

Breadcrumbs::for('admin.analisis-brechas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Análisis de Brechas', route('admin.analisis-brechas.index'));
});

Breadcrumbs::for('admin.planTrabajoBase.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Plan de Implementación', route('admin.planTrabajoBase.index'));
});

Breadcrumbs::for('admin.declaracion-aplicabilidad.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Declaración de Aplicabilidad', route('admin.declaracion-aplicabilidad.index'));
});

Breadcrumbs::for('admin.partes-interesadas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Partes Interesadas', route('admin.partes-interesadas.index'));
});
Breadcrumbs::for('admin.partes-interesadas.create', function ($trail) {
    $trail->parent('admin.partes-interesadas.index');
    $trail->push('Formulario', route('admin.partes-interesadas.create'));
});

Breadcrumbs::for('admin.matriz-requisito-legales.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Matriz de Requisitos Legales', route('admin.matriz-requisito-legales.index'));
});
Breadcrumbs::for('admin.matriz-requisito-legales.create', function ($trail) {
    $trail->parent('admin.matriz-requisito-legales.index');
    $trail->push('Formulario', route('admin.matriz-requisito-legales.create'));
});

Breadcrumbs::for('admin.entendimiento-organizacions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('FODA', route('admin.entendimiento-organizacions.index'));
});
Breadcrumbs::for('admin.entendimiento-organizacions.create', function ($trail) {
    $trail->parent('admin.entendimiento-organizacions.index');
    $trail->push('Formulario', route('admin.entendimiento-organizacions.create'));
});

Breadcrumbs::for('admin.alcance-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Determinación de Alcance', route('admin.alcance-sgsis.index'));
});
Breadcrumbs::for('admin.alcance-sgsis.create', function ($trail) {
    $trail->parent('admin.alcance-sgsis.index');
    $trail->push('Formulario', route('admin.alcance-sgsis.create'));
});

// Breadcrumbs::for('admin..index', function ($trail) {
// $trail->parent('admin.iso27001.index');                   generar reporte-------------
// $trail->push('', route('admin..index'));
// });

Breadcrumbs::for('admin.comiteseguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('admin.iso27001.index') . '#liderazgo');
    $trail->push('Conformación del Comité de Seguridad', route('admin.comiteseguridads.index'));
});
Breadcrumbs::for('admin.comiteseguridads.create', function ($trail) {
    $trail->parent('admin.comiteseguridads.index');
    $trail->push('Formulario', route('admin.comiteseguridads.create'));
});
Breadcrumbs::for('admin.comiteseguridads.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Comite de Seguridad');
});

Breadcrumbs::for('admin.minutasaltadireccions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('admin.iso27001.index') . '#liderazgo');
    $trail->push('Minutas de Sesiones con Alta Dirección', route('admin.minutasaltadireccions.index'));
});
Breadcrumbs::for('admin.minutasaltadireccions.create', function ($trail) {
    $trail->parent('admin.minutasaltadireccions.index');
    $trail->push('Formulario', route('admin.minutasaltadireccions.create'));
});

Breadcrumbs::for('admin.evidencias-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('admin.iso27001.index') . '#liderazgo');
    $trail->push('Evidencia de Asignación de Recursos al SGSI', route('admin.evidencias-sgsis.index'));
});
Breadcrumbs::for('admin.evidencias-sgsis.create', function ($trail) {
    $trail->parent('admin.evidencias-sgsis.index');
    $trail->push('Formulario', route('admin.evidencias-sgsis.create'));
});

Breadcrumbs::for('admin.politica-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('admin.iso27001.index') . '#liderazgo');
    $trail->push('Política SGSI', route('admin.politica-sgsis.index'));
});
Breadcrumbs::for('admin.politica-sgsis.create', function ($trail) {
    $trail->parent('admin.politica-sgsis.index');
    $trail->push('Formulario', route('admin.politica-sgsis.create'));
});

Breadcrumbs::for('admin.politicaSgsis.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Politica SGSI');
});

Breadcrumbs::for('admin.roles-responsabilidades.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('admin.iso27001.index') . '#liderazgo');
    $trail->push('Roles y Responsabilidades', route('admin.roles-responsabilidades.index'));
});
Breadcrumbs::for('admin.roles-responsabilidades.create', function ($trail) {
    $trail->parent('admin.roles-responsabilidades.index');
    $trail->push('Formulario', route('admin.roles-responsabilidades.create'));
});

Breadcrumbs::for('admin.amenazas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Amenazas', route('admin.amenazas.index'));
});

Breadcrumbs::for('admin.vulnerabilidads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Vulnerabilidades', route('admin.vulnerabilidads.index'));
});

Breadcrumbs::for('admin.analisis-riesgos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Matriz de Riesgos', route('admin.analisis-riesgos.index'));
});

Breadcrumbs::for('admin.riesgosoportunidades.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Riesgos y Oportunidades', route('admin.riesgosoportunidades.index'));
});
Breadcrumbs::for('admin.riesgosoportunidades.create', function ($trail) {
    $trail->parent('admin.riesgosoportunidades.index');
    $trail->push('Formulario', route('admin.riesgosoportunidades.create'));
});

Breadcrumbs::for('admin.objetivosseguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Objetivos de Seguridad', route('admin.objetivosseguridads.index'));
});
Breadcrumbs::for('admin.objetivosseguridads.create', function ($trail) {
    $trail->parent('admin.objetivosseguridads.index');
    $trail->push('Formulario', route('admin.objetivosseguridads.create'));
});

Breadcrumbs::for('admin.recursos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Capacitaciones', route('admin.recursos.index'));
});
Breadcrumbs::for('admin.recursos.create', function ($trail) {
    $trail->parent('admin.recursos.index');
    $trail->push('Formulario', route('admin.recursos.create'));
});

// Breadcrumbs::for('admin.competencia.index', function ($trail) {
//  	$trail->parent('admin.iso27001.index');
//     $trail->push('Soporte',route('admin.iso27001.index').'#soporte');
//  	$trail->push('Competencias', route('admin.competencia.index'));
// });

// Breadcrumbs::for('admin.competencia.create', function ($trail) {
//     $trail->parent('admin.competencia.index');
//     $trail->push('Formulario', route('admin.competencia.create'));
// });

Breadcrumbs::for('admin.competencia.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Competencias', route('admin.buscarCV') . '#soporte');
});

Breadcrumbs::for('admin.concientizacion-sgis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Concientización SGSI', route('admin.concientizacion-sgis.index'));
});
Breadcrumbs::for('admin.concientizacion-sgis.create', function ($trail) {
    $trail->parent('admin.concientizacion-sgis.index');
    $trail->push('Formulario', route('admin.concientizacion-sgis.create'));
});

Breadcrumbs::for('admin.material-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Material SGSI', route('admin.material-sgsis.index'));
});
Breadcrumbs::for('admin.material-sgsis.create', function ($trail) {
    $trail->parent('admin.material-sgsis.index');
    $trail->push('Formulario', route('admin.material-sgsis.create'));
});

Breadcrumbs::for('admin.material-iso-veinticientes.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Material ISO 27001:2013', route('admin.material-iso-veinticientes.index'));
});
Breadcrumbs::for('admin.material-iso-veinticientes.create', function ($trail) {
    $trail->parent('admin.material-iso-veinticientes.index');
    $trail->push('Formulario', route('admin.material-iso-veinticientes.create'));
});

Breadcrumbs::for('admin.comunicacion-sgis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Comunicación SGSI', route('admin.comunicacion-sgis.index'));
});
Breadcrumbs::for('admin.comunicacion-sgis.create', function ($trail) {
    $trail->parent('admin.comunicacion-sgis.index');
    $trail->push('Formulario', route('admin.comunicacion-sgis.create'));
});

Breadcrumbs::for('admin.politica-del-sgsi-soportes.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Política del SGSI', route('admin.politica-del-sgsi-soportes.index'));
});

Breadcrumbs::for('admin.control-accesos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Control de Acceso', route('admin.control-accesos.index'));
});
Breadcrumbs::for('admin.control-accesos.create', function ($trail) {
    $trail->parent('admin.control-accesos.index');
    $trail->push('Formulario', route('admin.control-accesos.create'));
});

Breadcrumbs::for('admin.informacion-documetadas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Información Documentada', route('admin.informacion-documetadas.index'));
});
Breadcrumbs::for('admin.informacion-documetadas.create', function ($trail) {
    $trail->parent('admin.informacion-documetadas.index');
    $trail->push('Formulario', route('admin.informacion-documetadas.create'));
});

Breadcrumbs::for('admin.planificacion-controls.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Operación', route('admin.iso27001.index') . '#operacion');
    $trail->push('Planificación y Control', route('admin.planificacion-controls.index'));
});
Breadcrumbs::for('admin.planificacion-controls.create', function ($trail) {
    $trail->parent('admin.planificacion-controls.index');
    $trail->push('Formulario', route('admin.planificacion-controls.create'));
});

Breadcrumbs::for('admin.tratamiento-riesgos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Operación', route('admin.iso27001.index') . '#operacion');
    $trail->push('Tratamiento de los Riesgos', route('admin.tratamiento-riesgos.index'));
});
Breadcrumbs::for('admin.tratamiento-riesgos.create', function ($trail) {
    $trail->parent('admin.tratamiento-riesgos.index');
    $trail->push('Formulario', route('admin.tratamiento-riesgos.create'));
});

Breadcrumbs::for('admin.indicadores-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Indicadores SGSI', route('admin.indicadores-sgsis.index'));
});
Breadcrumbs::for('admin.indicadores-sgsis.create', function ($trail) {
    $trail->parent('admin.indicadores-sgsis.index');
    $trail->push('Formulario', route('admin.indicadores-sgsis.create'));
});

Breadcrumbs::for('admin.incidentes-de-seguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Incidentes de Seguridad', route('admin.incidentes-de-seguridads.index'));
});
Breadcrumbs::for('admin.incidentes-de-seguridads.create', function ($trail) {
    $trail->parent('admin.incidentes-de-seguridads.index');
    $trail->push('Formulario', route('admin.incidentes-de-seguridads.create'));
});

Breadcrumbs::for('admin.indicadorincidentessis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Indicador de Incidentes', route('admin.indicadorincidentessis.index'));
});

Breadcrumbs::for('admin.auditoria-anuals.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Programa Anual de Auditoría', route('admin.auditoria-anuals.index'));
});
Breadcrumbs::for('admin.auditoria-anuals.create', function ($trail) {
    $trail->parent('admin.auditoria-anuals.index');
    $trail->push('Formulario', route('admin.auditoria-anuals.create'));
});

Breadcrumbs::for('admin.plan-auditoria.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Plan de Auditoría', route('admin.plan-auditoria.index'));
});
Breadcrumbs::for('admin.plan-auditoria.create', function ($trail) {
    $trail->parent('admin.plan-auditoria.index');
    $trail->push('Formulario', route('admin.plan-auditoria.create'));
});

Breadcrumbs::for('admin.auditoria-internas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Auditoría Interna', route('admin.auditoria-internas.index'));
});
Breadcrumbs::for('admin.auditoria-internas.create', function ($trail) {
    $trail->parent('admin.auditoria-internas.index');
    $trail->push('Formulario', route('admin.auditoria-internas.create'));
});

Breadcrumbs::for('admin.revision-direccions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('admin.iso27001.index') . '#evaluacion');
    $trail->push('Revisión por Dirección', route('admin.revision-direccions.index'));
});
Breadcrumbs::for('admin.revision-direccions.create', function ($trail) {
    $trail->parent('admin.revision-direccions.index');
    $trail->push('Formulario', route('admin.revision-direccions.create'));
});

Breadcrumbs::for('admin.accion-correctivas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Mejora', route('admin.iso27001.index') . '#mejora');
    $trail->push('Acciones Correctivas', route('admin.accion-correctivas.index'));
});
Breadcrumbs::for('admin.accion-correctivas.create', function ($trail) {
    $trail->parent('admin.accion-correctivas.index');
    $trail->push('Formulario', route('admin.accion-correctivas.create'));
});

Breadcrumbs::for('admin.registromejoras.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Mejora', route('admin.iso27001.index') . '#mejora');
    $trail->push('Registro de Mejoras', route('admin.registromejoras.index'));
});
Breadcrumbs::for('admin.registromejoras.create', function ($trail) {
    $trail->parent('admin.registromejoras.index');
    $trail->push('Formulario', route('admin.registromejoras.create'));
});

Breadcrumbs::for('admin.portal-comunicacion.reportes', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Reportes');
});

Breadcrumbs::for('admin.portal-comunicacion.sedes-organizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Sedes');
});

Breadcrumbs::for('admin.comunicacion-sgis.show', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Comunicados');
});

// Breadcrumbs::for('admin..index', function ($trail) {
// $trail->parent('admin.iso27001.index');
// $trail->push('', route('admin..index'));
// });

//##############################################################
//#################### RECURSOS HUMANOS #######################
//############################################################
Breadcrumbs::for('Evaluacion360', function ($trail) {
    $trail->push('RH - Evaluación 360 Grados', route('admin.rh-evaluacion360.index'));
});

Breadcrumbs::for('EV360-Evaluaciones', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Evaluaciones', route('admin.ev360-evaluaciones.index'));
});

Breadcrumbs::for('EV360-Evaluaciones-Create', function ($trail) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Crear Evaluación', route('admin.ev360-evaluaciones.create'));
});

Breadcrumbs::for('EV360-Evaluaciones-Evaluacion', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Evaluación', route('admin.ev360-evaluaciones.evaluacion', $evaluacion->id));
});

Breadcrumbs::for('EV360-Competencias', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Competencias', route('admin.ev360-competencias.index'));
});
Breadcrumbs::for('EV360-Competencias-Create', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Crear Competencia', route('admin.ev360-competencias.create'));
});
Breadcrumbs::for('EV360-Competencias-Edit', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Editar Competencia', '/recursos-humanos/evaluacion-360/evaluaciones/*/evaluacion');
});

Breadcrumbs::for('EV360-Competencias-Por-Puesto', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Competencias por puesto', route('admin.ev360-competencias-por-puesto.index'));
});
Breadcrumbs::for('EV360-Competencias-Por-Puesto-Create', function ($trail) {
    $trail->parent('EV360-Competencias-Por-Puesto');
    $trail->push('Asignar competencia al puesto', 'recursos-humanos/evaluacion-360/competencias-por-puesto/*/create');
});

Breadcrumbs::for('EV360-Objetivos', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Objetivos', route('admin.ev360-objetivos.index'));
});
Breadcrumbs::for('EV360-Objetivos-Create', function ($trail, $empleado) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Asignar Objetivo', route('admin.ev360-objetivos-empleado.create', $empleado));
});
Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Editar Objetivo', '/recursos-humanos/evaluacion-360/objetivos/*/edit');
});

Breadcrumbs::for('EV360-Evaluacion-Resumen', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion);
    $trail->push($evaluacion->nombre, '/recursos-humanos/evaluacion-360/evaluacion/*/resumen');
});
Breadcrumbs::for('EV360-Evaluacion-Consulta-Evaluado', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push($evaluacion['evaluado']->name, route('admin.ev360-evaluaciones.autoevaluacion.consulta.evaluado', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id]));
});
Breadcrumbs::for('EV360-Evaluacion-Cuestionario', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push('Cuestionario', route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id, 'evaluador' => $evaluacion['evaluador']->id]));
});
// Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
//     $trail->parent('EV360-Objetivos');
//     $trail->push('Editar Objetivo', route('admin.ev360-objetivos.edit'));
// });

Breadcrumbs::for('frontend.iso27001.index', function ($trail) {
    $trail->push('ISO 27001', route('frontend.iso27001.index'));
});

Breadcrumbs::for('frontend.analisis-brechas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('Análisis de Brechas', route('frontend.analisis-brechas.index'));
});

Breadcrumbs::for('frontend.planTrabajoBase.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('Plan de Implementación', route('frontend.planTrabajoBase.index'));
});

Breadcrumbs::for('frontend.declaracion-aplicabilidad.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Declaración de Aplicabilidad', route('frontend.declaracion-aplicabilidad.index'));
});

Breadcrumbs::for('frontend.partes-interesadas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('Partes Interesadas', route('frontend.partes-interesadas.index'));
});
Breadcrumbs::for('frontend.partes-interesadas.create', function ($trail) {
    $trail->parent('frontend.partes-interesadas.index');
    $trail->push('Formulario', route('frontend.partes-interesadas.create'));
});

Breadcrumbs::for('frontend.matriz-requisito-legales.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('Matriz de Requisitos Legales', route('frontend.matriz-requisito-legales.index'));
});
Breadcrumbs::for('frontend.matriz-requisito-legales.create', function ($trail) {
    $trail->parent('frontend.matriz-requisito-legales.index');
    $trail->push('Formulario', route('frontend.matriz-requisito-legales.create'));
});

Breadcrumbs::for('frontend.entendimiento-organizacions.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('FODA', route('frontend.entendimiento-organizacions.index'));
});
Breadcrumbs::for('frontend.entendimiento-organizacions.create', function ($trail) {
    $trail->parent('frontend.entendimiento-organizacions.index');
    $trail->push('Formulario', route('frontend.entendimiento-organizacions.create'));
});

Breadcrumbs::for('frontend.alcance-sgsis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Contexto', route('frontend.iso27001.index') . '#contexto');
    $trail->push('Determinación de Alcance', route('frontend.alcance-sgsis.index'));
});
Breadcrumbs::for('frontend.alcance-sgsis.create', function ($trail) {
    $trail->parent('frontend.alcance-sgsis.index');
    $trail->push('Formulario', route('frontend.alcance-sgsis.create'));
});

// Breadcrumbs::for('frontend..index', function ($trail) {
// $trail->parent('frontend.iso27001.index');                   generar reporte-------------
// $trail->push('', route('frontend..index'));
// });

Breadcrumbs::for('frontend.comiteseguridads.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Liderazgo', route('frontend.iso27001.index') . '#liderazgo');
    $trail->push('Conformación del Comité de Seguridad', route('frontend.comiteseguridads.index'));
});
Breadcrumbs::for('frontend.comiteseguridads.create', function ($trail) {
    $trail->parent('frontend.comiteseguridads.index');
    $trail->push('Formulario', route('frontend.comiteseguridads.create'));
});
Breadcrumbs::for('frontend.comiteseguridads.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('frontend.portal-comunicacion.index'));
    $trail->push('Comite de Seguridad');
});

Breadcrumbs::for('frontend.minutasaltadireccions.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Liderazgo', route('frontend.iso27001.index') . '#liderazgo');
    $trail->push('Minutas de Sesiones con Alta Dirección', route('frontend.minutasaltadireccions.index'));
});
Breadcrumbs::for('frontend.minutasaltadireccions.create', function ($trail) {
    $trail->parent('frontend.minutasaltadireccions.index');
    $trail->push('Formulario', route('frontend.minutasaltadireccions.create'));
});

Breadcrumbs::for('frontend.evidencias-sgsis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Liderazgo', route('frontend.iso27001.index') . '#liderazgo');
    $trail->push('Evidencia de Asignación de Recursos al SGSI', route('frontend.evidencias-sgsis.index'));
});
Breadcrumbs::for('frontend.evidencias-sgsis.create', function ($trail) {
    $trail->parent('frontend.evidencias-sgsis.index');
    $trail->push('Formulario', route('frontend.evidencias-sgsis.create'));
});

Breadcrumbs::for('frontend.politica-sgsis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Liderazgo', route('frontend.iso27001.index') . '#liderazgo');
    $trail->push('Política SGSI', route('frontend.politica-sgsis.index'));
});
Breadcrumbs::for('frontend.politica-sgsis.create', function ($trail) {
    $trail->parent('frontend.politica-sgsis.index');
    $trail->push('Formulario', route('frontend.politica-sgsis.create'));
});

Breadcrumbs::for('frontend.politicaSgsis.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('frontend.portal-comunicacion.index'));
    $trail->push('Politica SGSI');
});

Breadcrumbs::for('frontend.roles-responsabilidades.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Liderazgo', route('frontend.iso27001.index') . '#liderazgo');
    $trail->push('Roles y Responsabilidades', route('frontend.roles-responsabilidades.index'));
});
Breadcrumbs::for('frontend.roles-responsabilidades.create', function ($trail) {
    $trail->parent('frontend.roles-responsabilidades.index');
    $trail->push('Formulario', route('frontend.roles-responsabilidades.create'));
});

Breadcrumbs::for('frontend.amenazas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Amenazas', route('frontend.amenazas.index'));
});

Breadcrumbs::for('frontend.vulnerabilidads.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Vulnerabilidades', route('frontend.vulnerabilidads.index'));
});

Breadcrumbs::for('frontend.analisis-riesgos.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Matriz de Riesgos', route('frontend.analisis-riesgos.index'));
});

Breadcrumbs::for('frontend.riesgosoportunidades.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Riesgos y Oportunidades', route('frontend.riesgosoportunidades.index'));
});
Breadcrumbs::for('frontend.riesgosoportunidades.create', function ($trail) {
    $trail->parent('frontend.riesgosoportunidades.index');
    $trail->push('Formulario', route('frontend.riesgosoportunidades.create'));
});

Breadcrumbs::for('frontend.objetivosseguridads.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Planificación', route('frontend.iso27001.index') . '#planificacion');
    $trail->push('Objetivos de Seguridad', route('frontend.objetivosseguridads.index'));
});
Breadcrumbs::for('frontend.objetivosseguridads.create', function ($trail) {
    $trail->parent('frontend.objetivosseguridads.index');
    $trail->push('Formulario', route('frontend.objetivosseguridads.create'));
});

Breadcrumbs::for('frontend.recursos.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Capacitaciones', route('frontend.recursos.index'));
});
Breadcrumbs::for('frontend.recursos.create', function ($trail) {
    $trail->parent('frontend.recursos.index');
    $trail->push('Formulario', route('frontend.recursos.create'));
});

// Breadcrumbs::for('frontend.competencia.index', function ($trail) {
//  	$trail->parent('frontend.iso27001.index');
//     $trail->push('Soporte',route('frontend.iso27001.index').'#soporte');
//  	$trail->push('Competencias', route('frontend.competencia.index'));
// });

// Breadcrumbs::for('frontend.competencia.create', function ($trail) {
//     $trail->parent('frontend.competencia.index');
//     $trail->push('Formulario', route('frontend.competencia.create'));
// });

Breadcrumbs::for('frontend.competencia.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Competencias', route('frontend.buscarCV') . '#soporte');
});

Breadcrumbs::for('frontend.concientizacion-sgis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Concientización SGSI', route('frontend.concientizacion-sgis.index'));
});
Breadcrumbs::for('frontend.concientizacion-sgis.create', function ($trail) {
    $trail->parent('frontend.concientizacion-sgis.index');
    $trail->push('Formulario', route('frontend.concientizacion-sgis.create'));
});

Breadcrumbs::for('frontend.material-sgsis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Material SGSI', route('frontend.material-sgsis.index'));
});
Breadcrumbs::for('frontend.material-sgsis.create', function ($trail) {
    $trail->parent('frontend.material-sgsis.index');
    $trail->push('Formulario', route('frontend.material-sgsis.create'));
});

Breadcrumbs::for('frontend.material-iso-veinticientes.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Material ISO 27001:2013', route('frontend.material-iso-veinticientes.index'));
});
Breadcrumbs::for('frontend.material-iso-veinticientes.create', function ($trail) {
    $trail->parent('frontend.material-iso-veinticientes.index');
    $trail->push('Formulario', route('frontend.material-iso-veinticientes.create'));
});

Breadcrumbs::for('frontend.comunicacion-sgis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Comunicación SGSI', route('frontend.comunicacion-sgis.index'));
});
Breadcrumbs::for('frontend.comunicacion-sgis.create', function ($trail) {
    $trail->parent('frontend.comunicacion-sgis.index');
    $trail->push('Formulario', route('frontend.comunicacion-sgis.create'));
});

Breadcrumbs::for('frontend.politica-del-sgsi-soportes.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Política del SGSI', route('frontend.politica-del-sgsi-soportes.index'));
});

Breadcrumbs::for('frontend.control-accesos.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Control de Acceso', route('frontend.control-accesos.index'));
});
Breadcrumbs::for('frontend.control-accesos.create', function ($trail) {
    $trail->parent('frontend.control-accesos.index');
    $trail->push('Formulario', route('frontend.control-accesos.create'));
});

Breadcrumbs::for('frontend.informacion-documetadas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Soporte', route('frontend.iso27001.index') . '#soporte');
    $trail->push('Información Documentada', route('frontend.informacion-documetadas.index'));
});
Breadcrumbs::for('frontend.informacion-documetadas.create', function ($trail) {
    $trail->parent('frontend.informacion-documetadas.index');
    $trail->push('Formulario', route('frontend.informacion-documetadas.create'));
});

Breadcrumbs::for('frontend.planificacion-controls.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Operación', route('frontend.iso27001.index') . '#operacion');
    $trail->push('Planificación y Control', route('frontend.planificacion-controls.index'));
});
Breadcrumbs::for('frontend.planificacion-controls.create', function ($trail) {
    $trail->parent('frontend.planificacion-controls.index');
    $trail->push('Formulario', route('frontend.planificacion-controls.create'));
});

Breadcrumbs::for('frontend.tratamiento-riesgos.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Operación', route('frontend.iso27001.index') . '#operacion');
    $trail->push('Tratamiento de los Riesgos', route('frontend.tratamiento-riesgos.index'));
});
Breadcrumbs::for('frontend.tratamiento-riesgos.create', function ($trail) {
    $trail->parent('frontend.tratamiento-riesgos.index');
    $trail->push('Formulario', route('frontend.tratamiento-riesgos.create'));
});

Breadcrumbs::for('frontend.indicadores-sgsis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Indicadores SGSI', route('frontend.indicadores-sgsis.index'));
});
Breadcrumbs::for('frontend.indicadores-sgsis.create', function ($trail) {
    $trail->parent('frontend.indicadores-sgsis.index');
    $trail->push('Formulario', route('frontend.indicadores-sgsis.create'));
});

Breadcrumbs::for('frontend.incidentes-de-seguridads.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Incidentes de Seguridad', route('frontend.incidentes-de-seguridads.index'));
});
Breadcrumbs::for('frontend.incidentes-de-seguridads.create', function ($trail) {
    $trail->parent('frontend.incidentes-de-seguridads.index');
    $trail->push('Formulario', route('frontend.incidentes-de-seguridads.create'));
});

Breadcrumbs::for('frontend.indicadorincidentessis.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Indicador de Incidentes', route('frontend.indicadorincidentessis.index'));
});

Breadcrumbs::for('frontend.auditoria-anuals.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Programa Anual de Auditoría', route('frontend.auditoria-anuals.index'));
});
Breadcrumbs::for('frontend.auditoria-anuals.create', function ($trail) {
    $trail->parent('frontend.auditoria-anuals.index');
    $trail->push('Formulario', route('frontend.auditoria-anuals.create'));
});

Breadcrumbs::for('frontend.plan-auditoria.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Plan de Auditoría', route('frontend.plan-auditoria.index'));
});
Breadcrumbs::for('frontend.plan-auditoria.create', function ($trail) {
    $trail->parent('frontend.plan-auditoria.index');
    $trail->push('Formulario', route('frontend.plan-auditoria.create'));
});

Breadcrumbs::for('frontend.auditoria-internas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Auditoría Interna', route('frontend.auditoria-internas.index'));
});
Breadcrumbs::for('frontend.auditoria-internas.create', function ($trail) {
    $trail->parent('frontend.auditoria-internas.index');
    $trail->push('Formulario', route('frontend.auditoria-internas.create'));
});

Breadcrumbs::for('frontend.revision-direccions.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Evaluacion', route('frontend.iso27001.index') . '#evaluacion');
    $trail->push('Revisión por Dirección', route('frontend.revision-direccions.index'));
});
Breadcrumbs::for('frontend.revision-direccions.create', function ($trail) {
    $trail->parent('frontend.revision-direccions.index');
    $trail->push('Formulario', route('frontend.revision-direccions.create'));
});

Breadcrumbs::for('frontend.accion-correctivas.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Mejora', route('frontend.iso27001.index') . '#mejora');
    $trail->push('Acciones Correctivas', route('frontend.accion-correctivas.index'));
});
Breadcrumbs::for('frontend.accion-correctivas.create', function ($trail) {
    $trail->parent('frontend.accion-correctivas.index');
    $trail->push('Formulario', route('frontend.accion-correctivas.create'));
});

Breadcrumbs::for('frontend.registromejoras.index', function ($trail) {
    $trail->parent('frontend.iso27001.index');
    $trail->push('Mejora', route('frontend.iso27001.index') . '#mejora');
    $trail->push('Registro de Mejoras', route('frontend.registromejoras.index'));
});
Breadcrumbs::for('frontend.registromejoras.create', function ($trail) {
    $trail->parent('frontend.registromejoras.index');
    $trail->push('Formulario', route('frontend.registromejoras.create'));
});

Breadcrumbs::for('frontend.portal-comunicacion.reportes', function ($trail) {
    $trail->push('Portal de comunicación', route('frontend.portal-comunicacion.index'));
    $trail->push('Reportes');
});

Breadcrumbs::for('frontend.portal-comunicacion.sedes-organizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('frontend.portal-comunicacion.index'));
    $trail->push('Sedes');
});

Breadcrumbs::for('frontend.comunicacion-sgis.show', function ($trail) {
    $trail->push('Portal de comunicación', route('frontend.portal-comunicacion.index'));
    $trail->push('Comunicados');
});

// Breadcrumbs::for('frontend..index', function ($trail) {
// $trail->parent('frontend.iso27001.index');
// $trail->push('', route('frontend..index'));
// });

//##############################################################
//#################### RECURSOS HUMANOS #######################
//############################################################
Breadcrumbs::for('Evaluacion360', function ($trail) {
    $trail->push('RH - Evaluación 360 Grados', route('frontend.rh-evaluacion360.index'));
});

Breadcrumbs::for('EV360-Evaluaciones', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Evaluaciones', route('frontend.ev360-evaluaciones.index'));
});

Breadcrumbs::for('EV360-Evaluaciones-Create', function ($trail) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Crear Evaluación', route('frontend.ev360-evaluaciones.create'));
});

Breadcrumbs::for('EV360-Evaluaciones-Evaluacion', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Evaluación', route('frontend.ev360-evaluaciones.evaluacion', $evaluacion->id));
});

Breadcrumbs::for('EV360-Competencias', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Competencias', route('frontend.ev360-competencias.index'));
});
Breadcrumbs::for('EV360-Competencias-Create', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Crear Competencia', route('frontend.ev360-competencias.create'));
});
Breadcrumbs::for('EV360-Competencias-Edit', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Editar Competencia', '/recursos-humanos/evaluacion-360/evaluaciones/*/evaluacion');
});

Breadcrumbs::for('EV360-Competencias-Por-Puesto', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Competencias por puesto', route('frontend.ev360-competencias-por-puesto.index'));
});
Breadcrumbs::for('EV360-Competencias-Por-Puesto-Create', function ($trail) {
    $trail->parent('EV360-Competencias-Por-Puesto');
    $trail->push('Asignar competencia al puesto', 'recursos-humanos/evaluacion-360/competencias-por-puesto/*/create');
});

Breadcrumbs::for('EV360-Objetivos', function ($trail) {
    $trail->parent('Evaluacion360');
    $trail->push('Objetivos', route('frontend.ev360-objetivos.index'));
});
Breadcrumbs::for('EV360-Objetivos-Create', function ($trail, $empleado) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Asignar Objetivo', route('frontend.ev360-objetivos-empleado.create', $empleado));
});
Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Editar Objetivo', '/recursos-humanos/evaluacion-360/objetivos/*/edit');
});

Breadcrumbs::for('EV360-Evaluacion-Resumen', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion);
    $trail->push($evaluacion->nombre, '/recursos-humanos/evaluacion-360/evaluacion/*/resumen');
});
Breadcrumbs::for('EV360-Evaluacion-Consulta-Evaluado', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push($evaluacion['evaluado']->name, route('frontend.ev360-evaluaciones.autoevaluacion.consulta.evaluado', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id]));
});
Breadcrumbs::for('EV360-Evaluacion-Cuestionario', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push('Cuestionario', route('frontend.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id, 'evaluador' => $evaluacion['evaluador']->id]));
});
// Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
//     $trail->parent('EV360-Objetivos');
//     $trail->push('Editar Objetivo', route('frontend.ev360-objetivos.edit'));
// });
